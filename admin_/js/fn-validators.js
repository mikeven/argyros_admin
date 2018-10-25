// JavaScript Document
/*
 * fn-validators.js
 *
 */
/* --------------------------------------------------------- */
function nElementosTalla(){
	//Devuelve el número de tallas seleccionadas
	return $('.vt_seleccionado').size();
}
/* --------------------------------------------------------- */
function nImgsDetCargadas(){
	//Devuelve el número de imágenes subidas previamente al servidor 
	//al asignar imágenes a un detalle de producto
	return $('input[name="urlimgs[]"]').length;
}
/* --------------------------------------------------------- */
function checkDetalleProducto( accion ){
	//Validación de formulario de nuevo detalle de producto previo a su registro
	//Formulario edición de tallas de detalle
	var error = 0;
	var mensaje = "";

	if( nElementosTalla() < 1 ){
		error = 1;
		mensaje = "Debe indicar al menos un valor de talla-peso";
	}

	if( accion == "nuevo" ){
		if( nImgsDetCargadas() < 1 ){
			error = 1;
			mensaje = "Debe asignar y subir al menos una imagen al detalle de producto";
		}
	}

	if( error == 1 ){
		notificar( "Error", mensaje, "error" );
	}
	
	return error;	
}
/* --------------------------------------------------------- */

$( document ).ready(function() {	
    // ============================================================================ //
    
    /*new-product.php*/
    
    /*$(".form-control").on("change", function() {
		//$('#frm_nproduct').parsley().validate(); 
	});*/

	$("#bot_guardar_nuevo_producto").on( "click", function(){
		$('#frm_nproduct').parsley().validate();
    });

    $("#pcodigo").on('blur', function() {
		chequearCodigoProducto( $(this).val() );
	});	

    /*new-product.php*/
	

	// ============================================================================ //
	/*product-detail.php*/
	
	$("#bot_guardar_det_producto").on( "click", function(){
		$('#frm_ndetproduct').parsley().validate();
    });

	/*product-detail.php*/

	/*product-detail-edit.php*/
	
	$("#bot_editar_detproducto").on( "click", function(){
		$('#frm_mddetalle').parsley().validate();
    });

	/*product-detail-edit.php*/


});

/* --------------------------------------------------------- */