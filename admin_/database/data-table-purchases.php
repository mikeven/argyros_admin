<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones sobre datos de tabla de órdenes de compra */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerOrdenesCompra( $dbh ){
		//Devuelve el registro de las órdenes registradas
		$q = "select o.id, o.status as estado, o.note as nota, date_format( o.created_at,'%d/%m/%Y') as fecha, 
		p.id as idpvd, p.name as nombre, p.number as numero, u.first_name as nombre_u, u.last_name as apellido_u 
		from purchases o, providers p, users u 
		where o.provider_id = p.id and o.user_id = u.id order by o.created_at DESC";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetalleOrdenCompra( $dbh, $ido ){
		// Devuelve los registros de detalle de orden de compra indicado por id
		$q = "select doc.id, doc.product_id as idp, doc.product_detail_id as idd, doc.status as estado,  
		doc.quantity as cant, doc.detail_note as nota, p.name as producto, p.name as producto, s.id as idt, s.name as talla, 
		s.unit as unidad, sd.weight as peso, pd.location as ubicacion 
		from purchases oc, purchase_details doc, products p, sizes s, size_product_detail sd, product_details pd 
		where doc.purchase_id = oc.id and pd.product_id = p.id and doc.product_detail_id = pd.id and 
		doc.size_id = s.id and sd.product_detail_id = pd.id and sd.size_id = s.id and oc.id = $ido";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* ----------------------------------------------------------------------------------- */
	function calcularTotalPiezas( $dbh, $ido ){
		//Devuelve el total de piezas en una orden de compra
		$q = "select sum(quantity) as total_items from purchase_details where purchase_id = $ido";
		
		return mysqli_fetch_array( mysqli_query( $dbh, $q ) );
	}
	/* ----------------------------------------------------------------------------------- */
	function calcularTotalItems( $dorden ){
		//Devuelve el total de ítems en una orden de compra
		$ids_det		= array();
		
		foreach ( $dorden as $i ) {
			if( !in_array( $i["idd"], $ids_det ) ) $ids_det[] = $i["idd"];
		}

		return count( $ids_det );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTotalesPzasPesos( $detalle ){
		// Devuelve la sumatoria de pesos y cantidades de piezas en una orden de compra
		$totales["peso"] 	= 0;
		$totales["cant"] 	= 0;

		foreach ( $detalle as $item ){
			if( $item["estado"] != "no-recibido" ){ 
				$totales["cant"] += $item["cant"];
				$totales["peso"] += $item["peso"] * $item["cant"];
			}
		}

		return $totales;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTotalesOrden( $dbh, $dorden ){
		//Devuelve los totales: ítems, piezas, gramos en una orden de compra
		$total_items 		= calcularTotalItems( $dorden );
		$total_pzas_peso 	= obtenerTotalesPzasPesos( $dorden );
		$total_pzas 		= $total_pzas_peso["cant"];
		$total_gramos 		= $total_pzas_peso["peso"];

		$totales = "Ítems: ".$total_items." | Pzas: ".$total_pzas." | Peso: ".$total_gramos." gr";

		return $totales;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerIconoEstado( $estado, $x ){
		//Devuelve el ícono asociado al estado de un pedido
		$iconos = array( 
			"creada" 		=> "<i class='fa fa-file-o $x' title='Creada'></i>",
			"enviada" 		=> "<i class='fa fa-send-o $x' title='Enviada'></i>",
			"confirmada"	=> "<i class='fa fa-check $x' title='Confirmada'></i>",
			"recibida"		=> "<i class='fa fa-download $x' title='Recibida'></i>",
			"cancelada"		=> "<i class='fa fa-ban $x' title='Cancelada'></i>",
		);

		return $iconos[$estado];
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Clientes */
	/* ----------------------------------------------------------------------------------- */
	include( "bd.php" );

	$ordenes = obtenerOrdenesCompra( $dbh );

	foreach ( $ordenes as $o ) {

		$detalle_oc		= obtenerDetalleOrdenCompra( $dbh, $o["id"] );
		$iconoe 		= obtenerIconoEstado( $o["estado"], "" );
        $lnk_pvd 		= "provider.php?id=$o[idpvd]";
        $totales 		= obtenerTotalesOrden( $dbh, $detalle_oc ); 
        $link_orden 	= "<a href='purchase-data.php?purchase-id=$o[id]'>Orden de compra N° $o[id]</a>"." | ".
        					"<a href='purchase-data.php?purchase-id=$o[id]' target='_blank'>
        						<i class='fa fa-external-link'></i></a>";

        $reg_orden["id"] 			= $o["id"];
        $reg_orden["usuario"] 		= $o["nombre_u"]." ".$o["apellido_u"];
		$reg_orden["orden"] 		= $link_orden;
		$reg_orden["proveedor"] 	= "<a href='$lnk_pvd' target='_blank'>".$o["nombre"]." ".$o["numero"]."</a>";
		$reg_orden["fecha"] 		= $o["fecha"];
		$reg_orden["total"] 		= $totales;
		$reg_orden["status"] 		= $iconoe." ".$o["estado"];
		
		$data_ordenes["data"][] 	= $reg_orden;
	}

	/*......................................................................*/

	echo json_encode( $data_ordenes );
	
	/* ----------------------------------------------------------------------------------- */
?>