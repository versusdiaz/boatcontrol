<?php
require_once('conexion.php');

class Actividades{
    function __construct(){

    }

    public static function insertar($nombre,$numact,$horas,$materiales,$repuestos,$severidad,$tolerancia){
        $sql = "INSERT INTO act (nombre, numact, horas, materiales, repuestos, severidad, tolerancia, condicion) VALUES ('$nombre','$numact','$horas','$materiales','$repuestos','$severidad','$tolerancia',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    public static function editar($idact,$nombre,$numact,$horas,$materiales,$repuestos,$severidad,$tolerancia){
        $sql = "UPDATE act SET nombre = '$nombre', numact = '$numact', horas = '$horas', materiales = '$materiales', repuestos = '$repuestos', severidad = '$severidad', tolerancia = '$tolerancia' WHERE idact = '$idact'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    public static function desactivar($idact){
        $sql = "UPDATE act SET condicion='0' WHERE idact='$idact'";
        return Consulta($sql);
    }
    
    public static function activar($idact){
        $sql = "UPDATE act SET condicion='1' WHERE idact='$idact'";
        return Consulta($sql);
    }
    
    public static function mostrar($idact){
        $sql = "SELECT * FROM act WHERE idact='$idact'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM act";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idact, nombre FROM act WHERE condicion=1";
        return Consulta($sql);
    }

    public static function eliminar($idact){
        $sql = "DELETE FROM act WHERE idact='$idact'";
        return Consulta($sql);
    }

    public static function validarAct($numact){
        $sql = "SELECT numact FROM act WHERE numact='$numact'";
        return Consulta_num($sql); 
    }

}