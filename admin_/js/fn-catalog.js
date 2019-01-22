// JavaScript Document
/*
 * fn-catalog.js
 *
 */
/* --------------------------------------------------------- */
function cargarOpcionesLista( regs, idlista ){
	var lista = "";
    $( idlista ).html("");
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
        	$('#tallas_fc').picker('destroy');
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
function buscarImagenesCatalogo( form_r, param ){
	//Solicita los productos con los parámetros del formulario
    var wait = "<img src='images/ajax-loader.gif' width='25' height='25'>";
	$.ajax({
        type:"POST",
        url:"database/data-catalog.php",
        data:{ img_catal: form_r, descarga: param },
        beforeSend: function () {
            if( param == 'descargar' )
                $("#response_img").html( wait );
        },
        success: function( response ){
        	console.log( response );
            if( param != 'descargar' )
                $("#tabla_datos-consulta").html( response );
            else 
                $("#response_img").html( response );
        }
    });
}
/* --------------------------------------------------------- */
function mostrarSubcategoriasCatal( idc ){
    $.ajax({
        type:"POST",
        url:"database/data-categories.php",
        data:{ m_subcategs: idc },
        success: function( response ){
            res = jQuery.parseJSON( response );
            cargarSubcategoriasCatal( res );                     
        }
    }); 
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
		buscarImagenesCatalogo( form_r, '' );
    });

    $("#btn_rcatal_id").on( "click", function(){
        // Invoca la búsqueda de los productos según identificador de producto
        var form_r = $( "#frm_rcatalogo_id" ).serialize();
        buscarImagenesCatalogo( form_r, '' );
    });

    $("#btn_oimgs").on( "click", function(){
        // Invoca la generación de las imágenes de catálogo resultantes de la búsqueda
        var form_r = $( "#frm_rcatalogo" ).serialize();
        buscarImagenesCatalogo( form_r, 'descargar' );
    });
});
/* --------------------------------------------------------- */