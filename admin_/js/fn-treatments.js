// JavaScript Document
/*
 * fn-treatments.js
 *
 /* --------------------------------------------------------- */	

function borrarBano( idb ){
    //Invocación al servidor para eliminar baño
    $.ajax({
        type:"POST",
        url:"database/data-treatments.php",
        data:{ id_elim_bano: idb },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Baños", res.mje, "success" );
                setTimeout( function() { window.location = "treatments.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Borrar baño", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function iniciarBotonBorrarBano(){
    //Asigna los textos de la ventana de confirmación para borrar un material
    iniciarVentanaModal( "btn_borrar_bano", "btn_canc", 
                         "Borrar baño", "", 
                         "¿Confirma que desea borrar baño?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */

$( document ).ready(function() {

    if ( $("#frm_ntreatment").length > 0 ){
        $('#frm_ntreatment').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }

    if ( $("#frm_mtreatment").length > 0 ){
        $('#frm_mtreatment').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }

    $("#tabla_datos-banos").on( "click", ".elim-bano", function(){
        $("#id-bano-e").val( $(this).attr( "data-idb" ) );
        iniciarBotonBorrarBano();

        $('#btn_borrar_bano').on('click', function(){
            var idb = $("#id-bano-e").val();
            $("#btn_canc").click();
            borrarBano( idb );
        });
    });
});

/* --------------------------------------------------------- */