<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones sobre datos de tabla de pedidos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerOrdenesUsuarios( $dbh ){
		//Devuelve el registro de las órdenes registradas
		$q = "select o.id, o.user_id as idu, o.total_price as total, o.order_status as estado, 
		date_format( o.created_at,'%d/%m/%Y') as fecha, date_format( o.created_at,'YYYYMMDD') as creada, 
		c.id as cid, c.first_name nombre, c.last_name as apellido 
		from orders o, clients c where o.user_id = c.id order by o.created_at DESC";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
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
	function calcularTotalOrden( $orden, $detalle ){
		// Devuelve el total de una orden después de haber sido revisado/confirmado
		$monto = 0;

		foreach ( $detalle as $item ){
			if( $orden["estado"] == "pendiente" || $orden["estado"] == "cancelado" )
				$monto += $item["quantity"] * $item["price"];
			else{
				if( $item["istatus"] != "retirado" )
					$monto += $item["disponible"] * $item["price"];
			}
		}

		return number_format( $monto, 2, ".", "" );		
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerIconoEstado( $estado, $x ){
		//Devuelve el ícono asociado al estado de un pedido
		$iconos = array( 
			"pendiente" 	=> "<i class='fa fa-clock-o $x'></i>",
			"cancelado" 	=> "<i class='fa fa-ban $x' title='Cancelado'></i>",
			"revisado"		=> "<i class='fa fa-eye $x' title='Revisado'></i>",
			"confirmado"	=> "<i class='fa fa-check $x' title='Confirmado'></i>",
			"entregado"		=> "<i class='fa fa-arrow-right $x' title='Entregado'></i>",
		);

		return $iconos[$estado];
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Clientes */
	/* ----------------------------------------------------------------------------------- */
	include( "bd.php" );

	$pedidos = obtenerOrdenesUsuarios( $dbh );

	foreach ( $pedidos as $p ) {

		$iconoe 					= obtenerIconoEstado( $p["estado"], "" );
        $dorden 					= obtenerDetalleOrden( $dbh, $p["id"] );
        $total_o 					= calcularTotalOrden( $p, $dorden ); 
        $lnk_cliente 				= "client-data.php?id=$p[idu]";
        $link_pedido 				= "<a href='order-data.php?order-id=$p[id]'>Pedido N° $p[id]</a>"." | ".
        							"<a href='order-data.php?order-id=$p[id]' target='_blank'><i class='fa fa-external-link'></i></a>";

        $reg_pedido["id"] 			= $p["id"];
		$reg_pedido["pedido"] 		= $link_pedido;
		$reg_pedido["cliente"] 		= "<a href='$lnk_cliente' target='_blank'>".$p["nombre"]." ".$p["apellido"]."</a>";
		$reg_pedido["fecha"] 		= $p["fecha"];
		$reg_pedido["status"] 		= $iconoe." ".$p["estado"];
		$reg_pedido["total"] 		= "$".$total_o;
		$reg_pedido["creado"] 		= $p["creada"];
		
		$data_pedidos["data"][] 	= $reg_pedido;
	}

	/*......................................................................*/

	echo json_encode( $data_pedidos );
	
	/* ----------------------------------------------------------------------------------- */
?>