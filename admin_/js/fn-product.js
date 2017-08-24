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

function crearValorTallaPesoSeleccion( idt, t, p ){
	
	var elem = "<input class='vt_seleccionado' type='hidden' data-talla='" + t +"' data-peso='" + p + "' value='" + idt + "'>";
	return elem;
}

function crearEtiquetaTallaPesoSeleccion( t, p ){
	var elem = "<div> Talla: " + t + " - Peso: " + p + "<div>";
	return elem;
}

/* --------------------------------------------------------- */
function seleccionarTallas(){
	var elem = "";
	var etiq = ""; 
	$.each( $(".valtallas_sel"), function() {
		var peso = $(this).val();
		if ( peso != "" ){
			var idvt = $(this).attr("data-t");
			var talla = $("#" + idvt ).val();
			var idtalla = $("#" + idvt ).attr("data-idt");
			elem += crearValorTallaPesoSeleccion( idtalla, talla, peso );
			etiq += crearEtiquetaTallaPesoSeleccion( talla, peso );
		}
		
		$( "#valor_tseleccion" ).html( $( elem ) );
		$( "#tallas_seleccion" ).html( $( etiq ) );
	});			
}
/* --------------------------------------------------------- */

function obtenerValoresTallasSeleccionadas(){
	//
	var tallas = new Array();
	var dupla = new Object();
	$.each( $(".vt_seleccionado"), function() {	// vt_seleccionado: valor_tallas_seleccionado
		dupla["idt"] = $(this).val();
		dupla["peso"] = $(this).attr("data-peso");
		tallas.push( dupla );
		dupla = new Object();		
	});
	return JSON.stringify( tallas );			
}
/* --------------------------------------------------------- */
function agregarDetalleProducto(){
	//Envía al servidor la petición de registro de detalle de producto. 

	var form = $("#frm_ndetproduct");
	var form_det = form.serialize();
	var tallas = obtenerValoresTallasSeleccionadas();
	
	$.ajax({
        type:"POST",
        url:"database/data-products.php",
        data:{ form_ndetp: form_det, vtallas: tallas },
        success: function( response ){
			//res = jQuery.parseJSON(response);
			console.log(response);
			//window.location = "product-data.php?p=" + idp;
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

	$("#bot_seltallas").on( "click", function(){
		seleccionarTallas();	
    });


});

/* --------------------------------------------------------- */