// JavaScript Document
/*
* fn-product.js
*
*/

function agregarProducto(){

	var fs = $('#frm_nproduct').serialize();
	//$("#ghres").html( fs );	

	$.ajax({
        type:"POST",
        url:"database/data-products.php",
        data:{ form_np: fs },
        success: function( response ){
			//res = jQuery.parseJSON(response);
			console.log(response);
						
        }
    });
}
/* --------------------------------------------------------- */

$( document ).ready(function() {
    $("#seltprecio").on( "change", function(){
		$(".oprecio").hide("slow");
		if( $(this).val() == "g" ) $("#valor_gramo").fadeIn('slow');
		if( $(this).val() == "p" ) $("#valor_pieza").fadeIn('slow');
		if( $(this).val() == "mo" ) $("#valor_mo").fadeIn('slow');
    });

	$("#bot_guardar_nuevo_producto").on( "click", function(){
		agregarProducto();	
    });

});

/* --------------------------------------------------------- */