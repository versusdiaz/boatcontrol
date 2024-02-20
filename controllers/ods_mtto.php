<?php
session_start();
require_once("../modelos/Ods_mtto.php");
require_once("../modelos/Actividades.php");

$ods_mtto = new Ods_mtto();

$actividades = new Actividades();

/*INICIALIZO VARIABLES*/

$idods_mtto=isset($_POST['idods_mtto'])? limpiarCadena($_POST['idods_mtto']):"";

$fecha=isset($_POST['fecha'])? limpiarCadena($_POST['fecha']):"";

$idcentro=isset($_POST['centro'])? limpiarCadena($_POST['centro']):"";

$codigo=isset($_POST['codigo'])? limpiarCadena($_POST['codigo']):"";

$com_general=isset($_POST['com_general'])? limpiarCadena($_POST['com_general']):"";

$com_estado=isset($_POST['com_estado'])? limpiarCadena($_POST['com_estado']):"";

$com_falla=isset($_POST['com_falla'])? limpiarCadena($_POST['com_falla']):"";

$horas=isset($_POST['horas'])? limpiarCadena($_POST['horas']):"";

$tipo=isset($_POST['tipo'])? limpiarCadena($_POST['tipo']):"";

$sistema=isset($_POST['sistema'])? limpiarCadena($_POST['sistema']):"";

$tiempo_ino=isset($_POST['tiempo_ino'])? limpiarCadena($_POST['tiempo_ino']):"";

$tiempo_mtto=isset($_POST['tiempo_mtto'])? limpiarCadena($_POST['tiempo_mtto']):"";

$costo=isset($_POST['costo'])? limpiarCadena($_POST['costo']):"";

$afectaservicio=isset($_POST['afectaservicio'])? limpiarCadena($_POST['afectaservicio']):"";

$horastemp = isset($_POST['horastemp'])? limpiarCadena($_POST['horastemp']):"";

$nombreAct=isset($_POST['nombreAct'])? limpiarCadena($_POST['nombreAct']):"";

$idrequest_tempP=isset($_POST['idrequest_tempP'])? limpiarCadena($_POST['idrequest_tempP']):"";

$idrequest = isset($_GET['idrequest'])? limpiarCadena($_GET['idrequest']):"";

$idrequest_item = isset($_POST['idrequest_item'])? limpiarCadena($_POST['idrequest_item']):"";



switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idods_mtto)){
            $validacion = $ods_mtto->verificarCod($codigo);
            if($validacion == null){
                $rspta=$ods_mtto->insertar($idcentro,$codigo,$com_general,$com_estado,$com_falla,$horas,$tipo,$sistema,$tiempo_ino,$tiempo_mtto,$costo,$afectaservicio,$fecha);
                echo $rspta ? "Orden registrada con exito":"No se pudieron registrar todos los datos de la Orden";
            } else {
                echo "Ya existe una Orden registrada con el mismo numero";
            }
		}
		else {
            $rspta=$ods_mtto->editar($idods_mtto,$idcentro,$codigo,$com_general,$com_estado,$com_falla,$horas,$tipo,$sistema,$tiempo_ino,$tiempo_mtto,$costo,$afectaservicio,$fecha);
			echo $rspta ? "Orden actualizada con exito":"No se pudieron actualizar los datos de la Orden";
		}
    break;

    case 'guardaryeditarP':

             $horas = $actividades->mostrarHoras($nombreAct);
             $horasprox = $horas['horas'] + $horastemp;
             $rspta =$ods_mtto->insertarItem($nombreAct,$idrequest_tempP,$horasprox);
             echo $rspta ? "Actividad cargada con exito":"No se pudieron registrar todas las actividades";

    
break;

    case 'listar':
        $rspta = $ods_mtto->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idods_mtto.')"><i class="nav-icon icon-pencil" style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idods_mtto.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-primary" onclick="mostrarP('.$reg->idods_mtto.','.$reg->horas.')"><i class="fa fa-fire"></i></button> <button class="btn btn-success" onclick="confirmarP('.$reg->idods_mtto.','.$reg->idcentro.')"><i class="fa fa fa-check"></i></button>',
               "1"=>$reg->codigo,
               "2"=>$reg->nombre,
               "3"=>$reg->com_falla,
               "4"=>$reg->fecha,
               "5"=>'<span class="badge badge-dark">Numero: '.$reg->idods_mtto.'</span>'
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
        $rspta = $ods_mtto->mostrar($idods_mtto);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $ods_mtto->desactivar($idods_mtto);
      echo $rspta ? "Item desactivado": "El Item no se puede desactivar";
    break;

    case 'activar':
    $rspta = $ods_mtto->activar($idods_mtto);
    echo $rspta ? "Item activado": "El Item no se puede activar";
    break;
    
    case 'listarc':
    $rspta = $ods_mtto->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idods_mtto. '>' .$reg->nombre. '</option>';
        }
    break;

    case 'eliminar':
    $rspta = $ods_mtto->eliminar($idods_mtto);
    echo $rspta ? "Orden eliminada": "La Orden no se puede eliminar, verifique que no tenga actividades asociadas";
    break;

    case 'eliminarItem':
    $rspta = $ods_mtto->eliminarItem($idrequest_item);
    echo $rspta ? "Item eliminado": "El Item no se puede eliminar, verifique que no este vinculado";
    break;

    case 'listarP':
    $rspta = $ods_mtto->listarP($idrequest);
    $data = Array();
    while($reg = $rspta->fetch_object()){
       $data[]=array(
           "0"=>'<button class="btn btn-danger" onclick="eliminarItem('.$reg->idact_ods.')"><i class="fa fa-trash"></i></button>',
           "1"=>$reg->nombre,
           "2"=>$reg->horasprox
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

    case 'confirmarP':

        if($idods_mtto){
             // Consulto arreglo de las act de la ods que son preventivas 
            $rspta2 = $ods_mtto->act_odsPreventivas($idods_mtto);
            if ($rspta2 != null){
                // Consulto ID del programa preventivo que voy a editar
                $rspta3 = $ods_mtto->programaPreventivo($idcentro);
                //Consulto el arreglo de las act Preventivas de ese programa.
                $rspta4 = $ods_mtto->actProgramas($rspta3['idprogramas']);
                // Dame las horas de la ODS.
                $horasactuales = $ods_mtto->consultaHoras($idods_mtto);
 
            foreach($rspta4 as $item){
                foreach($rspta2 as $item2){
                    if($item['idact'] === $item2['idact'] ){
                        // Ahora calcula las horas donde se realizaron
                        $horasRealizadas = $horasactuales['horas'];
                        // Inserto las horas 
                        $ods_mtto->insertarHorasRealizadas($horasRealizadas,$item['idact_programas'],$idods_mtto);
                    }
                }
            }
            
            $rspta = $ods_mtto->updateR($idods_mtto);
            echo $rspta ? "Orden Almacenada": "Orden no se puede almacenar";

            } else {
                $rspta = $ods_mtto->updateR($idods_mtto);
                echo $rspta ? "Orden Almacenada": "Orden no se puede almacenar";
            }

        } else {
           echo $rspta = 'Error al registrar la Orden falta ID'; 
        }

        
    break;        

}
