// JavaScript Document
/*
 * fn-order.js
 *
 */
/* --------------------------------------------------------- */	
function asignarValorRegistro( status_rev, id ){
	//Asigna los valores para conformar un registro ( id_registro, cantidad, accion )
	var idr = id.substring(2);				//cdxx substring(2):xx
	var cant = $( "#" + id ).val();
	$( "#rr" + id ).val( idr + "," + cant + "," + status_rev );
	//alert(idr + "," + cant + "," + status_rev);
}
/* --------------------------------------------------------- */
function accionCantidad( accion, trg ){
	//Acciones sobre la revisión de cantidades de un pedido

	$( "#" + trg ).val("");
	$( "#" + trg ).prop( "disabled", true );

	if( $(accion).attr("data-c") == "0" ) {		//Marcar no disponible
		$( "#" + trg ).val( 0 );
	}
		 
	if( $(accion).attr("data-c") == "!0" ){		//Marcar disponible
		var a_qty = $( "#q" + trg ).html();
	    $( "#" + trg ).val( $.trim( a_qty ) );
	}

	if( $(accion).attr("data-c") == "*" ) {		//Modificar cantidad disponible
		$( "#" + trg ).prop( "disabled", false );
		$( "#" + trg ).focus();
	}
	var srev = $(accion).attr("data-sr");		//Status de revisión
	
	//if( $(accion).attr("data-c") != "*" )
		asignarValorRegistro( srev, trg );

}
/* --------------------------------------------------------- */
function validarRevisionPedido(){
	//Validar contenido de revisión de pedido antes de enviar
	var valido = true;
	$( ".qdisp_orden" ).each(function( index ) {
		if( $(this).val() == "" ) valido = false; 
	});
	
	return valido;
}
/* --------------------------------------------------------- */
function enviarRevisionPedido(){
	//Invoca al servidor para enviar revisión de pedido
	//notificar( "Revisión de pedido", "La revisión del pedido ha sido enviada al cliente", "success" );
	var tit_notif = "Revisión de pedido"
	var form_rev = $("#revision_pedido").serialize();
	var ido = $("#idpedido").val();
	$.ajax({
        type:"POST",
        url:"database/data-orders.php",
        data:{ rev_ped: form_rev, idp: ido },
        success: function( response ){
			res = jQuery.parseJSON(response);
			console.log(response);
			if( res.exito == 1 ){ 
				notificar( tit_notif, res.mje, "success" );
				location.reload();
			}
        }
    });	
}
/* --------------------------------------------------------- */
$( document ).ready( function() {

    //Clic: Inicia la tabla de revisión de pedido
    $('#r_pedido').on('click', function() {
	    $(".dcol").fadeToggle( "slow", "linear" );
	});	

    //Clic: Acción dada por los íconos de revisión de pedido
	$('.i-rev').on('click', function() {
	    var trg = $(this).attr("data-t");		//cdxx
	    $("." + trg ).removeClass("marked");
	    accionCantidad( $(this), trg );
	    $(this).addClass("marked");
	});

	//Blur: Acción dada por el campo cantidad disponible de revisión de pedido
	$('.qdisp_orden').on('blur', function() {
	    var id = $(this).attr("id");			//cdxx
	    var status_rev = $( "#i" + id ).attr("data-sr");
	    asignarValorRegistro( status_rev, id );
	});

	//Clic: Chequeo de la revisión de pedido
	$('#resp_pedido').on('click', function() {
		var r = validarRevisionPedido();
		if( r == false ) notificar( "Error", "Debe chequear respuesta", "error" );
		if( r == true ){
			enviarRevisionPedido();
		} 
	});

});
/* --------------------------------------------------------- */