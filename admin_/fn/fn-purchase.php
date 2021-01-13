<?php 
	/* Argyros - Funciones sobre pre-orden y órdenes de compra */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	define( "PFXLPOFILE", "saved_preorder_u" );

	function agregarItemListaPreorden( $item ){
		//Agrega el item de producto a lista de pre-orden

		$preorden 				= $_SESSION["preorden"];
		$preorden[] 			= $item;
		$_SESSION["preorden"] 	= $preorden;
	}
	/* ----------------------------------------------------------------------------------- */
	function guardarEstadoLista( $preorden ){
		// Devuelve el contenido de carrito de compra con los datos a almacenar en cookie
		$filename 				= PFXLPOFILE.$_SESSION["user-adm"]["id"];

		$json_string 			= json_encode( $preorden );
		$file 					= "saved_preorders/".$filename.".json";
		file_put_contents( $file, $json_string );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaPreOrdenRegistrada(){
		// Devuelve el contenido de carrito de compra con los datos a almacenar en cookie
		$filename 				= PFXLPOFILE.$_SESSION["user-adm"]["id"];

		if( file_exists( "../fn/saved_preorders/".$filename.".json" ) ){
			$filepreorder			= file_get_contents( "../fn/saved_preorders/".$filename.".json" );
			$preorden 				= json_decode( $filepreorder, true );
			$_SESSION["preorden"] 	= $preorden;
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function generarItemListaPreorden( $producto, $detalle, $imagenes, $talla ){
		// Devuelve un arreglo con los datos de un ítem de lista pre-orden
		$item = array();
		$valor_talla = $talla["talla"]." ".$talla["unidad"];
		if( !$detalle["fagotado"] ) $fagotado = $detalle["fcreado"]; else $fagotado = $detalle["fagotado"];

		$item["idp"] 		= $producto["id"];			// id de producto
		$item["idd"] 		= $detalle["id"];			// id de detalle de producto
		$item["idt"] 		= $talla["idtalla"];		// id de talla
		$item["talla"] 		= $valor_talla;				// talla
		$item["peso"] 		= $talla["peso"];			// peso de talla
		$item["nombre"] 	= $producto["nombre"];		// nombre de producto
		$item["imagen"] 	= $imagenes[0]["path"];		// imagen de producto
		$item["agotado"] 	= $fagotado;				// fecha agotado
		$item["idpvd"] 		= $producto["idpvd1"];		// id de proveedor 1 de producto
		$item["codf"] 		= $producto["codigof1"];	// código de fabricante 1 de producto
		$item["cant"] 		= 0;						// cantidad
		$item["nota"] 		= "";						// nota
		$item["en_oc"] 		= true;					// está incluído en orden de compra

		return $item;
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarProductoListaPreorden( $producto, $detalle ){
		//Genera los datos que conforman un item de producto a agregarse a la lista pre-orden
		
		$tallas		= $detalle["tallas"];
		$imagenes	= $detalle["imagenes"];
		$x			= 0; 
		$todos 		= 1;
		$nitems     = count( $tallas );

		foreach ( $tallas as $t ) {
			$item 	= generarItemListaPreorden( $producto, $detalle["datos"], $imagenes, $t );
			if( obtenerPosicionItem( $item["idd"], $item["idt"] ) == -1 ){
				agregarItemListaPreorden( $item ); $x++;
			}
		}
		
		if( $x > 0  && $x < $nitems ) 	$todos = 2;
		if( $x == 0 ) 					$todos = 0;

		return $todos;
	}
	/* ----------------------------------------------------------------------------------- */
	/* Tabla de pre-orden */
	function obtenerColorDisponibilidadTalla( $dbh, $item ){
		$disponibilidad = obtenerDisponibilidadTallaDetallePorIds( $dbh, $item["idd"], $item["idt"] );
		if( $disponibilidad["visible"] == 1 )  $class = "dsp_total"; else $class = "dsp_agotado";

		$html_ta = "<div align='center'>
						<a href='#!' class='badge $class'>".$item[talla]." ".$t['unidad']."</a>
						<span>".$item["peso"]."</span>
					</div>";

		return $html_ta;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaProveedoresPreorden( $dbh, $proveedores, $idpvd, $idd, $idt ){
		// Devuelve la lista de proveedores, con el proveedor del producto preseleccionado
		$lista = "<select class='form-control selec_pvd selectpicker act_preo_d' data-idd='$idd' data-prm='idpvd'>
            		<option disabled>Seleccione</option>";
        foreach ( $proveedores as $p ) {
        	$sel = sop( $p["id"], $idpvd );
            $lista .= "<option $sel class='cambio_pvd' data-trg='".$idp."' value='".$p["id"]."'>$p[numero]</option>";
        }

        $lista .= "</select>";

        return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerIdsDetallesEnPreorden( $preorden ){
		// Devuelve un vector con los ids de los detalles de productos en la lista pre-orden
		$ids_det		= array();
		
		foreach ( $preorden as $i ) {
			if( !in_array( $i["idd"], $ids_det ) ) $ids_det[] = $i["idd"];
		}

		return $ids_det;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerIdsDetallesEnOrdenCompra( $dorden ){
		// Devuelve un vector con los ids de los detalles de productos en una orden de compra
		$ids_det		= array();
		
		foreach ( $dorden as $i ) {
			if( !in_array( $i["idd"], $ids_det ) ) $ids_det[] = $i["idd"];
		}

		return $ids_det;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerItemsPorDetalle( $iddet ){
		// Devuelve un vector con los ítems en la lista pre-orden pertenecientes a un detalle de producto
		$preorden 		= $_SESSION["preorden"];
		$items			= array();

		foreach ( $preorden as $i )
			if( $i["idd"] == $iddet ) $items[] = $i;
		
		return $items;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerItemsPorDetalleOC( $iddet, $detalle_oc ){
		// Devuelve un vector con los ítems en la orden de compra pertenecientes a un detalle de producto
		$items			= array();

		foreach ( $detalle_oc as $i )
			if( $i["idd"] == $iddet ) $items[] = $i;
		
		return $items;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerItemsPorProveedorOC( $idpvd ){
		// Devuelve un vector con los ítems en pre-orden dado un id de detalle y un id de proveedor
		$preorden 		= $_SESSION["preorden"];
		$items			= array();

		foreach ( $preorden as $i )
			if( $i["idpvd"] == $idpvd && $i["en_oc"] ) $items[] = $i;
		
		return $items;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPosicionItem( $idd, $idt ){
		// Devuelve la posición dentro del vector de lista pre-orden de un elemento dado por los ids: idd e idt
		$preorden       = isset( $_SESSION["preorden"] ) ? $_SESSION["preorden"] : array();
		$index 			= -1;
		foreach ( $preorden as $key => $i ) {
			if( $i["idd"] == $idd && $i["idt"] == $idt ){
				$index 	= $key; break;	
			}
		}
		
		return $index;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProveedoresOrdenCompra(){
		// Devuelve la lista pre-orden organizada por proveedores
		$preorden       = isset( $_SESSION["preorden"] ) ? $_SESSION["preorden"] : array();
		$proveedores 	= array();

		foreach ( $preorden as $key => $i ) {
			if ( !in_array( $i["idpvd"], $proveedores ) && $i["en_oc"] ) 
				$proveedores[] = $i["idpvd"];					// Proveedores a generar órdenes
		}

		return $proveedores;
	}
	/* ----------------------------------------------------------------------------------- */
	function incluirItemsGeneracionOrdenes(){
		// Marca todos los ítems de la lista pre-orden para ser incluidos en la generación de órdenes de compra
		$preorden       = isset( $_SESSION["preorden"] ) ? $_SESSION["preorden"] : array();
		
		foreach ( $preorden as $key => $i )
			$_SESSION["preorden"][$key]["en_oc"] = true;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarValorListaPreorden( $campo, $idd, $idt, $valor ){
		// Actualiza un valor de un producto en la lista pre-orden identidicado por $idd y $idt
		$index = obtenerPosicionItem( $idd, $idt );
		$_SESSION["preorden"][$index][$campo] = $valor;
		//print_r($_SESSION["preorden"][$index]);
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarValorListaPreordenDetalle( $campo, $idd, $valor ){
		// Actualiza los valores de un producto en la lista pre-orden pertenecientes al detalle dado por $idd
		$preorden       = isset( $_SESSION["preorden"] ) ? $_SESSION["preorden"] : array();
		
		foreach ( $preorden as $key => $i ) {
			if( $i["idd"] == $idd ){
				$_SESSION["preorden"][$key][$campo]	= $valor;
			}
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarItemListaPreorden( $idd, $idt ){
		// Elimina un ítem de la lista pre-orden identidicado por $idd y $idt
		$index = obtenerPosicionItem( $idd, $idt );
		unset( $_SESSION["preorden"][$index] );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerIconoEstadoOC( $estado, $x ){
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
	function obtenerIndicadorEstadoItemOC( $estado ){
		// Devuelve el estilo a mostrar en el botón de estado de ítem de orden de compra
		$clase = array( 
			"pendiente" 	=> array( "btn-warning", "", "" ),
			"recibido"		=> array( "", "btn-success", "" ),
			"no-recibido"	=> array( "", "", "btn-danger" )
		);

		return $clase[$estado];
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarItemsProveedorPreorden( $idpvd ){
		// Elimina los ítems asociados a un proveedor de la lista pre-orden
		$preorden 		= $_SESSION["preorden"];

		foreach ( $preorden as $key => $i ) {
			if( $i["idpvd"] == $idpvd ) 
				unset( $_SESSION["preorden"][$key] );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTotalesOC( $detalle ){
		// Devuelve la sumatoria de pesos de productos incluidos en la orden de compra
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
	function tieneItemsEnOC( $items ){
		// Devuelve verdadero si al menos un ítem está marcado para ser incluido en una orden de compra
		$items_enoc = false;
		foreach ( $items as $it ) {
			if( $it["en_oc"] == true ) $items_enoc = true;
        }

        return $items_enoc;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerMovimientosProducto( $dbh, $idd ){
		// Devuelve los movimientos de compra y venta de un detalle de pedido
		$regs_oc 		= obtenerOrdenesCompraDetalleProducto( $dbh, $idd );
		$regs_p 		= obtenerPedidosDetalleProducto( $dbh, $idd );
		
		$movimientos 	= array_merge( $regs_oc, $regs_p ); 
		
		return $movimientos;
	}
	
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor sobre Órdenes de compra y lista pre-orden */
	/* ----------------------------------------------------------------------------------- */
	ini_set( 'display_errors', 1 );

	if( isset( $_POST["agregar_prod_preorden"] ) ){
		//Invoca a función de agregar un producto a la lista de pre-orden
		session_start();
		//$_SESSION["preorden"] = array();
		
		include( "../database/bd.php" );
		include( "../database/data-products.php" );
		
		$idd 		= $_POST["agregar_prod_preorden"];
		
		$detalle 	= obtenerDatosDetalleProductoPorId( $dbh, $idd );
		$producto 	= obtenerProductoPorId( $dbh, $detalle["datos"]["idp"] );
		
		$resultado 	= agregarProductoListaPreorden( $producto, $detalle );
		
		if ( $resultado == 1 ){
			$res["exito"] = $resultado;
			$res["mje"] = "Producto agregado a lista pre-orden";
		}
		if ( $resultado == 2 ){
			$res["exito"] = $resultado;
			$res["mje"] = "Se agregaron algunas tallas a la lista";
		}
		if ( $resultado == 0 ){
			$res["exito"] = $resultado;
			$res["mje"] = "Producto ya está incluído en la lista pre-orden";
		}

		guardarEstadoLista( $_SESSION["preorden"] );

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["act_preorden"] ) ){
		//Invoca a función de actualizar un producto de la lista de pre-orden
		session_start();
		
		$objetivo 	= $_POST["act_preorden"];
		$idd 		= $_POST["idd"]; 	$idt 	= $_POST["idt"];
		$valor  	= $_POST["valor"];
		
		if( $objetivo != "eliminar" && $objetivo != "eliminar_oc" ){
			$mensaje = "Lista actualizada";
			if( $idt != "" )	// Actualiza el valor de un item particular (id_detalle, id_talla )
				actualizarValorListaPreorden( $objetivo, $idd, $idt, $valor );	
			else 				// Actualiza el valor todos los ítems asociados al id_detalle
				actualizarValorListaPreordenDetalle( $objetivo, $idd, $valor );
		}
		else{
			$mensaje = "eliminar";
			if( $objetivo == "eliminar")
				eliminarItemListaPreorden( $idd, $idt );
			if( $objetivo == "eliminar_oc")
				actualizarValorListaPreorden( "en_oc", $idd, $idt, false );
		}

		guardarEstadoLista( $_SESSION["preorden"] );

		echo $mensaje;
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["purchase-id"] ) ){
		// Obtención de datos de orden de compra individual: purchase-data.php
        $ido 				= $_GET["purchase-id"];
        $orden 				= obtenerOrdenCompraPorId( $dbh, $ido );

        if( $orden ){
	        $detalle_oc		= obtenerDetalleOrdenCompra( $dbh, $ido );
	        $notas_oc 		= obtenerListaNotasOrden( $dbh, $ido );
	        $totales 		= obtenerTotalesOC( $detalle_oc );
	        $peso_aprox		= number_format( $totales["peso"], 2, '.', '' );
	        $iconoe 		= obtenerIconoEstadoOC( $orden["estado"], "fa-2x" );
    	}
    }
    /* ----------------------------------------------------------------------------------- */
?>