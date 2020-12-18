// JavaScript Document
/*
 * fn-purchase.js
 *
 */
/* --------------------------------------------------------- */
function guardarOrdenCompra( idpvd ){
    // Invoca el llamado a registrar nueva orden de compra
    $.ajax({
        type:"POST",
        url:"database/data-purchase.php",
        data:{ guardar_oc: idpvd },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            if( res.exito == 1 ){
                tNotificar( "Orden de compra", res.mje, "success", 3000 );
                $( "#bot_no" + idpvd + " .boton_guardar_orden" ).fadeOut( '200', function(){
                    $( "#alerta_exito_oc" + idpvd ).show( 300 );
                });
            }
            else
                tNotificar( "Orden de compra", res.mje, "error", 3000 );
        }
    });
}
/* --------------------------------------------------------- */
function agregarProductoPreorden( idd ){
	// Invoca al servidor para agregar un producto a la lista pre-orden

	$.ajax({
        type:"POST",
        url:"fn/fn-purchase.php",
        data:{ agregar_prod_preorden: idd },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 ){
				tNotificar( "Lista preorden", res.mje, "success", 2200 );
                $( "#oc" + idd + " i" ).addClass( "inc_lpreo" );
            }
			if( res.exito == 2 )
                tNotificar( "Lista preorden", res.mje, "info", 2200 );
			if( res.exito == 0 )
                tNotificar( "Lista preorden", res.mje, "warning", 2200 );
        }
    });
}
/* --------------------------------------------------------- */
function actualizarPreorden( param, id_d, id_t, obj, id_pvd, val ){
    // Invoca al servidor para actualizar un producto a la lista pre-orden, de acuerdo a un parámetro
    var fila = id_d+id_t;
    $.ajax({
        type:"POST",
        url:"fn/fn-purchase.php",
        data:{ act_preorden: param, idd: id_d, idt: id_t, valor: val },
        success: function( response ){
            console.log( response );
            if( response == "eliminar" ){
                quitarFilaItem( fila, id_d, obj, id_pvd, param );
            }
            else
                tNotificar( "Lista preorden", response, "success", 500 );
        }
    });
}
/* --------------------------------------------------------- */
function actualizarVisualBotEstadoItemOC( iddo, val ){
    // Actualiza la visualización del botón de cambio de estatus de item detalle de orden de compra
    $( ".btn-est-" + iddo ).removeClass( "btn-warning btn-success btn-danger" );
    if( val == "recibido" )
        $( "#recibido" + iddo ).addClass( "btn-success" );
    if( val == "pendiente" )
        $( "#pendiente" + iddo ).addClass( "btn-warning" );
    if( val == "no-recibido" )
        $( "#no-recibido" + iddo ).addClass( "btn-danger" );

    chequearElementosPendientes();
}
/* --------------------------------------------------------- */
function actualizarEstadoItemOC( iddo, val ){
    // Invoca al servidor para actualizar estado de un ítem de orden de compra
    $.ajax({
        type:"POST",
        url:"database/data-purchase.php",
        data:{ act_edo_doc: iddo, valor: val },
        success: function( response ){
            res = jQuery.parseJSON( response );
            if( res.exito == 1 ){
                tNotificar( "Orden de compra", res.mje, "success", 3000 );
                actualizarVisualBotEstadoItemOC( iddo, val );
            }
            else
                tNotificar( "Orden de compra", res.mje, "error", 3000 );
        }
    });
}
/* --------------------------------------------------------- */
function actualizarEstadoOC( ido, estado ){
    // Invoca al servidor para actualizar estado de una orden de compra  
    $.ajax({
        type:"POST",
        url:"database/data-purchase.php",
        data:{ act_st_oc: ido, valor: estado },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            if( res.exito == 1 ){
                $("#btn_canc").click();
                tNotificar( "Orden de compra", res.mje, "success", 3000 );
                setTimeout( function() { location.reload(); }, 5000 );
            }
            else
                tNotificar( "Orden de compra", res.mje, "error", 3000 );
        }
    });
}
/* --------------------------------------------------------- */
function actualizarNotaOC( ido, nota ){
    // Invoca al servidor para actualizar la nota de una orden de compra 
    $.ajax({
        type:"POST",
        url:"database/data-purchase.php",
        data:{ act_nota_oc: ido, valor: nota },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            if( res.exito == 1 ){
                $("#btn_canc").click();
                tNotificar( "Orden de compra", res.mje, "success", 3000 );
            }
            else
                tNotificar( "Orden de compra", res.mje, "error", 3000 );
        }
    });
}
/* --------------------------------------------------------- */
function iniciarPopImagenesProductos(){
	// Inicializa los enlaces para mostrar las imágenes de productos en ventanas emergentes

    $("#lista_productos_tallas").on( "click", ".pop-img-p", function(){
        var img = $(this).attr("data-src");
        $("#img-preview").attr( "src", img );
    });

    $("#tabs_items_proveedores").on( "click", ".pop-img-p", function(){
        var img = $(this).attr("data-src");
        $("#img-preview").attr( "src", img );
    });

    $(".pop-img-p").on( "click", function(){
    	var img = $(this).attr("data-src");
    	$("#img-preview").attr( "src", img );
    });
    /*Pop image */
}
/* --------------------------------------------------------- */
function quitarFilaItem( fila, id_d, obj, id_pvd, param ){
    // Oculta los ítems de las tablas identificadas por sus ids
    $("#" + fila ).fadeOut( '200', function(){
        $("#" + fila ).remove();
        
        actualizarBotonGuardarOC( param, obj );
        if( id_pvd != "" )
            calcularPreTotalesOC( id_pvd );
        
        if( contarItemsTalla( id_d ) == 0 ){
            $("#itemid" + id_d ).fadeOut( '200', function(){
                $("#itemid" + id_d ).remove();
            });
        } 
    });    
}
/* --------------------------------------------------------- */
function actualizarBotonGuardarOC( param, obj ){
    // Actualiza la habiliación del botón guardar orden de compra después de borrar ítems
    var cant_items = $( "." + obj ).toArray().length;
    
    if( param == "eliminar_oc" )
        if( cant_items == 0 )
            $( "#" + obj ).prop( "disabled", "true" );
}
/* --------------------------------------------------------- */
function contarItemsTalla( idd ){
    // Devuelve el número de tallas en la lista de pre-orden / órden de compra asociado a un detalle de producto
    return $(".itemt"+idd ).toArray().length;
}
/* --------------------------------------------------------- */
function cantidadesValidas( pvd ){
    // Devuelve verdadero si las cantidades de una orden son válidas, falso en caso contrario
    var valido = true;
    var selector_cant = "#" + pvd + " .cnt_preord";
    
    $( selector_cant ).each(function() {
        if( $( this ).val() == 0 ) valido = false;
    });

    return valido;
}
/* --------------------------------------------------------- */
function iniciarBotonConfirmacionOC( estado ){        //purchase-data.php
    //Asigna los textos de la ventana de confirmación para cambio de estado de las órdenes de compra
    iniciarVentanaModal( "btn_confirm_oc", "btn_canc", 
                         "Estado de orden de compra", "", 
                         "¿Confirma marcar orden de compra como " + estado + "?", 
                         "Confimar" );  
}
/* --------------------------------------------------------- */
function desactivarBotonesEstadoItems(){
    // Activa / desactiva los botones de estado de los ítems de orden de compra acorde al estado de la orden
    var inactivo = true;
    estado_orden_compra = $("#status_oc").val();

    if( estado_orden_compra == "confirmada" ){
        inactivo = false;
        $(".item_oc_estado .btn").prop('disabled', inactivo );
    }else{
        $(".item_oc_estado .btn").prop('disabled', inactivo );
        $( ".item_oc_estado" ).each(function(){
            $(this).removeClass( "item_oc_estado" );
        });
    }
    
}
/* --------------------------------------------------------- */
function chequearElementosPendientes(){
    // Activa / Desactiva los botones de estado de los ítems de orden de compra
    var inactivo = false;
    $( ".st_pdt" ).each(function(){
        if( $(this).hasClass( "btn-warning" ) )
            inactivo = true;            
    });
    $("#btn_oc_recibida").prop('disabled', inactivo );
}
/* --------------------------------------------------------- */
function calcularPreTotalesOC( idpvd ){
    // 
    var total_cant      = 0;
    var total_peso      = 0.00;
    var items_oc        = $( ".cant_oc" + idpvd );

    $( items_oc ).each(function() {
        cant_item       = $( this ).val();
        total_cant      += parseInt( cant_item ); 
        peso_item       = $( this ).attr( "data-peso" );
        total_peso      += parseInt( peso_item * cant_item ); 
    });

    $( "#tpzas" + idpvd ).html( "<b>" + total_cant + "</b>" + " und." );
    $( "#tpesos" + idpvd ).html( "<b>" + total_peso.toFixed(2) + "</b>" + " gr." );
}
/* --------------------------------------------------------- */
function calcularPreTotalOrdenes(){
    // Invoca el cálculo de totales
    var gcant = "";
    $( ".tabpvd" ).each(function() {
        calcularPreTotalesOC( $(this).val() );
    });
}
/* --------------------------------------------------------- */

