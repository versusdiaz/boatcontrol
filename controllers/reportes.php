<?php
session_start();
require_once("../modelos/Reportes.php");
require_once("fpdf/fpdf.php");

$report = new Reportes();

/*INICIALIZO VARIABLES*/

$idcentro=isset($_POST['idcentro'])? limpiarCadena($_POST['idcentro']):"";

$idcentro2=isset($_POST['idcentro2'])? limpiarCadena($_POST['idcentro2']):"";

switch ($_GET["op"]) {
    case 'reporteHistorial':
        if($idcentro != ""){
            require_once("fpdf/config.php");
            // //$dataCentro = $report->mostrarCentro($idcentro);

             $codigo = 'ATM-RG-MT-007';
             $fecha = '22/02/2024';
             $revision = '02';
             $titulo = 'HISTORIAL DE MANTENIMIENTO A EMBARCACIONES';
             $nombreCentro = $report->mostrarCentro($idcentro);
             $dataCentro = $report->dataCentro($idcentro);

            $pdf = new PDF($codigo,$fecha,$revision,$titulo,$nombreCentro['nombre'],$nombreCentro['tag']);
            $pdf->AddPage('L', 'Letter', 0);
            $pdf->SetFillColor(198, 198, 247);

            // GENERO LA TABLA Y RETORNO EL SUBTOTAL
            $pdf->tablaHistorial($dataCentro);

            $pdf->ln();

            $x = $pdf->getX();
            $y = $pdf->getY();

            $pdf->SetXY($x,$y+10);
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY($x,$y+15);
            $pdf->Cell(255,5,'RESUMEN INDICADORES 2024', 'LTRB', 0, 'C',true);
            $pdf->ln();
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(255,5,'DISPONIBILIDAD POR MES % = (TIEMPO TOTAL - TIEMPO INOPERATIVO) / TIEMPO TOTAL ', 'LTRB', 0, 'C');
            $pdf->ln();
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(21,5,'ENERO', 'LTRB', 0, 'C');
            $pdf->Cell(21,5,'FEBRERO', 'LTRB', 0, 'C');
            $pdf->Cell(21,5,'MARZO', 'LTRB', 0, 'C');
            $pdf->Cell(21,5,'ABRIL', 'LTRB', 0, 'C');
            $pdf->Cell(21,5,'MAYO', 'LTRB', 0, 'C');
            $pdf->Cell(21,5,'JUNIO', 'LTRB', 0, 'C');
            $pdf->Cell(21,5,'JULIO', 'LTRB', 0, 'C');
            $pdf->Cell(21,5,'AGOSTO', 'LTRB', 0, 'C');
            $pdf->Cell(21,5,'SEPTIEMBRE', 'LTRB', 0, 'C');
            $pdf->Cell(22,5,'OCTUBRE', 'LTRB', 0, 'C');
            $pdf->Cell(22,5,'NOVIEMBRE', 'LTRB', 0, 'C');
            $pdf->Cell(22,5,'DICIEMBRE', 'LTRB', 0, 'C');

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
    
    case 'controlInterno':
        if($idcentro2 != ""){
            require_once("fpdf/config2.php");

            $codigo = 'ATM-RG-MT-009';
            $fecha = '22/02/2024';
            $revision = '00';
            $titulo = 'SEGUIMIENTO Y CONTROL DEL PROGRAMA DE MANTENIMIENTO PREVENTIVO PARA EMBARCACIONES';
            // Pido los datos de la embarcacion
            $nombreCentro = $report->mostrarCentro($idcentro2);
            
            $dataAct = $report->mostrarAct($idcentro2);

            $pdf = new PDF($codigo,$fecha,$revision,$titulo,$nombreCentro['nombre'],$nombreCentro['tag']);
            $pdf->AddPage('L', 'Letter', 0);
            $pdf->SetFillColor(198, 198, 247);

            $pdf->tablaActividades($dataAct);

            // /*NOMBRE ARCHIVO*/
            $narchivo = 'RQ_'.round(microtime(true));
            
            $pdf->AliasNbPages();
            $pdf->Output('F','../vistas/reportes/controlInterno/'.$narchivo.'.pdf',true);
            $ruta = 'vistas/reportes/controlInterno/'.$narchivo.'.pdf';
            echo $ruta;

        } else {
        echo "No se puede generar el reporte";
        }
    break;

}