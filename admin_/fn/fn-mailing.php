<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones mensajes emails */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerCabecerasMensaje(){
		//Devuelve las cabecera 
		$email = "info@argyros.com";
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $cabeceras .= 'From: Argyros <'.$email.">"."\r\n";

        return $cabeceras;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerSobreEnvio( $mail, $asunto, $mensaje, $to ){
		//Devuelve el objeto PHPMAiler con los datos configurados para su envío
		$mail->IsSMTP();
		$mail->Host = "argyros.com.pa";
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;
		$mail->Username = "envios@argyros.com.pa";
		$mail->Password = "sendargyros";
		$mail->SetFrom('envios@argyros.com.pa', 'Argyros');
		$mail->Subject = $asunto;
		$mail->CharSet = 'UTF-8';
		$mail->MsgHTML( $mensaje );
		$mail->AddAddress( $to );

		return $mail;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPlantillaMensaje( $accion ){
		//Devuelve la plantilla html de acuerdo al mensaje a ser enviado
		$archivos = array(
			"usuario_nuevo" => "register.html",
			"recuperar_password" => "password_recovery.html",
			"nuevo_pedido_usuario" => "new_order_user.html",
			"nuevo_pedido_administrador" => "new_order_admin.html",
			"pedido_revisado_usuario" => "checked_order_user.html",
			"pedido_confirmado_usuario" => "confirmed_order_user.html",
			"pedido_entregado_usuario" => "delivered_order_user.html"
		);

		$archivo = $archivos[$accion];
		return file_get_contents( "../fn/mailing/".$archivo );
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeNuevoUsuario( $plantilla, $datos ){
		//Llenado de mensaje para plantilla de nuevo usuario
		$server = "http://mgideas.net";
		$url_activacion = $server."/argyros/verified_account.php?token_account=".$datos["token"];
		$plantilla = str_replace( "{url_activation}", $url_activacion, $plantilla );
		$plantilla = str_replace( "{user}", $datos["name"], $plantilla );
		
		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeRecuperarPassword( $plantilla, $datos ){
		//Llenado de mensaje para plantilla de recuperación de contraseña
		$server = "http://mgideas.net";
		$url_reset = $server."/argyros/password_reset.php?token_reset=".$datos;
		$plantilla = str_replace( "{url_pass_reset}", $url_reset, $plantilla );
		
		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeNuevoPedido( $tmensaje, $plantilla, $datos ){
		//Llenado de mensaje para plantilla de notificación pedido nuevo (status: pendiente)
		$cncy = "$"; 
		$usuario = $datos["usuario"];
		$orden = $datos["orden"];
		$plantilla = str_replace( "{user}", $usuario["first_name"]." ".$usuario["last_name"], $plantilla );
		$plantilla = str_replace( "{npedido}", $orden["id"], $plantilla );
		$plantilla = str_replace( "{monto_pedido}", $cncy.$datos["total"], $plantilla );
		
		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajePedidoRevisado( $tmensaje, $plantilla, $datos ){
		//Llenado de mensaje para plantilla de notificación pedido revisado (status: revisado)
		$cncy = "$"; 
		$orden = $datos;

		$plantilla = str_replace( "{user}", $orden["nombre"]." ".$orden["apellido"], $plantilla );
		$plantilla = str_replace( "{npedido}", $orden["id"], $plantilla );
		$plantilla = str_replace( "{monto_pedido}", $cncy.$datos["total_orden"], $plantilla );

		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajePedidoConfirmado( $tmensaje, $plantilla, $orden ){
		//Llenado de mensaje para plantilla de notificación pedido confirmado (status: entregado)
		$cncy = "$";

		$plantilla = str_replace( "{user}", $orden["nombre"]." ".$orden["apellido"], $plantilla );
		$plantilla = str_replace( "{npedido}", $orden["id"], $plantilla );
		$plantilla = str_replace( "{monto_pedido}", $cncy.$orden["total_orden"], $plantilla );

		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajePedidoEntregado( $tmensaje, $plantilla, $orden ){
		//Llenado de mensaje para plantilla de notificación pedido entregado (status: entregado)
		$cncy = "$"; 

		$plantilla = str_replace( "{user}", $orden["nombre"]." ".$orden["apellido"], $plantilla );
		$plantilla = str_replace( "{npedido}", $orden["id"], $plantilla );
		$plantilla = str_replace( "{monto_pedido}", $cncy.$orden["total_orden"], $plantilla );
		$plantilla = str_replace( "{observaciones}", $orden["admin_note"], $plantilla );

		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function escribirMensaje( $tmensaje, $plantilla, $datos ){
		//Sustitución de elementos de la plantilla con los datos del mensaje
		
		if( $tmensaje == "usuario_nuevo" ){
			$sobre["asunto"] = "Activación cuenta";
			$sobre["mensaje"] = mensajeNuevoUsuario( $plantilla, $datos );
		}
		if( $tmensaje == "recuperar_password" ){
			$sobre["asunto"] = "Restablecimiento de contraseña";
			$sobre["mensaje"] = mensajeRecuperarPassword( $plantilla, $datos );
		}
		if( $tmensaje == "nuevo_pedido_usuario" ){
			$sobre["asunto"] = "Nuevo pedido Argyros";
			$sobre["mensaje"] = mensajeNuevoPedido( $tmensaje, $plantilla, $datos );
		}
		if( $tmensaje == "nuevo_pedido_administrador" ){
			$sobre["asunto"] = "Nuevo pedido";
			$sobre["mensaje"] = mensajeNuevoPedido( $tmensaje, $plantilla, $datos );
		}
		if( $tmensaje == "pedido_revisado_usuario" ){
			$sobre["asunto"] = "Pedido revisado";
			$sobre["mensaje"] = mensajePedidoRevisado( $tmensaje, $plantilla, $datos );
		}
		if( $tmensaje == "pedido_confirmado_usuario" ){
			$sobre["asunto"] = "Pedido confirmado";
			$sobre["mensaje"] = mensajePedidoConfirmado( $tmensaje, $plantilla, $datos );
		}
		if( $tmensaje == "pedido_entregado_usuario" ){
			$sobre["asunto"] = "Pedido entregado";
			$sobre["mensaje"] = mensajePedidoEntregado( $tmensaje, $plantilla, $datos );
		}

		return $sobre; 
	}
	/* ----------------------------------------------------------------------------------- */
	function enviarMensajeEmail( $tipo_mensaje, $datos, $email ){
		//Construcción del mensaje para enviar por email
		require_once( "PHPMailer/PHPMailerAutoload.php" );
		$mail = new PHPMailer();
		
		$plantilla = obtenerPlantillaMensaje( $tipo_mensaje );
		$envio = escribirMensaje( $tipo_mensaje, $plantilla, $datos );
		$sobre = obtenerSobreEnvio( $mail, $envio["asunto"], $envio["mensaje"], $email );

		if( !$sobre->send() ) {
			$res["exito"] = -1; 
			$res["msg"] = $mail->ErrorInfo;
		}else
		  	$res["exito"] = 1;

		return $res;
	}
	/* ----------------------------------------------------------------------------------- */
?>