<?php
  if(!$_SESSION['validarPTR']){
      header("location:inicio");
      exit();
  } else {
        include_once("vistas/modulos/inc/aside.php");
 }
?>
<main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">
            <a href="#">Admin</a>
        </li>
        <li class="breadcrumb-item active">Ver Alertas</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-globe"></i> Actividades Preventivas y Correctivas
                            <button class="float-right btn btn-primary" id="btnagregar" onclick="mostrarform(true)">
                                <i class="fa fa-plus-circle"></i> Ver Alertas</button>
                        </div>
                    </div>
                </div> 

                <div class="col-lg-12 col-md-6 col-xs-12 bg-white">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                
                                <h3 class="box-title">Resumen de Alertas</h3>
                            </div>
                            <div class="box-body" id='licenciaPorVencer'>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DEL JUMBO -->
    </div>
</main>
</div>
<?php include_once("vistas/modulos/inc/footer.php"); ?>
<!-- SCRIPT UNICOS-->
<script type="text/javascript" src="vistas/js/veralert.js"></script>
<?php ob_end_flush(); ?>