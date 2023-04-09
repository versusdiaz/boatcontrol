<?php
session_start();
require_once("../modelos/Ods_mtto.php");

$ods_mtto = new Ods_mtto();

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



$idrequest = isset($_GET['idrequest'])? limpiarCadena($_GET['idrequest']):"";

$idrequest_item = isset($_POST['idrequest_item'])? limpiarCadena($_POST['idrequest_item']):"";



switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idods_mtto)){
            $rspta=$ods_mtto->insertar($idcentro,$codigo,$com_general,$com_estado,$com_falla,$horas,$tipo,$sistema,$tiempo_ino,$tiempo_mtto,$costo,$afectaservicio,$fecha);
            echo $rspta ? "Orden registrada con exito":"No se pudieron registrar todos los datos de la Orden";
		}
		else {
            $rspta=$ods_mtto->editar($idods_mtto,$idusuario,$iddepartamento,$idcentro,$comentario,$responsable,$supervisor,$prioridad,$calidad,$mantenimiento,$fecha,$servicio,$stock);
			echo $rspta ? "Requisicion actualizada con exito":"No se pudieron actualizar los datos de la requisicion";
		}
    break;

    case 'guardaryeditarP':
        $validarItem = $ods_mtto->propiedadItem($nombreItem);
        $validarRequest = $ods_mtto->propiedadRequest($idrequest_tempP);
        if( $validarItem == $validarRequest ){
            $rspta =$ods_mtto->insertarItem($idrequest_tempP,$detalle,$nombreItem,$cantidad,$precio);
            echo $rspta ? "Item cargado con exito":"No se pudieron registrar todos los item de la Requisicion";
          } else {
             echo 'Error el Item y el tipo de Requisicion no coinciden';
          }
