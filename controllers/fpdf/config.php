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
                $this ->MultiCell(20,5,'AFECTA EJECUCION DEL SERVICIO', 'LRT', 'C', 0);

                $this->SetXY(156,42);
                $this->Cell(68,15,'MANTENIMIENTO REALIZADO', 'LRT', 0, 'C',true);

                $this->SetXY(224,42);
                $this ->MultiCell(21,5,'TIEMPO DE MANTENIMIENTO (HRS)', 'LRT', 'C', true);

                $this->SetXY(245,42);
                $this ->MultiCell(20,5,'TIEMPO INOPERATIVO (HRS)', 'LRT', 'C', true);

                // BAJO LINEA DE EMBARCACION

                $this->SetXY(10,47);
                $this->Cell(10,10,'ITEM', 'LRT', 0, 'C',true);

                $this->SetXY(20,47);
                $this ->MultiCell(16,5,'ORDEN DE SERVICIO', 'LRT', 'C', true);

                $this->SetXY(36,47);
                $this->Cell(16,10,'FECHA', 'LRT', 0, 'C',true);

                $this->SetXY(52,47);
                $this ->MultiCell(22,5,'TIPO DE MANTENIMIENTO', 'LRT', 'C', true);

                $this->SetXY(74,47);
                $this->Cell(16,10,'SISTEMA', 'LRT', 0, 'C',true);

                $this->SetXY(90,47);
                $this ->MultiCell(23,5,'SITUACION ENCONTRADA', 'LRT', 'C', true);

                $this->SetXY(113,47);
                $this ->MultiCell(23,5,'INDICIO DE FALLA (SI APLICA)', 'LRT', 'C', true);

                $this->SetXY(10,57);

                }
            }
            /*FOOTER UNIVERSAL*/
            function Footer()
            {
                $x = $this->getX();
                $y = $this->getY();
   
                $this->SetXY($x,$y);
                $this->SetFont('Arial','B',8);
                $this->Cell(30,5,'', 'LRT', 0, 'L');
                $this->Cell(81,5,'ELABORADO POR', 1, 0, 'C', true);
                $this->Cell(81,5,'APROBADO POR', 1, 0, 'C', true);

                $this->SetXY($x,$y+5);

                $this->SetFont('Arial','',6);
                $this->Cell(30,5,'NOMBRE Y APELLIDO:', 'LRT', 0, 'L');
                $this->Cell(81,5,''.'', 1, 0, 'L');
                $this->Cell(81,5,''.'', 1, 0, 'L');

                $this->SetXY($x,$y+10);
                $this->Cell(30,5,'CARGO:', 'LRT', 0, 'L');
                $this->Cell(81,5,'', 1, 0, 'L');
                $this->Cell(81,5,'', 1, 0, 'L');

                $this->SetXY($x,$y+15);
                $this->Cell(30,5,'FIRMA:', 'LRT', 0, 'L');
                $this->Cell(81,5,'', 1, 0, 'L');
                $this->Cell(81,5,'', 1, 0, 'L');

                $this->SetXY($x,$y+20);
                $this->Cell(30,5,'FECHA:', 1, 0, 'L');
                $this->Cell(81,5,''.date('d/m/Y',strtotime($this->fecha)), 1, 0, 'L');
                $this->Cell(81,5,''.date('d/m/Y',strtotime($this->fecha)), 1, 0, 'L');
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