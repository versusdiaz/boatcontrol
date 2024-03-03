<?php
class EnlacesModels{

    public function __construct() { }

    public static function enlacesModels($enlaces){
        if($enlaces == "centro" ||
           $enlaces == "reportes" ||
           $enlaces == "ods_list" ||
           $enlaces == "ods_mtto" ||
           $enlaces == "programas" ||
           $enlaces == "veralert" ||
           $enlaces == "actividades" ||
           $enlaces == "escritorio" ){
            /* MODULO A CARGAR SERA */
            $module = "vistas/modulos/".$enlaces.".php";

        } else if ($enlaces == "index") {
            $module = "vistas/modulos/escritorio.php";
        } else if ($enlaces == "admin") {
            // $module = "admin/";
            // Este sistema no maneja modulo admin
            $module = "vistas/modulos/inicio.php";
        } else {
          $module = "vistas/modulos/inicio.php";
        }
        return $module; 
    }
}

