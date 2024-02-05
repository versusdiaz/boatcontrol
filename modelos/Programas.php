<?php
require_once('conexion.php');

class Programas{
    function __construct(){

    }
    public static function insertar($idcentro, $horasinicio, $fechainicio){
        $sql = "INSERT INTO programas (idcentro,horasinicio, fechainicio, condicion) VALUES ('$idcentro','$horasinicio','$fechainicio',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    public static function editar($idcentro,$nombre){
        $sql = "UPDATE centro SET nombre = '$nombre' WHERE idcentro = '$idcentro'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    public static function desactivar($idprogramas){
        $sql = "UPDATE programas SET condicion='0' WHERE idprogramas='$idprogramas'";
        return Consulta($sql);
    }
    
    public static function activar($idcentro){
        $sql = "UPDATE centro SET condicion='1' WHERE idcentro='$idcentro'";
        return Consulta($sql);
    }
    
    public static function mostrar($idprogramas){
        $sql = "SELECT * FROM programas WHERE idprogramas='$idprogramas'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT T1.idprogramas, T1.idcentro, T2.nombre, T1.horasinicio, T1.fechainicio, T1.condicion FROM programas AS T1 LEFT JOIN centro AS T2 ON T1.idcentro = T2.idcentro WHERE T2.condicion = 1 AND T1.condicion= 1";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idcentro, nombre FROM centro WHERE condicion=1";
        return Consulta($sql);
    }

    public static function eliminar($idprogramas){
        $sql = "DELETE FROM programas WHERE idprogramas='$idprogramas'";
        return Consulta($sql);
    }

    public static function consultaPlanActivo($idcentro){
        $sql = "SELECT * FROM programas WHERE idcentro='$idcentro' AND condicion=1";
        return ConsultaFila($sql);
    }

    public static function insertarID($idcentro, $horasinicio, $fechainicio){
        $sql = "INSERT INTO programas (idcentro,horasinicio, fechainicio, condicion) VALUES ('$idcentro','$horasinicio','$fechainicio',1)";
        return Consulta_retornarID($sql);
    }
    
    public static function consultaActPreventivas(){
        $sql = "SELECT * FROM act WHERE esplan= 2 ORDER BY numact ASC";
        return Consulta($sql);
    }

    public static function insertarAct($idact,$idprogramas,$horasplan){
        $sql = "INSERT INTO act_programas (idact,idprogramas, horasplan, condicion) VALUES ('$idact','$idprogramas','$horasplan',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sql;
    }
}