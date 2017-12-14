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
	/* Solicitudes asíncronas al servidor para procesar información de Líneas */
	/* ----------------------------------------------------------------------------------- */
	
	
	/* ----------------------------------------------------------------------------------- */

?>