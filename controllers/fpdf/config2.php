<?php
            /*CONST DE LA TABLA*/
            class PDF extends FPDF{
            
            private $codigo = '';
            private $fecha = '';
            private $revision = '';
            private $titulo = '';
            private $nombre = '';
            private $tag = '';

            function __construct($codigo,$fecha,$revision,$titulo,$nombre,$tag){
                parent::__construct();

                $this->codigo = $codigo;
                $this->fecha = $fecha;
                $this->titulo = $titulo;
                $this->revision = $revision;
                $this->nombre = $nombre;
                $this->tag = $tag;

            }

            function check_fecha($fecha_inicio, $fecha_fin, $fecha){

                $fecha_inicio = strtotime($fecha_inicio);
                $fecha_fin = strtotime($fecha_fin);
                $fecha = strtotime($fecha);
           
                if(($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {
           
                    return true;
           
                } else {
           
                    return false;
           
                }
            }

            /*HEADER UNIVERSAL*/    
            function Header()
            {
                $X=5;
                $Y=5;
                // FIJAMOS EL COLOR PARA TODOS LOS RELLENOS
                $this->SetFillColor(198, 198, 247);
                $this->Image('../vistas/img/logoatm.png',15,18,25,19);
                if( $this->codigo != '' ){
                $this->SetXY(10,18);
                $this->SetFont('Arial','',14);
                $this->Cell(35,20, utf8_decode("   "), 1, 0, 'C');
                    
    
                $this->SetXY(45,18);
                $this->SetFont('Arial','',14);
                $this->Cell(220,20, utf8_decode("SISTEMA DE GESTIÓN DE LA CALIDAD           "), 1, 0, 'C');
    
                $this->SetXY(229,18);
                $this->SetFont('Arial','',8);
                $this->Cell(16,5,'CODIGO', 1, 0, 'C',true);
                $this->SetXY(245,18);
                $this->SetFont('Arial','',6);
                $this->Cell(20,5, $this->codigo , 1, 0, 'C');
                    
                $this->SetXY(229,23);
                $this->SetFont('Arial','',8);
                $this->Cell(16,5,'FECHA', 1, 0, 'C',true);
                $this->SetXY(245,23);
                $this->SetFont('Arial','',6);
                $this->Cell(20,5, $this->fecha, 1, 0, 'C');
                    
                $this->SetXY(229,28);
                $this->SetFont('Arial','',8);
                $this->Cell(16,5,utf8_decode('REVISION'), 1, 0, 'C',true);
                $this->SetXY(245,28);
                $this->SetFont('Arial','',6);
                $this->Cell(20,5, $this->revision , 1, 0, 'C');
                    
                $this->SetXY(229,33);
                $this->SetFont('Arial','',8);
                $this->Cell(16,5,'PAGINA', 1, 0, 'C',true);
                $this->SetXY(245,33);
                $this->SetFont('Arial','',6);
    
                $this->Cell(20,5,''.$this->PageNo(), 1, 0, 'C');
                    
                $this->SetXY(10,38);
                $this->SetFont('Arial','B',8);
                $this->Cell(255,4, utf8_decode($this->titulo) , 1, 0, 'C', true);

                $this->SetXY(10,42);
                $this->Cell(35,5,'EMBARCACION', 'LRTB', 0, 'C',true);

                $this->SetXY(45,42);
                $this->Cell(30,5, utf8_decode($this->nombre), 'LRTB', 0, 'C');

                $this->SetXY(75,42);
                $this->Cell(34,5,'SERIAL O MATRICULA', 'LRTB', 0, 'C',true);

                $this->SetXY(109,42);
                $this->Cell(25,5,utf8_decode($this->tag), 'LRTB', 0, 'C',);

                $this->SetXY(134,42);
                $this->Cell(30,5,'ELABORADO POR', 'LRTB', 0, 'C',true);

                $this->SetXY(164,42);
                $this->SetFont('Arial','',6);
                $this->Cell(22,5,'JOSE FUENTES', 'LRTB', 0, 'C');

                $this->SetXY(186,42);
                $this->SetFont('Arial','B',8);
                $this->Cell(15,5,'CARGO', 'LRTB', 0, 'C',true);

                $this->SetXY(201,42);
                $this->SetFont('Arial','',6);
                $this->Cell(22,5,'ANALISTA DE MTTO', 'LRTB', 0, 'C');

                $this->SetXY(223,42);
                $this->SetFont('Arial','B',8);
                $this->Cell(21,5,'FECHA', 'LRTB', 0, 'C', true);

                $this->SetXY(244,42);
                $fechaHoy = date('d/m/Y');
                $this->Cell(21,5,$fechaHoy, 'LRTB', 0, 'C');


                // ENCABEZADO DE LA LISTA
                $this->SetFont('Arial','',6);
                $this->SetXY(10,47);
                $this->Cell(35,5,'MES PLANIFICADO', 'LRTB', 0, 'C', true);

                $this->SetXY(45,47);
                $this->Cell(115,5, 'ACTIVIDAD', 'LRTB', 0, 'C', true);

                $this->SetXY(160,47);
                $this->Cell(21,5, 'FECHA INCIO P.', 'LRTB', 0, 'C', true);

                $this->SetXY(181,47);
                $this->Cell(21,5, 'FECHA EJECUTADA', 'LRTB', 0, 'C', true);

                $this->SetXY(202,47);
                $this->Cell(21,5, 'ORDEN D. SERVICIO', 'LRTB', 0, 'C', true);

                $this->SetXY(223,47);
                $this->Cell(21,5, 'HORA PROG.', 'LRTB', 0, 'C', true);

                $this->SetXY(244,47);
                $this->Cell(21,5, 'HORA EJECUTADA.', 'LRTB', 0, 'C', true);

                // BAJO LINEA DE EMBARCACION

                $this->SetXY(10,52);



                }
            }
            /*FOOTER UNIVERSAL*/
            function Footer()
            {
            }

             function tablaActividades($data){
                // Column widths

                // Header
                $nitem = 0;
                $this->SetFont('Arial','',6);
                // VARIABLES

                 // Data
                foreach($data as $row)
                {
                    // Rangos de validacion fecha para 2024

                    $validarFechaEnero = $this->check_fecha('2024-01-01','2024-01-31',$row['fechainicio']);
                    $validarFechaFebrero = $this->check_fecha('2024-02-01','2024-02-31',$row['fechainicio']);
                    $validarFechaMarzo = $this->check_fecha('2024-03-01','2024-03-31',$row['fechainicio']);
                    $validarFechaAbril = $this->check_fecha('2024-04-01','2024-04-31',$row['fechainicio']);
                    $validarFechaMayo = $this->check_fecha('2024-05-01','2024-05-31',$row['fechainicio']);
                    $validarFechaJunio = $this->check_fecha('2024-06-01','2024-06-31',$row['fechainicio']);
                    $validarFechaJulio = $this->check_fecha('2024-07-01','2024-07-31',$row['fechainicio']);
                    $validarFechaAgosto = $this->check_fecha('2024-08-01','2024-08-31',$row['fechainicio']);
                    $validarFechaSeptiembre = $this->check_fecha('2024-09-01','2024-09-31',$row['fechainicio']);
                    $validarFechaOctubre = $this->check_fecha('2024-10-01','2024-10-31',$row['fechainicio']);
                    $validarFechaNoviembre = $this->check_fecha('2024-11-01','2024-11-31',$row['fechainicio']);
                    $validarFechaDiciembre = $this->check_fecha('2024-12-01','2024-12-31',$row['fechainicio']);

                    $nitem = $nitem + 1;

                    if($validarFechaEnero == true ){

                        $existeEjecutadas01 = isset($actEjecutadas01);
                        if($existeEjecutadas01 == false){
                            $actEjecutadas01 = 0;
                            $actNoEjecutadas01 = 0;
                        } else {
                            $actEjecutadas01 = $actEjecutadas01;
                            $actNoEjecutadas01 = $actNoEjecutadas01;
                        }
                        
                        $this->Cell(35,5,'ENERO-'.$nitem, 'LTRB', 0, 'C');
                        $this->Cell(115,5,$row['nombre'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['fechainicio'], 'LTRB', 0, 'C');
                        if($row['fecha'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                            $actNoEjecutadas01 = $actNoEjecutadas01 + 1;
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C');
                            $actEjecutadas01 = $actEjecutadas01 + 1; 
                        }
                        if($row['codigo'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                        } else {
                           $this->Cell(21,5,$row['codigo'], 'LTRB', 0, 'C'); 
                        }
                        $this->Cell(21,5,$row['horasplan'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['horasrealizadas'], 'LTRB', 0, 'C');
                        $this->Ln();
                        $mes = 1;
                    } 
                    else if ($validarFechaFebrero == true) {

                        $existeEjecutadas02 = isset($actEjecutadas02);
                        if($existeEjecutadas02 == false){
                            $actEjecutadas02 = 0;
                            $actNoEjecutadas02 = 0;
                        } else {
                            $actEjecutadas02 = $actEjecutadas02;
                            $actNoEjecutadas02 = $actNoEjecutadas02;
                        }

                        // SEPARO AL FINAL DEL MES
                         if($mes == 1){
                            $this->SetFont('Arial','B',6);
                            $this->Cell(255,5,'FEBRERO', 'LTRB', 0, 'C');
                            $this->Ln();
                            $this->SetFont('Arial','',6);
                            $mes++;
                         }

                        $this->Cell(35,5,'FEBRERO-'.$nitem, 'LTRB', 0, 'C');
                        $this->Cell(115,5,$row['nombre'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['fechainicio'], 'LTRB', 0, 'C');
                        if($row['fecha'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                            $actNoEjecutadas02 = $actNoEjecutadas02 + 1;
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C'); 
                           $actEjecutadas02 = $actEjecutadas02 + 1;
                        }
                        if($row['codigo'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                        } else {
                           $this->Cell(21,5,$row['codigo'], 'LTRB', 0, 'C'); 
                        }
                        $this->Cell(21,5,$row['horasplan'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['horasrealizadas'], 'LTRB', 0, 'C');
                        $this->Ln();
                    }
                     else if ($validarFechaMarzo == true) {

                        $existeEjecutadas03 = isset($actEjecutadas03);
                        if($existeEjecutadas03 == false){
                            $actEjecutadas03 = 0;
                            $actNoEjecutadas03 = 0;
                        } else {
                            $actEjecutadas03 = $actEjecutadas03;
                            $actNoEjecutadas03 = $actNoEjecutadas03;
                        }

                        // SEPARO AL FINAL DEL MES
                        if($mes == 2){
                            $this->SetFont('Arial','B',6);
                            $this->Cell(255,5,'MARZO', 'LTRB', 0, 'C');
                            $this->Ln();
                            $this->SetFont('Arial','',6);
                            $mes++;
                         }

                        $this->Cell(35,5,'MARZO-'.$nitem, 'LTRB', 0, 'C');
                        $this->Cell(115,5,$row['nombre'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['fechainicio'], 'LTRB', 0, 'C');
                        if($row['fecha'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                            $actNoEjecutadas03 = $actNoEjecutadas03 + 1;
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C');
                           $actEjecutadas03 = $actEjecutadas03 + 1; 
                        }
                        if($row['codigo'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                        } else {
                           $this->Cell(21,5,$row['codigo'], 'LTRB', 0, 'C'); 
                        }
                        $this->Cell(21,5,$row['horasplan'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['horasrealizadas'], 'LTRB', 0, 'C');
                        $this->Ln();
                        
                    }
                    else if ($validarFechaAbril == true) {

                        $existeEjecutadas04 = isset($actEjecutadas04);
                        if($existeEjecutadas04 == false){
                            $actEjecutadas04 = 0;
                            $actNoEjecutadas04 = 0;
                        } else {
                            $actEjecutadas04 = $actEjecutadas04;
                            $actNoEjecutadas04 = $actNoEjecutadas04;
                        }
                        // SEPARO AL FINAL DEL MES
                        if($mes == 3){
                            $this->SetFont('Arial','B',6);
                            $this->Cell(255,5,'ABRIL', 'LTRB', 0, 'C');
                            $this->Ln();
                            $this->SetFont('Arial','',6);
                            $mes++;
                         }

                        $this->Cell(35,5,'ABRIL-'.$nitem, 'LTRB', 0, 'C');
                        $this->Cell(115,5,$row['nombre'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['fechainicio'], 'LTRB', 0, 'C');
                        if($row['fecha'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                            $actNoEjecutadas04 = $actNoEjecutadas04 + 1;
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C');
                           $actEjecutadas04 = $actEjecutadas04 + 1;  
                        }
                        if($row['codigo'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                        } else {
                           $this->Cell(21,5,$row['codigo'], 'LTRB', 0, 'C'); 
                        }
                        $this->Cell(21,5,$row['horasplan'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['horasrealizadas'], 'LTRB', 0, 'C');
                        $this->Ln();
                        
                    }
                    else if ($validarFechaMayo == true) {

                        $existeEjecutadas05 = isset($actEjecutadas05);
                        if($existeEjecutadas05 == false){
                            $actEjecutadas05 = 0;
                            $actNoEjecutadas05 = 0;
                        } else {
                            $actEjecutadas05 = $actEjecutadas05;
                            $actNoEjecutadas05 = $actNoEjecutadas05;
                        }
                        // SEPARO AL FINAL DEL MES
                        if($mes == 4){
                            $this->SetFont('Arial','B',6);
                            $this->Cell(255,5,'MAYO', 'LTRB', 0, 'C');
                            $this->Ln();
                            $this->SetFont('Arial','',6);
                            $mes++;
                         }

                        $this->Cell(35,5,'MAYO-'.$nitem, 'LTRB', 0, 'C');
                        $this->Cell(115,5,$row['nombre'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['fechainicio'], 'LTRB', 0, 'C');
                        if($row['fecha'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                            $actNoEjecutadas05 = $actNoEjecutadas05 + 1;
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C');
                           $actEjecutadas05 = $actEjecutadas05 + 1;  
                        }
                        if($row['codigo'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                        } else {
                           $this->Cell(21,5,$row['codigo'], 'LTRB', 0, 'C'); 
                        }
                        $this->Cell(21,5,$row['horasplan'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['horasrealizadas'], 'LTRB', 0, 'C');
                        $this->Ln();
                        
                    }
                    else if ($validarFechaJunio == true) {

                        $existeEjecutadas06 = isset($actEjecutadas06);
                        if($existeEjecutadas06 == false){
                            $actEjecutadas06 = 0;
                            $actNoEjecutadas06 = 0;
                        } else {
                            $actEjecutadas06 = $actEjecutadas06;
                            $actNoEjecutadas06 = $actNoEjecutadas06;
                        }

                        // SEPARO AL FINAL DEL MES
                        if($mes == 5){
                            $this->SetFont('Arial','B',6);
                            $this->Cell(255,5,'JUNIO', 'LTRB', 0, 'C');
                            $this->Ln();
                            $this->SetFont('Arial','',6);
                            $mes++;
                         }

                        $this->Cell(35,5,'JUNIO-'.$nitem, 'LTRB', 0, 'C');
                        $this->Cell(115,5,$row['nombre'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['fechainicio'], 'LTRB', 0, 'C');
                        if($row['fecha'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                            $actNoEjecutadas06 = $actNoEjecutadas06 + 1;
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C');
                           $actEjecutadas06 = $actEjecutadas06 + 1; 
                        }
                        if($row['codigo'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                        } else {
                           $this->Cell(21,5,$row['codigo'], 'LTRB', 0, 'C'); 
                        }
                        $this->Cell(21,5,$row['horasplan'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['horasrealizadas'], 'LTRB', 0, 'C');
                        $this->Ln();
                        
                    }
                    else if ($validarFechaJulio == true) {

                        $existeEjecutadas07 = isset($actEjecutadas07);
                        if($existeEjecutadas07 == false){
                            $actEjecutadas07 = 0;
                            $actNoEjecutadas07 = 0;
                        } else {
                            $actEjecutadas07 = $actEjecutadas07;
                            $actNoEjecutadas07 = $actNoEjecutadas07;
                        }
                        // SEPARO AL FINAL DEL MES
                        if($mes == 6){
                            $this->SetFont('Arial','B',6);
                            $this->Cell(255,5,'JULIO', 'LTRB', 0, 'C');
                            $this->Ln();
                            $this->SetFont('Arial','',6);
                            $mes++;
                         }

                        $this->Cell(35,5,'JULIO-'.$nitem, 'LTRB', 0, 'C');
                        $this->Cell(115,5,$row['nombre'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['fechainicio'], 'LTRB', 0, 'C');
                        if($row['fecha'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                            $actNoEjecutadas07 = $actNoEjecutadas07 + 1;
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C');
                           $actEjecutadas07 = $actEjecutadas07 + 1;  
                        }
                        if($row['codigo'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                        } else {
                           $this->Cell(21,5,$row['codigo'], 'LTRB', 0, 'C'); 
                        }
                        $this->Cell(21,5,$row['horasplan'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['horasrealizadas'], 'LTRB', 0, 'C');
                        $this->Ln();
                        
                    }
                    else if ($validarFechaAgosto == true) {

                        $existeEjecutadas08 = isset($actEjecutadas08);
                        if($existeEjecutadas08 == false){
                            $actEjecutadas08 = 0;
                            $actNoEjecutadas08 = 0;
                        } else {
                            $actEjecutadas08 = $actEjecutadas08;
                            $actNoEjecutadas08 = $actNoEjecutadas08;
                        }
                        // SEPARO AL FINAL DEL MES
                        if($mes == 7){
                            $this->SetFont('Arial','B',6);
                            $this->Cell(255,5,'AGOSTO', 'LTRB', 0, 'C');
                            $this->Ln();
                            $this->SetFont('Arial','',6);
                            $mes++;
                         }

                        $this->Cell(35,5,'AGOSTO-'.$nitem, 'LTRB', 0, 'C');
                        $this->Cell(115,5,$row['nombre'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['fechainicio'], 'LTRB', 0, 'C');
                        if($row['fecha'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                            $actNoEjecutadas08 = $actNoEjecutadas08 + 1;
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C');
                           $actEjecutadas08 = $actEjecutadas08 + 1;   
                        }
                        if($row['codigo'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                        } else {
                           $this->Cell(21,5,$row['codigo'], 'LTRB', 0, 'C'); 
                        }
                        $this->Cell(21,5,$row['horasplan'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['horasrealizadas'], 'LTRB', 0, 'C');
                        $this->Ln();
                        
                        
                    }
                    else if ($validarFechaSeptiembre == true) {
                        $existeEjecutadas09 = isset($actEjecutadas09);
                        if($existeEjecutadas09 == false){
                            $actEjecutadas09 = 0;
                            $actNoEjecutadas09 = 0;
                        } else {
                            $actEjecutadas09 = $actEjecutadas09;
                            $actNoEjecutadas09 = $actNoEjecutadas09;
                        }
                        // SEPARO AL FINAL DEL MES
                        if($mes == 8){
                            $this->SetFont('Arial','B',6);
                            $this->Cell(255,5,'SEPTIEMBRE', 'LTRB', 0, 'C');
                            $this->Ln();
                            $this->SetFont('Arial','',6);
                            $mes++;
                         }

                        $this->Cell(35,5,'SEPTIEMBRE-'.$nitem, 'LTRB', 0, 'C');
                        $this->Cell(115,5,$row['nombre'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['fechainicio'], 'LTRB', 0, 'C');
                        if($row['fecha'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                            $actNoEjecutadas09 = $actNoEjecutadas09 + 1;
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C');
                           $actEjecutadas09 = $actEjecutadas09 + 1; 
                        }
                        if($row['codigo'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                        } else {
                           $this->Cell(21,5,$row['codigo'], 'LTRB', 0, 'C'); 
                        }
                        $this->Cell(21,5,$row['horasplan'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['horasrealizadas'], 'LTRB', 0, 'C');
                        $this->Ln();
                        
                        
                    }
                    else if ($validarFechaOctubre == true) {
                        $existeEjecutadas10 = isset($actEjecutadas10);
                        if($existeEjecutadas10 == false){
                            $actEjecutadas10 = 0;
                            $actNoEjecutadas10 = 0;
                        } else {
                            $actEjecutadas10 = $actEjecutadas10;
                            $actNoEjecutadas10 = $actNoEjecutadas10;
                        }
                        // SEPARO AL FINAL DEL MES
                        if($mes == 9){
                            $this->SetFont('Arial','B',6);
                            $this->Cell(255,5,'OCTUBRE', 'LTRB', 0, 'C');
                            $this->Ln();
                            $this->SetFont('Arial','',6);
                            $mes++;
                         }

                        $this->Cell(35,5,'OCTUBRE-'.$nitem, 'LTRB', 0, 'C');
                        $this->Cell(115,5,$row['nombre'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['fechainicio'], 'LTRB', 0, 'C');
                        if($row['fecha'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                            $actNoEjecutadas10 = $actNoEjecutadas10 + 1;
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C');
                           $actEjecutadas10 = $actEjecutadas10 + 1; 
                        }
                        if($row['codigo'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                        } else {
                           $this->Cell(21,5,$row['codigo'], 'LTRB', 0, 'C'); 
                        }
                        $this->Cell(21,5,$row['horasplan'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['horasrealizadas'], 'LTRB', 0, 'C');
                        $this->Ln();
                        
                        
                    }
                    else if ($validarFechaNoviembre == true) {
                        $existeEjecutadas11 = isset($actEjecutadas11);
                        if($existeEjecutadas11 == false){
                            $actEjecutadas11 = 0;
                            $actNoEjecutadas11 = 0;
                        } else {
                            $actEjecutadas11 = $actEjecutadas11;
                            $actNoEjecutadas11 = $actNoEjecutadas11;
                        }
                        // SEPARO AL FINAL DEL MES
                        if($mes == 10){
                            $this->SetFont('Arial','B',6);
                            $this->Cell(255,5,'NOVIEMBRE', 'LTRB', 0, 'C');
                            $this->Ln();
                            $this->SetFont('Arial','',6);
                            $mes++;
                         }

                        $this->Cell(35,5,'NOVIEMBRE-'.$nitem, 'LTRB', 0, 'C');
                        $this->Cell(115,5,$row['nombre'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['fechainicio'], 'LTRB', 0, 'C');
                        if($row['fecha'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                            $actNoEjecutadas11 = $actNoEjecutadas11 + 1;
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C');
                           $actEjecutadas11 = $actEjecutadas11 + 1;  
                        }
                        if($row['codigo'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                        } else {
                           $this->Cell(21,5,$row['codigo'], 'LTRB', 0, 'C'); 
                        }
                        $this->Cell(21,5,$row['horasplan'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['horasrealizadas'], 'LTRB', 0, 'C');
                        $this->Ln();
                       
                        
                    }
                    else {
                        $existeEjecutadas12 = isset($actEjecutadas12);
                        if($existeEjecutadas12 == false){
                            $actEjecutadas12 = 0;
                            $actNoEjecutadas12 = 0;
                        } else {
                            $actEjecutadas12 = $actEjecutadas12;
                            $actNoEjecutadas12 = $actNoEjecutadas12;
                        }
                        // SEPARO AL FINAL DEL MES
                        if($mes == 11){
                            $this->SetFont('Arial','B',6);
                            $this->Cell(255,5,'DICIEMBRE', 'LTRB', 0, 'C');
                            $this->Ln();
                            $this->SetFont('Arial','',6);
                            $mes++;
                         }

                        $this->Cell(35,5,'DICIEMBRE-'.$nitem, 'LTRB', 0, 'C');
                        $this->Cell(115,5,$row['nombre'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['fechainicio'], 'LTRB', 0, 'C');
                        if($row['fecha'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                            $actNoEjecutadas12 = $actNoEjecutadas12 + 1;
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C');
                           $actEjecutadas12 = $actEjecutadas12 + 1;  
                        }
                        if($row['codigo'] == null){
                            $this->Cell(21,5,'PENDIENTE', 'LTRB', 0, 'C');
                        } else {
                           $this->Cell(21,5,$row['codigo'], 'LTRB', 0, 'C'); 
                        }
                        $this->Cell(21,5,$row['horasplan'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['horasrealizadas'], 'LTRB', 0, 'C');
                        $this->Ln();
                        
                    }

               }

               // MUESTRO LOS VALORES
               $x = $this->getX();
               $y = $this->getY();
               
               $this->SetXY($x,$y);
               $this->SetFont('Arial','',8);
              

              


               $this->Ln();

               // INDICADOR DE MTTO

               $this->ln();
               $this->SetFont('Arial','B',12);
               $this->SetXY($x,$y+10);
               $this->Cell(255,5,'RESUMEN INDICADORES 2024', 'LTRB', 0, 'C',true);
               $this->ln();
               $this->SetFont('Arial','',8);
               $this->Cell(255,5,'EFICACIA DEL PROGRAMA DE MANTENIMIENTO % = (CANTIDAD DE MANTENIMIENTO EJECUTADO / CANTIDAD DE MANTENIMIENTO PLANIFICADO)', 'LTRB', 0, 'C');
               $this->ln();
               $this->SetFont('Arial','B',8);
               $this->Cell(21,5,'ENERO', 'LTRB', 0, 'C');
               $this->Cell(21,5,'FEBRERO', 'LTRB', 0, 'C');
               $this->Cell(21,5,'MARZO', 'LTRB', 0, 'C');
               $this->Cell(21,5,'ABRIL', 'LTRB', 0, 'C');
               $this->Cell(21,5,'MAYO', 'LTRB', 0, 'C');
               $this->Cell(21,5,'JUNIO', 'LTRB', 0, 'C');
               $this->Cell(21,5,'JULIO', 'LTRB', 0, 'C');
               $this->Cell(21,5,'AGOSTO', 'LTRB', 0, 'C');
               $this->Cell(21,5,'SEPTIEMBRE', 'LTRB', 0, 'C');
               $this->Cell(22,5,'OCTUBRE', 'LTRB', 0, 'C');
               $this->Cell(22,5,'NOVIEMBRE', 'LTRB', 0, 'C');
               $this->Cell(22,5,'DICIEMBRE', 'LTRB', 0, 'C');
               $this->SetFont('Arial','',8);
               $this->ln();

               // VALIDO ENERO
                 $existeEjecutadas01 = isset($actEjecutadas01);
                 $existeNoEjecutadas01 = isset($actNoEjecutadas01);
                 if(($existeEjecutadas01 && $existeNoEjecutadas01) == false) {
                  $actEjecutadasTotales01 = 1;
                  $actEjecutadas01= 0;
                 } else {
                  $actEjecutadasTotales01 = $actEjecutadas01 + $actNoEjecutadas01;
                 }

               // VALIDO FEBRERO
               $existeEjecutadas02 = isset($actEjecutadas02);
               $existeNoEjecutadas02 = isset($actNoEjecutadas02);
               if(($existeEjecutadas02 && $existeNoEjecutadas02) == false) {
                $actEjecutadasTotales02 = 1;
                $actEjecutadas02= 0;
               } else {
                $actEjecutadasTotales02 = $actEjecutadas02 + $actNoEjecutadas02;
               }


               // VALIDO MARZO
               $existeEjecutadas03 = isset($actEjecutadas03);
               $existeNoEjecutadas03 = isset($actNoEjecutadas03);
               if(($existeEjecutadas03 && $existeNoEjecutadas03) == false) {
                $actEjecutadasTotales03 = 1;
                $actEjecutadas03= 0;
               } else {
                $actEjecutadasTotales03 = $actEjecutadas03 + $actNoEjecutadas03;
               }

               // VALIDO ABRIL
               $existeEjecutadas04 = isset($actEjecutadas04);
               $existeNoEjecutadas04 = isset($actNoEjecutadas04);
               if(($existeEjecutadas04 && $existeNoEjecutadas04) == false) {
                $actEjecutadasTotales04 = 1;
                $actEjecutadas04= 0;
               } else {
                $actEjecutadasTotales04 = $actEjecutadas04 + $actNoEjecutadas04;
               }

               // VALIDO MAYO
               $existeEjecutadas05 = isset($actEjecutadas05);
               $existeNoEjecutadas05 = isset($actNoEjecutadas05);
               if(($existeEjecutadas05 && $existeNoEjecutadas05) == false) {
                $actEjecutadasTotales05 = 1;
                $actEjecutadas05= 0;
               } else {
                $actEjecutadasTotales05 = $actEjecutadas05 + $actNoEjecutadas05;
               }

               // VALIDO JUNIO
               $existeEjecutadas06 = isset($actEjecutadas06);
               $existeNoEjecutadas06 = isset($actNoEjecutadas06);
               if(($existeEjecutadas06 && $existeNoEjecutadas06) == false) {
                $actEjecutadasTotales06 = 1;
                $actEjecutadas06= 0;
               } else {
                $actEjecutadasTotales06 = $actEjecutadas06 + $actNoEjecutadas06;
               }

               // VALIDO JULIO
               $existeEjecutadas07 = isset($actEjecutadas07);
               $existeNoEjecutadas07 = isset($actNoEjecutadas07);
               if(($existeEjecutadas07 && $existeNoEjecutadas07) == false) {
                $actEjecutadasTotales07 = 1;
                $actEjecutadas07= 0;
               } else {
                $actEjecutadasTotales07 = $actEjecutadas07 + $actNoEjecutadas07;
               }

               // VALIDO AGOSTO
               $existeEjecutadas08 = isset($actEjecutadas08);
               $existeNoEjecutadas08 = isset($actNoEjecutadas08);
               if(($existeEjecutadas08 && $existeNoEjecutadas08) == false) {
                $actEjecutadasTotales08 = 1;
                $actEjecutadas08= 0;
               } else {
                $actEjecutadasTotales08 = $actEjecutadas08 + $actNoEjecutadas08;
               }

               // VALIDO SEPTIEMBRE
               $existeEjecutadas09 = isset($actEjecutadas09);
               $existeNoEjecutadas09 = isset($actNoEjecutadas09);
               if(($existeEjecutadas09 && $existeNoEjecutadas09) == false) {
                $actEjecutadasTotales09 = 1;
                $actEjecutadas09= 0;
               } else {
                $actEjecutadasTotales09 = $actEjecutadas09 + $actNoEjecutadas09;
               }

               // VALIDO OCTUBRE
               $existeEjecutadas10 = isset($actEjecutadas10);
               $existeNoEjecutadas10 = isset($actNoEjecutadas10);
               if(($existeEjecutadas10 && $existeNoEjecutadas10) == false) {
                $actEjecutadasTotales10 = 1;
                $actEjecutadas10= 0;
               } else {
                $actEjecutadasTotales10 = $actEjecutadas10 + $actNoEjecutadas10;
               }

               // VALIDO NOVIEMBRE
               $existeEjecutadas11 = isset($actEjecutadas11);
               $existeNoEjecutadas11 = isset($actNoEjecutadas11);
               if(($existeEjecutadas11 && $existeNoEjecutadas11) == false) {
                $actEjecutadasTotales11 = 1;
                $actEjecutadas11= 0;
               } else {
                $actEjecutadasTotales11 = $actEjecutadas11 + $actNoEjecutadas11;
               }

               // VALIDO DICIEMBRE
               $existeEjecutadas12 = isset($actEjecutadas12);
               $existeNoEjecutadas12 = isset($actNoEjecutadas12);
               if(($existeEjecutadas12 && $existeNoEjecutadas12) == false) {
                $actEjecutadasTotales12 = 1;
                $actEjecutadas12= 0;
               } else {
                $actEjecutadasTotales12 = $actEjecutadas12 + $actNoEjecutadas12;
               }               

               $this->Cell(21,5,number_format(( (($actEjecutadas01) / ($actEjecutadasTotales01))  *100), 2, '.', ',').'%', 'LTRB', 0, 'C');

               $this->Cell(21,5,number_format(( (($actEjecutadas02) / ($actEjecutadasTotales02))  *100), 2, '.', ',').'%', 'LTRB', 0, 'C');

               $this->Cell(21,5,number_format(( (($actEjecutadas03) / ($actEjecutadasTotales03))  *100), 2, '.', ',').'%'
               , 'LTRB', 0, 'C');

               $this->Cell(21,5,number_format(( (($actEjecutadas04) / ($actEjecutadasTotales04))  *100), 2, '.', ',').'%'
               , 'LTRB', 0, 'C');

               $this->Cell(21,5,number_format(( (($actEjecutadas05) / ($actEjecutadasTotales05))  *100), 2, '.', ',').'%'
               , 'LTRB', 0, 'C');

               $this->Cell(21,5,number_format(( (($actEjecutadas06) / ($actEjecutadasTotales06))  *100), 2, '.', ',').'%'
               , 'LTRB', 0, 'C');

               $this->Cell(21,5,number_format(( (($actEjecutadas07) / ($actEjecutadasTotales07))  *100), 2, '.', ',').'%'
               , 'LTRB', 0, 'C');

               $this->Cell(21,5,number_format(( (($actEjecutadas08) / ($actEjecutadasTotales08))  *100), 2, '.', ',').'%'
               , 'LTRB', 0, 'C');

               $this->Cell(21,5,number_format(( (($actEjecutadas09) / ($actEjecutadasTotales09))  *100), 2, '.', ',').'%'
               , 'LTRB', 0, 'C');

               $this->Cell(22,5,number_format(( (($actEjecutadas10) / ($actEjecutadasTotales10))  *100), 2, '.', ',').'%'
               , 'LTRB', 0, 'C');

               $this->Cell(22,5,number_format(( (($actEjecutadas11) / ($actEjecutadasTotales11))  *100), 2, '.', ',').'%'
               , 'LTRB', 0, 'C');

               $this->Cell(22,5,number_format(( (($actEjecutadas12) / ($actEjecutadasTotales12))  *100), 2, '.', ',').'%'
               , 'LTRB', 0, 'C');

               $this->Ln();

            }

        }



?>