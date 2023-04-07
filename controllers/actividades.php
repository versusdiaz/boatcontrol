<?php
session_start();
require_once("../modelos/Actividades.php");

$actividades = new Actividades();

/*INICIALIZO VARIABLES*/

$idact = isset($_POST['idact']) ? limpiarCadena($_POST['idact']): "";

$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$numact = isset($_POST['numact']) ? limpiarCadena($_POST['numact']): "";

$horas = isset($_POST['horas']) ? limpiarCadena($_POST['horas']): "";

$materiales = isset($_POST['materiales']) ? limpiarCadena($_POST['materiales']): "";

$repuestos = isset($_POST['repuestos']) ? limpiarCadena($_POST['repuestos']): "";

$severidad = isset($_POST['severidad']) ? limpiarCadena($_POST['severidad']): "";

$tolerancia = isset($_POST['tolerancia']) ? limpiarCadena($_POST['tolerancia']): "";

/* INICIALIZO EL SWITCH DEL GET */

switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idact)){
                $validacion = $actividades->validarAct($numact);
                if( $validacion == null ){
                    $rspta=$actividades->insertar($nombre,$numact,$horas,$materiales,$repuestos,$severidad,$tolerancia);
                    echo $rspta ? "Actividad registrada con exito":"No se pudieron registrar todos los datos de la Actividad";
                } else {
                    echo "Error ya existe una actividad con el mismo numero";
                }
		}
		else {
            $validacion = $actividades->validarAct($numact);
            if( $validacion == null ){
                $rspta=$actividades->editar($idact,$nombre,$numact,$horas,$materiales,$repuestos,$severidad,$tolerancia);
                echo $rspta ? "Actividad actualizada con exito":"No se pudieron actualizar todos los datos de la Actividad";
            } else {
                echo "Error ya existe una actividad con el mismo numero";
            }
		}
    break;

    case 'listar':
        $rspta = $actividades->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idact.')"><i class="nav-icon icon-pencil" style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idact.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idact.')"><i class="fa fa-times"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idact.')"><i class="nav-icon icon-pencil"  style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idact.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idact.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->nombre,
               "2"=>$reg->numact,
               "3"=>$reg->severidad,
               "4"=>$reg->tolerancia,
               "5"=>($reg->condicion)?'<span class="badge badge-success">Activado</span>':'<span class="badge badge-danger">Desactivado</span>'
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
        $rspta = $actividades->mostrar($idact);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $actividades->desactivar($idact);
      echo $rspta ? "Actividad desactivada": "La Actividad no se puede desactivar";
    break;

    case 'activar':
    $rspta = $actividades->activar($idact);
    echo $rspta ? "Actividad activada": "La Actividad no se puede activar";
    break;
    
    case 'listarc':
    $rspta = $actividades->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idact. '>' .$reg->nombre. '</option>';
        }
    break;

    case 'eliminar':
    $rspta = $actividades->eliminar($idact);
    echo $rspta ? "Actividad eliminada": "La Actividad no se puede eliminar, verifique que no este vinculada a otro ";
    break;
        

}