$( document ).ready(function() {	
    // ============================================================================ //
    iniciarPopImagenesProductos();
    chequearElementosPendientes();
    desactivarBotonesEstadoItems();
	/* ---------------------------------------------------------------- */
	//Acción para invocar agregar un producto a la lista pre-orden
    $("#lista_productos_tallas").on( "click", ".selpre-o", function(){   
		agregarProductoPreorden( $(this).attr("data-idd") );
	});
	/* ---------------------------------------------------------------- */
	$(".act_preo").on( "change", function(){   
        var idd = $(this).attr("data-idd");
        var idt = $(this).attr("data-idt");
        var prm = $(this).attr("data-prm");
        var pvd = $(this).attr("data-idpvd-oc");
        actualizarPreorden( prm, idd, idt, '', pvd, $(this).val() );
    });

    $(".act_preo_d").on( "change", function(){   
        var idd = $(this).attr("data-idd");
        var prm = $(this).attr("data-prm");
        actualizarPreorden( prm, idd, '', '', '', $(this).val() );
    });
    
    $(".quitar_item").on( "click", function(){   
        var idd = $(this).attr("data-idd");
        var idt = $(this).attr("data-idt");
        var prm = $(this).attr("data-prm");
        var btn = $(this).attr("data-bot");
        var pvd = $(this).attr("data-idpvd-oc");
        actualizarPreorden( prm, idd, idt, btn, pvd, $(this).val() );
    });
    /* ---------------------------------------------------------------- */
    $("#ordenes_p_proveedor").on( "click", ".guardar_oc", function(){ 
        var idpvd = $(this).attr("data-idpvd");
        if( cantidadesValidas( "dp" + idpvd ) )
            guardarOrdenCompra( idpvd );
        else{
            tNotificar( "Lista preorden", "Las cantidades en la orden no deben cero", "warning", 2200 );
        }
    });

    $(".item_oc_estado").on( "click", function(){    
        var iddo    = $(this).attr("data-iddo");
        var edo     = $(this).attr("data-valor");
        actualizarEstadoItemOC( iddo, edo );
    });

    /*.......................................................*/
    //Clic: Actualización de nota de orden de compra
    $('#act_nota_oc').on('click', function() {
        var ido     = $(this).attr( "data-idoc" );
        var nota    = $("#nota_oc").val();
        
        actualizarNotaOC( ido, nota ); 
    });

    //Clic: Cambio de estatus de órdenes de compra
    $('.estat_oc').on('click', function() {
        var ido     = $(this).attr( "data-idoc" );
        var estado  = $(this).attr( "data-estado" );

        iniciarBotonConfirmacionOC( estado );
        $('#btn_confirm_oc').on('click', function() {
            actualizarEstadoOC( ido, estado ); 
        });
    });

});

/* --------------------------------------------------------- */