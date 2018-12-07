// JavaScript Document
/*
 * fn-catalog.js
 *
 */
/* --------------------------------------------------------- */
function cargarOpcionesLista( regs, idlista ){
	var lista = "";

	$.each( regs, function( i, v ) {
		lista += "<option value=" + v.id + ">" + v.name + "</option>"; 
	});

	$( lista ).appendTo( idlista );
}
/* --------------------------------------------------------- */
function mostrarTallasCategoria( idc ){
	//Muestra las opciones de tallas correspondientes a la categoría seleccionada
	
	$.ajax({
        type:"POST",
        url:"database/data-products.php",
        data:{ tallas_cat: idc },
        success: function( response ){
        	res = jQuery.parseJSON( response );
        	cargarOpcionesLista( res, "#tallas_fc" );
        	$('#tallas_fc').picker();
        }
    });
}
/* --------------------------------------------------------- */
function mostrarBanosMaterial( idm ){
	//Muestra las opciones de baños correspondientes al material seleccionado
	
	$.ajax({
        type:"POST",
        url:"database/data-treatments.php",
        data:{ banos_mat: idm },
        success: function( response ){
        	res = jQuery.parseJSON( response );
        	cargarOpcionesLista( res, "#banos_fc" );
        	//$('#banos_fc').prepend( "<option selected>Seleccione</option>" );
        	$('#banos_fc').picker();
        }
    });
}
/* --------------------------------------------------------- */
function buscarImagenesCatalogo( form_r ){
	//Solicita los productos con los parámetros del formulario

	$.ajax({
        type:"POST",
        url:"database/data-catalog.php",
        data:{ img_catal: form_r },
        success: function( response ){
        	//console.log(response);
            $("#tabla_datos-consulta").html(response);
        }
    });
}
/* --------------------------------------------------------- */
$( document ).ready(function() {	
	$("#selcateg_fr").on( "change", function(){
		$("#tallas_fc").html("");
		var idc = $(this).val();
		mostrarSubcategorias( idc );
		mostrarTallasCategoria( idc );
    });

    $("#rmaterial").on( "change", function(){
		$("#banos_fc").html("");
		var idm = $(this).val();
		mostrarBanosMaterial( idm );
    });

    $("#btn_rcatal").on( "click", function(){
    	
		var form_r = $( "#frm_rcatalogo" ).serialize();
		buscarImagenesCatalogo( form_r );
    });
});
/* --------------------------------------------------------- */