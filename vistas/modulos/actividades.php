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
        <li class="breadcrumb-item active">Actividades</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-globe"></i> Actividades Preventivas y Correctivas
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
                                        <th>Numero Act.</th>
                                        <th>Severidad</th>
                                        <th>Tolerancia</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <th>Opciones</th>
                                        <th>Nombre</th>
                                        <th>Numero Act.</th>
                                        <th>Severidad</th>
                                        <th>Tolerancia</th>
                                        <th>Status</th>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="card-body" id="formularioregistros">
                            <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="col-sm-12 control-label">Nombre *:</label>
                            <input type="hidden" name="idact" id="idact">
                                <div class="col-sm-12">
                                <input type="text" class="form-control" name="nombre" id="nombre">
                                </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-sm-12 control-label">Numero de Actividad *:</label>
                        <div class="col-sm-12">
                        <input type="number" class="form-control" name="numact" id="numact" step="1" required>                       
                        </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-sm-12 control-label">Horas de ejecucion de actividad *:</label>
                        <div class="col-sm-12">
                        <input type="number" class="form-control" name="horas" id="horas" step="1" required>                                               
                        </div>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="col-sm-12 control-label">Materiales *:</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" name="materiales" id="materiales">
                                </div>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="col-sm-12 control-label">Repuestos *:</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" name="repuestos" id="repuestos">
                                </div>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-sm-12 control-label">Severidad *:</label>
                        <div class="col-sm-12">
                            <select class="form-control selectpicker" data-live-search="true" name="severidad" id="severidad">
                            <option value="">SELECCIONE</option>
                            <option value="NORMAL">NORMAL</option>
                            <option value="URGENTE">URGENTE</option>
                            <option value="CRITICA">CRITICA</option>
                            </select>
                        </div>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-sm-12 control-label">Tolerancia *:</label>
                        <div class="col-sm-12">
                        <input type="number" class="form-control" name="tolerancia" id="tolerancia" step="1" required>                       
                        </div>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary" type="submit" id="btnGuardar">
                            <i class="fa fa-save"></i> Guardar</button>
                        <button class="btn btn-danger" type="button" onclick="cancelarform()">
                            <i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
<script type="text/javascript" src="vistas/js/actividades.js"></script>
<?php ob_end_flush(); ?>