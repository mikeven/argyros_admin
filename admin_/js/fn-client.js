// JavaScript Document
/*
 * fn-client.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
/* --------------------------------------------------------- */
function agregarGrupoCliente(){
	//Invocación al servidor para agregar nuevo registro de grupo cliente
	var fs = $('#frm_ngrupocliente').serialize();
	
	$.ajax({
        type:"POST",
        url:"database/data-clients.php",
        data:{ form_ngrupo: fs },
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
});

/* --------------------------------------------------------- */