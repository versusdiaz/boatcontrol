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
                            <i class="fa fa-globe"></i> Ordenes Almacenadas
                        </div>
                        <div class="card-body">
                            <!-- AQUI VA TABLA -->
                            <div class="panel-body table-responsive" id="listadoregistros">
                                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <th>Opciones</th>
                                    <th>Num ODS</th>
                                    <th>Embarcacion</th>
                                    <th>Situacion E.</th>
                                    <th>Fecha</th>
                                    <th>Cod. Interno</th>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <th>Opciones</th>
                                    <th>Num ODS</th>
                                    <th>Embarcacion</th>
                                    <th>Situacion E.</th>
                                    <th>Fecha</th>
                                    <th>Cod. Interno</th>
                                </tfoot>
                                </table>
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
<script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>    
<script src="vistas/plugins/datatables/buttons.colVis.min.js"></script>
<script type="text/javascript" src="vistas/js/ods_list.js"></script>
<?php ob_end_flush(); ?>