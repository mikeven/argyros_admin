// JavaScript Document
/*
 * fn-catalogue.js
 *
 */
/* --------------------------------------------------------- */
function cargarOpcionesLista( regs, idlista ){
    // 

	var lista = "";
    $( idlista ).html("");
	$.each( regs, function( i, v ) {
		lista += "<option value=" + v.id + ">" + v.name + "</option>"; 
	});

	$( lista ).appendTo( idlista );
}
/* --------------------------------------------------------- */
function mostrarTallasCategoria( idc ){
	// Muestra las opciones de tallas correspondientes a la categoría seleccionada
	
	$.ajax({
        type:"POST",
        url:"database/data-products.php",
        data:{ tallas_cat: idc },
        success: function( response ){
        	res = jQuery.parseJSON( response );
        	cargarOpcionesLista( res, "#tallas_fc" );
        	$('#tallas_fc').picker('destroy');
            $('#tallas_fc').picker();
        }
    });
}
/* --------------------------------------------------------- */
function mostrarBanosMaterial( idm ){
	// Muestra las opciones de baños correspondientes al material seleccionado
	
	$.ajax({
        type:"POST",
        url:"database/data-treatments.php",
        data:{ banos_mat: idm },
        success: function( response ){
        	res = jQuery.parseJSON( response );
        	cargarOpcionesLista( res, "#banos_fc" );
            $('#banos_fc').picker('destroy');
        	$('#banos_fc').picker();
        }
    });
}
/* --------------------------------------------------------- */
function cargarSubcategoriasCatal( regs ){
    // Muestra subcategorías en la lista desplegable al seleccionar una categoría 
    $( "#val_subc" ).html("");
    var lista = "<option value='todos'>Todas</option>";
    
    $.each( regs, function( i, v ) {
        lista += "<option value=" + v.id + ">" + v.name + "</option>"; 
    });

    $( lista ).appendTo("#val_subc");
    //alert(lista);
}
/* --------------------------------------------------------- */
function progreso(){
    // Invoca el proceso que muestra el avance de la generación de imágenes de catálogo
    
    if( $("#status_r").val() == 0 ){
        var progre = $.ajax({
            type:"POST",
            url:"database/data-catalogue.php",
            data:{ progreso: 1 },
            success: function( response ){
                valorBarra( "#barra_progreso_img", response );
            }
        });
    }
}
/* --------------------------------------------------------- */
function previoVisualCargaImgs( wait, param ){
    // Prepara elementos previo a la invocación de generación de imágenes
    
    $("#status_r").val(0);
    $("#response_img").html("");
    if( param == 'descargar' ){
        $("#btn_oimgs").prop( "disabled", true );
        $("#progreso_img").fadeIn(100);
    }else{
        $("#tabla_datos-consulta").html( wait );
        $("#btn_rcatal").prop( "disabled", true );
    }
}
/* --------------------------------------------------------- */
function posteriorVisualCargaImgs( param, si, data ){
    // Reasigna valores a elementos después de la invocación de generación de imágenes

    if( param != 'descargar' ){
        // Posterior a la obtención de resultados preliminares
        $("#btn_rcatal").prop( "disabled", false );
        $("#tabla_datos-consulta").html( data );
    }
    else {
        // Posterior a la generación de imágenes con texto.
        $("#status_r").val(1);
        window.clearInterval( si );
        $("#progreso_img").fadeOut( 500, function(){
            $("#btn_oimgs").prop( "disabled", false );
            valorBarra( "#barra_progreso_img", 0 );
        });
        $("#response_img").html( data );
    }
    $("#btn_oimgs").show(10);
}
/* --------------------------------------------------------- */
function buscarImagenesCatalogo( form_r, param ){
	// Solicita los productos con los parámetros del formulario
    
    valorBarra( "#barra_progreso_img", 0 );
    var wait = "<img src='images/ajax-loader.gif' width='25' height='25'>";
    if( param == 'descargar' ){
        var si = setInterval( progreso, 200 );
    }
    
	var request = $.ajax({
        type:"POST",
        url:"database/data-catalogue.php",
        data:{ img_catal: form_r, descarga: param },
        beforeSend: function(){
            previoVisualCargaImgs( wait, param ); 
        },
        success: function( response ){
            request.abort();
            console.log(response);
            posteriorVisualCargaImgs( param, si, response );  
        }
    });
}
/* --------------------------------------------------------- */
function mostrarSubcategoriasCatal( idc ){
    // Muestra las subcategorías en la lista de opciones de acuerdo a la categoría seleccionada

    var wait = "<img src='images/ajax-loader.gif' width='10' height='10'>";
    $.ajax({
        type:"POST",
        url:"database/data-categories.php",
        data:{ m_subcategs: idc },
        beforeSend: function () {
            $("#rcatr").html( wait ); 
        }, 
        success: function( response ){
            $("#rcatr").html( "" );
            res = jQuery.parseJSON( response );
            cargarSubcategoriasCatal( res );                     
        }
    }); 
}
/* --------------------------------------------------------- */
function llenoValPr(){
    var vacio = false;
    $.each( $( ".valpr" ), function(){
        if( $(this).val() != "" ) vacio = true; 
    });
    
    return vacio;
}//
/* --------------------------------------------------------- */
function formCatalValido( arrfrm ){
    // Determina si existen los datos mínimos para invocar la generación de imágenes
    valido = true;
    
    if( $("#chk_prcat").is(':checked') || llenoValPr() ){
        if( ( $("#gcliente").val() == "" ) && ( !$("#busq_id").is(':checked') ) || 
            ( $("#gcliente_id").val() == "" ) && ( $("#busq_id").is(':checked') ) ){
            valido = false;
            notificar( "Imágenes de catálogo", "Debe seleccionar perfil de cliente", "error" );
        }
    }

    return valido;
}
/* --------------------------------------------------------- */
$( document ).ready(function() {

    $("#busq_id").on( "ifChanged", function(){
        // Muestra / oculta opciones de búsqueda en formulario de parámetros
        if( $(this).is(':checked') ){
            $("#panel_opciones_2").fadeIn("250");
            $("#panel_opciones_1").fadeOut("250");
        }
        else{
            $("#panel_opciones_1").fadeIn("250");
            $("#panel_opciones_2").fadeOut("250");
        }
    });

	$("#selcateg_fr").on( "change", function(){
        // Invoca la actualización de la lista de subcategorías y tallas
        // según la categoría seleccionada
		$("#tallas_fc").html("");
		var idc = $(this).val();
		mostrarSubcategoriasCatal( idc );
		mostrarTallasCategoria( idc );
    });

    $("#rmaterial").on( "change", function(){
        // Invoca la actualización de la lista de baños según el material seleccionado
		$("#banos_fc").html("");
		var idm = $(this).val();
		mostrarBanosMaterial( idm );
    });

    $("#btn_rcatal").on( "click", function(){
    	// Invoca la búsqueda de los productos según el formulario de parámetros
		var form_r = $( "#frm_rcatalogo" ).serialize();
        if( formCatalValido() )
		  buscarImagenesCatalogo( form_r, '' );
    });

    $("#btn_rcatal_id").on( "click", function(){
        // Invoca la búsqueda de los productos según identificador de producto
        var form_r = $( "#frm_rcatalogo_id" ).serialize();
        buscarImagenesCatalogo( form_r, '' );
    });

    $("#btn_oimgs").on( "click", function(){
        // Invoca la generación de las imágenes de catálogo resultantes de la búsqueda
        $("#status_r").val(0);
        var form_r = $( "#frm_rcatalogo" ).serialize();
        buscarImagenesCatalogo( form_r, 'descargar' );
    });

    $("#rst_frepos").on( "click", function(){
        // Vacía el campo de rango de fechas de reposición
        $("#frepos").val("");
    });
});
/* --------------------------------------------------------- */