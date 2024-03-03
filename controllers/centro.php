<?php
session_start();
require_once("../modelos/Centro.php");

$centro = new Centro();

/*INICIALIZO VARIABLES*/

$idcentro = isset($_POST['idcentro']) ? limpiarCadena($_POST['idcentro']): "";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$horas=isset($_POST["horas"])? limpiarCadena($_POST["horas"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idcentro)){
            $rspta=$centro->insertar($nombre);
            echo $rspta ? "Embarcacion registrada con exito":"No se pudieron registrar todos los datos de la embarcacion";
		}
		else {
            $rspta=$centro->editar($idcentro,$nombre);
			echo $rspta ? "Embarcacion actualizada con exito":"No se pudieron actualizar los datos de la embarcacion";
		}
    break;

    case 'listar':
        $rspta = $centro->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcentro.')"><i class="nav-icon icon-pencil" style="color:white" ></i></button> <button class="btn btn-primary" onclick="horas('.$reg->idcentro.')"><i class="nav-icon icon-clock" style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idcentro.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-secondary" onclick="desactivar('.$reg->idcentro.')"><i class="fa fa-times"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idcentro.')"><i class="nav-icon icon-pencil"  style="color:white" ></i></button> <button class="btn btn-primary" onclick="horas('.$reg->idcentro.')"><i class="nav-icon icon-clock" style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idcentro.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idcentro.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->nombre,
               "2"=>$reg->horasactual,
               "3"=>($reg->condicion)?'<span class="badge badge-success">Activado</span>':'<span class="badge badge-danger">Desactivado</span>'
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
        $rspta = $centro->mostrar($idcentro);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $centro->desactivar($idcentro);
      echo $rspta ? "Embarcacion desactivada": "La embarcacion no se puede desactivar";
    break;

    case 'activar':
    $rspta = $centro->activar($idcentro);
    echo $rspta ? "Embarcacion activada": "La embarcacion no se puede activar";
    break;
    
    case 'listarc':
    $rspta = $centro->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idcentro. '>' .$reg->nombre. '</option>';
        }
    break;

    case 'eliminar':
    $rspta = $centro->eliminar($idcentro);
    echo $rspta ? "Embarcacion eliminada": "La embarcacion no se puede eliminar, verifique que no este vinculada a otro ";
    break;
    
    case 'horas':
        $rspta = $centro->horasActuales($idcentro);
        if ($horas >= $rspta['horasactual']){
            $rspta2 = $centro->horas($idcentro,$horas);
            echo $rspta2 ? "Horas actualizadas": "Las horas no se pudieron actualizar";
        } else {
            // Nota se tiene que modificar las HRS desde la base de datos en caso de que se cambien los motores
            echo 'No se pudieron actualizar las horas por ser menores a las registradas';
        }
    break;

}