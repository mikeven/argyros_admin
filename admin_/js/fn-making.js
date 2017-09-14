// JavaScript Document
/*
 * fn-making.js
 *
 */

function cargarListaTrabajosMaterial( idm ){
	//
	$.ajax({
        type:"POST",
        url:"database/data-makings.php",
        data:{ obt_mattrabajo: idm },
        success: function( response ){
        	console.log( response );
			//res = jQuery.parseJSON( response );
        }
    });
}

/* --------------------------------------------------------- */
$( document ).ready(function() {
   
    // ============================================================================ //
    /*.php*/
    
    /*.php*/

});

/* --------------------------------------------------------- */