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
			if( res.exito == 1 )
				enviarRespuesta( res, "redireccion", "product-data.php?p=" + res.reg.idproducto );
			else
				notificar( "Nuevo producto", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */
function editarProducto(){
	var fs = $('#frm_mproduct').serialize();

	$.ajax({
        type:"POST",
        url:"database/data-products.php",
        data:{ form_mp: fs },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 )
				notificar( "Productos", res.mje, "success" );
			if( res.exito == 2 )
				notificar( "Productos", res.mje, "info" );
			setTimeout( function() { 
				enviarRespuesta( res, "redireccion", "product-data.php?p=" + res.reg.id ); 
				}, 5000 
			);
        }
    });
}

/* --------------------------------------------------------- */
function cargarSubcategorias( regs ){
	var lista = "";
	$( "#val_subc" ).html("");
	
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
			cargarSubcategorias( res );						
        }
    });	
}
/* --------------------------------------------------------- */
function crearValorTallaPesoSeleccion( idt, t, p ){
	
	var elem = "<input class='vt_seleccionado' type='hidden' data-talla='" + t +"' data-peso='" + p + "' value='" + idt + "'>";
	return elem;
}
/* --------------------------------------------------------- */
function crearEtiquetaTallaPesoSeleccion( t, p, aj ){
	var elem = "<div> Talla: " + t + aj + " - Peso: " + p + "<div>";
	return elem;
}
/* --------------------------------------------------------- */
function seleccionarTallas(){
	var elem = "";
	var etiq = ""; 
	
	$.each( $(".valtallas_sel"), function() {
		var peso = $(this).val();
		var etiq_aj = "";
		
		if ( peso != "" ){
			var idvt = $(this).attr("data-t");
			var talla = $("#" + idvt ).val();
			var idtalla = $("#" + idvt ).attr("data-idt");
			if( $('#ajustable').prop('checked') && ( talla == 'N/A' ) ) {
				etiq_aj = "(ajustable)"; 
			}

			elem += crearValorTallaPesoSeleccion( idtalla, talla, peso );
			etiq += crearEtiquetaTallaPesoSeleccion( talla, peso, etiq_aj );
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
	$.each( $(".vt_seleccionado"), function(){	// vt_seleccionado: valor_tallas_seleccionado
		dupla["idt"] = $(this).val();
		dupla["talla"] = $(this).attr("data-talla");
		dupla["peso"] = $(this).attr("data-peso");
		tallas.push( dupla );
		dupla = new Object();		
	});
	return JSON.stringify( tallas );			
}
/* --------------------------------------------------------- */
function agregarDetalleProducto(){
	//Envía al servidor la petición de registro de detalle de producto. 
	var idp = $("#idproducto").val();
	var form = $("#frm_ndetproduct");
	var form_det = form.serialize();
	var tallas = obtenerValoresTallasSeleccionadas();
	
	$.ajax({
        type:"POST",
        url:"database/data-products.php",
        data:{ form_ndetp: form_det, vtallas: tallas },
        success: function( response ){
        	console.log(response);
			res = jQuery.parseJSON(response);
			enviarRespuesta( res, "redireccion", "product-data.php?p=" + idp );
        }
    });
}
/* --------------------------------------------------------- */
function activarProducto( idp, edo ){
	//Envía al servidor la petición para activar/desactivar producto 
	//dependiendo de su estado actual
	$.ajax({
        type:"POST",
        url:"database/data-products.php",
        data:{ activar_prod: idp, visible: edo },
        success: function( response ){
        	console.log( idp + " " + edo );
        	res = jQuery.parseJSON( response );
			if( res.exito == 1 ){
				notificar( "Productos", res.mje, "success" );
                setTimeout( function() { window.location = "products.php"; }, 4000 );
			}
        }
    });
}
/* --------------------------------------------------------- */
function editarDatosDetalleProducto(){
	//Envía al servidor la petición de edición de datos de detalle de producto. 

	var form = $("#frm_mddetalle");
	var form_det = form.serialize();
	var tit_notif = "Detalle de producto";
	
	$.ajax({
        type:"POST",
        url:"database/data-products.php",
        data:{ form_modif_detprod: form_det },
        success: function( response ){
			res = jQuery.parseJSON(response);
			//console.log( response );
			if( res.exito == 1 ) 
				notificar( tit_notif, res.mje, "success" );
			else
				notificar( tit_notif, res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */
function editarTallasDetalleProducto(){
	//Envía al servidor la petición de edición de tallas de detalle de producto.

	var form_tedit = $("#frm_mtalladetalle").serialize();
	var iddet = $("#iddetalle").val();
	var tallas = obtenerValoresTallasSeleccionadas();
	var tit_notif = "Tallas de producto"
	
	$.ajax({
        type:"POST",
        url:"database/data-products.php",
        data:{ idt: iddet, frm_tallas:form_tedit, modif_tallasdetprod: tallas },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON(response);
			
			if( res.exito == 1 ) 
				notificar( tit_notif, res.mje, "success" );
			if( res.exito == -2 )
				notificar( tit_notif, res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */
function eliminarImagenDetalleProducto( cuadro, id_img ){
	//Envía al servidor la petición de eliminar imagen de detalle de producto. 
	var img_gal = $( "#" + cuadro );
	
	$.ajax({
        type:"POST",
        url:"database/data-products.php",
        data:{ elim_imgdetprod: id_img },
        success: function( response ){
			//res = jQuery.parseJSON(response);
			console.log( response );
			$(img_gal).hide("slow");
			window.location = "product-data.php?p=" + idp;
        }
    });		
}
/* --------------------------------------------------------- */
function agregarImagenesDetalleProducto(){
	//Envía al servidor la petición de guardar las imágenes cargadas por el plugin. 

	var form = $("#frm_nimg_detprod");
	var form_img = form.serialize();
	var iddet = $("#iddetalle").val();
	
	$.ajax({
        type:"POST",
        url:"database/data-products.php",
        data:{ form_nimgsdetp: form_img, idt: iddet },
        success: function( response ){
			//res = jQuery.parseJSON(response);
			console.log(response);
			window.location = "product-data.php?p=" + idp;
        }
    });
}
/* --------------------------------------------------------- */
function actualizarDisponibilidadProducto( nivel, idp, iddp, iddettalla, estado ){
	//Envía al servidor la petición de guardar las imágenes cargadas por el plugin. 
	var tit_notif = "Actualización de producto";
	
	$.ajax({
        type:"POST",
        url:"database/data-products.php",
        data:{ ajuste_disp: nivel, id_p:idp, id_dp:iddp, id_dettalla:iddettalla, status:estado },
        success: function( response ){
			console.log(response);

			res = jQuery.parseJSON(response);
			
			if( res.exito == 1 ) 
				notificar( tit_notif, res.mje, "success" );
			else
				notificar( tit_notif, res.mje, "error" );

			setTimeout(function() { location.reload(); }, 3000 );
        }
    });
}
/* --------------------------------------------------------- */
function addCampoImg( valor ){
	
	var fld = "<input type='hidden' name='urlimgs[]' value='" + valor + "'>";
	//$("#image-response").html( fld );
	$(fld).appendTo( "#image-response" );
}
/* --------------------------------------------------------- */
function agregarCamposOcultosImagenes(){
	//Toma los datos enviados después de la carga del plugin 
	//para crear campos ocultos en el documento html que serán 
	//usados posteriormente para procesar en la base de datos.
	$("#image-response").html( "" );
	$.each( $(".fpiup"), function() {
		//.fpiup: imágenes en vista previa después de haberse subido al servidor
		//.fpiup definido en database/data-products: uploadPictures( $dbh, $images, $idu )
		addCampoImg( $(this).attr("data-uimg") );	
	});
}
/* --------------------------------------------------------- */
function chequearCodigoProducto( codigo ){
	//Envía al servidor código de producto nuevo y devuelve si ya existe en BD. 
	
	$.ajax({
        type:"POST",
        url:"database/data-products.php",
        data:{ chcodigo: codigo },
        success: function( response ){
        	
        	console.log( response );
        	if ( response == 0 ){
        		window.Parsley.addValidator('available', {
				  validateString: function(value) {  return false; },
				  messages: { es: "Código de producto no disponible" }
				});
        	}
        	if ( response == 1 ){
        		window.Parsley.addValidator('available', {
				  validateString: function(value) { return true; }
				});
        	}
        }
    });
}
/* --------------------------------------------------------- */
function mostrarDatosValorPorTipoPrecio( tprecio ){
	
	if( tprecio == "g" ) { 
		$("#valor_gramo").fadeIn('slow'); 
		$("#vgramo").attr("data-parsley-nocero", 0.00);

	}

	if( tprecio == "p" ) { 
		$("#valor_pieza").fadeIn('slow'); 
		$("#vpieza").attr("data-parsley-nocero", 0.00);
	}

	if( tprecio == "mo" ){ 
		$("#valor_mo").fadeIn('slow'); 
		$("#vmanoo").attr("data-parsley-nocero", 0.00); 
	}
}
/* --------------------------------------------------------- */
function checkProducto(){
	//Validación de formulario de nuevo producto previo a su registro
	var error = 0;
	var mensaje = "";

	if( $("#pnombre").val() == "" ){
		error = 1;
		mensaje = "Debe indicar nombre de producto";
	}

	if( error == 1 ){
		notificar( "Error", mensaje, "error" );
	}
	
	return error;	
}
/* --------------------------------------------------------- */
function iniciarBotonActivarProducto( titulo, accion, mje ){
    //Asigna los textos de la ventana de confirmación para borrar una línea
    iniciarVentanaModal( "btn_accion_producto", "btn_canc", 
                         titulo + " producto", "", 
                         "¿Confirma que desea " + accion + " producto?" +
                         "<div>" + mje + "</div>", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
function etiqAccionActivarProd( op ){
	//Devuelve la etiqueta del botón confirmación de acción al mostrar/ocultar producto
	var etiq = new Object();
	etiq.t = "Mostrar"; etiq.a = "mostrar"; 
	etiq.m = "Esto hará disponible al producto en el catálogo";

	if( op == 1 ){ 
		etiq.t = "Ocultar"; 
		etiq.a = "ocultar"; etiq.m = "Esto hará que no se muestre en el catálogo";
	}

	return etiq;
}
/* --------------------------------------------------------- */
$( document ).ready(function() {	
    // ============================================================================ //
    
    /*Pop image list products*/
    $("#datatable").on( "click", ".pop-img-p", function(){
    	var img = $(this).attr("data-src");
    	$("#img-preview").attr( "src", img );
    });

    $(".pop-img-p").on( "click", function(){
    	var img = $(this).attr("data-src");
    	$("#img-preview").attr( "src", img );
    });
    /*Pop image */

	// ============================================================================ //
	/*product-detail.php*/
	
	function initNoCero(){
		window.Parsley
		  .addValidator('nocero', {
		    requirementType: 'integer',
		    validateNumber: function( value, requirement ) {
		    	return ( value > requirement );
		    },
		    messages: {
		      es: 'Este valor debe ser mayor a 0.00'
		    }
	  	});	
	}

	/* ---------------------------------------------------------------- */
	//Acción para invocar el mostrar/ocultar un producto
    $("#lista_general_productos").on( "click", ".bt-prod-act", function(){

    	var edo = $(this).attr("data-op");		//operación: 1:esta visible -> acción: ocultar
    											//operación: 0:esta oculto 	-> acción: mostrar
		var idp = $(this).attr("data-idp");
        
        mensaje_conf = etiqAccionActivarProd( edo );
        iniciarBotonActivarProducto( mensaje_conf.t, mensaje_conf.a, mensaje_conf.m );

        $('#btn_accion_producto').on('click', function(){
            
            $("#btn_canc").click();
            activarProducto( idp, edo );
        });
    });
	
	/* ---------------------------------------------------------------- */
	//initNoCero();
	
	$("#seltprecio").on( "change", function(){ 
		// Evento durante la creación de nuevo detalle de producto
		$(".oprecio").hide("slow");
		$(".vtp").removeAttr( "data-parsley-nocero");
		initNoCero();
		mostrarDatosValorPorTipoPrecio( $(this).val() );
    });

    /* ---------------------------------------------------------------- */

	//Evento durante la edición de detalle de producto
    mostrarDatosValorPorTipoPrecio( $("#seltprecio").val() );

    $("#selcateg").on( "change", function(){
		$("#val_subc").html("");
		var idc = $(this).val();
		mostrarSubcategorias( idc );
    });

    $("#smaterial_e").on( "change", function(){
		var m_nvo = $(this).val();
		var m_act = $("#idmat_actual").val();
		if( m_nvo != m_act ){
			/*notificar( "Cambio de material", 
			"Si se cambia el material del producto, se deben reasignar los valores de baño para cada detalle de este producto", 
			"error" );*/
			$("#cambio_mm").show(500);
		}else{
			$("#cambio_mm").hide(500);
		}
    });

	/*$("#bot_guardar_det_producto").on( "click", function(){
		$(this).attr("disabled", true);
		agregarDetalleProducto();
    });*/

    /*Bloque peticiones para editar datos asociados a detalle de producto*/

    

    $("#bot_editar_detproducto").on( "click", function(){
		//editarDatosDetalleProducto();	
    });

    $("#bot_edit_tallasdetalle").on( "click", function(){
		
		if( checkDetalleProducto( "edicion" ) == 0 ){ 
			editarTallasDetalleProducto();
		}
		
    });

	$(".lnk_elimimg_detprod").on( "click", function(){
		var ec = $(this).attr( "data-target" ) ;
		$(this).fadeOut(200);
		$("#" + ec).fadeIn(300);
    });

    $(".lnk_cancelim_idetp").on( "click", function(){
		var ecanc = $(this).attr( "data-target" );
		var bloc = $(this).attr( "data-bloc" );

		//alert(ecanc +" "+bloc);
		$( "#" + bloc ).fadeOut( 200 );
		$( "#" + ecanc ).fadeIn( 300 );
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

    /*product-data.php*/
    $(".o-tdetp").on( "click", function(){
		var idtalla 	= $(this).attr("data-idtalla");
		var iddetprod 	= $(this).attr("data-idpdet");
		var valestado	= $(this).attr("data-st");
		$(this).fadeOut( 200 );

		actualizarDisponibilidadProducto( "talla", "", iddetprod, idtalla, valestado );
    });

});

/* --------------------------------------------------------- */