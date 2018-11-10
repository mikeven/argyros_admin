<?php
	/* Argyros - Funciones de configuración */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	
	function obtenerEmailNotificacionPedidos( $dbh ){
		//Devuelve el correo electrónico de notificaciones de pedidos
		$q = "select orders_email from admin_configs";
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerEmailNotificacionContacto( $dbh ){
		//Devuelve el correo electrónico de notificaciones de recepción de datos del formulario de contacto
		$q = "select contact_email from admin_configs";
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarEmailNotificacionPedidos( $dbh, $email ){
		//Actualiza el correo electrónico que recibe notificaciones de pedidos
		
		$q = "update admin_configs set orders_email = '$email'";
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarEmailNotificacionContacto( $dbh, $email ){
		//Actualiza el correo electrónico que recibe notificaciones del formulario de contacto 
		
		$q = "update admin_configs set contact_email = '$email'";
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarEmailsNotificaciones( $dbh, $email_p, $email_c ){
		//Actualiza los emails que reciben notificaciones 
		
		$q = "update admin_configs set orders_email = '$email_p', contact_email = '$email_c'";
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarConfiguracionEmail( $dbh, $cgf_email ){
		//Guarda los valores de direcciones de correo de la configuración de notificación de emails
		$ra = actualizarEmailsNotificaciones( $dbh, $cgf_email["email-pedidos"], 
													$cgf_email["email-contacto"] );
		return $ra;
	}
	/* ----------------------------------------------------------------------------------- */

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar datos de configuración */
	/* ----------------------------------------------------------------------------------- */

	if( isset( $_POST["form_cfg_email"] ) ){
		include( "bd.php" );
		ini_set( 'display_errors', 1 );
		parse_str( $_POST["form_cfg_email"], $cgf_email );
		
		$r_cfg = actualizarConfiguracionEmail( $dbh, $cgf_email );

		if ( $r_cfg == 1 ){
			$res["exito"] = 1;
			$res["mje"] = "Datos de configuración actualizados con éxito";
		} else {
			$res["exito"] = -1;
			$res["mje"] = "Error al actualizar configuración";
		}

		echo json_encode( $res );
	}

?>