<?php
session_start();
require_once("../modelos/Reportes.php");
require_once("fpdf/fpdf.php");

$report = new Reportes();

/*INICIALIZO VARIABLES*/

$idcentro=isset($_POST['idcentro'])? limpiarCadena($_POST['idcentro']):"";

switch ($_GET["op"]) {
    case 'reporteHistorial':
        if($idcentro != ""){
            require_once("fpdf/config.php");
            // //$dataCentro = $report->mostrarCentro($idcentro);

             $codigo = 'ATM-RG-MT-007';
             $fecha = '30/12/2021';
             $revision = '00';
             $titulo = 'HISTORIAL DE MANTENIMIENTO A EMBARCACIONES';
             $nombreCentro = $report->mostrarCentro($idcentro);
             $dataCentro = $report->dataCentro($idcentro);

            $pdf = new PDF($codigo,$fecha,$revision,$titulo,$nombreCentro['nombre']);
            $pdf->AddPage('L', 'Letter', 0);
            $pdf->SetFillColor(198, 198, 247);

            // GENERO LA TABLA Y RETORNO EL SUBTOTAL
            $pdf->tablaHistorial($dataCentro);

            $pdf->ln();

            $x = $pdf->getX();
            $y = $pdf->getY();

            $pdf->SetXY($x,$y+10);
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(255,5,'RESUMEN INDICADORES 2023', 'LTRB', 0, 'C');
            $pdf->ln();

            $pdf->tablaIndicador($dataCentro);

            // /*NOMBRE ARCHIVO*/
            $narchivo = 'RQ_'.round(microtime(true));
            
            $pdf->AliasNbPages();
            $pdf->Output('F','../vistas/reportes/historial/'.$narchivo.'.pdf',true);
            $ruta = 'vistas/reportes/historial/'.$narchivo.'.pdf';
            echo $ruta;
            

        } else {
            echo "No se puede generar el reporte";
        }
    break;
    
}