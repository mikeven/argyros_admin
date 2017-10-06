// JavaScript Document
/*
 * fn-validators.js
 *
 */

$( document ).ready(function() {	
    // ============================================================================ //
    
    /*new-product.php*/
    
    $(".form-control").on("change", function() {
		//$('#frm_nproduct').parsley().validate(); 
	});

    $('#frm_nproduct').parsley().on('form:success', function() {
		checkProducto();  
	});

	$("#bot_guardar_nuevo_producto").on( "click", function(){
		$('#frm_nproduct').parsley().validate();
		//agregarProducto();	
    });

    $("#pcodigo").on('blur', function() {
		chequearCodigoProducto( $(this).val() );
		  
	});	

    /*new-product.php*/
	

	// ============================================================================ //
	/*product-detail.php*/
	
	$("#seltprecio").on( "change", function(){
		$(".oprecio").hide("slow");
		mostrarDatosValorPorTipoPrecio( $(this).val() );
    });

    mostrarDatosValorPorTipoPrecio( $("#seltprecio").val() );

    $("#selcateg").on( "change", function(){
		$("#val_subc").html("");
		var idc = $(this).val();
		mostrarSubcategorias( idc );
    });

	$("#bot_guardar_det_producto").on( "click", function(){
		agregarDetalleProducto();	
    });

    /*Bloque peticiones para editar datos asociados a detalle de producto*/

    $("#bot_editar_detproducto").on( "click", function(){
		editarDatosDetalleProducto();	
    });

    $("#bot_edit_tallasdetalle").on( "click", function(){
		editarTallasDetalleProducto();	
    });

	$(".lnk_elimimg_detprod").on( "click", function(){
		var ec = $(this).attr( "data-target" ) ;
		$(this).fadeOut(20);
		$("#" + ec).fadeIn(50);
    });

    $(".lnk_cancelim_idetp").on( "click", function(){
		var ecanc = $(this).attr( "data-target" );
		var bloc = $(this).attr( "data-bloc" );

		//alert(ecanc +" "+bloc);
		$( "#" + bloc ).fadeOut( 20 );
		$( "#" + ecanc ).fadeIn( 50 );
    });

    $(".lnk_confelim_idet").on( "click", function(){
    	var cuadro = $(this).attr( "data-gal" );
    	var id_img = $(this).attr( "data-idimg" );
    	eliminarImagenDetalleProducto( cuadro, id_img );
    });

	$("#bot_seltallas").on( "click", function(){
		seleccionarTallas();	
    });
	
	/*product-edit.php*/
	$("#bot_editar_producto").on( "click", function(){
		editarProducto();	
    });


});

/* --------------------------------------------------------- */