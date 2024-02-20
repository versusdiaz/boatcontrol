<?php
            /*CONST DE LA TABLA*/
            class PDF extends FPDF{
            
            private $codigo = '';
            private $fecha = '';
            private $revision = '';
            private $titulo = '';
            private $nombre = '';

            function __construct($codigo,$fecha,$revision,$titulo,$nombre){
                parent::__construct();

                $this->codigo = $codigo;
                $this->fecha = $fecha;
                $this->titulo = $titulo;
                $this->revision = $revision;
                $this->nombre = $nombre;

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
                $this->Cell(16,5,'CODIGO:', 1, 0, 'C',true);
                $this->SetXY(245,18);
                $this->SetFont('Arial','',6);
                $this->Cell(20,5, $this->codigo , 1, 0, 'C');
                    
                $this->SetXY(229,23);
                $this->SetFont('Arial','',8);
                $this->Cell(16,5,'FECHA:', 1, 0, 'C',true);
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
                $this->Cell(91,5, utf8_decode($this->nombre), 'LRTB', 0, 'C');

                $this->SetXY(136,42);
                $this->Cell(129,5,'', 'LRTB', 0, 'C',true);

                // ENCABEZADO DE LA LISTA
                $this->SetFont('Arial','',6);
                $this->SetXY(10,47);
                $this->Cell(35,5,'MES PROGRAMADO', 'LRTB', 0, 'C');

                $this->SetXY(45,47);
                $this->Cell(115,5, 'ACTIVIDAD', 'LRTB', 0, 'C');

                $this->SetXY(160,47);
                $this->Cell(21,5, 'FECHA INCIO P.', 'LRTB', 0, 'C');

                $this->SetXY(181,47);
                $this->Cell(21,5, 'FECHA EJECUTADA', 'LRTB', 0, 'C');

                $this->SetXY(202,47);
                $this->Cell(21,5, 'ORDEN D. SERVICIO', 'LRTB', 0, 'C');

                $this->SetXY(223,47);
                $this->Cell(21,5, 'HORA PROG.', 'LRTB', 0, 'C');

                $this->SetXY(244,47);
                $this->Cell(21,5, 'HORA EJECUTADA.', 'LRTB', 0, 'C');

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
                        $actEjecutadas01 = 1;
                        $actNoEjecutadas01 = 1;
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
                        $actEjecutadas02 = 1;
                        $actNoEjecutadas02 = 1;

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
                        $actEjecutadas03 = 1;
                        $actNoEjecutadas03 = 1;
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
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C'); 
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
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C'); 
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
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C'); 
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
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C'); 
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
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C'); 
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
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C'); 
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
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C'); 
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
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C'); 
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
                        } else {
                           $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C'); 
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

               //
               $actEjecutadasTotales01 = $actEjecutadas01 + $actNoEjecutadas01;
               $actEjecutadasTotales02 = $actEjecutadas02 + $actNoEjecutadas02;

               // VALIDO MARZO
               $existeEjecutadas03 = isset($actEjecutadas03);
               $existeNoEjecutadas03 = isset($actNoEjecutadas03);
               if(($existeEjecutadas03 && $existeNoEjecutadas03) == false) {
                $actEjecutadasTotales03 = 1;
                $actEjecutadas03= 0;
               } else {
                $actEjecutadasTotales03 = $actEjecutadas03 + $actNoEjecutadas03;
               }
               

               $this->Cell(21,5,number_format(( (($actEjecutadas01) / ($actEjecutadasTotales01))  *100), 2, '.', ',')
               , 'LTRB', 0, 'C');

               $this->Cell(21,5,number_format(( (($actEjecutadas02) / ($actEjecutadasTotales02))  *100), 2, '.', ',')
               , 'LTRB', 0, 'C');

               $this->Cell(21,5,number_format(( (($actEjecutadas03) / ($actEjecutadasTotales03))  *100), 2, '.', ',')
               , 'LTRB', 0, 'C');

               $this->Ln();

            }

        }



?>