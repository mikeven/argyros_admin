// JavaScript Document
/*
 * fn-client.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
/* --------------------------------------------------------- */
function agregarGrupoCliente(){
    //Invocación al servidor para agregar nuevo grupo de cliente
    var fs = $('#frm_ngrupocliente').serialize();
    
    $.ajax({
        type:"POST",
        url:"database/data-clients.php",
        data:{ form_ngrupo:fs },
        success: function( response ){
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
               window.location = "client-groups.php?ngroupsuccess";
            }
        }
    });
}
/* --------------------------------------------------------- */
function cambiarGrupoCliente( idc, valor ){
	//Invocación al servidor para modificar el grupo al que pertenece un cliente
	var fs = $('#frm_ngrupocliente').serialize();
	
	$.ajax({
        type:"POST",
        url:"database/data-clients.php",
        data:{ id_c: idc, grupo_valor: valor },
        success: function( response ){
			console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
               notificar( "Clientes", res.mje, "success" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function borrarGrupoCliente( idg ){
    //Invocación al servidor para eliminar un grupo de clientes
    $.ajax({
        type:"POST",
        url:"database/data-clients.php",
        data:{ id_elimg: idg },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Grupo de cliente", res.mje, "success" );
                setTimeout( function() { window.location = "client-groups.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Borrar grupo de cliente", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function borrarCliente( idc ){
    //Invocación al servidor para eliminar un grupo de clientes
    $.ajax({
        type:"POST",
        url:"database/data-clients.php",
        data:{ id_elim_cl: idc },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Cliente", res.mje, "success" );
                setTimeout( function() { window.location = "clients.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Borrar cliente", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function bloquearCliente( idc, bloqueo ){
    //Invocación al servidor para bloquear/desbloquear clientes
    $.ajax({
        type:"POST",
        url:"database/data-clients.php",
        data:{ id_bloq_c: idc, accion_b: bloqueo },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            if( res.exito == 1 ){ 
                notificar( "Cliente", res.mje, "success" );
                setTimeout( function() { window.location = "clients.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Bloquear cliente", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function iniciarBotonBorrarGrupoCliente(){
    //Asigna los textos de la ventana de confirmación para borrar un grupo de clientes
    iniciarVentanaModal( "btn_borrar_grupo_cliente", "btn_canc", 
                         "Borrar grupo de cliente", "", 
                         "¿Confirma que desea borrar grupo?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
function iniciarBotonBorrarCliente(){
    //Asigna los textos de la ventana de confirmación para borrar un cliente
    iniciarVentanaModal( "btn_borrar_cliente", "btn_canc", 
                         "Borrar cliente", "", 
                         "¿Confirma que desea borrar cliente?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
function iniciarBotonBloquearCliente( accion ){
    //Asigna los textos de la ventana de confirmación para bloquear/desbloquear un cliente

    if( accion == 0 ){
        tit = "Desbloquear "; txa = " desbloquear ";
    }else{
        tit = "Bloquear "; txa = " bloquear ";
    }

    iniciarVentanaModal( "btn_bloquear_cliente", "btn_canc", 
                         tit + "cliente", "", 
                         "¿Confirma que desea" + txa + "cliente?", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */

$( document ).ready(function() {
    $("#bot_guardar_grupo").on( "click", function(){
		agregarGrupoCliente();
    });

    $(".selec_grupo_perfil").on( "change", function(){
        var valor = $(this).val();
        var idc = $(this).attr("data-idc");
        cambiarGrupoCliente( idc, valor );
    });
    /* ................................................................ */
    $("#tabla_datos-gclientes").on( "click", ".elim-gcliente", function(){
        $("#ig-grupo-e").val( $(this).attr( "data-idg" ) );
        iniciarBotonBorrarGrupoCliente();

        $('#btn_borrar_grupo_cliente').on('click', function(){
            var idg = $("#ig-grupo-e").val();
            $("#btn_canc").click();
            borrarGrupoCliente( idg );
        });
    });
    /* ................................................................ */
    $("#tabla_datos-clientes").on( "click", ".elim-cliente", function(){
        $("#id-cliente-e").val( $(this).attr( "data-idc" ) );
        iniciarBotonBorrarCliente();

        $('#btn_borrar_cliente').on('click', function(){
            var idc = $("#id-cliente-e").val();
            $("#btn_canc").click();
            borrarCliente( idc );
        });
    });
    /* ................................................................ */
    $("#tabla_datos-clientes").on( "click", ".bloq-cliente", function(){
        $("#id-cliente-b").val( $(this).attr( "data-idc" ) );
        var accion = $(this).attr( "data-bl" );
        iniciarBotonBloquearCliente( accion );

        $('#btn_bloquear_cliente').on('click', function(){
            var idc = $("#id-cliente-b").val();
            $("#btn_canc").click();
            bloquearCliente( idc, accion );
        });
    });
    /* ................................................................ */
    $('#datatable-clients').dataTable({
          "paging": true,
          "iDisplayLength": 10,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "order": [ 1, "desc" ],
          "columnDefs": [ { "searchable": false, "targets": 6 } ],
          "language": {
            "lengthMenu": "Mostrar _MENU_ regs por página",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando pág _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros",
            "infoFiltered": "(filtrados de _MAX_ regs)",
            "search": "Buscar:",
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