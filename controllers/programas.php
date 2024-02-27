<?php
session_start();
require_once("../modelos/Programas.php");

$programas = new Programas();

/*INICIALIZO VARIABLES*/

$idprogramas = isset($_POST['idprogramas']) ? limpiarCadena($_POST['idprogramas']): "";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$idcentro=isset($_POST["centro"])? limpiarCadena($_POST["centro"]):"";

$horasinicio=isset($_POST["horasinicio"])? limpiarCadena($_POST["horasinicio"]):"";

$fechainicio=isset($_POST["fechainicio"])? limpiarCadena($_POST["fechainicio"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idprogramas)){
            $validacionPlan= $programas->consultaPlanActivo($idcentro);
            if($validacionPlan == null){
            // Inserto y obtengo el numero del programa y almaceno en rspta
            $rspta=$programas->insertarID($idcentro, $horasinicio, $fechainicio);
            // Obtengo arreglo de actividades del plan 

            $rspta2 = $programas->consultaActPreventivas();
            while ($reg = $rspta2->fetch_object())
            {
                // Saco una a una las actividades y voy guardando junto a su programa
                $idact = $reg->idact;
                $horasplan = $horasinicio + $reg->horas;
                // Inserto act uno a uno
                $rspta3 = $programas->insertarAct($idact,$rspta,$horasplan);
            }            
             echo $rspta ? "Programa registrado con exito":"No se pudieron registrar todos los datos del programa";
            } else {
              echo $rspta = "Existe un programa abierto para esta embarcacion todavia";  
            }
            
		}
		else {
            $rspta=$programas->editar($idprogramas,$nombre);
			echo $rspta ? "Programa actualizado con exito":"No se pudieron actualizar los datos del programa";
		}
    break;

    case 'listar':
        $rspta = $programas->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idprogramas.')"><i class="nav-icon icon-pencil" style="color:white" ></i></button> <button class="btn btn-primary" onclick="mostrarPlan('.$reg->idprogramas.')"><i class="nav-icon icon-calendar" style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idprogramas.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-success" onclick="desactivar('.$reg->idprogramas.','.$reg->idcentro.')"><i class="fa fa-lock"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idprogramas.')"><i class="nav-icon icon-pencil"  style="color:white" ></i></button> <button class="btn btn-primary" onclick="mostrarPlan('.$reg->idprogramas.')"><i class="nav-icon icon-calendar" style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idprogramas.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idprogramas.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->nombre,
               "2"=>$reg->fechainicio,
               "3"=>$reg->horasinicio,
               "4"=>($reg->condicion)?'<span class="badge badge-success">Activado</span>':'<span class="badge badge-danger">Desactivado</span>'
           );
        }
        /*CARGAMOS LA DATA EN LA VARIABLE USADA PARA EL DATATABLE*/
        $results = array(
 			"sEcho"=>1, //Informacion para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
        echo json_encode($results);
    break;

    case 'mostrar':
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        $rspta = $programas->mostrar($idprogramas);
        echo json_encode($rspta);
    break;

    case 'mostrarPlan':
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        $rspta = $programas->mostrarPlan($idprogramas);
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>"Actividad: ".$reg->nombre." \n ",
               "1"=>"Horas Planificadas: ".$reg->horasplan." \n ",
               "2"=>($reg->horasrealizadas == 0 ? "Horas Ejecutadas: Pendientes  \n" : "Horas Ejecutadas: ".$reg->horasrealizadas." \n "),
               "3"=>$resultado = ($reg->condicion == 1 ? 'Status: Pendiente' : ($reg->condicion == 2 ? 'Status: Ejecutado' : 'Otro resultado'))
           );
        }
        echo json_encode($data);
    break;


    case 'desactivar':

     // Debo buscar las horas actuales de la embarcacion para iniciar el programa nuevo, lo buscare dentro de todas las ODS.
       $horasActuales = $programas->horasActuales($idcentro);
       $fecha = date("Y-m-d");
       //Ahora creo un nuevo programa e inserto las actividades nuevas.
       $idNuevoPrograma=$programas->insertarID($idcentro, $horasActuales['horas'], $fecha);

       // Reviso las actividades ejecutadas.
       $rpsta2 = $programas->actProgramadas($idprogramas); 
       $item = array();

       // Recorro el arreglo de las actividades ejecutadas y creo las nuevas horoas

       foreach ($rpsta2 as $item) {
        if($item['condicion'] > 1 ){
            // Sumo las horas realizadas con las horas de la actividad ojo es el mismo arreglo
            $item ['horasrealizadas'] = $item['horasrealizadas'] + $item['horas'];
        } else {
            // Validar que haya alcanzado las horas.
            $item['horasrealizadas'] = $item['horasplan'];
        }
        $programas->insertarAct($item['idact'],$idNuevoPrograma,$item['horasrealizadas']);
       }

        // DESACTIVO EL PROGRAMA VIEJO Y LO DOY POR CERRADO
      $rspta = $programas->desactivar($idprogramas);
      echo $rspta ? "Programa guardado": "El programa no se puede guardar";


    break;

    case 'activar':
    $rspta = $programas->activar($idprogramas);
    echo $rspta ? "Embarcacion activada": "La embarcacion no se puede activar";
    break;
    
    case 'listarc':
    $rspta = $programas->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idprogramas. '>' .$reg->nombre. '</option>';
        }
    break;

    case 'eliminar':
    $rspta = $programas->eliminar($idprogramas);
    echo $rspta ? "Programa eliminado": "El programa no se puede eliminar, verifique que no este vinculada a otro ";
    break;
        

}
