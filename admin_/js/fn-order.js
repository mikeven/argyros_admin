// JavaScript Document
/*
 * fn-order.js
 *
 */
/* --------------------------------------------------------- */	
function obtenerPrecioUnitarioItemMarcado( elem ){
	//
	//elem (class:qini)
	var trg = $(elem).attr("id");
	var monto = $( "#mnt" + trg ).html();
	return monto;
}
/* --------------------------------------------------------- */	
function mostrarMontoPrevio( monto ){
    //Muestra el monto previo después de marcar/desmarcar ítems en la revisión de pedido
    //Guarda el monto en campo oculto ( #previo_total_orden )
    $("#monto_total_orden").html( monto );
    $("#previo_total_orden").html( monto );
}
/* --------------------------------------------------------- */
function actualizarTotalItem( elem, c, p ){
	//Actualiza el total de ítem en tabla de pedido al modificar ítem
	//elem (class:qini)
	var trg = $(elem).attr("data-ti");
	var titem = parseFloat( c * p ).toFixed(2);
	$("#" + trg).html( titem );
}
/* --------------------------------------------------------- */	
function calcularTotalOrdenPrevio(){
    //Calcula el monto total del pedido después de modificar ítems
    monto = 0.00;

    $(".qini").each( function() {
        cant = $( this ).val(); 
        punit = obtenerPrecioUnitarioItemMarcado( $( this ) );
        actualizarTotalItem( $( this ), punit, cant );
        monto = parseFloat( punit * cant ) + parseFloat( monto );
        monto = parseFloat( monto ).toFixed(2);
    });
    mostrarMontoPrevio( monto );
}
/* --------------------------------------------------------- */
function asignarValorRegistro( status_rev, id ){
	//Asigna los valores para conformar un registro ( id_registro, cantidad, accion )
	var idr = id.substring(2);				//cdxx substring(2):xx
	var cant = $( "#" + id ).val();
	$( "#rr" + id ).val( idr + "," + cant + "," + status_rev );
	$( "#qo" + id ).val( cant );
	//alert(idr + "," + cant + "," + status_rev);
}
/* --------------------------------------------------------- */
function accionCantidad( accion, trg ){
	//Acciones sobre la revisión de cantidades de un pedido
	//accion: icon fa trg:cd00 
	$( "#" + trg ).val("");
	$( "#" + trg ).prop( "disabled", true );

	if( $(accion).attr("data-c") == "0" ) {		//Marcar no disponible
		$( "#" + trg ).val( 0 );
		$( "#qo" + trg ).val( 0 );
	}
		 
	if( $(accion).attr("data-c") == "!0" ){		//Marcar disponible
		var a_qty = $( "#q" + trg ).html();
	    $( "#" + trg ).val( $.trim( a_qty ) );
	    $( "#qo" + trg ).val( $.trim( a_qty ) );
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
	var tit_notif = "Revisión de pedido"
	var form_rev = $("#revision_pedido").serialize();
	var ido = $("#idpedido").val();
	var monto = $("#previo_total_orden").val();
	
	$.ajax({
        type:"POST",
        url:"database/data-orders.php",
        data:{ rev_ped: form_rev, idp: ido, monto_orden:monto },
        success: function( response ){
        	console.log(response);
			res = jQuery.parseJSON(response);
			if( res.exito == 1 ){ 
				notificar( tit_notif, res.mje, "success" );
				location.reload();
			}else{
				notificar( tit_notif, res.mje, "error" );
			}
        }
    });	
}
/* --------------------------------------------------------- */
function actualizarPedido( estado ){
	//Invoca al servidor para actualizar un pedido: Cambio de estatus
	var tit_notif = "Actualización de pedido";
	var ido = $("#idpedido").val();
	var observacion = $("#admin_obs").val();

	$.ajax({
        type:"POST",
        url:"database/data-orders.php",
        data:{ conf_ped: ido, status: estado, nota:observacion },
        beforeSend: function () {
            $("#res_serv").html("<img src='images/ajax-loader.gif' width='16' height='16'>");
        },
        success: function( response ){
        	$("#btn_canc").click();
        	console.log(response);
			res = jQuery.parseJSON(response);
			
			if( res.exito == 1 ){ 
				notificar( tit_notif, res.mje, "success" );
				setTimeout(function() { location.reload(); }, 5000 );
			}
        }
    });		
}
/* --------------------------------------------------------- */
function iniciarBotonCancelacionPedido(){	//order-data.php
	//Asigna los textos de la ventana de confirmación para cancelar pedido
	iniciarVentanaModal( "btn_cancel_ped", "btn_canc", 
						 "Cancelar pedido", "", 
						 "¿Confirma que desea cancelar pedido?", 
						 "Confirmar acción" );	
}
/* --------------------------------------------------------- */
function iniciarBotonEntregado(){			//order-data.php
	//Asigna los textos de la ventana de confirmación para marcar pedido como entregado
	iniciarVentanaModal( "btn_ped_entregado", "btn_canc", 
						 "Entregar pedido", "", 
						 "¿Confirma marcar este pedido como entregado?", 
						 "Confirmar" );	
}
/* --------------------------------------------------------- */
function iniciarBotonConfirmacion(){		//order-data.php
	//Asigna los textos de la ventana de confirmación para marcar pedido como confirmado
	iniciarVentanaModal( "btn_confirm_ped", "btn_canc", 
						 "Confirmar pedido", "", 
						 "¿Confirma la disponibilidad de todos los ítems para entregar en el pedido?", 
						 "Confimar" );	
}
/* --------------------------------------------------------- */
$( document ).ready( function() {
    //Clic: Inicia la tabla de revisión de pedido
    $('#r_pedido').on('click', function() {
	    $(".dcol").fadeToggle( "slow", "linear" );
	});	

    /*.......................................................*/

    //Clic: Acción dada por los íconos de revisión de pedido
	$('.i-rev').on('click', function() {
	    var trg = $(this).attr("data-t");		//cdxx
	    $("." + trg ).removeClass("marked");
	    accionCantidad( $(this), trg );
	    $(this).addClass("marked");
	    calcularTotalOrdenPrevio();
	});

	//Blur: Acción dada por el campo 'cantidad disponible' de revisión de pedido
	$('.qdisp_orden').on('blur', function() {
	    var id = $(this).attr("id");			//cdxx
	    var status_rev = $( "#i" + id ).attr("data-sr");
	    asignarValorRegistro( status_rev, id );
	    calcularTotalOrdenPrevio();
	});

	/*.......................................................*/

	//Clic: Chequeo de la revisión de pedido
	$('#resp_pedido').on('click', function(){
		var r = validarRevisionPedido();
		if( r == false ) notificar( "Error", "Debe chequear respuesta", "error" );
		if( r == true ){
			enviarRevisionPedido();
		} 
	});

	//Clic: Cancelación de pedido
	$('#can_pedido').on('click', function() {
		iniciarBotonCancelacionPedido();		//fn-ui.js
		$('#btn_cancel_ped').on('click', function() {
			actualizarPedido( "cancelado" ); 
		});
	});

	/*.......................................................*/
	//Clic: Confirmación de pedido
	$('#cnf_pedido').on('click', function() {
		iniciarBotonConfirmacion();				//fn-ui.js
		$('#btn_confirm_ped').on('click', function() {
			actualizarPedido( "confirmado" ); 
		});
	});

	/*.......................................................*/
	//Clic: Marcar pedido como entregado
	$('#btn_ped_entregado').on('click', function() {
		actualizarPedido( "entregado" ); 
	});

});
/* --------------------------------------------------------- */