// JavaScript Document
/*
 * fn-category.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
function obtenerSubcategoriasCategoria( idc ){
	$.ajax({
        type:"POST",
        url:"database/data-category.php",
        data:{ obt_subcat_cat: idc },
        success: function( response ){
			//res = jQuery.parseJSON(response);
			console.log(response);
        }
    });
}

/* --------------------------------------------------------- */

$( document ).ready(function() {
	$("#selcateg").on( "click", function(){
		var idc = $(this).val();
		obtenerSubcategoriasCategoria( idc );
    });   
});

/* --------------------------------------------------------- */