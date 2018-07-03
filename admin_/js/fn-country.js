// JavaScript Document
/*
 * fn-country.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
function obtenerEtiquetaPaísProductor( estado ){
	//Devuelve etiqueta de país productor según estado
	if( estado == 1 ) return "Sí";
	if( estado == 0 ) return "No";	
}
/* --------------------------------------------------------- */
function actualizarPaisProductor( enlace ){
	
	var idp = $(enlace).attr("data-id");
	$.ajax({
        type:"POST",
        url:"database/data-countries.php",
        data:{ act_pprod: idp },
        success: function( response ){
			console.log( response );
			res = jQuery.parseJSON( response );
            if( res.rslt == 1 ){ 
                notificar( "Países", "País modificado con éxito", "success" );
                var etq = obtenerEtiquetaPaísProductor( res.estado );
				$(enlace).html(etq);
            }
            else{ 
                notificar( "Países", "Error al modificar dato de país", "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function borrarPais( idc ){
	//Invocación al servidor para eliminar país
    $.ajax({
        type:"POST",
        url:"database/data-countries.php",
        data:{ id_elim_pais: idc },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Países", res.mje, "success" );
                setTimeout( function() { window.location = "countries.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Borrar país", res.mje, "error" );
            }
        }
    });

}
/* --------------------------------------------------------- */
function iniciarBotonBorrarPais(){
    //Asigna los textos de la ventana de confirmación para borrar un país
    iniciarVentanaModal( "btn_borrar_pais", "btn_canc", 
                         "Borrar país", "", 
                         "¿Confirma que desea borrar país?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
$( document ).ready( function() {

    $('body').on('click', '.epaisproductor', function() {
	    actualizarPaisProductor( $(this) );
	});

	if ( $("#frm_npais").length > 0 ){
        $('#frm_npais').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }
    
    if ( $("#frm_mpais").length > 0 ){
        $('#frm_mpais').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }

    $("#tabla_datos-paises").on( "click", ".elim-pais", function(){
        $("#id-pais-e").val( $(this).attr( "data-idp" ) );
        iniciarBotonBorrarPais();

        $('#btn_borrar_pais').on('click', function(){
            var idc = $("#id-pais-e").val();
            $("#btn_canc").click();
            borrarPais( idc );
        });
    });

});
/* --------------------------------------------------------- */