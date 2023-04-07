var tabla;
var bandera;
function init(){
    mostrarform(false);
    listar();
    
    jQuery.validator.addMethod("nombre", function(value, element){
        if (/^[-_\w\.\s]*$/i.test(value)) {
            return true;  // FAIL validation when REGEX matches
        } else {
            return false;   // PASS validation otherwise
        };
    }, "Nombre no valido");
    
    $("#formulario").validate({
        rules:{
            nombre:{
                required: true,
                nombre: true
            },
            numact:{
                required: true,
                number: true,
                min: 0
            },
            horas:{
                required: true,
                number: true,
                min: 0
            },
            tolerancia:{
                number: true,
                min: 0
            }
        },
        messages: {
            nombre:{
                required: "Campo requerido"
            }
        },
        errorElement: "div",
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "invalid-feedback" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            // $( element ).parents( ".col-sm-12" ).addClass( "is-invalid" ).removeClass( "has-success" );
            $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
        },
        unhighlight: function (element, errorClass, validClass) {
            $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
        }
       });

    $("#formulario").on("submit",function(e){
        if ($("#formulario").validate().form() == true){
            guardaryeditar(e);
        }
    });
    
}

function limpiar(){
    $("#idact").val("");
    $("#nombre").val("");
    $("#numact").val("");
    $("#horas").val("");
    $("#materiales").val("");
    $("#repuestos").val("");
    $("#severidad").val("");
    $("#severidad").selectpicker('refresh');
    $("#tolerancia").val("");
    /*QUITAR CLASES A LOS ELEMENTOS*/
    $(".form-group").removeClass('has-success has-error');
}

function mostrarform(flag){
    limpiar();
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
    limpiar();
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
					url: 'controllers/actividades.php?op=listar',
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

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
       url:"controllers/actividades.php?op=guardaryeditar",
       type:"POST",
       data: formData,
       contentType: false,
	   processData: false,
       success: function(respuesta){
         swal(respuesta, "Presione OK para continuar");
         mostrarform(false);
	     tabla.ajax.reload();
       }
    });
}

function mostrar(idact){
     $.post("controllers/actividades.php?op=mostrar",{idact:idact},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
        $("#idact").val(data.idact);
        $("#nombre").val(data.nombre);
        $("#numact").val(data.numact);
        $("#horas").val(data.horas);
        $("#materiales").val(data.materiales);
        $("#repuestos").val(data.repuestos);
        $("#unidad").val(data.unidad);
        $("#unidad").selectpicker('refresh');
        $("#severidad").val(data.severidad);
        $("#severidad").selectpicker('refresh');
        $("#tolerancia").val(data.tolerancia);
     });
    }

 function eliminar(idact){
    swal({
        title: "Esta seguro..?"
        , text: "Al eliminar esta actividad, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo eliminarla!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/actividades.php?op=eliminar',{idact:idact},function(e){
            swal("Eliminada!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function desactivar(idact){
    swal({
        title: "Esta seguro..?"
        , text: "Al desactivar esta actividad, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo desactivarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/actividades.php?op=desactivar',{idact:idact},function(e){
            swal("Desactivado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function activar(idact){
    swal({
        title: "Esta seguro..?"
        , text: "Al activar este actividad podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo activarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/actividades.php?op=activar',{idact:idact},function(e){
            swal("Activado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

init();
