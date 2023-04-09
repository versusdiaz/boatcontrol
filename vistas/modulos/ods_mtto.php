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
            Admin
        </li>
        <li class="breadcrumb-item active">Ordenes y Actividades</li>
    </ol>
    <div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-globe"></i> Orden de Mantenimiento
                        <button class="float-right btn btn-success" id="btnagregar" onclick="mostrarform(true)">
                            <i class="fa fa-plus-circle"></i> Agregar</button>
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
                        <div class="card-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                            <div class="row">

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Embarcacion *:</label>
                                    <div class="col-sm-12">
                                        <select class="form-control selectpicker" data-live-search="true" name="centro" id="centro">
                                        <option value="">SELECCIONE</option>
                                        </select>
                                    </div>
                                </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <input type="hidden" name="idods_mtto" id="idods_mtto">
                                    <label class="col-sm-12 control-label">Numero de Orden *:</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" name="codigo" id="codigo">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="col-sm-12 control-label">Mantenimiento Realizado:</label>
                                    <div class="col-sm-12">
                                        <!-- <input type="textbox" class="form-control" name="com_general" id="com_general"> -->
                                         <textarea class="form-control" name="com_general" id="com_general" ></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Situacion Encontrada:</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="com_estado" id="com_estado">
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Indicio de Falla (Si aplica):</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="com_falla" id="com_falla">
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Horas de la Embarcacion:</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" name="horas" id="horas">
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Tipo de Mantenimiento *:</label>
                                    <div class="col-sm-12">
                                        <select class="form-control selectpicker" data-live-search="true" name="tipo" id="tipo">
                                            <option value="">SELECCIONE</option>
                                            <option value="1">CORRECTIVO</option>
                                            <option value="2">PREVENTIVO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Tiempo inoperativo:</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" name="tiempo_ino" id="tiempo_ino" step="0.1">
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Tipo de Sistema *:</label>
                                    <div class="col-sm-12">
                                        <select class="form-control selectpicker" data-live-search="true" name="sistema" id="sistema">
                                            <option value="">SELECCIONE</option>
                                            <option value="PROPULSION">PROPULSION</option>
                                            <option value="DEFENSAS">DEFENSAS</option>
                                            <option value="COMBUSTIBLE">COMBUSTIBLE</option>
                                            <option value="COMBUSTION">COMBUSTION</option>
                                            <option value="ELECTRICO">ELECTRICO</option>
                                            <option value="ENFRIAMIENTO">ENFRIAMIENTO</option>
                                            <option value="LUBRICACION">LUBRICACION</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Tiempo de Mantenimiento:</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" name="tiempo_mtto" id="tiempo_mtto" step="0.1">
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Afecta el Servicio? *:</label>
                                    <div class="col-sm-12">
                                        <select class="form-control selectpicker" data-live-search="true" name="afectaservicio" id="afectaservicio">
                                            <option value="">SELECCIONE</option>
                                            <option value="1">Si</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Costo:</label>
                                    <div class="input-group-append col-sm-12">
                                        <input type="number" class="form-control" name="costo" id="costo">
                                        <span class="input-group-text">$</span>
                                    </div>
                                </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Fecha *:</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" name="fecha" id="fecha" required>
                                    </div>
                                </div>

                            </div><!-- FIN DEL ROW -->
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
            
            <div class="col-lg-6 col-sm-6 col-xl-6">
                
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-fire"></i> Cargar Actividades
                    <button class="float-right btn btn-success" id="btnInfo" >
                            Numero</button>
                </div>
                <div class="card-body" id="formularioPurchase">
                    <form name="formulario" id="formularioP" method="POST">
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <input type="hidden" name="idrequest_tempP" id="idrequest_tempP">
                            <label class="col-sm-12 control-label">Nombre *:</label>
                            <input type="hidden" name="iditems" id="iditems">
                                <div class="col-sm-12">
                                    <select class="form-control selectpicker" data-live-search="true" name="nombreItem" id="nombreItem">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <label class="col-sm-12 control-label">Cantidad *:</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="cantidad" id="cantidad" min='0.1' step='0.1' value='1' >
                                </div>
                            </div>                            
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6 formDetalle">
                                <label class="col-sm-12 control-label">Detalle *:</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="detalle" id="detalle" >
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6 formDetalle">
                                <label class="col-sm-12 control-label">Precio *:</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="precio" id="precio" step='0.01' >
                                </div>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardarP">
                                    <i class="fa fa-download"></i> Cargar</button>
                                <button class="btn btn-danger" type="button" onclick="cancelarformP()">
                                    <i class="fa fa-eraser"></i> Limpiar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-xl-6">
            <div class="card">
                    <div class="card-header">
                        <i class="fa fa-list-alt"></i> Actividades ejecutadas
                    </div>
                    <div class="card-body">
                        <!-- AQUI VA TABLA -->
                        <div class="panel-body table-responsive" id="listadoregistrosPurchase">
                            <table id="tbllistadoPurchase" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
        </div> 
                <!-- FIN DEL TABLE PURCHASE -->
        </div>
 </div>
<!-- FIN DEL TABLE PURCHASE -->
        </div>
    </div> <!-- FIN DEL ROW -->
</div>
        <!-- FIN DEL JUMBO -->
    </div>
</main>
</div>
<?php include_once("vistas/modulos/inc/footer.php"); ?>
<!-- SCRIPT UNICOS-->
<script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>    
<!-- <script src="vistas/plugins/datatables/dataTables.buttons.min.js"></script> -->
<!-- <script src="vistas/plugins/datatables/buttons.html5.min.js"></script> -->
<script src="vistas/plugins/datatables/buttons.colVis.min.js"></script>
<!-- <script src="vistas/plugins/datatables/jszip.min.js"></script> -->
<!-- <script src="vistas/plugins/datatables/pdfmake.min.js"></script> -->
<!-- <script src="vistas/plugins/datatables/vfs_fonts.js"></script>  -->
<script type="text/javascript" src="vistas/js/ods_mtto.js"></script>
<?php ob_end_flush(); ?>