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

$( document ).ready(function() {
    $("#bot_guardar_grupo").on( "click", function(){
		agregarGrupoCliente();
    });

    $(".selec_grupo_perfil").on( "change", function(){
        var valor = $(this).val();
        var idc = $(this).attr("data-idc");
        cambiarGrupoCliente( idc, valor );
    });
});

/* --------------------------------------------------------- */