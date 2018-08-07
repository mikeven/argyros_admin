// JavaScript Document
/*
* fn-user.js
*
*/
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
function log_in(){
	//Invocación al servidor iniciar sesión
	var error_m = "<div class='alert alert-warning' role='alert'></div>";
	var form = $('#loginform');

	$.ajax({
        type:"POST",
        url:"database/data-user.php",
        data:form.serialize(),
        success: function( response ){
			$("#response").html( response );
			res = jQuery.parseJSON(response);
			if( res.exito == 1 ){
				window.location = "home.php";
			}
			else {
				error_m = "<div class='alert alert-warning' role='alert'>" + res.mje + "</div>";
				$("#response").html( error_m );
			}
        }
    });
}
/* --------------------------------------------------------- */
function registroU(){
	//Invocación al servidor ingresar nuevo usuario
	var form = $('#regform');
	$.ajax({
        type:"POST",
        url:"bd/data-usuario.php",
        data:form.serialize(),
        success: function( response ){
			//$("#rreg").html(response);
			res = jQuery.parseJSON(response);
			if( res.exito == '1' ){
				$("#txexi").html(res.mje);
				$("#mje_exito").show("slow");
				$("#mje_error").hide(100);
			}
			if( res.exito == '0' ){
				$("#mje_error").show(100);
				$("#txerr").html(res.mje);
			}
        }
    });
}
/* --------------------------------------------------------- */
function initValid(){
  
	$('#frm_mcuenta').bootstrapValidator({
		message: 'Revise el contenido del campo',
		feedbackIcons: {
		  valid: 'glyphicon glyphicon-ok',
		  invalid: 'glyphicon glyphicon-remove',
		  validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
		  email: {
		      validators: { notEmpty: { message: 'Debe indicar un email' }}
		  },
		  nombre: {
		      validators: { notEmpty: { message: 'Debe indicar nombre' } }
		  },
		  rif: {
		      validators: { notEmpty: { message: 'Debe indicar RIF' } }
		  }
		},
		onSuccess: function(e, data) {
			e.preventDefault();
			modificarDatosUsuario( "#frm_mcuenta" );
		}
	});

	$('#frm_musuario').bootstrapValidator({
		message: 'Revise el contenido del campo',
		feedbackIcons: {
		    valid: 'glyphicon glyphicon-ok',
		    invalid: 'glyphicon glyphicon-remove',
		    validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
		    usuario: {
		        validators: { notEmpty: { message: 'Debe indicar nombre de usuario' } }
		    }
		},
		onSuccess: function(e, data) {
			e.preventDefault();
			modificarDatosUsuario( "#frm_musuario" );
		}
	});

	$('#frm_mpassw').bootstrapValidator({
		message: 'Revise el contenido del campo',
		feedbackIcons: {
		    valid: 'glyphicon glyphicon-ok',
		    invalid: 'glyphicon glyphicon-remove',
		    validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
		    password1: {
		        validators: { notEmpty: { message: 'Debe indicar constraseña' } }
		    },
		    password2:{
		        validators: { 
		          identical: {
		            field: 'password1',
		            message: 'Las contraseñas deben coincidir'
		          }
		        }
		    }
		},
		onSuccess: function(e, data) {
			e.preventDefault();
			$(".alert").hide();
			modificarDatosUsuario( "#frm_mpassw" );//modificarDatosUsuario( $(this) );
		}
	});

}
/* --------------------------------------------------------- */
function modificarDatosUsuario( param ){
//Invocación al servidor para modificar datos de usuario
	$.ajax({
        type:"POST",
        url:"bd/data-usuario.php",
        data: $(param).serialize(),
        success: function( response ){
			res = jQuery.parseJSON(response);
			//$("#waitconfirm").html(response);
			if( res.exito == '1' ){
				$("#txexi").html(res.mje);
				$("#mje_exito").show("slow");
				$("#mje_error").hide(100);
			}
			if( res.exito == '0' ){
				$("#mje_error").show(100);
				$("#txerr").html(res.mje);
			}
        }
    });
}
/* --------------------------------------------------------- */
function modificarRolUsuario( idu, idr ){
//Invocación al servidor para modificar el rol de un usuario
	$.ajax({
        type:"POST",
        url:"database/data-user.php",
        data: { id_cambio_rol: idr, id_usuario:idu },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON(response);
			if( res.exito == 1 ){ 
                notificar( "Rol de usuario", res.mje, "success" );
                if( res.idrol == 4 ){
                	notificar( "Rol de usuario", "Este usuario no podrá ingresar al administrador", "info" );	
                }
            }
            if( res.exito == -1 ){ 
                notificar( "Rol de usuario", res.mje, "error" );
            }
        }
    });
}

/* --------------------------------------------------------- */

$( document ).ready(function() {

    $("#bt_ag_ctab").on( "click", function(){
		$("#closeModal").click();
		if( checkCuentaBancaria() == 0 )
			agregarCuentaBancaria();
		else
			$("#enl_vmsj").click();
    });

    $(".ctr_rol_usuario").on( "change", function(){
		var idu = $(this).attr("id");
		var idr = $(this).val();
		modificarRolUsuario( idu, idr );
    });
});

/* --------------------------------------------------------- */