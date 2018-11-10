// JavaScript Document
/*
 * fn-colors.js
 *
 */

 function borrarColor( idc ){
    //Invocación al servidor para eliminar color
    $.ajax({
        type:"POST",
        url:"database/data-colors.php",
        data:{ id_elim_color: idc },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Colores", res.mje, "success" );
                setTimeout( function() { window.location = "colors.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Borrar colores", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function iniciarBotonBorrarColor(){
    //Asigna los textos de la ventana de confirmación para borrar un color
    iniciarVentanaModal( "btn_borrar_color", "btn_canc", 
                         "Borrar color", "", 
                         "¿Confirma que desea borrar color?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
$( document ).ready(function() {

    if ( $("#frm_ncolor").length > 0 ){
        $('#frm_ncolor').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }

    if ( $("#frm_mcolor").length > 0 ){
        $('#frm_mcolor').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }
   
    $("#tabla_datos-colores").on( "click", ".elim-color", function(){
        $("#id-color-e").val( $(this).attr( "data-idc" ) );
        iniciarBotonBorrarColor();

        $('#btn_borrar_color').on('click', function(){
            var idc = $("#id-color-e").val();
            $("#btn_canc").click();
            borrarColor( idc );
        });
    });

});

/* --------------------------------------------------------- */