<?php
session_start();
require_once("../modelos/VerAlert.php");

$verAlert = new VerAlert();

/*INICIALIZO VARIABLES*/

// $idcentro = isset($_POST['idcentro']) ? limpiarCadena($_POST['idcentro']): "";

switch ($_GET["op"]){

    case 'verAlert':
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        // Consulto arreglo de los programas
        $rspta = $verAlert->verProgramas();
        
        // Leo cada programa con y comparo las horas actuales con las programadas
        foreach ($rspta as $item){

        // Consulto arreglo de las act de ese programa
            $rspta2 = $verAlert->verActProgramas($item['idprogramas']);

            foreach ($rspta2 as $item2){
                // Comparo las horas actuales con el programa

                if ($item['horasactual'] < $item2['horasplan']) {
                    // La actividad está pendiente
                    $diferenciaHoras = $item2['horasplan'] - $item['horasactual'];
                    
                    if ($diferenciaHoras < 24) {
                        $mensaje = "<p>**¡Alerta!** La actividad <strong>" . $item2['nombre'] . "</strong> está planeada para las " . $item2['horasplan']  . " y solo quedan <strong>" . $diferenciaHoras . " horas</strong> para que ser ejecutada.</p>";
                      } elseif ($diferenciaHoras < 50) {
                        $mensaje = "<p>**Aviso:** ".$item['nombre']." tiene la actividad <strong>" . $item2['nombre']  . "</strong> planeada para las " . $item2['horasplan'] . " y quedan <strong>" . $diferenciaHoras . " horas</strong> para que se ejecute.</p>";
                      } else {
                        $mensaje = "<p>".$item['nombre']." tiene la actividad <strong>" . $item2['nombre'] . "</strong> planeada para las " . $item2['horasplan'] . " y aún quedan <strong>" . $diferenciaHoras . " horas</strong> para que se ejecute.</p>";
                      }
                
                    } else {
                    // La actividad está vencida
                    $diferenciaHoras = $item['horasactual'] - $item2['horasplan'];
                    $mensaje = "La actividad estaba planeada para las " . $item2['horasplan'] . " y está vencida desde hace " . $diferenciaHoras . " horas.";
                  }
                  
                  echo $mensaje;

            }
        }

    break;

    case 'verAlert2':
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        // Consulto arreglo de los programas
        $rspta = $verAlert->verProgramas();

        $mensajesAgrupados = array();
        
        // Leo cada programa con y comparo las horas actuales con las programadas
        foreach ($rspta as $item){

        // Consulto arreglo de las act de ese programa
            $rspta2 = $verAlert->verActProgramas($item['idprogramas']);

            foreach ($rspta2 as $item2){
                // Comparo las horas actuales con el programa
                if ($item['horasactual'] < $item2['horasplan']) {
                    // La diferencia
                    $diferenciaHoras = $item2['horasplan'] - $item['horasactual'];

                        // Obtener el nombre de la embarcación
                        $embarcacion = $item['nombre'];

                        // Si la embarcación no existe en el array de mensajes agrupados, crear una nueva entrada
                        if (!isset($mensajesAgrupados[$embarcacion])) {
                            $mensajesAgrupados[$embarcacion] = array();
                        }

                    
                    if ($diferenciaHoras < 24) {
                        $mensaje = "<p>**¡Alerta!** La actividad <strong>" . $item2['nombre'] . "</strong> está planeada para las " . $item2['horasplan']  . " y solo quedan <strong>" . $diferenciaHoras . " horas</strong> para que ser ejecutada.</p>";
                        // Agregar el mensaje al array de la embarcación
                    } elseif ($diferenciaHoras < 50) {
                        $mensaje = "<p>**Aviso:**  tiene la actividad <strong>" . $item2['nombre']  . "</strong> planeada para las " . $item2['horasplan'] . " y quedan <strong>" . $diferenciaHoras . " horas</strong> para que se ejecute.</p>";

                    } else {
                        $mensaje = "<p> <strong>" . $item2['nombre'] . "</strong> planeada para las " . $item2['horasplan'] . " y aún quedan <strong>" . $diferenciaHoras . " horas</strong> para que se ejecute.</p>";  
                    }

                    $mensajesAgrupados[$embarcacion][] = $mensaje;  
                
                    } else {
                    // La actividad está vencida
                    $diferenciaHoras = $item['horasactual'] - $item2['horasplan'];
                    $mensaje = "La actividad estaba planeada para las " . $item2['horasplan'] . " y está vencida desde hace " . $diferenciaHoras . " horas.";
                  }
            }

        }

                    // Recorro el arreglo
                    foreach ($mensajesAgrupados as $embarcacion => $mensajes) {
                        echo "<h2>Embarcación: $embarcacion</h2>";
                        foreach ($mensajes as $mensaje) {
                            echo $mensaje;
                        }
                }

    break;

}

