<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de órdenes de compra */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerOrdenesCompra( $dbh ){
		//Devuelve el registro de las órdenes de compra registradas
		$q = "select o.id, o.status as estado, o.note as nota, date_format( o.created_at,'%d/%m/%Y') as fecha, 
		date_format( o.created_at,'YYYY-MM-DD') as creada, p.id as idpvd, p.name as nombre, p.number as numero  
		from purchases o, providers p where o.provider_id = p.id order by o.created_at DESC";

		$data 	= mysqli_query( $dbh, $q );
		$lista 	= obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerOrdenesCompraDetalleProducto( $dbh, $idd ){
		//Devuelve el registro de las órdenes de compra registradas con un detalle de producto
		$q = "select distinct (oc.id) as id, date_format(oc.created_at,'%d/%m/%y') as fcreacion,  
		concat('compra ', oc.id) as movimiento, concat(p.number, ' ', p.name) as cliente_proveedor, 
		doc.quantity as cant, 'oc' as tipo_movimiento from purchases oc, purchase_details doc, providers p
		where doc.purchase_id= oc.id and oc.provider_id = p.id and doc.product_detail_id = $idd";
		
		$data 	= mysqli_query( $dbh, $q );
		$lista 	= obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerOrdenCompraPorId( $dbh, $ido ){
		//Devuelve el registro de una orden de compra por id
		$q = "select o.id, o.status as estado, o.note as nota, 
		date_format( o.created_at,'%d/%m/%Y') as fecha, date_format( o.created_at,'%m/%d/%Y') as fecha_en, 
		date_format( o.created_at,'%m%d%Y') as fecha_mdy, o.created_at as creada, 
		p.id as idpvd, p.name as nombre, p.number as numero, SUM(doc.quantity) AS cantidades, 
		u.first_name as nombre_u, u.last_name as apellido_u 
		from purchases o, providers p, purchase_details doc, users u  
		where o.provider_id = p.id and doc.purchase_id = o.id and o.user_id = u.id and o.id = $ido";

		return mysqli_fetch_array( mysqli_query( $dbh, $q ) );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetalleOrdenCompra( $dbh, $ido ){
		// Devuelve los registros de detalle de orden de compra indicado por id
		$q = "select doc.id, doc.product_id as idp, doc.product_detail_id as idd, doc.status as estado,  
		doc.quantity as cant, doc.detail_note as nota, p.name as producto, p.name as producto, s.id as idt, 
		s.name as talla, convert(s.name, decimal(4,2)) as vsize, s.unit as unidad, 
		sd.weight as peso, pd.location as ubicacion, pd.disused as desuso 
		from purchases oc, purchase_details doc, products p, sizes s, size_product_detail sd, product_details pd 
		where doc.purchase_id = oc.id and pd.product_id = p.id and doc.product_detail_id = pd.id and 
		doc.size_id = s.id and sd.product_detail_id = pd.id and sd.size_id = s.id and oc.id = $ido 
		ORDER BY doc.product_id, doc.product_detail_id, vsize";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaNotasOrden( $dbh, $ido ){
		//Devuelve la lista de notas asociadas a una orden de compra
		$q = "select n.note as nota, u.first_name as nombre, u.last_name as apellido, 
		 		date_format(n.created_at,'%d/%m/%Y') as fecha from purchase_notes n, users u, purchases o 
				where n.fk_user = u.id and n.fk_purchase = o.id and o.id = $ido order by n.created_at DESC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarOrdenCompra( $dbh, $idpvd, $idu ){
		//Guarda el registro de una orden
		$q = "insert into purchases ( status, provider_id, user_id, created_at ) 
				values ( 'creada', $idpvd, $idu, NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function guardarRegistroDetalleOrdenCompra( $dbh, $orden, $item ){
		//Guarda un registro de detalle de orden de compra
		$nota_item = escaparTexto( $dbh, $item["nota"] );
		$q = "insert into purchase_details ( purchase_id, product_id, product_detail_id, size_id, 
				quantity, status, detail_note, created_at ) values ( $orden[id], $item[idp], $item[idd], 
				$item[idt], $item[cant], 'pendiente', '$nota_item', NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarDetalleOrdenCompra( $dbh, $orden, $preorden, $idpvd ){
		//Guarda el detalle de una orden de compra, recorriendo la lista pre-orden
		$n = 0;
		foreach ( $preorden as $item ) {
			if( $item["en_oc"] && $item["idpvd"] == $idpvd ){
				guardarRegistroDetalleOrdenCompra( $dbh, $orden, $item );
				$n++; 
			}
		}
		return $n;
	} 
	/* ----------------------------------------------------------------------------------- */
	function actualizarEstadoItemOC( $dbh, $iddo, $valor ){
		//Actualiza el estado de un ítem de orden de compra
		$q = "update purchase_details set status = '$valor' where id = $iddo";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarEstadoOrdenCompra( $dbh, $iddo, $valor ){
		//Actualiza el estado de una orden de compra
		$q = "update purchases set status = '$valor' where id = $iddo";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarNotaOrdenCompra( $dbh, $iddo, $valor ){
		//Actualiza la nota de una orden de compra
		$q = "update purchases set note = '$valor' where id = $iddo";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarNotaOrden( $dbh, $nota ){
		// Agrega una nueva nota asociada a una orden de compra
		$q = "insert into purchase_notes ( note, fk_purchase, fk_user, created_at ) 
				values ( '$nota[nota]', $nota[ido], $nota[idu], NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarCantidadItemOC( $dbh, $idord, $id_item, $cant ){
		//Actualiza la nota de una orden de compra
		$q = "update purchase_details set quantity = $cant where id = $id_item and purchase_id = $idord";
		
		return mysqli_query( $dbh, $q );
	}

	/* ----------------------------------------------------------------------------------- */
	// Agregar nueva nota
	if( isset( $_GET["nvanota"] ) ){
		ini_set( 'display_errors', 1 );
		include( "bd.php" );

		$nota["ido"]			= $_POST["idorden"];
		$nota["idu"]			= $_POST["idusuario"];
		$nota["nota"]			= mysqli_real_escape_string( $dbh, $_POST["nota"] );		 

		$idr = agregarNotaOrden( $dbh, $nota );
		
		if( ( $idr != 0 ) && ( $idr != "" ) ){
			header( "Location: ../purchase-data.php?purchase-id=$nota[ido]&nueva_nota-exito" );
		}
		
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor sobre Órdenes de compra */
	/* ----------------------------------------------------------------------------------- */
	
	if( isset( $_POST["guardar_oc"] ) ){
		//Invoca a la creación de nueva orden de compra
		session_start();
		include( "bd.php" );
		include( "../fn/fn-purchase.php" );

		$idpvd 		= $_POST["guardar_oc"];
		$idu 		= $_SESSION["user-adm"]["id"];
		$preorden 	= isset( $_SESSION["preorden"] ) ? $_SESSION["preorden"] : array();
		$items_pvd  = obtenerItemsPorProveedorOC( $idpvd );
		
		if ( ( count( $items_pvd["registros"] ) > 0 ) && $items_pvd["cants_en0"] == false ) {
			//Existen registros del proveedor y no hay cantidades en cero
			
			$orden["id"] 		= registrarOrdenCompra( $dbh, $idpvd, $idu );
			
			if( $orden["id"] != 0 ){
				$n = registrarDetalleOrdenCompra( $dbh, $orden, $preorden, $idpvd );
				if( $n > 0 ){
					eliminarItemsProveedorPreorden( $idpvd );
					$res["exito"] 	= 1;
					$res["mje"] 	= "Orden registrada con éxito";
				}
			}else{
				$res["exito"] 	= -1;
				$res["mje"] 	= "Error al registrar orden";
			}

		}else{
			if ( $items_pvd["cants_en0"] ){
				// Existen ítems con cantidades en cero
				$res["exito"] 	= -2;
				$res["mje"] 	= "Las cantidades en la orden no deben cero";
			}else{
				// no existen ítems del proveedor marcados para orden de compra 
				$res["exito"] 	= -1;
				$res["mje"] 	= "No hay registros para crear orden";
			}
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["act_edo_doc"] ) ){
		//Invoca el cambio de estado de un detalle de una orden de compra
		include( "bd.php" );

		$iddo 		= $_POST["act_edo_doc"];
		$valor 		= $_POST["valor"];
		$idr 		= actualizarEstadoItemOC( $dbh, $iddo, $valor );
		
		if ( ( $idr != 0 ) && ( $idr != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Item de orden de compra actualizado con éxito";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al actualizar ítem de orden de compra";
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["act_st_oc"] ) ){
		//Invoca el cambio de estado de una orden de compra
		include( "bd.php" );

		$iddo 		= $_POST["act_st_oc"];
		$valor 		= $_POST["valor"];
		$idr 		= actualizarEstadoOrdenCompra( $dbh, $iddo, $valor );
		
		if ( ( $idr != 0 ) && ( $idr != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Orden de compra actualizada con éxito";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al actualizar orden de compra";
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["act_nota_oc"] ) ){
		//Invoca el cambio de estado de una orden de compra
		include( "bd.php" );

		$idr 		= actualizarNotaOrdenCompra( $dbh, $_POST["act_nota_oc"], $_POST["valor"] );
		
		if ( ( $idr != 0 ) && ( $idr != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Orden de compra actualizada con éxito";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al actualizar orden de compra";
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["editar_cants"] ) ){
		//Invoca el cambio de estado de una orden de compra
		include( "bd.php" );
		$idordenc = $_POST["ido"];
		$items_oc = json_decode( stripslashes( $_POST["editar_cants"] ) );
		$ok = true;

		foreach( $items_oc as $i ) {
			$item = get_object_vars( $i );
			$ok = actualizarCantidadItemOC( $dbh, $idordenc, $item["iddoc"], $item["cant"] );
		}

		if( $ok ){
			$res["exito"] = 1;
			$res["mje"] = "Orden de compra actualizada con éxito";
		}else{
			$res["exito"] = -1;
			$res["mje"] = "Error al actualizar orden de compra";
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
?>