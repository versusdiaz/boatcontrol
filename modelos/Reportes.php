<?php
require_once("conexion.php");

class Reportes{
    function __construct(){
        
    }

    public static function dataCentro($idcentro){
        $sql = "SELECT T1.idods_mtto, T1.codigo, T1.com_general, T2.nombre, T1.sistema, T1.com_estado, T1.tipo, T1.com_falla, T1.fecha, T1.horas, T1.afectaservicio, T1.costo, T1.tiempo_ino, T1.tiempo_mtto FROM ods_mtto AS T1 LEFT JOIN centro AS T2 ON T1.idcentro = T2.idcentro WHERE T1.idcentro = $idcentro ORDER BY idods_mtto DESC";
        return Consulta($sql);
    }

    public static function mostrarCentro($idcentro){
        $sql = "SELECT * FROM centro WHERE idcentro = $idcentro";
        return ConsultaFila($sql);
    }

    public static function mostrarRequest($idrequest_temp){
        $sql = "SELECT T1.comentario, T2.nombre, T1.responsable, T1.supervisor, T1.fecha, T1.prioridad, T1.calidad, T1.mantenimiento, T1.servicio, T1.stock, T3.nombre AS dpto FROM request_temp AS T1 LEFT JOIN centro AS T2 ON T2.idcentro = T1.idcentro LEFT JOIN departamento AS T3 ON T1.iddepartamento = T3.iddepartamento  WHERE idrequest_temp = $idrequest_temp";
        return ConsultaFila($sql);
    }

    public static function numReq($idrequest_temp, $bdDepartamento){
        $sql = "SELECT codigo FROM $bdDepartamento WHERE idrequest_temp = $idrequest_temp";
        return ConsultaFila($sql);
    }

    public static function mostrarOC($idodc,$bdDepartamento,$bdReq){
        $sql = "SELECT T1.codigo, T1.cotizacion, T1.fecha, T2.nombre, T3.codigo FROM $bdDepartamento AS T1 LEFT JOIN proveedores AS T2 ON T1.idproveedor = T2.idproveedor LEFT JOIN $bdReq AS T3 ON T1.idrequest_temp = T3.idrequest_temp WHERE idodc = $idodc";
        return ConsultaFila($sql);
    }

    public static function mostrarPCS($idpcs){
        $sql = "SELECT T1.codigo, T1.fecha, T2.nombre, T2.nfiscal, T2.direccion, T2.telefono FROM pcs AS T1 LEFT JOIN proveedores AS T2 ON T1.idproveedor = T2.idproveedor WHERE idpcs = $idpcs";
        return ConsultaFila($sql);
    }

}
