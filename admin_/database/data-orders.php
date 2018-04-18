<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de pedidos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerOrdenesUsuarios( $dbh ){
		//Devuelve el registro de las órdenes registradas
		$q = "select o.id, o.user_id as idu, o.total_price as total, o.order_status as estado, 
		date_format( o.created_at,'%d/%m/%Y') as fecha, date_format( o.created_at,'YYYYMMDD') as creada, 
		u.id as cid, u.first_name nombre, u.last_name as apellido 
		from orders o, users u where o.user_id = u.id order by o.created_at DESC";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerRegistroOrdenPorId( $dbh, $ido ){
		//Devuelve el registro de una orden dado su id
		$q = "select o.id, o.user_id as idu, o.total_price as total, o.order_status as estado, 
		o.client_note, o.admin_note, date_format( o.created_at,'%d/%m/%Y') as fecha, u.id as cid, 
		u.first_name nombre, u.last_name as apellido, u.email as email, g.name as grupo_cliente 
		from orders o, users u, user_group g where o.user_id = u.id and u.user_group_id = g.id and o.id = $ido";

		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetalleOrden( $dbh, $ido ){
		//Devuelve los registros correspondientes a un detalle de pedido dado su id
		$q = "select od.id, od.order_id, od.product_id, od.product_detail_id, 
		od.available as disponible, od.item_status as istatus, od.check_revision as revision, od.quantity, 
		od.price, p.name as producto, p.description, s.name as talla, s.unit 
		from orders o, order_details od, products p, sizes s, size_product_detail sd, product_details pd 
		where od.order_id = o.id and od.product_id = p.id and od.product_detail_id = pd.id and 
		od.size_id = s.id and sd.product_detail_id = pd.id and sd.size_id = s.id and o.id = $ido";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function calcularTotalOrdenConfirmada( $detalle ){
		//Devuelve el total de una orden después de haber sido confirmado
		$monto = 0;
		foreach ( $detalle as $item ) {
			if( $item["istatus"] != "retirado" ){
				$monto += $item["disponible"] * $item["price"];
			}
		}
		return $monto;		
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenesProductoOrden( $dbh, $detalle ){
		//Devuelve las imágenes de los productos de una orden
		$ndetalle = array();
		foreach ( $detalle as $reg ) {
			$data = obtenerImagenesDetalleProducto( $dbh, $reg["product_detail_id"], 1 );
			$reg["imagen"] = $data[0]["path"];
			$ndetalle[] = $reg;		
		}
		return $ndetalle;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerOrdenPorId( $dbh, $ido, $param ){
		//Devuelve el contenido de una orden, su detalle dado su id
		$orden["orden"] = obtenerRegistroOrdenPorId( $dbh, $ido );
		if( $param == "full" ){
			$orden["detalle"] = obtenerDetalleOrden( $dbh, $ido );
			$orden["detalle"] = obtenerImagenesProductoOrden( $dbh, $orden["detalle"] );
		}
		
		return $orden;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarDisponibilidadItems( $dbh, $ido ){
		//Asigna el valor de las cantidades solicitadas a las cantidades disponibles del pedido
		$detalle = obtenerDetalleOrden( $dbh, $ido );
		foreach ( $detalle as $r ) {
			actualizarDetallePedidoRevision( $dbh, $r["id"], $r["quantity"], "disp" );		
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarDetallePedidoRevision( $dbh, $id, $cant, $rev ){
		//Modifica las cantidades del pedido en revisión ( administrador )
		$q = "update order_details set available = $cant, check_revision = '$rev', 
		updated_at = NOW() where id = $id";

		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarEstadoPedido( $dbh, $id, $estado ){
		//Actualiza el estado de un pedido
		$q = "update orders set order_status = '$estado', updated_at = NOW() where id = $id";
		
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarRevisionPedido( $dbh, $revision ){
		//Recorre el vector de registros de detalle de pedido (id, cant) para enviar a BD
		$res = 0;
		foreach ( $revision as $r ) {
			list( $id, $cant, $srev ) = explode( ',', $r );
			$res += actualizarDetallePedidoRevision( $dbh, $id, $cant, $srev );
		}
		return $res;
	}
	/* ----------------------------------------------------------------------------------- */
	function ingresarObservacionesAdministrador( $dbh, $idpedido, $obs ){
		//Guarda observaciones por parte del administrador al entregar pedido
		$q = "update orders set admin_note = '$obs' where id = $idpedido";

		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function notificarActualizacionPedido( $dbh, $paso_pedido, $ido, $total ){
		//Prepara los datos necesarios para enviar notificación por email acerca de cambios en estados de pedido
		include( "../fn/fn-mailing.php" );
		
		$orden = obtenerRegistroOrdenPorId( $dbh, $ido );
		$orden["total_orden"] = $total;

		if( $paso_pedido == "pedido_revisado" ){
			enviarMensajeEmail( "pedido_revisado_usuario", $orden, $orden["orden"]["email"] );
		}
		if( $paso_pedido == "pedido_entregado" ){
			enviarMensajeEmail( "pedido_entregado_usuario", $orden, $orden["email"] );
		}
		if( $paso_pedido == "pedido_confirmado_a" ){
			enviarMensajeEmail( "pedido_confirmado_usuario", $orden, $orden["email"] );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Líneas */
	/* ----------------------------------------------------------------------------------- */
	
	//Registrar revisión de pedido
	if( isset( $_POST["rev_ped"] ) ){
		include( "bd.php" );	
		parse_str( $_POST["rev_ped"], $revision );
		
		$idr = registrarRevisionPedido( $dbh, $revision["regrev"] );
		if ( ( $idr != 0 ) && ( $idr != "" ) ){
			actualizarEstadoPedido( $dbh, $_POST["idp"], "revisado" );
			notificarActualizacionPedido( $dbh, "pedido_revisado", $_POST["idp"], $_POST["monto_orden"] );
			$res["exito"] = 1;
			$res["mje"] = "La respuesta del pedido ha sido enviada";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al actualizar pedido";
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	//Registrar confirmación/entrega de pedido
	if( isset( $_POST["conf_ped"] ) ){
		include( "bd.php" );
		$estado = $_POST["status"];	
		$idp = $_POST["conf_ped"];
		$idr = actualizarEstadoPedido( $dbh, $idp, $estado );
		$monto_cnf = calcularTotalOrdenConfirmada( obtenerDetalleOrden( $dbh, $idp ) );
		
		if( $estado == "confirmado" ){
			//Al confirmar un pedido desde el administrador se asignan disponibles todas las cantidades
			actualizarDisponibilidadItems( $dbh, $idp );
			notificarActualizacionPedido( $dbh, "pedido_confirmado_a", $idp, $monto_cnf );
			$m1 = "confirmado"; $m2 = "confirmar";
		}
		if( $estado == "entregado" ){
			//Se actualiza el pedido con las observaciones del administrador y se notifica por email al cliente
			ingresarObservacionesAdministrador( $dbh, $idp, $_POST["nota"] );
			notificarActualizacionPedido( $dbh, "pedido_entregado", $idp, $monto_cnf );
			$m1 = "entregado";  $m2 = "entregar";
		}

		if( $estado == "cancelado" ){ $m1 = "cancelado"; $m2 = "cancelar"; }

		if ( ( $idr != 0 ) && ( $idr != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "El pedido ha sido marcado como $m1";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al $m2 pedido";
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
?>