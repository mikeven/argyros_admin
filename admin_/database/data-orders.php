<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de pedidos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerOrdenesUsuarios( $dbh ){
		//Devuelve el registro de las órdenes asociadas a un usuario
		$q = "select o.id, o.user_id as idu, o.total_price as total, o.order_status as estado, 
		date_format( o.created_at,'%d/%m/%Y') as fecha, u.id as cid, u.first_name nombre, 
		u.last_name as apellido from orders o, users u where o.user_id = u.id order by o.created_at DESC";
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerRegistroOrdenPorId( $dbh, $ido ){
		//Devuelve el registro de una orden dado su id
		$q = "select o.id, o.user_id as idu, o.total_price as total, o.order_status as estado, 
		date_format( o.created_at,'%d/%m/%Y') as fecha, u.id as cid, u.first_name nombre, 
		u.last_name as apellido, g.name as grupo_cliente from orders o, users u, user_group g 
		where o.user_id = u.id and u.user_group_id = g.id and o.id = $ido";

		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetalleOrden( $dbh, $ido ){
		//Devuelve los registros correspondientes a un detalle de pedido dado su id
		$q = "select od.id, od.order_id, od.product_id, od.product_detail_id, 
		od.quantity, od.price, p.name as producto, p.description, s.name as talla, s.unit from orders o, 
		order_details od, products p, sizes s, size_product_detail sd, product_details pd 
		where od.order_id = o.id and od.product_id = p.id and od.product_detail_id = pd.id and 
		od.size_id = s.id and sd.product_detail_id = pd.id and sd.size_id = s.id and o.id = $ido";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
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
	function obtenerOrdenPorId( $dbh, $ido ){
		//Devuelve el contenido de una orden, su detalle dado su id
		$orden["orden"] = obtenerRegistroOrdenPorId( $dbh, $ido );
		$orden["detalle"] = obtenerDetalleOrden( $dbh, $ido );
		$orden["detalle"] = obtenerImagenesProductoOrden( $dbh, $orden["detalle"] );
		
		return $orden;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarDetallePedidoRevision( $dbh, $id, $cant ){
		//Modifica las cantidades del pedido en revisión ( administrador )
		$q = "update order_details set available = $cant, updated_at = NOW() where id = $id";
		
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
			list( $id, $cant ) = explode( ',', $r );
			$res += actualizarDetallePedidoRevision( $dbh, $id, $cant );
		}
		return $res;
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Líneas */
	/* ----------------------------------------------------------------------------------- */
	
	//Registrar revisión de pedido
	if( isset( $_POST["rev_ped"] ) ){
		include( "bd.php" );	
		parse_str( $_POST["rev_ped"], $revision );
		//print_r( $revision );
		
		$idr = registrarRevisionPedido( $dbh, $revision["regrev"] );
		if ( ( $idr != 0 ) && ( $idr != "" ) ){
			actualizarEstadoPedido( $dbh, $_POST["idp"], "revisado" );
			$res["exito"] = 1;
			$res["mje"] = "La respuesta del pedido ha sido enviada";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al actualizar producto";
		}

		echo json_encode( $res );
		//print_r( $revision );
	}
	
	/* ----------------------------------------------------------------------------------- */

?>