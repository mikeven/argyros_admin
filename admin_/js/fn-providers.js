// JavaScript Document
/*
* fn-providers.js
*
*/

/* --------------------------------------------------------- */	
function borrarProveedor( idprv ){
    //Invocación al servidor para eliminar proveedor
    $.ajax({
        type:"POST",
        url:"database/data-providers.php",
        data:{ elimprovider: idprv },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Proveedores", res.mje, "success" );
                setTimeout( function() { window.location = "providers.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Proveedores", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */ 
function desvincularProductoLinea( idp, idl_d ){
    //Invocación al servidor para desvincular producto de una línea
    $.ajax({
        type:"POST",
        url:"database/data-lines.php",
        data:{ id_desvprod: idp, id_desvlinea: idl_d },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){
                notificar( "Líneas", res.mje, "success" );
                setTimeout( function() { location.reload(); }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Líneas", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function iniciarBotonBorrarProveedor(){
    //Asigna los textos de la ventana de confirmación para borrar un proveedor
    iniciarVentanaModal( "btn_borrar_proveedor", "btn_canc", 
                         "Borrar proveedor", "", 
                         "¿Confirma que desea borrar proveedor?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
$( document ).ready(function() {

    if ( $("#frm_nlinea").length > 0 ){
        $('#frm_nlinea').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }

    if ( $("#frm_mlinea").length > 0 ){
        $('#frm_mlinea').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }
    /* ............................................................ */
    $( "#tabla_datos-proveedores" ).on( "click", ".elim-proveedor", function(){
        $("#id-proveedor-e").val( $(this).attr( "data-idp" ) );
        iniciarBotonBorrarProveedor();

        $('#btn_borrar_proveedor').on('click', function(){
            var idp = $("#id-proveedor-e").val();
            $("#btn_canc").click();
            borrarProveedor( idp );
        });
    });
});

/* --------------------------------------------------------- */