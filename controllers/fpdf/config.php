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
                $this->Cell(220,20, utf8_decode("SISTEMA DE GESTIÓN DE LA CALIDAD"), 1, 0, 'L');
    
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