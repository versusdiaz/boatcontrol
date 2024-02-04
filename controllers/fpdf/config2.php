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


                // BAJO LINEA DE EMBARCACION

                $this->SetXY(10,57);

                }
            }
            /*FOOTER UNIVERSAL*/
            function Footer()
            {
            }

             function tablaActividades($data){
                // Column widths

                // Header
                $nitem = 1;
                $this->SetFont('Arial','',6);
                // VARIABLES

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

                        $this->Cell(40,5,'Actividades ejecutadas en enero', 'LTRB', 0, 'C');
                        $this->Cell(100,5,$row['nombre'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['fecha'], 'LTRB', 0, 'C');
                        $this->Cell(21,5,$row['codigo'], 'LTRB', 0, 'C');
                        $this->Ln();
                        

                    } 
                    else if ($validarFechaFebrero == true) {

                        
                    }
                     else if ($validarFechaMarzo == true) {

                        
                    }
                    else if ($validarFechaAbril == true) {

                        
                    }
                    else if ($validarFechaMayo == true) {


                        
                    }
                    else if ($validarFechaJunio == true) {

                        
                    }
                    else if ($validarFechaJulio == true) {

                        
                    }
                    else if ($validarFechaAgosto == true) {

                        
                    }
                    else if ($validarFechaSeptiembre == true) {

                        
                    }
                    else if ($validarFechaOctubre == true) {

                        
                    }
                    else if ($validarFechaNoviembre == true) {

                        
                    }
                    else {

                        
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
               $this->SetFont('Arial','',8);
               $this->Cell(255,5,'ACTIVIDADES EJECUTADAS POR MES', 'LTRB', 0, 'C');
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

               $this->Cell(21,5,'COLOCAR AQUI VALORES RECORRER', 'LTRB', 0, 'C');


               $this->Ln();

            }

        }



?>