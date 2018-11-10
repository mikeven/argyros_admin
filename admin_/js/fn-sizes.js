// JavaScript Document
/*
* fn-sizes.js
*
*/

/* --------------------------------------------------------- */	

function borrarTalla( idt ){
    //Invocación al servidor para eliminar talla
    $.ajax({
        type:"POST",
        url:"database/data-sizes.php",
        data:{ id_elimtalla: idt },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Tallas", res.mje, "success" );
                setTimeout( function() { window.location = "sizes.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Borrar talla", res.mje, "error" );
            }
        }
    });

}
/* --------------------------------------------------------- */
function iniciarBotonBorrarTalla(){
    //Asigna los textos de la ventana de confirmación para borrar una talla
    iniciarVentanaModal( "btn_borrar_talla", "btn_canc", 
                         "Borrar talla", "", 
                         "¿Confirma que desea borrar talla?", 
                         "Confirmar acción" );
}

/* --------------------------------------------------------- */

$( document ).ready(function() {

    if ( $("#frm_ntalla").length > 0 ){
        $('#frm_ntalla').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }

    if ( $("#frm_mtalla").length > 0 ){
        $('#frm_mtalla').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }

    $("#tabla_datos-tallas").on( "click", ".elim-rtalla", function(){
        $("#id-talla-e").val( $(this).attr( "data-idt" ) );
        iniciarBotonBorrarTalla();

        $('#btn_borrar_talla').on('click', function(){
            var idt = $("#id-talla-e").val();
            $("#btn_canc").click();
            borrarTalla( idt );
        });
    });
});

/* --------------------------------------------------------- */