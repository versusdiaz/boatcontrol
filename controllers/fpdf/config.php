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
                $this->Cell(35,5,'EMBARCACION', 'LRT', 0, 'C',true);

                $this->SetXY(45,42);
                $this->Cell(91,5, utf8_decode($this->nombre), 'LRT', 0, 'C');

                $this->SetFont('Arial','B',6);
                $this->SetXY(136,42);
                $this ->MultiCell(20,5,'AFECTA EJECUCION DEL SERVICIO', 'LRTB', 'C', 0);

                $this->SetXY(156,42);
                $this->Cell(68,15,'MANTENIMIENTO REALIZADO', 'LRTB', 0, 'C',true);

                $this->SetXY(224,42);
                $this ->MultiCell(21,5,'TIEMPO DE MANTENIMIENTO (HRS)', 'LRTB', 'C', true);

                $this->SetXY(245,42);
                $this ->MultiCell(20,5,'TIEMPO INOPERATIVO (HRS)', 'LRTB', 'C', true);

                // BAJO LINEA DE EMBARCACION

                $this->SetXY(10,47);
                $this->Cell(10,10,'ITEM', 'LRTB', 0, 'C',true);

                $this->SetXY(20,47);
                $this ->MultiCell(16,5,'ORDEN DE SERVICIO', 'LRTB', 'C', true);

                $this->SetXY(36,47);
                $this->Cell(16,10,'FECHA', 'LRTB', 0, 'C',true);

                $this->SetXY(52,47);
                $this ->MultiCell(22,5,'TIPO DE MANTENIMIENTO', 'LRTB', 'C', true);

                $this->SetXY(74,47);
                $this->Cell(16,10,'SISTEMA', 'LRTB', 0, 'C',true);

                $this->SetXY(90,47);
                $this ->MultiCell(23,5,'SITUACION ENCONTRADA', 'LRTB', 'C', true);

                $this->SetXY(113,47);
                $this ->MultiCell(23,5,'INDICIO DE FALLA (SI APLICA)', 'LRTB', 'C', true);

                $this->SetXY(10,57);

                }
            }
            /*FOOTER UNIVERSAL*/
            function Footer()
            {
            }


             function tablaHistorial($data){
                 // Column widths
                 $w = array(10, 16, 16, 22, 16, 23, 23, 20, 68, 21, 20);
                 // Header
                 $nitem = 1;
                 $this->SetFont('Arial','',6);
                  // Data
                 foreach($data as $row)
                 {

                     $this->Cell($w[0],6,$nitem,'LRB',0,'C');
                     $this->Cell($w[1],6,$row['codigo'],'LRB',0,'C');
                     $this->Cell($w[2],6,date('d/m/Y',strtotime($row['fecha'])),'LRB',0,'C');
                     $this->Cell($w[3],6,$row['tipo'] == 1 ? 'Correctivo' : 'Preventivo','LRB',0,'C');
                     $this->Cell($w[4],6,utf8_decode($row['sistema']),'LRB',0,'C');
                     $this->Cell($w[5],6,utf8_decode($row['com_estado']),'LRB',0,'C');
                     $this->Cell($w[6],6,utf8_decode($row['com_falla']),'LRB',0,'C');
                     $this->Cell($w[7],6,$row['afectaservicio']  == 1 ? 'Si' : 'No','LRB',0,'C');
                     $this->Cell($w[8],6,utf8_decode($row['com_general']),'LRB',0,'C');
                     $this->Cell($w[9],6,$row['tiempo_mtto'],'LRB',0,'C');
                     $this->Cell($w[10],6,$row['tiempo_ino'],'LRB',0,'C');

                     $this->Ln();
                     $nitem++;
                }

                 // Closing line
                 $this->Cell(array_sum($w),0,'','T');
             }

             function tablaIndicador($data){
                // Column widths
                $w = array(10, 16, 16, 22, 16, 23, 23, 20, 68, 21, 20);
                // Header
                $nitem = 1;
                $this->SetFont('Arial','',6);
                // VARIABLES
                $tiempo = 720;
                $tiempototal = 0;
                $tiempoino = 0;
                $tiempoinototal = 0;

                $tiempoinototal01 = 0;
                $tiempoinototal02 = 0;
                $tiempoinototal03 = 0;
                $tiempoinototal04 = 0;
                $tiempoinototal05 = 0;
                $tiempoinototal06 = 0;
                $tiempoinototal07 = 0;
                $tiempoinototal08 = 0;
                $tiempoinototal09 = 0;
                $tiempoinototal10 = 0;
                $tiempoinototal11 = 0;
                $tiempoinototal12 = 0;


                $tiempoMttoTotal01 = 0;
                $tiempoMttoTotal02 = 0;
                $tiempoMttoTotal03 = 0;
                $tiempoMttoTotal04 = 0;
                $tiempoMttoTotal05 = 0;
                $tiempoMttoTotal06 = 0;
                $tiempoMttoTotal07 = 0;
                $tiempoMttoTotal08 = 0;
                $tiempoMttoTotal09 = 0;
                $tiempoMttoTotal10 = 0;
                $tiempoMttoTotal11 = 0;
                $tiempoMttoTotal12 = 0;

                 // Data
                foreach($data as $row)
                {
                    // Rangos de validacion fecha para 2023

                    $validarFechaEnero = $this->check_fecha('2023-01-01','2023-01-31',$row['fecha']);
                    $validarFechaFebrero = $this->check_fecha('2023-02-01','2023-02-31',$row['fecha']);
                    $validarFechaMarzo = $this->check_fecha('2023-03-01','2023-03-31',$row['fecha']);
                    $validarFechaAbril = $this->check_fecha('2023-04-01','2023-04-31',$row['fecha']);
                    $validarFechaMayo = $this->check_fecha('2023-05-01','2023-05-31',$row['fecha']);
                    $validarFechaJunio = $this->check_fecha('2023-06-01','2023-06-31',$row['fecha']);
                    $validarFechaJulio = $this->check_fecha('2023-07-01','2023-07-31',$row['fecha']);
                    $validarFechaAgosto = $this->check_fecha('2023-08-01','2023-08-31',$row['fecha']);
                    $validarFechaSeptiembre = $this->check_fecha('2023-09-01','2023-09-31',$row['fecha']);
                    $validarFechaOctubre = $this->check_fecha('2023-10-01','2023-10-31',$row['fecha']);
                    $validarFechaNoviembre = $this->check_fecha('2023-11-01','2023-11-31',$row['fecha']);
                    $validarFechaDiciembre = $this->check_fecha('2023-12-01','2023-12-31',$row['fecha']);


                    if($validarFechaEnero == true ){

                        $tiempoinototal01 = $tiempoinototal01+$row['tiempo_ino'];
                        $tiempoMttoTotal01 = $tiempoMttoTotal01+$row['tiempo_mtto'];

                    } 
                    else if ($validarFechaFebrero == true) {
                        $tiempoinototal02 = $tiempoinototal02+$row['tiempo_ino'];
                        $tiempoMttoTotal02 = $tiempoMttoTotal02+$row['tiempo_mtto'];
                        
                    }
                     else if ($validarFechaMarzo == true) {
                        $tiempoinototal03 = $tiempoinototal03+$row['tiempo_ino'];
                        $tiempoMttoTotal03 = $tiempoMttoTotal03+$row['tiempo_mtto'];
                        
                    }
                    else if ($validarFechaAbril == true) {
                        $tiempoinototal04 = $tiempoinototal04+$row['tiempo_ino'];
                        $tiempoMttoTotal04 = $tiempoMttoTotal04+$row['tiempo_mtto'];
                        
                    }
                    else if ($validarFechaMayo == true) {
                        $tiempoinototal05 = $tiempoinototal05+$row['tiempo_ino'];
                        $tiempoMttoTotal05 = $tiempoMttoTotal05+$row['tiempo_mtto'];

                        
                    }
                    else if ($validarFechaJunio == true) {
                        $tiempoinototal06 = $tiempoinototal06+$row['tiempo_ino'];
                        $tiempoMttoTotal06 = $tiempoMttoTotal06+$row['tiempo_mtto'];
                        
                    }
                    else if ($validarFechaJulio == true) {
                        $tiempoinototal07 = $tiempoinototal07+$row['tiempo_ino'];
                        $tiempoMttoTotal07 = $tiempoMttoTotal07+$row['tiempo_mtto'];
                        
                    }
                    else if ($validarFechaAgosto == true) {
                        $tiempoinototal08 = $tiempoinototal08+$row['tiempo_ino'];
                        $tiempoMttoTotal08 = $tiempoMttoTotal08+$row['tiempo_mtto'];
                        
                    }
                    else if ($validarFechaSeptiembre == true) {
                        $tiempoinototal09 = $tiempoinototal09+$row['tiempo_ino'];
                        $tiempoMttoTotal09 = $tiempoMttoTotal09+$row['tiempo_mtto'];
                        
                    }
                    else if ($validarFechaOctubre == true) {
                        $tiempoinototal10 = $tiempoinototal10+$row['tiempo_ino'];
                        $tiempoMttoTotal10 = $tiempoMttoTotal10+$row['tiempo_mtto'];
                        
                    }
                    else if ($validarFechaNoviembre == true) {
                        $tiempoinototal11 = $tiempoinototal11+$row['tiempo_ino'];
                        $tiempoMttoTotal11 = $tiempoMttoTotal11+$row['tiempo_mtto'];
                        
                    }
                    else {
                        $tiempoinototal12 = $tiempoinototal12+$row['tiempo_ino'];
                        $tiempoMttoTotal12 = $tiempoMttoTotal12+$row['tiempo_mtto'];
                        
                    }

               }

               // MUESTRO LOS VALORES
               $x = $this->getX();
               $y = $this->getY();
               
               $this->SetXY($x,$y);
               $this->SetFont('Arial','',8);
               // Tiempo total Disponible (Si es 0 entoces no realiza la formula)
               $tiempototal01 = ($tiempoinototal01 == 0 ? 0 : ( ($tiempo - $tiempoinototal01) / $tiempo )); 
               $tiempototal02 = ($tiempoinototal02 == 0 ? 0 : ( ($tiempo - $tiempoinototal02) / $tiempo )); 
               $tiempototal03 = ($tiempoinototal03 == 0 ? 0 : ( ($tiempo - $tiempoinototal03) / $tiempo ));
               $tiempototal04 = ($tiempoinototal04 == 0 ? 0 : ( ($tiempo - $tiempoinototal04) / $tiempo ));
               $tiempototal05 = ($tiempoinototal05 == 0 ? 0 : ( ($tiempo - $tiempoinototal05) / $tiempo ));
               $tiempototal06 = ($tiempoinototal06 == 0 ? 0 : ( ($tiempo - $tiempoinototal06) / $tiempo )); 
               $tiempototal07 = ($tiempoinototal07 == 0 ? 0 : ( ($tiempo - $tiempoinototal07) / $tiempo )); 
               $tiempototal08 = ($tiempoinototal08 == 0 ? 0 : ( ($tiempo - $tiempoinototal08) / $tiempo ));
               $tiempototal09 = ($tiempoinototal09 == 0 ? 0 : ( ($tiempo - $tiempoinototal09) / $tiempo )); 
               $tiempototal10 = ($tiempoinototal10 == 0 ? 0 : ( ($tiempo - $tiempoinototal10) / $tiempo )); 
               $tiempototal11 = ($tiempoinototal11 == 0 ? 0 : ( ($tiempo - $tiempoinototal11) / $tiempo )); 
               $tiempototal12 = ($tiempoinototal12 == 0 ? 0 : ( ($tiempo - $tiempoinototal12) / $tiempo ));

               // Tiempo total en Mtto

               $tiempototalMtto01 = ($tiempoMttoTotal01 == 0 ? 0 : ( ($tiempo - $tiempoMttoTotal01) / $tiempo ));
               $tiempototalMtto02 = ($tiempoMttoTotal02 == 0 ? 0 : ( ($tiempo - $tiempoMttoTotal02) / $tiempo ));
               $tiempototalMtto03 = ($tiempoMttoTotal03 == 0 ? 0 : ( ($tiempo - $tiempoMttoTotal03) / $tiempo ));
               $tiempototalMtto04 = ($tiempoMttoTotal04 == 0 ? 0 : ( ($tiempo - $tiempoMttoTotal04) / $tiempo ));
               $tiempototalMtto05 = ($tiempoMttoTotal05 == 0 ? 0 : ( ($tiempo - $tiempoMttoTotal05) / $tiempo ));
               $tiempototalMtto06 = ($tiempoMttoTotal06 == 0 ? 0 : ( ($tiempo - $tiempoMttoTotal06) / $tiempo ));
               $tiempototalMtto07 = ($tiempoMttoTotal07 == 0 ? 0 : ( ($tiempo - $tiempoMttoTotal07) / $tiempo ));
               $tiempototalMtto08 = ($tiempoMttoTotal08 == 0 ? 0 : ( ($tiempo - $tiempoMttoTotal08) / $tiempo ));
               $tiempototalMtto09 = ($tiempoMttoTotal09 == 0 ? 0 : ( ($tiempo - $tiempoMttoTotal09) / $tiempo )); 
               $tiempototalMtto10 = ($tiempoMttoTotal10 == 0 ? 0 : ( ($tiempo - $tiempoMttoTotal10) / $tiempo ));
               $tiempototalMtto11 = ($tiempoMttoTotal11 == 0 ? 0 : ( ($tiempo - $tiempoMttoTotal11) / $tiempo ));
               $tiempototalMtto12 = ($tiempoMttoTotal12 == 0 ? 0 : ( ($tiempo - $tiempoMttoTotal12) / $tiempo ));
               

               $this->Cell(21,5,number_format(($tiempototal01*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototal02*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototal03*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototal04*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototal05*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototal06*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototal07*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototal08*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototal09*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(22,5,number_format(($tiempototal10*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(22,5,number_format(($tiempototal11*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(22,5,number_format(($tiempototal12*100), 2, '.', ',').'%', 'LTRB', 0, 'C');

               $this->Ln();

               // INDICADOR DE MTTO

               $this->ln();
               $this->SetFont('Arial','',8);
               $this->Cell(255,5,'MANTENIBILIDAD POR MES % = (TIEMPO TOTAL - TIEMPO EN MANTENIMIENTO) / TIEMPO TOTAL ', 'LTRB', 0, 'C');
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

               $this->Cell(21,5,number_format(($tiempototalMtto01*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototalMtto02*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototalMtto03*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototalMtto04*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototalMtto05*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototalMtto06*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototalMtto07*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototalMtto08*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(21,5,number_format(($tiempototalMtto09*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(22,5,number_format(($tiempototalMtto10*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(22,5,number_format(($tiempototalMtto11*100), 2, '.', ',').'%', 'LTRB', 0, 'C');
               $this->Cell(22,5,number_format(($tiempototalMtto12*100), 2, '.', ',').'%', 'LTRB', 0, 'C');

               $this->Ln();

            }

            // function tablaReq($header, $data){
            //     // Column widths
            //     $w = array(10, 134, 22, 26);
            //     // Header
            //     $this->SetFont('Arial','B',7);
            //     for($i=0;$i<count($header);$i++){
            //         $this->Cell($w[$i],10,$header[$i],1,0,'C', true);
            //     }
            //     $nitem = 1;
            //     $this->Ln();
            //     $this->SetFont('Arial','',8);
            //      // Data
            //     foreach($data as $row)
            //     {
            //         $this->Cell($w[0],6,$nitem,'LRB',0,'C');
            //         $this->Cell($w[1],6, ($row['detalle'] != '' )? utf8_encode($row['nombre'].' '.$row['detalle']): utf8_encode($row['nombre']) ,'LRB',0,'L');
            //         $this->Cell($w[2],6,preg_replace('/^(\d+)\.0+$/', '$1',$row['cantidad']),'LRB',0,'C');
            //         $this->Cell($w[3],6,$row['unidad'],'LRB',0,'C');
            //         $this->Ln();
            //         $nitem++;
            //     }

            //     for($nitem;$nitem <= 15; $nitem++){
            //         $this->Cell($w[0],6,$nitem,'LRB',0,'C');
            //         $this->Cell($w[1],6,'','LRB',0,'L');
            //         $this->Cell($w[2],6,'','LRB',0,'C');
            //         $this->Cell($w[3],6,'','LRB',0,'C');
            //         $this->Ln();
            //     }
            //     // Closing line
            //     $this->Cell(array_sum($w),0,'','T');
            // }

            // function tablaOC($data){
            //     // Column widths
            //     $w = array(10, 20, 20, 95, 24, 23);
            //     // Header
            //     $nitem = 1;
            //     $this->SetFont('Arial','',6);
            //      // Data
            //     foreach($data as $row)
            //     {
            //         $this->Cell($w[0],6,$nitem,'LRB',0,'C');
            //         $this->Cell($w[1],6,preg_replace('/^(\d+)\.0+$/', '$1',$row['cantidad']),'LRB',0,'C');
            //         $this->Cell($w[2],6,$row['unidad'],'LRB',0,'C');
            //         $this->Cell($w[3],6, ($row['detalle'] != '' )? utf8_encode($row['nombre'].' '.$row['detalle']): utf8_encode($row['nombre']) ,'LRB',0,'L');
            //         $this->Cell($w[4],6,'','LRB',0,'C');
            //         $this->Cell($w[5],6,'','LRB',0,'C');
            //         $this->Ln();
            //         $nitem++;
            //     }

            //     for($nitem;$nitem <= 13; $nitem++){
            //         $this->Cell($w[0],6,$nitem,'LRB',0,'C');
            //         $this->Cell($w[1],6,'','LRB',0,'L');
            //         $this->Cell($w[2],6,'','LRB',0,'C');
            //         $this->Cell($w[3],6,'','LRB',0,'C');
            //         $this->Cell($w[4],6,'','LRB',0,'C');
            //         $this->Cell($w[5],6,'','LRB',0,'C');
            //         $this->Ln();
            //     }
            //     // Closing line
            //     $this->Cell(array_sum($w),0,'','T');
            // }

        }



?>