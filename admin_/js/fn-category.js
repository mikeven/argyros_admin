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
function borrarCategoria( idc ){
    //Invocación al servidor para eliminar una categoría
    $.ajax({
        type:"POST",
        url:"database/data-categories.php",
        data:{ id_elim_cat: idc },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Categoría", res.mje, "success" );
                setTimeout( function() { window.location = "categories.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Borrar categoría", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function borrarSubcategoria( idsc ){
    //Invocación al servidor para eliminar una subcategoría
    $.ajax({
        type:"POST",
        url:"database/data-categories.php",
        data:{ id_elim_subcat: idsc },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Subcategoría", res.mje, "success" );
                setTimeout( function() { window.location = "subcategories.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Borrar subcategoría", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function iniciarBotonBorrarCategoria(){
    //Asigna los textos de la ventana de confirmación para borrar una categoría
    iniciarVentanaModal( "btn_borrar_categoria", "btn_canc", 
                         "Borrar categoría", "", 
                         "¿Confirma que desea borrar categoría?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
function iniciarBotonBorrarSubcategoria(){
    //Asigna los textos de la ventana de confirmación para borrar una subcategoría
    iniciarVentanaModal( "btn_borrar_subcategoria", "btn_canc", 
                         "Borrar subcategoría", "", 
                         "¿Confirma que desea borrar subcategoría?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */

$( document ).ready(function() {
	
    $("#selcateg").on( "click", function(){
		var idc = $(this).val();
		obtenerSubcategoriasCategoria( idc );
    });

    if ( $("#frm_mcategoria").length > 0 ){
        $('#frm_mcategoria').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }

    if ( $("#frm_ncategoria").length > 0 ){
        $('#frm_ncategoria').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }

    $("#tabla_datos-categorias").on( "click", ".elim-categoria", function(){
        $("#id-categ-e").val( $(this).attr( "data-idc" ) );
        iniciarBotonBorrarCategoria();

        $('#btn_borrar_categoria').on('click', function(){
            var idc = $("#id-categ-e").val();
            $("#btn_canc").click();
            borrarCategoria( idc );
        });
    });
    
    /* ================= SUBCATEGORÍAS ============== */

    if ( $("#frm_nsubcategoria").length > 0 ){
        $('#frm_nsubcategoria').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }

    if ( $("#frm_msubcategoria").length > 0 ){
        $('#frm_msubcategoria').parsley().on('form:success', function() {
            //Validación del formulario sin acciones previstas, submit directo por POST sin ajax
        });
    }

    $("#tabla_datos-subcategorias").on( "click", ".elim-subcategoria", function(){
        $("#id-scateg-e").val( $(this).attr( "data-idsc" ) );
        iniciarBotonBorrarSubcategoria();

        $('#btn_borrar_subcategoria').on('click', function(){
            var idsc = $("#id-scateg-e").val();
            $("#btn_canc").click();
            borrarSubcategoria( idsc );
        });
    });
      
});

/* --------------------------------------------------------- */