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
			var etq = obtenerEtiquetaPaísProductor( response );
			$(enlace).html(etq);				
        }
    });
}

/* --------------------------------------------------------- */
$( document ).ready( function() {
    $(".epaisproductor").on( "click", function(){
		actualizarPaisProductor( $(this) );
    });
});
/* --------------------------------------------------------- */