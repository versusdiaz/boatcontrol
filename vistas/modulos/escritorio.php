<?php
  if(!$_SESSION['validarPTR']){
      header("location:inicio");
      exit();
  } else {
        include_once("vistas/modulos/inc/aside.php");
 }
?>
<!-- INICIO DEL ESCRITORIO USUARIOS COMUNES -->
<!-- FIN DEL BODY -->
<main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">
            <a href="#">Admin</a>
          </li>
          <li class="breadcrumb-item active">Escritorio</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                  <div class="col-sm-12 col-xl-12">
                    <div class="card">
                      <div class="card-header">
                        <i class="fa fa-globe"></i> Escritorio
                      </div>
                      <div class="card-body">
                        <div class="jumbotron">
                          <h1 class="display-3">NavegaContigo</h1>
                          <p class="lead">Sistema para control de embarcaciones de ATM</p>
                          <hr class="my-4">
                          <p> <b>Objetivo de la Sistema</b></p>
                          <p>Gestionar el mantenimiento preventivo y correctivo a las embarcaciones, con el fin de asegurar las condiciones operativas que permitan la seguridad y confort a bordo y al mismo tiempo extender la vida útil de la misma.</p>
                        </div>
                      </div>
                      <!-- FIN DEL CARDBODY -->
                    </div>
                    <!-- FIN CARD -->
                  </div>
                  <!-- FIN DEL COL -->
                </div>
              </div>
              <!-- FIN DEL JUMBO -->
        </div>
      </main>
    </div>
<?php include_once("vistas/modulos/inc/footer.php"); ?>
<!-- SCRIPT UNICOS-->
<script type="text/javascript" src="vistas/js/escritorio.js"></script> 
<?php ob_end_flush(); ?>