break;

    case 'listar':
        $rspta = $ods_mtto->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idrequest_temp.')"><i class="nav-icon icon-pencil" style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idrequest_temp.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-primary" onclick="mostrarP('.$reg->idrequest_temp.')"><i class="fa fa-cart-arrow-down"></i></button> <button class="btn btn-success" onclick="confirmarP('.$reg->idrequest_temp.')"><i class="fa fa fa-check"></i></button>',
               "1"=>$reg->depto,
               "2"=>$reg->buque,
               "3"=>$reg->usuario,
               "4"=>$reg->fecha,
               "5"=>'<span class="badge badge-dark">Numero: '.$reg->idrequest_temp.'</span>'
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
            echo '<option value=' .$reg->idrequest_temp. '>' .$reg->nombre. '</option>';
        }
    break;

    case 'eliminar':
    $rspta = $ods_mtto->eliminar($idods_mtto);
    echo $rspta ? "Requisicion eliminada": "La Requisicion no se puede eliminar, verifique que no este vinculada";
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
           "0"=>'<button class="btn btn-danger" onclick="eliminarItem('.$reg->idrequest_items_temp.')"><i class="fa fa-trash"></i></button>',
           "1"=>($reg->detalle) ? $reg->nombre.' '.$reg->detalle : $reg->nombre,
           "2"=>$reg->cantidad,
           "3"=>$reg->precio
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
    $rspta = $ods_mtto->mostrarObj($idods_mtto);
    while($reg = $rspta->fetch_object() ){
        switch ($reg->iddepartamento) {
            case 1:
                # MTTO
                $dpto = 'request_mtto';
                $dptoOC = 'odc_mtto';
                $codigo = '';
                $codigoOC = '';
                $validarFecha = $ods_mtto->validarAnterior($reg->iddepartamento,$reg->fecha);
                $validarFecha2 = $ods_mtto->validarSiguiente($reg->iddepartamento,$reg->fecha);
                if( $validarFecha == 0 && $validarFecha2 == 0 ){

                    $rspta2 = $ods_mtto->insertR($reg->idrequest_temp,$dpto,$reg->fecha);
                    // $rspta5 = $ods_mtto->insertOC($reg->idrequest_temp,$dptoOC,$reg->fecha);

                    if( $rspta2 != "0" ){
                        if( $rspta2 < 10 ){
                            $codigo = 'RQ/GGO/MT-00'.$rspta2; /* AGREGAR IF DE 00 */
                        } else if ( $rspta2 < 100 ){
                            $codigo = 'RQ/GGO/MT-0'.$rspta2; /* AGREGAR IF DE 00 */
                        } else {
                            $codigo = 'RQ/GGO/MT-'.$rspta2; /* AGREGAR IF DE 00 */
                        }

                        //if( $rspta5 < 10 ){
                        //    $codigoOC = 'OC/GGO/MT-00'.$rspta2; /* AGREGAR IF DE 00 */
                        // } else if ( $rspta2 < 100 ){
                        //    $codigoOC = 'OC/GGO/MT-0'.$rspta2; /* AGREGAR IF DE 00 */
                        // } else {
                        //    $codigoOC = 'OC/GGO/MT-'.$rspta2; /* AGREGAR IF DE 00 */
                        // }

                        $rspta3 = $ods_mtto->updateR($reg->idrequest_temp,$dpto,$codigo);
                        // $rspta6 = $ods_mtto->updateOC($reg->idrequest_temp,$dptoOC,$codigoOC,1);
                        $rspta4 = $ods_mtto->vincular($reg->idrequest_temp);

                        echo $rspta3 ? "Requisicion almacenada": "Requisicion no se puede almacenar";
                        break;
                       
                    } else {
                        echo 'Error al insertar requisicion ya existe';
                    }
                } else {
                    echo 'Error existe una requisicion pendiente para la fecha';
                }
                 break;
            
            case 2:
                # OPERACIONES
                $dpto = 'request_op';
                $dptoOC = 'odc_op';
                $codigo = '';
                $codigoOC = '';
                $validarFecha = $ods_mtto->validarAnterior($reg->iddepartamento,$reg->fecha);
                $validarFecha2 = $ods_mtto->validarSiguiente($reg->iddepartamento,$reg->fecha);
                if( $validarFecha == 0 && $validarFecha2 == 0 ){

                    $validarItem = $ods_mtto->validarItem($reg->idrequest_temp);

                    if( $validarItem != 0 ){

                        $rspta2 = $ods_mtto->insertR($reg->idrequest_temp,$dpto,$reg->fecha);
                        $rspta5 = $ods_mtto->insertOC($reg->idrequest_temp,$dptoOC,$reg->fecha);
    
                        if( $rspta2 != "0" ){
                            if( $rspta2 < 10 ){
                                $codigo = 'RQ/GGO/OP-00'.$rspta2; /* AGREGAR IF DE 00 */
                            } else if ( $rspta2 < 100 ){
                                $codigo = 'RQ/GGO/OP-0'.$rspta2; /* AGREGAR IF DE 00 */
                            } else {
                                $codigo = 'RQ/GGO/OP-'.$rspta2; /* AGREGAR IF DE 00 */
                            }
    
                            if( $rspta5 < 10 ){
                                $codigoOC = 'OC/GGO/OP-00'.$rspta2; /* AGREGAR IF DE 00 */
                            } else if ( $rspta2 < 100 ){
                                $codigoOC = 'OC/GGO/OP-0'.$rspta2; /* AGREGAR IF DE 00 */
                            } else {
                                $codigoOC = 'OC/GGO/OP-'.$rspta2; /* AGREGAR IF DE 00 */
                            }
    
                            $rspta3 = $ods_mtto->updateR($reg->idrequest_temp,$dpto,$codigo);
                            $rspta6 = $ods_mtto->updateOC($reg->idrequest_temp,$dptoOC,$codigoOC,1);
                            $rspta4 = $ods_mtto->vincular($reg->idrequest_temp);
    
                            echo $rspta3 ? "Requisicion almacenada": "Requisicion no se puede almacenar";
                            break;
                           
                        } else {
                            echo 'Error al insertar requisicion ya existe';
                        }

                    } else {
                        echo 'Error esta requisicion no tiene items asociados';
                    }

                } else {
                    echo 'Error existe una requisicion pendiente para la fecha';
                }
                 break;
        
            case 3:
                # ALMACEN
                $dpto = 'request_al';
                $dptoOC = 'odc_al';
                $codigo = '';
                $codigoOC = '';
                $validarFecha = $ods_mtto->validarAnterior($reg->iddepartamento,$reg->fecha);
                $validarFecha2 = $ods_mtto->validarSiguiente($reg->iddepartamento,$reg->fecha);
                if( $validarFecha == 0 && $validarFecha2 == 0 ){
 
                     $validarItem = $ods_mtto->validarItem($reg->idrequest_temp);
 
                     if( $validarItem != 0 ){
 
                         $rspta2 = $ods_mtto->insertR($reg->idrequest_temp,$dpto,$reg->fecha);
                         $rspta5 = $ods_mtto->insertOC($reg->idrequest_temp,$dptoOC,$reg->fecha);
     
                         if( $rspta2 != "0" ){
                             if( $rspta2 < 10 ){
                                 $codigo = 'RQ/GGO/AL-00'.$rspta2; /* AGREGAR IF DE 00 */
                             } else if ( $rspta2 < 100 ){
                                 $codigo = 'RQ/GGO/AL-0'.$rspta2; /* AGREGAR IF DE 00 */
                             } else {
                                 $codigo = 'RQ/GGO/AL-'.$rspta2; /* AGREGAR IF DE 00 */
                             }
     
                             if( $rspta5 < 10 ){
                                 $codigoOC = 'OC/GGO/AL-00'.$rspta2; /* AGREGAR IF DE 00 */
                             } else if ( $rspta2 < 100 ){
                                 $codigoOC = 'OC/GGO/AL-0'.$rspta2; /* AGREGAR IF DE 00 */
                             } else {
                                 $codigoOC = 'OC/GGO/AL-'.$rspta2; /* AGREGAR IF DE 00 */
                             }
     
                             $rspta3 = $ods_mtto->updateR($reg->idrequest_temp,$dpto,$codigo);
                             $rspta6 = $ods_mtto->updateOC($reg->idrequest_temp,$dptoOC,$codigoOC,1);
                             $rspta4 = $ods_mtto->vincular($reg->idrequest_temp);
     
                             echo $rspta3 ? "Requisicion almacenada": "Requisicion no se puede almacenar";
                             break;
                            
                         } else {
                             echo 'Error al insertar requisicion ya existe';
                         }
 
                     } else {
                         echo 'Error esta requisicion no tiene items asociados';
                     }
 
                 } else {
                     echo 'Error existe una requisicion pendiente para la fecha';
                 }
                  break;
        }
    }

    break;        

}
