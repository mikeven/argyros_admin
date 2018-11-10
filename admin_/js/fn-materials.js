// JavaScript Document
/*
* fn-materials.js
*
*/
/* --------------------------------------------------------- */	
function borrarMaterial( idm ){
    //Invocación al servidor para eliminar material
    $.ajax({
        type:"POST",
        url:"database/data-materials.php",
        data:{ id_elim_material: idm },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Materiales", res.mje, "success" );
                setTimeout( function() { window.location = "materials.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Borrar materiales", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function iniciarBotonBorrarMaterial(){
    //Asigna los textos de la ventana de confirmación para borrar un material
    iniciarVentanaModal( "btn_borrar_material", "btn_canc", 
                         "Borrar material", "", 
                         "¿Confirma que desea borrar material?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */

$( document ).ready(function() {

    $('#frm_nmaterial').parsley().on('form:success', function() {
        //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
    });

    $("#tabla_datos-materiales").on( "click", ".elim-material", function(){
        $("#id-material-e").val( $(this).attr( "data-idm" ) );
        iniciarBotonBorrarMaterial();

        $('#btn_borrar_material').on('click', function(){
            var idm = $("#id-material-e").val();
            $("#btn_canc").click();
            borrarMaterial( idm );
        });
    });
});

/* --------------------------------------------------------- */