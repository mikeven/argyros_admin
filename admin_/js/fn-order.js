// JavaScript Document
/*
 * fn-order.js
 *
 */
/* --------------------------------------------------------- */	

/* --------------------------------------------------------- */
$( document ).ready( function() {

    $('#r_pedido').on('click', function() {
	    $(".dcol").fadeToggle( "slow", "linear" );
	});

	$('.dfull').on('click', function() {
	    var trg = $(this).attr("data-t");
	    var a_qty = $("#q" + trg).html();
	    $( "#" + trg ).val( a_qty );
	    $(this).addClass("marked");
	});

	$('.dnone').on('click', function() {
	    var trg = $(this).attr("data-t");
	    var a_qty = $("#q" + trg).html();
	    $( "#" + trg ).val( 0 );
	    $(this).addClass("marked");
	});

});
/* --------------------------------------------------------- */