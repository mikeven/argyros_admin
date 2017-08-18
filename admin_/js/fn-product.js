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
        	console.log( response );
			res = jQuery.parseJSON( response );
			enviarRespuesta( res, "redireccion", "product-data.php?p=" + res.reg.id );
        }
    });
}

/* --------------------------------------------------------- */

function agregarDetalleProducto(){
	var idp = $('#idproducto').val();
	var fs = $('#frm_ndetproduct').serialize();
	//$("#ghres").html( fs );	

	$.ajax({
        type:"POST",
        url:"database/data-products.php",
        data:{ form_ndetp: fs },
        success: function( response ){
			//res = jQuery.parseJSON(response);
			console.log(response);
			window.location = "product-data.php?p=" + idp;
        }
    });	
}
/* --------------------------------------------------------- */
function cargarSubcategorias( regs ){
	var lista = "";
	$.each( regs, function( i, v ) {
		lista += "<option value=" + v.id + ">" + v.name + "</option>"; 
	});
	$( lista ).appendTo("#val_subc");
	//alert(lista);
}
/* --------------------------------------------------------- */
function mostrarSubcategorias( idc ){
	$.ajax({
        type:"POST",
        url:"database/data-categories.php",
        data:{ m_subcategs: idc },
        success: function( response ){
        	res = jQuery.parseJSON( response );
			console.log(res);
			cargarSubcategorias( res );						
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

    $("#selcateg").on( "change", function(){
		$("#val_subc").html("");
		var idc = $(this).val();
		mostrarSubcategorias( idc );
    });

	$("#bot_guardar_nuevo_producto").on( "click", function(){
		agregarProducto();	
    });

	$("#bot_guardar_det_producto").on( "click", function(){
		agregarDetalleProducto();	
    });
});

/* --------------------------------------------------------- */