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
                                
                                <h3 class="box-title">Resumen de Actividades</h3>
                            </div>
                            <div class="box-body">
                                <div id="ldanger2" class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>
                                        <i class="icon fa fa-ban"></i> Vencido!</h4>Las siguientes actividades estan vencidas:
                                    <ol id='certificadoVencida'>

                                    </ol>
                                </div>
                                <div id="lwarning2" class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>
                                        <i class="fa fa-warning"></i> Advertencia!</h4>Las siguientes actividades estan proximas a ejecutarse:

                                    <ol id='licenciaPorVencer'>
                                    </ol>
                                </div>
                                <div id="lsuccess2" class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>
                                        <i class="icon fa fa-check"></i> Exito!</h4> Todas las actividades estan al dia! </div>
                            </div>
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