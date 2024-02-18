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
        <li class="breadcrumb-item active">Embarcaciones</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-globe"></i> Programas
                            <button class="float-right btn btn-success" id="btnagregar" onclick="mostrarform(true)">
                                <i class="fa fa-plus-circle"></i> Agregar</button>
                        </div>
                        <div class="card-body">
                            <!-- AQUI VA TABLA -->
                            <div class="panel-body table-responsive" id="listadoregistros">
                                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <th>Opciones</th>
                                        <th>Nombre</th>
                                        <th>Fecha Inicio</th>
                                        <th>Horas Inicio</th>
                                        <th>Status</th>
                                        </tfoot>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <th>Opciones</th>
                                        <th>Nombre</th>
                                        <th>Fecha Inicio</th>
                                        <th>Horas Inicio</th>
                                        <th>Status</th>
                                    </tfoot>
                                </table>
                            </div>
                        <div class="card-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="col-sm-12 control-label">Programa *:</label>
                                        <input type="hidden" name="idprogramas" id="idprogramas">
                            <div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Embarcacion *:</label>
                                    <div class="col-sm-12">
                                        <select class="form-control selectpicker" data-live-search="true" name="centro" id="centro">
                                        <option value="">SELECCIONE</option>
                                        </select>
                                    </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Horas de Inicio *:</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" name="horasinicio" id="horasinicio">
                                    </div>
                                </div>
                         <div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Fecha *:</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" name="fechainicio" id="fechainicio" required>
                                    </div>
                        </div>


                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar">
                            <i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" type="button" onclick="cancelarform()">
                            <i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                        </div>
                        </div>
                        </form>
                        </div>

                        <div class="card-body" id="formularioregistros">
                        <form name="formulario" id="formulario2" method="POST">
                            <div class="row">

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="col-sm-12 control-label">Actividades Programadas *:</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="pendientes" rows="10" cols="50" id="pendientes"  ></textarea>
                                    </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-danger" type="button" id="btnRegresar" onclick="cancelarform()">
                            <i class="fa fa-arrow-circle-left"></i> Regresar</button>
                        </div>
                        </div>
                        </form>
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
<script src="vistas/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="vistas/plugins/datatables/buttons.html5.min.js"></script>
<script src="vistas/plugins/datatables/buttons.colVis.min.js"></script>
<script src="vistas/plugins/datatables/jszip.min.js"></script>
<script src="vistas/plugins/datatables/pdfmake.min.js"></script>
<script src="vistas/plugins/datatables/vfs_fonts.js"></script> 
<script type="text/javascript" src="vistas/js/programas.js"></script>
<?php ob_end_flush(); ?>