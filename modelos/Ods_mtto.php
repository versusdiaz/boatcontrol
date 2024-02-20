<?php
require_once("conexion.php");

class Ods_mtto{
    function __construct(){
        
    }
    public static function insertar($idcentro,$codigo,$com_general,$com_estado,$com_falla,$horas,$tipo,$sistema,$tiempo_ino,$tiempo_mtto,$costo,$afectaservicio,$fecha){
        $sql = "INSERT INTO ods_mtto (idcentro,codigo,com_general,com_estado,com_falla,horas,tipo,sistema,tiempo_ino,tiempo_mtto,costo,afectaservicio,fecha,condicion) VALUES ('$idcentro','$codigo','$com_general','$com_estado','$com_falla','$horas','$tipo','$sistema'
        ,'$tiempo_ino','$tiempo_mtto','$costo','$afectaservicio','$fecha',1)";
       $sw = true;
       Consulta($sql) or $sw = false;
       return $sw;
    }
    
    public static function editar($idods_mtto,$idcentro,$codigo,$com_general,$com_estado,$com_falla,$horas,$tipo,$sistema,$tiempo_ino,$tiempo_mtto,$costo,$afectaservicio,$fecha){
        $sql = "UPDATE ods_mtto SET idcentro='$idcentro',codigo='$codigo',com_general='$com_general',com_estado='$com_estado',com_falla='$com_falla',horas='$horas',tipo='$tipo',sistema='$sistema',tiempo_ino='$tiempo_ino',tiempo_mtto='$tiempo_mtto',costo='$costo',afectaservicio='$afectaservicio',fecha='$fecha' WHERE idods_mtto = '$idods_mtto'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function verificarCod($codigo){
        $sql = "SELECT codigo FROM ods_mtto WHERE codigo='$codigo'";
        return Consulta_num($sql); 
    }

    public static function eliminar($idods_mtto){
        $sql = "DELETE FROM ods_mtto WHERE idods_mtto='$idods_mtto'";
        return Consulta($sql);
    }

    public static function act_odsPreventivas($idods_mtto){
        $sql = "SELECT T1.idact_ods,T1.idact,T1.idods_mtto, T2.esplan FROM act_ods AS T1 LEFT JOIN act AS T2 ON T1.idact = T2.idact WHERE idods_mtto='$idods_mtto' AND T2.esplan = 2";   
        return Consulta($sql);
    }


    public static function programaPreventivo($idcentro){
        $sql = "SELECT idprogramas FROM programas WHERE idcentro='$idcentro' AND condicion = 1";
        return ConsultaFila($sql); 
    }

    public static function actProgramas($idprogramas){
        $sql = "SELECT * FROM act_programas WHERE idprogramas='$idprogramas'";
        return Consulta($sql); 
    }

    public static function consultaHoras($idods_mtto){
        $sql = "SELECT horas FROM ods_mtto WHERE idods_mtto='$idods_mtto'";
        return ConsultaFila($sql);
    }

    public static function consultaIntervalos($idact){
        $sql = "SELECT horas FROM act WHERE idact='$idact'";
        return ConsultaFila($sql);
    }

    public static function insertarHorasRealizadas($horasRealizadas,$idact_programas,$idods_mtto){
        $sql = "UPDATE act_programas SET horasrealizadas = '$horasRealizadas', idods_mtto = '$idods_mtto', condicion = 2 WHERE idact_programas = '$idact_programas'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function activar($idrequest_temp){
        $sql = "UPDATE request_temp SET condicion='1' WHERE idrequest_temp='$idrequest_temp'";
        return Consulta($sql);
    }
    
    public static function mostrar($idods_mtto){
        $sql = "SELECT * FROM ods_mtto WHERE idods_mtto='$idods_mtto'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT T1.idods_mtto, T1.codigo, T2.nombre, T1.com_falla, T1.fecha, T1.horas, T1.idcentro FROM ods_mtto AS T1 LEFT JOIN centro AS T2 ON T1.idcentro = T2.idcentro WHERE T1.condicion = 1"; 
        return Consulta($sql);
    }

    public static function listarP($idrequest_temp){
        $sql = "SELECT T1.idact_ods,T1.horasprox, T2.nombre,T3.idods_mtto AS ods FROM act_ods AS T1 LEFT JOIN act AS T2 ON T1.idact = T2.idact LEFT JOIN ods_mtto AS T3 ON T1.idods_mtto = T3.idods_mtto WHERE T1.idods_mtto = $idrequest_temp";
        // $sql = "SELECT T1.adact_ods, T1.detalle, T2.nombre, T1.cantidad, T1.precio FROM request_items_temp AS T1 LEFT JOIN items AS T2 ON T1.iditem = T2.iditems WHERE T1.idrequest_temp = $idrequest_temp";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idrequest_temp, nombre FROM request_temp WHERE condicion=1";
        return Consulta($sql);
    }

    public static function eliminarItem($idact_ods){
        $sql = "DELETE FROM act_ods WHERE idact_ods='$idact_ods'";
        return Consulta($sql);
    }

    public static function insertarItem($idact,$idods_mtto,$horasprox){
        $sql = "INSERT INTO act_ods (idact,idods_mtto,horasprox,condicion) VALUES ('$idact','$idods_mtto','$horasprox',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }

    public static function insertR($idrequest_temp,$dpto,$fecha){
        $sql = "INSERT INTO $dpto (idrequest_temp,fecha) VALUES ('$idrequest_temp','$fecha')";
        return Consulta_retornarID($sql);
    }
    
    public static function updateR($idods_mtto){
        $sql = "UPDATE ods_mtto SET condicion = 2 WHERE idods_mtto = '$idods_mtto'";
        return Consulta($sql);        
    }

    public static function vincular($idrequest_temp){
        $sql = "UPDATE request_temp SET condicion='2' WHERE idrequest_temp='$idrequest_temp'";
        return Consulta($sql);
    }

    // public static function validarAnterior($iddepartamento,$fecha){
    //     $sql = "SELECT idrequest_temp FROM request_temp WHERE fecha < '$fecha' AND iddepartamento = '$iddepartamento' AND condicion != 2";
    //     return Consulta_num($sql);        
    // }

    // public static function validarSiguiente($iddepartamento,$fecha){
    //     $sql = "SELECT idrequest_temp FROM request_temp WHERE fecha > '$fecha' AND iddepartamento = '$iddepartamento' AND condicion = 2";
    //     return Consulta_num($sql);        
    // }

    // public static function validarItem($idrequest_temp){
    //     $sql = "SELECT idrequest_temp FROM request_items_temp WHERE idrequest_temp = '$idrequest_temp'";
    //     return Consulta_num($sql);        
    // }

    public static function propiedadItem($nombreItem){
        $sql = "SELECT servicio FROM items WHERE iditems= '$nombreItem' AND servicio=1";
        return Consulta_num($sql);
    }

    public static function propiedadRequest($idrequest_temp) {
        $sql = "SELECT servicio FROM request_temp WHERE idrequest_temp = '$idrequest_temp' AND servicio=1";
        return Consulta_num($sql);
    }

    public static function mostrarItem($idrequest_temp){
        $sql = "SELECT * FROM request_items_temp WHERE idrequest_temp = '$idrequest_temp'";
        return Consulta($sql);
    }

    public static function insertOC($idrequest_temp,$dpto,$fecha){
        $sql = "INSERT INTO $dpto (idrequest_temp ,fecha, idproveedor) VALUES ('$idrequest_temp','$fecha',1)";
        return Consulta_retornarID($sql);   
    }

    public static function updateOC($idrequest_temp,$dpto,$codigo,$idproveedor){
        $sql = "UPDATE $dpto SET codigo = '$codigo', idproveedor = '$idproveedor' WHERE idrequest_temp = '$idrequest_temp'";
        return Consulta($sql);
    }


}
