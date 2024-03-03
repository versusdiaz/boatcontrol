function init(){

//    $.post("controllers/veralert.php?op=verAlert2",function(respuesta){
//        /*CONVERTIMOS EL JSON EN UN ARREGLO*/
//        parsed = JSON.parse(respuesta);
//        for (var i=0;i<parsed.length;i++){
//             // $("#licenciaPorVencer").append("<li>"+parsed[i]['nombre']+" - <b><span style='color:red;font-size:16px;'></span></b> Dias Restantes </li>");
//         }
//        alert(respuesta);
//    });
    
}


init();


$.post("controllers/veralert.php?op=verAlert2",function(respuesta){
    /*CONVERTIMOS EL JSON EN UN ARREGLO*/
         $("#licenciaPorVencer").append(respuesta);
    console.log(respuesta);
});