// JavaScript Document
/*
 * fn-sets.js
 *
 */
 /* --------------------------------------------------------- */
 function borrarDPJ( iddpj, idj ){
    //Invocación al servidor para desvincular un producto de un juego
    $.ajax({
        type:"POST",
        url:"database/data-sets.php",
        data:{ id_elim_dpj: iddpj, id_juego: idj },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Juegos", res.mje, "success" );
                setTimeout( function() { window.location = "sets.php"; }, 2000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Borrar producto de juego", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function borrarJuego( idj ){
    //Invocación al servidor para eliminar un juego
    $.ajax({
        type:"POST",
        url:"database/data-sets.php",
        data:{ id_elim_j: idj },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Juegos", res.mje, "success" );
                setTimeout( function() { window.location = "sets.php"; }, 2000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Borrar juego", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function obtenerElementoSeleccionJuego( id_e, img, iddet, id_img ){
    //Genera código hltm correspondiente a un elemento
	
	var id_f = "f" + iddet;
	var html_i = "<tr id='" + id_f + "' class='fselj'>";
    html_i += "<th width='33.3%'><img id='" + id_e + "' src='" + img + "' width='50px'></th>";
	html_i += "<th width='33.3%'><span class=''>#" 
	+ iddet + "</span><input type='hidden' name='iddp[]' value='" + iddet + "'></th>";
	html_i += "<th width='33.3%'><a href='#!' class='e_spj' data-fj='"
				+ id_f + "'><i class='fa fa-times-circle'></i></a></th>";
	html_i += "</tr>";

	return html_i;
}
/* --------------------------------------------------------- */
function chequearMinimoElementos(){
	//Bloquea/desbloquea botón guardar nuevo juego si hay el mínimo de elementos necesarios
	if( $('.fselj').length >= 2 ){
		//alert("valido: " + $('.fselj').length );
		$("#bot_ag_juego").prop("disabled", false );
	}
	else {
		//alert("no valido: " + $('.fselj').length );
		$("#bot_ag_juego").prop("disabled", true );	
	}
}
/* --------------------------------------------------------- */
function agregarSeleccionJuego( iddet, id_img ){
	//Agrega un producto al bloque de creación de juegos
	var img = $( "#" + id_img ).attr("src");
	var id_e = "sel" + iddet;
	var elemento = obtenerElementoSeleccionJuego( id_e, img, iddet, id_img );
	$("#seleccion_juego").append( elemento );
	$("#f" + iddet ).show("slow");
	chequearMinimoElementos();
}
/* --------------------------------------------------------- */
function iniciarBotonBorrarDPJ(){
    //Asigna los textos de la ventana de confirmación para borrar un producto de un juego
    iniciarVentanaModal( "btn_borrar_dpj", "btn_canc", 
                         "Quitar producto", "", 
                         "¿Confirma que desea quitar este producto del juego?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
function iniciarBotonBorrarJuego(){
    //Asigna los textos de la ventana de confirmación para borrar un juego
    iniciarVentanaModal( "btn_borrar_j", "btn_canc", 
                         "Eliminar juego", "", 
                         "¿Confirma que desea eliminar juego?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
function iniciarBotonAgregarSeleccionJuego(){
    // Asigna acción al botón de agregar detalle de producto a nuevo juego
    $("#datatable-sets-products").on( "click", ".sel-pj", function(){
        var iddet = $(this).attr( "data-idd" );
        var id_img = "img" + iddet;
        agregarSeleccionJuego( iddet, id_img );
    });   
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
		window.Parsley.addValidator('nocero', {
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

	if ( $("#frm_njuego").length > 0 ){
        $('#frm_njuego').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }
    
    iniciarBotonAgregarSeleccionJuego();

    $("#seleccion_juego").on( "click", ".e_spj", function(){
    	var idf = $(this).attr( "data-fj" );
    	$("#" + idf ).hide("slow").remove();
    	chequearMinimoElementos();
    });

    $("#tabla_datos-juegos").on( "click", ".elim_djp", function(){
        $("#id-dpj-e").val( $(this).attr( "data-iddpj" ) );
        $("#id-juego-e").val( $(this).attr( "data-idj" ) );
        iniciarBotonBorrarDPJ();

        $('#btn_borrar_dpj').on('click', function(){
            var iddpj = $("#id-dpj-e").val();
            var idj = $("#id-juego-e").val();
            $("#btn_canc").click();
            borrarDPJ( iddpj, idj );
        });
    });

    $("#tabla_datos-juegos").on( "click", ".elim_j", function(){
        $("#id-juego-e").val( $(this).attr( "data-idj" ) );
        iniciarBotonBorrarJuego();

        $('#btn_borrar_j').on('click', function(){
            var idj = $("#id-juego-e").val();
            $("#btn_canc").click();
            borrarJuego( idj );
        });
    });

    $('#tsets').dataTable({
            "paging": true,
            "iDisplayLength": 10,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "language": {
            "lengthMenu": "Mostrar _MENU_ regs por página",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando pág _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros",
            "infoFiltered": "(filtrados de _MAX_ regs)",
            "search": "Vuscar:",
            "paginate": {
              "first":      "Primero",
              "last":       "Último",
              "next":       "Próximo",
              "previous":   "Anterior"
            }
          }
        });

});
/* --------------------------------------------------------- */