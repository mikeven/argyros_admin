// JavaScript Document
/*
* fn-lines.js
*
*/

/* --------------------------------------------------------- */	
function borrarLinea( idl ){
    //Invocación al servidor para eliminar talla
    $.ajax({
        type:"POST",
        url:"database/data-lines.php",
        data:{ id_elimlinea: idl },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Líneas", res.mje, "success" );
                setTimeout( function() { window.location = "lines.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Borrar líneas", res.mje, "error" );
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
function iniciarBotonBorrarLinea(){
    //Asigna los textos de la ventana de confirmación para borrar una línea
    iniciarVentanaModal( "btn_borrar_linea", "btn_canc", 
                         "Borrar línea", "", 
                         "¿Confirma que desea borrar línea?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
function iniciarBotonDesvincularProductoLinea(){
    //Asigna los textos de la ventana de confirmación para desvincular una línea de un producto
    iniciarVentanaModal( "btn_desv_linea_prod", "btn_canc", 
                         "Desvincular producto", "", 
                         "¿Confirma que desea desvincular este producto de la línea?", 
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
    $("#tabla_datos-lineas").on( "click", ".elim-linea", function(){
        $("#id-linea-e").val( $(this).attr( "data-idl" ) );
        iniciarBotonBorrarLinea();

        $('#btn_borrar_linea').on('click', function(){
            var idl = $("#id-linea-e").val();
            $("#btn_canc").click();
            borrarLinea( idl );
        });
    });
    /* ............................................................ */
    $("#tabla_datos-lineas").on( "click", ".desv-prod", function(){
        var idl_d = $("#id-linea-d").val();
        $("#id-producto-d").val( $(this).attr( "data-idp" ) );
        iniciarBotonDesvincularProductoLinea();

        $('#btn_desv_linea_prod').on('click', function(){
            var idp = $("#id-producto-d").val();
            $("#btn_canc").click();
            desvincularProductoLinea( idp, idl_d );
        });
    });
});

/* --------------------------------------------------------- */