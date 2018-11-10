// JavaScript Document
/*
* fn-settings.js
*
*/
/* --------------------------------------------------------- */	
function iniciarBotonBorrarMaterial(){
    //Asigna los textos de la ventana de confirmación para borrar un material
    iniciarVentanaModal( "btn_borrar_material", "btn_canc", 
                         "Borrar material", "", 
                         "¿Confirma que desea borrar material?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
function actualizarEmailsConfig(){
    //Invoca la actualización de datos de configuración de emails
    var fc = $('#frm_cfg_email').serialize();    

    $.ajax({
        type:"POST",
        url:"database/data-settings.php",
        data:{ form_cfg_email: fc },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            if( res.exito == 1 )
                notificar( "Configuración", res.mje, "success" );
            else
                notificar( "Configuración", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */

$( document ).ready(function() {

    $('#frm_cfg_email').parsley().on('form:success', function() {
        //Validación del formulario
    });
    $('#frm_cfg_email').submit(function(e){
        e.preventDefault();
        actualizarEmailsConfig();
    });
    
});

/* --------------------------------------------------------- */