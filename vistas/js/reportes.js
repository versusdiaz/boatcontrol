/*JS PARA CONTROL DE IMPRIMIR, COLOCAR BOTONES EN EL MEDIO PARA QUE NO SE VEAN TODAS LAS OPCIONES Y USAR UN SHOW Y HIDE PARA QUE TODO ESTA FINO*/
var tabla;
var bandera;

function init(){

/*TRAEMOS LAS EMBARCACIONES POR POST*/
    $.post("controllers/centro.php?op=listarc",function(respuesta){
        $("#idcentro").html(respuesta);
        $("#idcentro").selectpicker('refresh');
        });

        $.post("controllers/centro.php?op=listarc",function(respuesta){
        $("#idcentro2").html(respuesta);
        $("#idcentro2").selectpicker('refresh');
        });


    mostrarform(false,0);
    
     $("#formulario1").on("submit",function(e){
        e.preventDefault();
        var formData = new FormData($("#formulario")[0]);
        var idcentro = $("#idcentro").val();

        formData.append("idcentro",idcentro);

         $.ajax({
            url:"controllers/reportes.php?op=reporteHistorial",
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(respuesta){
              /*swal(respuesta, "Presione OK para continuar");*/
              swal({
                title: "Historial ATM-RG-MT-007"
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
    });

    $("#formulario2").on("submit",function(e){
        e.preventDefault();
        var formData = new FormData($("#formulario")[0]);
        var idcentro2 = $("#idcentro2").val();

        formData.append("idcentro2",idcentro2);

         $.ajax({
            url:"controllers/reportes.php?op=controlInterno",
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(respuesta){
              /*swal(respuesta, "Presione OK para continuar");*/
              swal({
                title: "Programa de Mantenimiento Preventivo ATM-RG-MT-002"
                , text: "Ha sido generado, continue para imprimir"
                , type: "info"
                , showCancelButton: true
                , confirmButtonColor: "#da4f49"
                , confirmButtonText: "Imprimir!"
                , closeOnConfirm: true
                }, function () {
                    // window.open(respuesta,"_blank");
                    alert(respuesta);
                });
            }
         });
    });

    $("#formulario3").on("submit",function(e){
        e.preventDefault();
        var formData = new FormData($("#formulario3")[0]);
        var empresa = $("#idempresa3").val();
        var ticket = $("#ticket").val();

        formData.append("idempresa",empresa);
        formData.append("ticket",ticket);
         $.ajax({
            url:"controllers/imprimiru.php?op=detalleTicket",
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(respuesta){
              /*swal(respuesta, "Presione OK para continuar");*/
              swal({
                title: "Detalle de Ticket"
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
    });

    $("#formulario4").on("submit",function(e){
        e.preventDefault();
        var formData = new FormData($("#formulario3")[0]);
        var cliente = $("#idcliente").val();
        var startDate = $("#fechaprepago3").data("daterangepicker").startDate.format('YYYY-MM-DD');
        var endDate = $("#fechaprepago3").data("daterangepicker").endDate.format('YYYY-MM-DD');
        var empresa = $("#idempresa4").val();

        formData.append("idcliente",cliente);
        formData.append("startDate",startDate);
        formData.append("endDate",endDate);
        formData.append("idempresa",empresa);
         $.ajax({
            url:"controllers/imprimiru.php?op=SxCliente",
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(respuesta){
              /*swal(respuesta, "Presione OK para continuar");*/
              swal({
                title: "Servicios por Cliente"
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
    });
}

function limpiar(){
    $("#idcentro").selectpicker("val","");
    $("#idcentro2").selectpicker("val","");
    /*QUITAR CLASES A LOS ELEMENTOS*/
    $(".form-group").removeClass('has-success has-error');
}

function mostrarform(flag,valor){
    limpiar();
    if(flag){
        $(".reportes").hide();
        $("#cuadro"+valor).show('fast');
        
    }else{
        $(".reportes").hide();
        $("#btnagregar").show();
    }
}

function cancelarform(){
    mostrarform(false);
    limpiar();
}


init();
