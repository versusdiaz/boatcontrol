<?php
session_start();
require_once("../modelos/Ods_list.php");

$ods_list = new Ods_list();

/*INICIALIZO VARIABLES*/

$idods_mtto=isset($_POST['idods_mtto'])? limpiarCadena($_POST['idods_mtto']):"";

switch ($_GET["op"]){

    case 'listar':
        $rspta = $ods_list->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>'</button> <button class="btn btn-dark" onclick="convertirOds('.$reg->idods_mtto.')"><i class="fa fa fa-check"></i></button>',
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

    case 'convertirOds':
    $rspta = $ods_list->activar($idods_mtto);
    echo $rspta ? "Ods disponible para modificar": "Ods no se puede activar";
    break;


}
