<?php 
	/* Argyros - Funciones de órdenes ( pedidos ) */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
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
	function calcularMontoPedido( $detalle, $estado_orden ){
		//Devuelve el monto total del pedido después de la revisión de disponibilidades
		$monto = 0.00;
		foreach ( $detalle as $r ) {
			if( $r["istatus"] != "retirado" )
				$monto += ( $r["disponible"] * $r["price"] );
		}
		return $monto;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerNumeroCantidadItems( $detalle, $estado ){
		//Devuelve la suma total de cantidades de los ítems de un pedido dependiendo del estatus
		$nitems = 0;
		foreach ( $detalle as $r ) {
			if( $estado == "pendiente" || $estado == "cancelado" )
				$nitems += $r["quantity"];
			else{
				$nitems += $r["disponible"];
			}
		}
		return $nitems;
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

		return $monto;		
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTotalPesoItemOrden( $item, $estado ){
		//Devuelve el peso total de un ítem de acuerdo a la disponibilidad del mismo y el estatus del pedido

		if( $estado == "pendiente" || $estado == "cancelado" ){
			$tpeso = $item["quantity"] * $item["peso"];
		}else
			$tpeso = $item["disponible"] * $item["peso"];
		
		return $tpeso;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPesoTotalOrden( $orden, $detalle ){
		//Devuelve el peso total de un pedido

		$tpeso = 0;
		foreach ( $detalle as $i ) {
			$tpeso += obtenerTotalPesoItemOrden( $i, $orden["estado"] );
		}
		
		return $tpeso;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerOrdenActualizada( $orden, $detalle ){
		//Devuelve los datos actualizados de una orden dependiendo del estado
		$orden["procesada"] = false;
		if ( ( $orden["estado"] != "pendiente" ) && ( $orden["estado"] != "cancelado" ) ){
			$orden["procesada"] = true;
			$orden["total_actualizado"] = calcularMontoPedido( $detalle, $orden["estado"] );
		}else{
			$orden["total_actualizado"] = $orden["total"];
			$orden["ncant_items"] = obtenerNumeroCantidadItems( $detalle, $orden["estado"] );
		}

		if( ( $orden["estado"] == "revisado" ) || ( $orden["estado"] == "confirmado" ) || ( $orden["estado"] == "entregado" ) ){
			$orden["ncant_items"] = obtenerNumeroCantidadItems( $detalle, $orden["estado"] );	
		}
		
		return $orden;
	}
	/* ----------------------------------------------------------------------------------- */
	function activarIconoRevision( $estado_item, $estado_icono ){
		//Devuelve el estado de un ícono 
		$res = "marked";
		if( $estado_item != $estado_icono ) 
			$res = "";
		return $res;
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["order-id"] ) ){
		
        $ido 				= $_GET["order-id"];
        $data_o 			= obtenerOrdenPorId( $dbh, $ido, "full" );
        
        if( $data_o["orden"] ){
	        $dorden 		= $data_o["detalle"];
	        $orden 			= obtenerOrdenActualizada( $data_o["orden"], $dorden );
	        $iconoe 		= obtenerIconoEstado( $orden["estado"], "fa-2x" );
	        $orden["tpeso"]	= obtenerPesoTotalOrden( $data_o["orden"], $dorden );
    	}
    }
?>