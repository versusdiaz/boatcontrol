<?php
require_once('conexion.php');

class VerAlert{
    function __construct(){

    }

    public static function verProgramas(){
        $sql = "SELECT T1.nombre, T1.idcentro,T1.horasactual, T2.idprogramas FROM centro AS T1 LEFT JOIN programas AS T2 ON T1.idcentro = T2.idcentro WHERE T1.condicion = 1 AND T2.condicion = 1;";
        return Consulta($sql);
    }

    public static function verActProgramas($idprogramas){
        $sql ="SELECT T1.horasplan,T1.horasrealizadas, T2.nombre FROM act_programas AS T1 LEFT JOIN act AS T2 ON T1.idact = T2.idact WHERE idprogramas = '$idprogramas'";
        return Consulta($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM centro";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idcentro, nombre FROM centro WHERE condicion=1";
        return Consulta($sql);
    }

    public static function eliminar($idcentro){
        $sql = "DELETE FROM centro WHERE idcentro='$idcentro'";
        return Consulta($sql);
    }

    public static function horas($idcentro,$horas){
        $sql = "UPDATE centro SET horasactual = '$horas' WHERE idcentro = '$idcentro'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }


}