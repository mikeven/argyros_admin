// JavaScript Document
/*
 * fn-making.js
 *
 */

 function borrarTrabajo( idt ){
    //Invocación al servidor para eliminar trabajo
    $.ajax({
        type:"POST",
        url:"database/data-makings.php",
        data:{ id_elim_trabajo: idt },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Trabajos", res.mje, "success" );
                setTimeout( function() { window.location = "makings.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Borrar trabajos", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function iniciarBotonBorrarTrabajo(){
    //Asigna los textos de la ventana de confirmación para borrar un trabajo
    iniciarVentanaModal( "btn_borrar_trabajo", "btn_canc", 
                         "Borrar trabajo", "", 
                         "¿Confirma que desea borrar trabajo?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
function cargarListaTrabajosMaterial( idm ){
	//
	$.ajax({
        type:"POST",
        url:"database/data-makings.php",
        data:{ obt_mattrabajo: idm },
        success: function( response ){
        	console.log( response );
			//res = jQuery.parseJSON( response );
        }
    });
}

/* --------------------------------------------------------- */
$( document ).ready(function() {
   
    $("#tabla_datos-trabajos").on( "click", ".elim-trabajo", function(){
        $("#id-trabajo-e").val( $(this).attr( "data-idt" ) );
        iniciarBotonBorrarTrabajo();

        $('#btn_borrar_trabajo').on('click', function(){
            var idt = $("#id-trabajo-e").val();
            $("#btn_canc").click();
            borrarTrabajo( idt );
        });
    });

});

/* --------------------------------------------------------- */