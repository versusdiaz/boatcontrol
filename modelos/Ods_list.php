<?php
require_once("conexion.php");

class Ods_list{
    function __construct(){
        
    } 

    public static function activar($idods_mtto){
        $sql = "UPDATE ods_mtto SET condicion='1' WHERE idods_mtto='$idods_mtto'";
        return Consulta($sql);
    }
    
    public static function listar(){
        $sql = "SELECT T1.idods_mtto, T1.codigo, T2.nombre, T1.com_falla, T1.fecha, T1.horas FROM ods_mtto AS T1 LEFT JOIN centro AS T2 ON T1.idcentro = T2.idcentro WHERE T1.condicion = 2"; 
        return Consulta($sql);
    }

}
