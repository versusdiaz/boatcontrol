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
            horasinicio:{
                required:true,
                number:true
            },
            centro:{
                required:true
            },
            fechainicio:{
                required: true,
                date: true,
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
        if($("#formulario").validate().form() == true){
            guardaryeditar(e);
        }
    });

}

$.post("controllers/centro.php?op=listarc",function(respuesta){
    $("#centro").html(respuesta);
    $("#centro").selectpicker('refresh');
    });

function limpiar(){
    $("#idcentro").val("");
    $("#idcentro").val("");
    $("#horasinicio").val("");
    $("#fechainicio").val("");
    $("#centro").val("");
    $("#centro").selectpicker("refresh");

    $(".form-group").removeClass('has-success has-error');
}

function mostrarform(flag){
    limpiar();
    if(flag){
        $("#listadoregistros").hide();
        $("#formulario").show('fast');
        $("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();
    } else {
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
					url: 'controllers/programas.php?op=listar',
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
       url:"controllers/programas.php?op=guardaryeditar",
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

function mostrar(idprogramas){
    $.post("controllers/programas.php?op=mostrar",{idprogramas:idprogramas},function(data,status){
         /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
        data = JSON.parse(data);
        mostrarform(true);
       $("#idprogramas").val(data.idprogramas);
       $("#horasinicio").val(data.horasinicio);

       $("#fechainicio").val(data.fechainicio);
       $("#centro").val(data.idcentro);
       $("#centro").selectpicker("refresh");

    });
   }

function eliminar(idcentro){
swal({
    title: "Esta seguro..?"
    , text: "Al eliminar esta embarcacion, no podra utilizarse en el sistema"
    , type: "warning"
    , showCancelButton: true
    , confirmButtonColor: "#da4f49"
    , confirmButtonText: "Si, deseo eliminarla!"
    , closeOnConfirm: false
    }, function () {
        $.post('controllers/centro.php?op=eliminar',{idcentro:idcentro},function(e){
        swal("Eliminada!", e , "success");  
        tabla.ajax.reload();
        });
    });
 }

 function desactivar(idprogramas){
    swal({
        title: "Esta seguro..?"
        , text: "Al guardar este programa la informacion no estara disponible para editar"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo Guardarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/programas.php?op=desactivar',{idprogramas:idprogramas},function(e){
            swal("Guardado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function activar(idcentro){
    swal({
        title: "Esta seguro..?"
        , text: "Al activar esta embarcacion, podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo activarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/centro.php?op=activar',{idcentro:idcentro},function(e){
            swal("Activado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

init();