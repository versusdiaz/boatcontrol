<?php
require_once("global.php");
$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
mysqli_query($conn,'SET NAMES "'.DB_ENCODE.'"');
/*COMPROBAMOS ERRORES*/
if(mysqli_connect_errno()){
  printf("Error en la conexion a la base de datos: %s\n",mysqli_connect_error());
  exit();
}