// JavaScript Document
/*
 * fn-client.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
/* --------------------------------------------------------- */
function cambiarGrupoCliente( idc, valor ){
	//Invocación al servidor para modificar el grupo al que pertenece un cliente
	var fs = $('#frm_ngrupocliente').serialize();
	
	$.ajax({
        type:"POST",
        url:"database/data-clients.php",
        data:{ id_c: idc, grupo_valor: valor },
        success: function( response ){
			console.log( response );
        }
    });
}
/* --------------------------------------------------------- */
function borrarGrupoCliente( idg ){
    //Invocación al servidor para eliminar un grupo de clientes
    $.ajax({
        type:"POST",
        url:"database/data-clients.php",
        data:{ id_elimg: idg },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            
            if( res.exito == -1 ){ 
                notificar( "Borrar grupo de cliente", res.mje, "error" );
            }
        }
    });

}
/* --------------------------------------------------------- */
function iniciarBotonBorrarGrupoCliente(){
    //Asigna los textos de la ventana de confirmación para borrar un grupo de clientes
    iniciarVentanaModal( "btn_borrar_grupo_cliente", "btn_canc", 
                         "Borrar grupo de cliente", "", 
                         "¿Confirma que desea borrar grupo?", 
                         "Confirmar acción" );
}

/* --------------------------------------------------------- */

$( document ).ready(function() {
    $("#bot_guardar_grupo").on( "click", function(){
		agregarGrupoCliente();
    });

    $(".selec_grupo_perfil").on( "change", function(){
        var valor = $(this).val();
        var idc = $(this).attr("data-idc");
        cambiarGrupoCliente( idc, valor );
    });

    $(".elim-gcliente").on( "click", function(){
        $("#ig-grupo-e").val( $(this).attr( "data-idg" ) );
        iniciarBotonBorrarGrupoCliente();
    });

    $('.btn-ok').on('click', function(){
        var idg = $("#ig-grupo-e").val();
        $("#btn_canc").click();
        borrarGrupoCliente( idg );
    });
});

/* --------------------------------------------------------- */