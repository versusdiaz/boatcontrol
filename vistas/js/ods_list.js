var tabla;
var bandera;
function init(){
    mostrarform(false);
    listar();

}

function mostrarform(flag){
    if(flag){
        $("#listadoregistros").hide();
        $("#formulario").show('fast');
        $("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();
        
    }else{
        $("#listadoregistros").show();
        $("#formulario").hide();
        $("#btnagregar").show();
    }
}

function cancelarform(){
    mostrarform(false);
}

function listar(){
    tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginacion y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: 'controllers/ods_list.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginacion
	    "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

 function convertirOds(idods_mtto){
    swal({
        title: "Esta seguro..?"
        , text: "Esta Orden dejara de estar almacenada y podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo activarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/ods_list.php?op=convertirOds',{idods_mtto:idods_mtto},function(e){
            swal("Activado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }


function imprimir(idrequest, idrequest_temp){
    var formData = new FormData();
    formData.append("idrequest",idrequest);
    formData.append("idrequest_temp",idrequest_temp);
    formData.append("bdDepartamento",'request_mtto'); // NOTA CAMBIAR PARA CADA DPTO
    $.ajax({
        url:"controllers/reportes.php?op=reportRequisicion",
        type:"POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(respuesta){
          swal({
            title: "Reporte de Presupuesto"
            , text: "Ha sido generado, continue para imprimir"
            , type: "info"
            , showCancelButton: true
            , confirmButtonColor: "#da4f49"
            , confirmButtonText: "Imprimir!"
            , closeOnConfirm: true
            }, function () {
                window.open(respuesta,"_blank");
            });
        }
     });
}

init();
