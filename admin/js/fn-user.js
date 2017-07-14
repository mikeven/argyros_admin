// JavaScript Document
/*
* setup.js
*
*/
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
function log_in(){
	var error_m = "<div class='alert alert-warning' role='alert'>Verifica usuario y contraseña</div>";
	var form = $('#loginform');
	$.ajax({
        type:"POST",
        url:"database/data-user.php",
        data:form.serialize(),
        success: function( response ){
			$("#response").html( response );
			/*if( response == 1 ){
				window.location = "main.php";
			}
			else {
				$("#response").html( error_m );
			}*/
        }
    });
}
/* --------------------------------------------------------- */
function registroU(){
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
function agregarCuentaBancaria(){
	var idu = $( '#idu_sesion' ).val();
	var vbanco = $( '#banco' ).val();
	var vdesc = $( '#bdescripcion' ).val(); 

	$.ajax({
        type:"POST",
        url:"bd/data-usuario.php",
        data:{ banco: vbanco, desc: vdesc, id_u: idu },
        success: function( response ){
			res = jQuery.parseJSON(response);
			if( res.exito == '1' ){
				console.log(response);
				actualizarTablaCtasBancarias( '+', res.registro );
			}
			if( res.exito == '0' ){
				$("#mje_error").show(100);
				$("#txerr").html(res.mje);
			}
        }
    });
}
/* --------------------------------------------------------- */
function elimRegCA( idc ){
	//Invocación a eliminar registro de cuenta bancaria

	$.ajax({
        type:"POST",
        url:"bd/data-usuario.php",
        data:{ el_cuenta: idc },
        success: function( response ){
			res = jQuery.parseJSON(response);
			if( res.exito == '1' ){
				console.log(response);
				actualizarTablaCtasBancarias( '-', idc );
			}
			if( res.exito == '0' ){
				$("#mje_error").show(100);
				$("#txerr").html(res.mje);
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
});

/* --------------------------------------------------------- */