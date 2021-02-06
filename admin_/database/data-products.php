<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de catálogo */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	ini_set( "memory_limit", "128M" );
	
	function obtenerListaProductos( $dbh ){
		//Devuelve la lista de productos en general
		$q = "select p.id, p.code as codigo, p.name as nombre, p.description as descripcion, 
		p.visible as visible, co.name as pais, ca.name as categoria, sc.name as subcategoria, 
		m.name as material FROM products p, categories ca, subcategories sc, countries co, 
		materials m where p.category_id = ca.id and p.subcategory_id = sc.id 
		and p.material_id = m.id and p.country_id = co.id order by p.id DESC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosC_S( $dbh, $idc, $idsc ){
		//Devuelve la lista de productos pertenecientes a una categoría y subcategoría
		$q = "select p.id, p.code, p.name, p.description, p.visible as visible, 
		co.name as pais, ca.name as category, sc.name as subcategory, m.name as material 
		FROM products p, categories ca, subcategories sc, countries co, materials m 
		where p.visible = 1 and p.category_id = ca.id and p.subcategory_id = sc.id and 
		p.category_id = $idc and p.subcategory_id = $idsc order by p.name ASC";
	
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosC_S_Basico( $dbh, $idc, $idsc ){
		//Devuelve la lista de productos pertenecientes a una categoría y subcategoría
		$q = "select p.id, p.code, p.name, p.description, p.visible as visible 
		FROM products p, categories ca, subcategories sc 
		where p.visible = 1 and p.category_id = ca.id and p.subcategory_id = sc.id and 
		p.category_id = $idc and p.subcategory_id = $idsc order by p.name ASC";
	
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;	
	}
	/* ----------------------------------------------------------------------------------- */
	function codigoDisponible( $dbh, $codigo ){
		//Devuelve si un código de producto ya está registrado
		$disp = 1;
		$q = "select * from products where code = '$codigo'";

		$datap = mysqli_query ( $dbh, $q );
		$nrows = mysqli_num_rows( $datap );
		
		if( $nrows > 0 ){
			$disp = 0;
		}
		return $disp;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductoPorId( $dbh, $idp ){
		//Devuelve los datos de un producto dado su id
		$q = "select p.id, p.code as codigo, p.name as nombre, p.description as descripcion, 
		p.category_id as cid, p.subcategory_id as scid, p.visible as visible, 
		co.id as idpais, co.name as pais, ca.name as categoria, sc.name as subcategoria, 
		m.id as idmaterial, m.name as material, p.provider_id1 as idpvd1, p.provider_id2 as idpvd2, 
		p.provider_id3 as idpvd3, p.manfact_code1 as codigof1, p.manfact_code2 as codigof2, p.manfact_code3 as codigof3, 
		date_format(p.created_at,'%d/%m/%Y') as fcreacion 
		FROM products p, categories ca, subcategories sc, countries co, materials m 
		where p.category_id = ca.id and p.subcategory_id = sc.id and p.material_id = m.id 
		and p.country_id = co.id and p.id = $idp";
		
		$data = mysqli_query( $dbh, $q );
		if( $data )
			return mysqli_fetch_array( $data );

	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerLineasDeProductoPorId( $dbh, $idp ){
		//Devuelve los datos de las líneas a las que pertenece un producto
		$q = "select l.id as idlinea, l.name as nombre, l.description as descripcion 
		from plines l, line_product lp where lp.line_id = l.id and lp.product_id = $idp 
		order by nombre ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTrabajosDeProductoPorId( $dbh, $idp ){
		//Devuelve los datos de las líneas a las que pertenece un producto
		$q = "select t.id as idtrabajo, t.name as nombre 
		from makings t, making_product tp where tp.making_id = t.id and tp.product_id = $idp 
		order by nombre ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetalleProductoPorId( $dbh, $idp ){
		//Devuelve los registros detalles asociados a un producto dado su id
		$q = "select dp.id as id, c.name as color, t.name as bano, dp.price_type as tipo_precio, 
		dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, dp.location as ubicacion, 
		dp.disused as en_desuso, dp.reference_id as idref, date_format(dp.disused_at,'%d/%m/%Y') as fdesuso, 
		date_format(dp.repositioned_at,'%d/%m/%Y') as freposicion, dp.weight_price_value as precio_peso 
		FROM product_details dp LEFT JOIN treatments t ON t.id = dp.treatment_id 
		LEFT JOIN colors c ON dp.color_id = c.id WHERE dp.product_id = $idp ORDER BY dp.id DESC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;		
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerRegistroDetalleProductoPorId( $dbh, $idd ){
		//Devuelve un registro de detalle de producto dado id de detalle
		$q = "select dp.id as id, dp.product_id as idp, c.id as color, t.id as bano, 
		dp.price_type as tipo_precio, dp.piece_price_value as precio_pieza, dp.disused as desuso,  
		date_format(dp.created_at,'%d/%m/%Y %h:%i:%s %p') as fcreado,      
		date_format(dp.unavailable_at,'%d/%m/%Y %h:%i:%s %p') as fagotado,
		dp.manufacture_value as precio_mo, dp.product_id as pid, dp.weight_price_value as precio_peso 
		FROM product_details dp LEFT JOIN treatments t ON t.id = dp.treatment_id 
		LEFT JOIN colors c ON dp.color_id = c.id where dp.id = $idd";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );		
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDatosRegistroDetalleProductoPorId( $dbh, $idp, $idd ){
		//Devuelve los datos de un registro de detalle de producto dado id de detalle
		$q = "select dp.id as id, c.name as color, t.name as bano, dp.price_type as tipo_precio, 
		dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, dp.location as ubicacion,  
		date_format(dp.repositioned_at,'%d/%m/%Y') as freposicion, dp.weight_price_value as precio_peso 
		FROM product_details dp LEFT JOIN treatments t ON t.id = dp.treatment_id 
		LEFT JOIN colors c ON dp.color_id = c.id WHERE dp.product_id = $idp and dp.id = $idd";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );		
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductoPorImagen( $dbh, $archivo ){
		$q = "select p.id, p.name as nombre FROM products p, product_details dp, images i
		where p.id = dp.product_id and dp.id = i.product_detail_id and i.path = '$archivo'";

		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function imagenAsignada( $dbh, $archivo ){
		//Devuelve verdadero si el archivo está asignado a un producto
		$asignada = false;
		$data = obtenerProductoPorImagen( $dbh, $archivo );
		$nregs = mysqli_num_rows( $data );
		
		if( $nregs > 0 )
			$asignada = true;
		
		return $asignada;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenesProducto( $dbh, $id ){
		//Devuelve los registros de imágenes de dado el id de producto
		$q = "select i.path as image FROM images i, product_details d 
		where i.product_detail_id = d.id and d.product_id = $id";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenesDetalleProducto( $dbh, $idd, $limite ){
		//Devuelve los registros de imágenes de detalle de producto
		$l = "";
		if( $limite != NULL ) $l = "LIMIT $limite";
		
		$q = "select id, path from images where product_detail_id = $idd $l";
	
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenDetalleProductoPorId( $dbh, $id_img ){
		//Devuelve el registro de imagen de detalle de producto
		$q = "select id, path from images where id = $id_img";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerFechaReposicionDetalle( $dbh, $idd ){
		//Devuelve los registros detalles asociados a un producto dado su id
		$q = "select date_format(repositioned_at,'%d/%m/%Y') as freposicion FROM product_details WHERE id = $idd";
		
		$data = mysqli_fetch_array( mysqli_query( $dbh, $q ) );
		return $data["freposicion"];
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTallasDetalleProducto( $dbh, $idd ){
		//Devuelve los registros de tallas de detalle de producto
		$q = "select spd.size_id as idtalla, convert(s.name, decimal(4,2)) as vsize, 
		spd.product_detail_id as iddetprod, s.name as talla, s.unit as unidad, 
		spd.weight as peso, spd.visible as visible, spd.adjustable as ajustable 
		from size_product_detail spd, sizes s where spd.size_id = s.id 
		and spd.product_detail_id = $idd order by vsize ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDisponibilidadTallaDetallePorIds( $dbh, $idd, $idt ){
		//Devuelve la disponibilidad de una talla de detalle de producto
		$q = "select visible from size_product_detail where size_id = $idt and product_detail_id = $idd";
		
		return mysqli_fetch_array( mysqli_query( $dbh, $q ) );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDatosDetalleProductoPorId( $dbh, $idd ){
		//Devuelve los datos de un detalle de producto dado su id
		$detalle["datos"]		= obtenerRegistroDetalleProductoPorId( $dbh, $idd );
		$detalle["tallas"] 		= obtenerTallasDetalleProducto( $dbh, $idd );
		$detalle["imagenes"] 	= obtenerImagenesDetalleProducto( $dbh, $idd, "" );

		return $detalle;
	}
	/* ----------------------------------------------------------------------------------- */
	function asociarLineaProducto( $dbh, $idl, $idp ){
		//Registra la asignación de una línea a un producto
		$q = "insert into line_product ( line_id, product_id ) values ( $idl, $idp )";
		$data = mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function asociarTrabajoProducto( $dbh, $idt, $idp ){
		//Registra la asignación de un trabajo a un producto
		$q = "insert into making_product ( making_id, product_id ) values ( $idt, $idp )";
		$data = mysqli_query( $dbh, $q );

	}
	/* ----------------------------------------------------------------------------------- */
	function agregarProducto( $dbh, $producto ){
		//Guarda el registro de un producto
		$idprv1 = $producto[proveedor1]; if( !$producto[proveedor1] ) $idprv1 = 'NULL';
		$idprv2 = $producto[proveedor2]; if( !$producto[proveedor2] ) $idprv2 = 'NULL';
		$idprv3 = $producto[proveedor3]; if( !$producto[proveedor3] ) $idprv3 = 'NULL';
		
		$q = "insert into products ( code, name, description, country_id, category_id, 
		subcategory_id, material_id, provider_id1, provider_id2, provider_id3, manfact_code1, 
		manfact_code2, manfact_code3, created_at ) values ( '$producto[codigo]', '$producto[nombre]', 
		'$producto[descripcion]', $producto[pais], $producto[categoria], $producto[subcategoria], 
		$producto[material], $idprv1, $idprv2, $idprv3, 
		'$producto[codigof1]', '$producto[codigof2]', '$producto[codigof3]', NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarDetalleProducto( $dbh, $detalle ){
		//Guarda el registro de detalle de un producto
		$q = "insert into product_details ( product_id, location, color_id, treatment_id, price_type, 
		piece_price_value, manufacture_value, weight_price_value, created_at, repositioned_at ) 
		values ( $detalle[idproducto], '$detalle[ubicacion]', $detalle[color], $detalle[bano], '$detalle[tprecio]', 
		$detalle[valor_pieza], $detalle[valor_mano_obra], $detalle[valor_gramo], NOW(), NOW())";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function editarProducto( $dbh, $producto ){
		//Actualiza los datos de producto
		$q = "update products set code = '$producto[codigo]', name = '$producto[nombre]', 
		description = '$producto[descripcion]', country_id = '$producto[pais]', 
		category_id = $producto[categoria], subcategory_id = $producto[subcategoria], 
		material_id = $producto[material], provider_id1 = $producto[proveedor1], 
		provider_id2 = $producto[proveedor2], provider_id3 = $producto[proveedor3], 
		manfact_code1 = '$producto[codigof1]', manfact_code2 = '$producto[codigof2]', 
		manfact_code3 = '$producto[codigof3]', updated_at = NOW() where id = $producto[idproducto]";
		
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function editarDatosDetalleProducto( $dbh, $detalle ){
		//Actualiza los datos de detalle de producto
		$q = "update product_details set color_id = $detalle[color], 
		treatment_id = $detalle[bano], price_type = '$detalle[tprecio]', 
		piece_price_value = $detalle[valor_pieza], manufacture_value = $detalle[valor_mano_obra], 
		weight_price_value = $detalle[valor_gramo], updated_at = NOW() 
		where id = $detalle[iddetalle]";
		
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarRegistrosTrabajosProductos( $dbh, $idp ){
		//Elimina todos los registros de trabajos asociados a un producto.
		$q = "delete from making_product where product_id = $idp";
		$data = mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarRegistrosLineasProductos( $dbh, $idp ){
		//Elimina todos los registros de líneas asociadas a un producto.
		$q = "delete from line_product where product_id = $idp";
		$data = mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarAsociacionesTrabajosLineas( $dbh, $producto ){
		//Elimina todos los registros de líneas y trabajos asociadas a un producto
		eliminarRegistrosTrabajosProductos( $dbh, $producto["idproducto"] );
		eliminarRegistrosLineasProductos( $dbh, $producto["idproducto"] );
	}
	/* ----------------------------------------------------------------------------------- */
	function existeRegistroTallaDetalle( $dbh, $iddet, $id_talla ){
		//Chequea si existe un registro con valores de talla-detalle
		$existe = false;
		$q = "select * from size_product_detail where size_id = $id_talla 
		and product_detail_id = $iddet";
		$data = mysqli_query( $dbh, $q );
		$nregs = mysqli_num_rows( $data );
		
		if( $nregs > 0 )
			$existe = true;
		
		return $existe;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTallasEliminar( $dbh, $tallas_selec, $iddet ){
		//Devuelve la lista de tallas que se van a eliminar de un detalle de producto
		//Compara las tallas existentes con la selección de tallas a modificar, las tallas 
		//que no estén seleccionadas serán eliminadas

		$tallas_elim = array();

		$tallas_regs = obtenerTallasDetalleProducto( $dbh, $iddet );
		foreach ( $tallas_regs as $texist ) {
			$contenida = false;
			foreach ( $tallas_selec as $sel ) {
				if( $sel->idt == $texist["idtalla"] ){ 
					$contenida = true;	
				}
			}
			if( $contenida == false )
				$tallas_elim[] = $texist;
		}

		return $tallas_elim;
	}
	/* ----------------------------------------------------------------------------------- */
	function editarTallasDetalleProducto( $dbh, $iddet, $tallas, $tajustable ){
		//Actualiza los datos de tallas en detalle de producto

		foreach ( $tallas as  $reg ) {
			$e = existeRegistroTallaDetalle( $dbh, $iddet, $reg->idt );
			if( $e == true ){
				actualizarTallasDetalleProducto( $dbh, $iddet, $reg->idt, $reg->peso, $tajustable );
			} else {
				guardarTallaDetalleProducto( $dbh, $iddet, $reg->idt, $reg->peso, $tajustable );
			}
		}

		$tallas_elim = obtenerTallasEliminar( $dbh, $tallas, $iddet );

		if( count( $tallas_elim ) > 0 ){
			$res["exito"] = 2;
			$res["tallas_e"] = $tallas_elim;
		}else{
			$res["exito"] = 1;
			$res["tallas_e"] = NULL;
		}

		return $res;
	}
	/* ----------------------------------------------------------------------------------- */
	function registrosAsociadosTallaDetalle( $dbh, $iddet, $idtalla ){
		//Determina si existe un registro de alguna tabla asociada a una talla de detalle producto
		//Tablas relacionadas: order_details
		include( "data-system.php" );

		return registroAsociadoTabla2P( $dbh, "order_details", "product_detail_id", $iddet, 
															   "size_id", $idtalla );
	} 
	/* ----------------------------------------------------------------------------------- */
	function eliminarTallaDetalleProducto( $dbh, $iddet, $idtalla ){
		//Elimina el registro de talla de un detalle de producto
		$q = "delete from size_product_detail where product_detail_id = $iddet and size_id = $idtalla";
		$data = mysqli_query( $dbh, $q );

		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarRegistrosTallasDetalleProducto( $dbh, $iddet, $tallas_elim ){
		//Evalúa la eliminación de una talla de un detalle de producto
		$talladet_asoc = "";
		$asociada = false;
		$res_e["exito"] = 1;

		foreach ( $tallas_elim as $talla ){
			if( registrosAsociadosTallaDetalle( $dbh, $iddet, $talla["idtalla"] ) == true ){
				$asociada = true;
				$talladet_asoc .= $talla["talla"]." ";
			}else
				eliminarTallaDetalleProducto( $dbh, $iddet, $talla["idtalla"] );
		}
		if( $asociada == true ){
			$res_e["exito"] = -2;
			$res_e["t_asoc"] = $talladet_asoc;
		}

		return $res_e;
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarRegistroImagenDetalleProducto( $dbh, $id_img ){
		//Elimina el registro de imagen de detalle de producto en la BD
		$q = "delete from images where id = $id_img";
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarImagenDetalleProducto( $dbh, $id_img ){
		//Elimina el archivo de imagen de detalle de producto e invoca la eliminación de la BD. 
		$prefijo_url = "../"; 
		$img = obtenerImagenDetalleProductoPorId( $dbh, $id_img );
		$res["archivo"] = unlink( $prefijo_url.$img["path"] );
		$res["databas"] = eliminarRegistroImagenDetalleProducto( $dbh, $img["id"] );
		
	}
	/* ----------------------------------------------------------------------------------- */
	function guardarTallaDetalleProducto( $dbh, $idd, $idtalla, $peso, $tajustable ){
		//Guarda el registro de tallas y pesos de un detalle de producto
		$q = "insert into size_product_detail ( weight, size_id, adjustable, product_detail_id ) 
			   values ( $peso, $idtalla, $tajustable, $idd )";
		
		$data = mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarTallasDetalleProducto( $dbh, $iddet, $idtalla, $peso, $tajustable ){
		//Actualiza el valor talla-peso de un detalle de producto
		$q = "update size_product_detail set weight = $peso, adjustable = $tajustable 
				where size_id = $idtalla and product_detail_id = $iddet";
		
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarVisibilidadProducto( $dbh, $id, $act ){
		//Actualiza la visibilidad de un producto
		$q = "update products set visible = $act where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarTallasDetalleProducto( $dbh, $idd, $tallas, $tajustable ){
		//Procesa los datos de tallas-peso del detalle de producto para almacenar en la BD
		foreach ( $tallas as $reg ) {
			guardarTallaDetalleProducto( $dbh, $idd, $reg->idt, $reg->peso, $tajustable );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarImagenDetalleProducto( $dbh, $idd, $image ){
		//Guarda el registro de una imagen asociada a un detalle de un producto dado por idd
		$q = "insert into images ( path, image_path_300x300, thumb_path_50x50, product_detail_id, created_at ) values ( '$image', '', '', $idd, NOW() )";

		$data = mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarAsociacionesTrabajosLineas( $dbh, $producto ){
		
		//Asociar producto-líneas:
		$lineas = $producto["linea"];
		foreach ( $lineas as $idl ) {
			asociarLineaProducto( $dbh, $idl, $producto["idproducto"] );
		}
		//Asociar producto-trabajos:
		$trabajos = $producto["trabajo"];
		foreach ( $trabajos as $idt ) {
			asociarTrabajoProducto( $dbh, $idt, $producto["idproducto"] );
		}

	}
	/* ----------------------------------------------------------------------------------- */
	function moverArchivoImagenProducto( $archivo, $nombre ){
		//Mueve los archivos de imágenes de la carpeta de carga a la carpeta de catálogo 
		$destino = "../catalog/".$nombre;
		rename( $archivo, $destino );
	}
	/* ----------------------------------------------------------------------------------- */
	function guardarImagenesDetalleProducto( $dbh, $idd, $img ){
		//Reubica el archivo de la imagen desde la carpeta de cargas a la carpeta destino
		//Envía la url destino a registrarse en la BD.
		$prefijo_destino = "catalog/";
		$nombre = explode( '../uploads/', $img );
		moverArchivoImagenProducto( $img, $nombre[1] );
		$url = $prefijo_destino.$nombre[1];
		agregarImagenDetalleProducto( $dbh, $idd, $url );

	}
	/* ----------------------------------------------------------------------------------- */
	function procesarImagenes( $dbh, $idd, $data ){
		//
		$imagenes = $data["urlimgs"];
		foreach ( $imagenes as $img ){
			guardarImagenesDetalleProducto( $dbh, $idd, $img );	
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function uploadPictures( $dbh, $images, $idu ){
		//Guarda los archivos de imágenes de detalle de producto y almacena urls en la BD
		$success = null;
		$paths = array();
		$html_markups = array();
		$filenames = $images['name'];
		$url_dest = "../uploads/";			//Ubicación del archivo destino después de la carga
		$url_dest_show = "uploads/";		//Ubicación de foto de previsualización después de la carga

		$html_img = "<img src='{url}' class='file-preview-image nouploaded' alt='Desert' title='Desert'>";
		
		for( $i = 0; $i < count( $filenames ); $i++ ){
			$data_ext = explode( '.', basename( $filenames[$i] ) );
			$ext = array_pop( $data_ext ); $fname = array_pop( $data_ext );
			$md5 =  md5( uniqid() );
			$target = $url_dest . $fname.$md5 . "." . $ext;
			$target_show = $url_dest_show . $fname.$md5 . "." . $ext;

			/*echo "ARA: ".move_uploaded_file( $images['tmp_name'][$i], $target );
			echo "CRA";*/
			if( move_uploaded_file( $images['tmp_name'][$i], $target ) ) {
				$success = true;
				$paths[] = $target;
				$html_markups[] = "<img src='".$target_show."' class='file-preview-image fpiup' alt='".
									$filenames[$i]."' title='Desert' data-uimg='".$target."' 
									data-check='server'>";
			} else {
				$success = false;
				break;
			}
		}
		//guardarImagenesProductos( $dbh, $idd, $paths );
		$info["paths"] = $paths;
		$info["html_markups"] = $html_markups;
		return $info;	
	}
	/* ----------------------------------------------------------------------------------- */
	function tieneTallasDisponiblesProducto( $dbh, $idp ){
		//Devuelve verdadero si hay registros de tallas disponibles en todos los detalles de un producto
		$disponible = false;

		$detalle = obtenerDetalleProductoPorId( $dbh, $idp );
		foreach ( $detalle as $reg_det ) {
			$tallas_det = obtenerTallasDetalleProducto( $dbh, $reg_det["id"] );
			foreach ( $tallas_det as $t ) {
				if( $t["visible"] == 1 ) $disponible = true;
			}
		}
		return $disponible;
	}
	/* ----------------------------------------------------------------------------------- */
	function tieneTallasDisponiblesDetalleProducto( $dbh, $tallas_det ){
		//Devuelve verdadero si hay registros de tallas disponibles en un detalle de un producto
		$disponible = false;

		foreach ( $tallas_det as $t ) {
			if( $t["visible"] == 1 ) $disponible = true;
		}
		return $disponible;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarDisponibilidadProductoPorAjuste( $dbh, $idp ){
		//Chequea si todas las tallas de un producto están disponibles, marca como no diponible
		//si no hay alguna talla disponible.
		
		if( tieneTallasDisponiblesProducto( $dbh, $idp ) == false ){
			actualizarVisibilidadProducto( $dbh, $idp, 0 );
		}else{
			actualizarVisibilidadProducto( $dbh, $idp, 1 );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarDisponibilidadTallaProducto( $dbh, $iddetprod, $idtalla, $estado ){
		//Actualiza el valor talla-peso de un detalle de producto
		$q = "update size_product_detail set visible = $estado where size_id = $idtalla and 
		product_detail_id = $iddetprod";
		
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarFechaNoDisponibilidad( $dbh, $iddetprod ){
		// Actualiza la fecha de un producto al NO estar disponible
		$q = "update product_details set unavailable_at = NOW() where id = $iddetprod";
		
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarFechaReposicion( $dbh, $iddet ){
		// Actualiza la fecha de reposición de un detalle de producto
		$q = "update product_details set repositioned_at = NOW() where id = $iddet";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarUbicacionDetalle( $dbh, $iddet, $ubicacion ){
		// Actualiza la ubicación de un detalle de producto
		$q = "update product_details set location = '$ubicacion' where id = $iddet";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarBañoDetalleProducto( $dbh, $idd, $valor ){
		//Actualiza el valor de un baño de detalle de producto
		$q = "update product_details set treatment_id = $valor where id = $idd";
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerIdsDetalleProductoPorId( $dbh, $idp ){
		$q = "select p.id as p_id, dp.id as d_id, p.name as nombre FROM product_details dp, products p 
		WHERE dp.product_id = p.id and dp.product_id = $idp ORDER BY p.id DESC LIMIT 1";
		
		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerHtmlImagenDetalleProducto( $dbh, $idd ){
		// Devuelve la primera imagen del detalle de producto.
		$images 	= obtenerImagenesDetalleProducto( $dbh, $idd, "" );
		
		$url_img	= $images[0]["path"];
		$html_img 	= "<div class='wrng_prods'>
						<div><a href='#!' class='pop-img-p' data-toggle='modal' 
						data-src='".$url_img."' data-target='#img-product-pop'>
						<img src='".$url_img."' width='60px'></a></div>";

		return $html_img;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosPorCodigoFabricante( $dbh, $codigof, $idp ){
		// Devuelve la lista de productos dado un código de fabricante 
		$param 		= "";
		if( $idp != NULL ) $param = "and p.id <> $idp";
		
		$q = "select p.id as p_id, dp.id as d_id, p.name as nombre from product_details dp, products p 
				where dp.product_id = p.id and 
				(manfact_code1 = '$codigof' or manfact_code2 = '$codigof' or manfact_code3 = '$codigof') 
				$param order by p.id desc LIMIT 1";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* ----------------------------------------------------------------------------------- */
	function productosCodigosFabricantesRepetidos( $dbh, $codigos, $idp ){
		// Devuelve los productos que ya tienen asignado un código de fabricante
		$detalles 			= array();
		
		foreach ( $codigos as $cod ){
			if( $cod != "" )
				$productos 			= obtenerProductosPorCodigoFabricante( $dbh, $cod, $idp );
		}
		
		$html 				= "";

		foreach ( $productos as $r ){
			$lnk_dp 		= "product-data.php?p=$r[p_id]#$r[d_id]";
			$html			.= obtenerHtmlImagenDetalleProducto( $dbh, $r["d_id"] );		
			$html 			.= "<div>
									<a href='".$lnk_dp."' target='_blank'>#".$r["p_id"]."-".$r["d_id"]."</a>
								</div></div>";
		}

		$resultado["cant"] = count( $productos );
		$resultado["regs"] = $html;

		return $resultado;
	}
	/* ----------------------------------------------------------------------------------- */
	function codigoFabricanteDisponible( $dbh, $valor, $idp ){
		//Actualiza el valor de un baño de detalle de producto
		$disponible 	= true;
		$param 			= "";

		if( $valor != "" ){
			
			if( $idp != NULL ) $param = "and id <> $idp";
			$q = "select id from products 
					where (manfact_code1 = '$valor' or manfact_code2 = '$valor' or manfact_code3 = '$valor') $param";
			
			$nrows = mysqli_num_rows( mysqli_query( $dbh, $q ) );

			if( $nrows > 0 ) $disponible = false;
		}

		return $disponible;
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarBañoRegistrosProducto( $dbh, $idproducto ){
		//Anula los valores de baño asociado a todos los detalles de un producto
		$detalle = obtenerDetalleProductoPorId( $dbh, $idproducto );
		foreach ( $detalle as $r ) {
			actualizarBañoDetalleProducto( $dbh, $r["id"], "NULL" );	
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function ajusteRegistroBanos( $dbh, $producto ){
		//Elimina los registros de baños si hay un cambio de material al editar producto
		$cambio = 0;
		if( $producto["material"] != $producto["idmat_actual"] ){
			$cambio = 1;
			eliminarBañoRegistrosProducto( $dbh, $producto["idproducto"] );
		}
		return $cambio;
	}
	/* ----------------------------------------------------------------------------------- */
	function codigosProductoValidos( $dbh, $data, $idp ){
		// Devuelve falso si los códigos de fabricantes ya están asociados a otro producto.
		$valido 			= true;
		$asignados 			= "";

		for ( $i = 1;  $i  <= 3 ;  $i++ ) { 
			if( !codigoFabricanteDisponible( $dbh, $data["codigof$i"], $idp ) ){
				$valido = false;
				$asignados .= $data["codigof$i"].", ";
			}
		}

		$validez["mensaje"] = "Códigos de fabricante ya asignados: ".substr( $asignados, 0, -2 );
		$validez["valido"] 	= $valido;
		
		return $validez;
	}
	/* ----------------------------------------------------------------------------------- */
	function asignarValorProveedores( $producto ){
		//Ajusta el valor de proveedores si no están asignados

		if( !$producto[proveedor1] ) $producto[proveedor1] = 'NULL';
		if( !$producto[proveedor2] ) $producto[proveedor2] = 'NULL';
		if( !$producto[proveedor3] ) $producto[proveedor3] = 'NULL';

		return $producto;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerIdsDetalleSubcategoria( $dbh, $iddet, $idctg, $idactual ){
		// Devuelve los ids de detalle de productos pertenecientes a una subcategoría
		$q = "select dp.id as iddet from product_details dp, products p, categories c, subcategories sc 
				where dp.product_id = p.id and p.category_id = c.id and p.subcategory_id = sc.id 
				and sc.category_id = c.id and p.category_id=c.id and sc.id = $idctg 
				and dp.id <> $idactual and dp.disused is null and dp.id like '$iddet%'";
		
		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDatosVistaPrevia( $dbh, $iddet_ref ){
		// Devuelve los datos de la vista previa de una referencia de detalle de producto.
		$q = "select dp.id as id, dp.product_id as idp, i.path as image 
				from product_details dp, images i where i.product_detail_id = dp.id and dp.id = $iddet_ref";
		
		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* ----------------------------------------------------------------------------------- */
	function asignarDetalleProductoDesuso( $dbh, $valor, $id_desuso, $id_detref ){
		// Asigna un detalle de producto en desuso, registra una referencia si es indicada

		if( $id_detref == "" ) $id_detref = 'NULL';
		if( $valor == "false" ) { $valor = 'NULL'; $fecha_dsu = 'NULL'; } 
		else { $valor = true; $fecha_dsu = 'NOW()'; };

		$q = "update product_details set disused = $valor, reference_id = $id_detref, 
				disused_at = $fecha_dsu where id = $id_desuso";
		
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function validarReferenciaProductoDesuso( $dbh, $desuso, $id_org, $id_ref ){
		// Devuelve la validez para asignar un producto en desuso, evaluando su referencia
		$valido = true; $mje = "";
		
		if( $desuso == 'true' && $id_ref != "" ){ 
			// Se debe analizar la referencia del producto en desuso
			$registro 		= obtenerRegistroDetalleProductoPorId( $dbh, $id_ref );
			
			if( $registro ){
				if( $registro["desuso"] ){
					$valido 	= false; 
					$mje 		= "La referencia no debe ser otro producto en desuso";
				}
			} 
			else { 
				$valido 	= false; 
				$mje 		= "No existe producto de referencia";
			}
		}

		$validez["val"] = $valido;
		$validez["mje"] = $mje;

		return $validez;
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Productos */
	/* ----------------------------------------------------------------------------------- */
	
	if( isset( $_POST["chcodigo"] ) ){
		include( "bd.php" );
		$r = codigoDisponible( $dbh, $_POST["chcodigo"] );
		echo $r;
	}
	
	/* ----------------------------------------------------------------------------------- */
	
	if( isset( $_POST["activar_prod"] ) ){
		include( "bd.php" );
		$visible = $_POST["visible"];
		$id = $_POST["activar_prod"];
		if( $visible == 1 ) $act = 0; else $act = 1;

		$idp = actualizarVisibilidadProducto( $dbh, $id, $act );

		if( ( $idp != 0 ) && ( $idp != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Producto actualizado";
			$res["reg"] = $idp;
			$res["sta"] = $act;
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al actualizar producto";
			$res["reg"] = NULL;
		}

		echo json_encode( $res );

	}

	/* ----------------------------------------------------------------------------------- */
	
	//Registro de nuevo producto
	if( isset( $_POST["form_np"] ) ){
		include( "bd.php" );	
		parse_str( $_POST["form_np"], $producto );

		$producto 		= escaparCampos( $dbh, $producto );
		//$val_codigos 	= codigosProductoValidos( $dbh, $producto, NULL );
		
		//if( $val_codigos["valido"] ){
			$idp = agregarProducto( $dbh, $producto );
			$producto["idproducto"] = $idp;
			
			registrarAsociacionesTrabajosLineas( $dbh, $producto );

			if( ( $idp != 0 ) && ( $idp != "" ) ){
				$res["exito"] 	= 1;
				$res["mje"] 	= "Registro exitoso";
				$res["reg"] 	= $producto;
			} else {
				$res["exito"] 	= 0;
				$res["mje"] 	= "Error al registrar producto";
				$res["reg"] 	= NULL;
			}

		/*}else {
			$res["exito"] 		= 0;
			$res["mje"] 		= $val_codigos["mensaje"];
			$res["reg"] 		= NULL;
		}*/

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	//Edición de datos de producto
	if( isset( $_POST["form_mp"] ) ){
		include( "bd.php" );	
		
		parse_str( $_POST["form_mp"], $producto );
		$producto 		= escaparCampos( $dbh, $producto );
		$producto 		= asignarValorProveedores( $producto );
		//$val_codigos 	= codigosProductoValidos( $dbh, $producto, $producto["idproducto"] );
		
		//if( $val_codigos["valido"] ){

			$r = editarProducto( $dbh, $producto );
			
			$cambio_mat = ajusteRegistroBanos( $dbh, $producto );
			eliminarAsociacionesTrabajosLineas( $dbh, $producto );
			registrarAsociacionesTrabajosLineas( $dbh, $producto );
			$producto["id"] = $producto["idproducto"];

			if( ( $r != 0 ) && ( $r != "" ) ) {
				if( $cambio_mat != 1 ){
					$res["exito"] = 1;
					$res["mje"] = "Datos de productos actualizados";
					$res["reg"] = $producto;
				}else{
					$res["exito"] = 2;
					$res["mje"] = "Datos de productos actualizados. Debe reasignar valores de baños en los detalles de producto";
					$res["reg"] = $producto;
				}
			} else {
				$res["exito"] = 0;
				$res["mje"] = "Error al modificar producto";
				$res["reg"] = NULL;
			}
		/*}else {
			$res["exito"] 		= 0;
			$res["mje"] 		= $val_codigos["mensaje"];
			$res["reg"] 		= NULL;
		}*/

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	//Registro de nuevo detalle de producto
	if( isset( $_POST["form_ndetp"] ) ){
		include( "bd.php" );	

		$tajustable = 0;
		parse_str( $_POST["form_ndetp"], $detalle );
		$detalle 	= escaparCampos( $dbh, $detalle );
		$tallas 	= json_decode( $_POST["vtallas"] );

		if( isset( $detalle["talla-ajustable"] ) ) $tajustable = 1;
		
		$idd = agregarDetalleProducto( $dbh, $detalle );
		registrarTallasDetalleProducto( $dbh, $idd, $tallas, $tajustable );
		
		if( isset( $detalle["urlimgs"] ) )
			procesarImagenes( $dbh, $idd, $detalle );

		if( ( $idd != 0 ) && ( $idd != "" ) ) {
			$res["exito"] = 1;
			$res["mje"] = "Registro exitoso";
			$res["reg"] = $detalle;
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al registrar detalle de producto";
			$res["reg"] = NULL;
		}
		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	//Edición de datos de detalle de producto
	if( isset( $_POST["form_modif_detprod"] ) ){

		include( "bd.php" );	
		parse_str( $_POST["form_modif_detprod"], $detalle );

		$idd = editarDatosDetalleProducto( $dbh, $detalle );

		if ( ( $idd != 0 ) && ( $idd != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Datos de producto actualizados con éxito";
			$res["reg"] = $detalle;
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al actualizar producto";
			$res["reg"] = $detalle;
		}

		echo json_encode( $res );

	}
	/* ----------------------------------------------------------------------------------- */
	//Edición de tallas en detalle de producto
	if( isset( $_POST["modif_tallasdetprod"] ) ){
		include( "bd.php" );	
		ini_set( 'display_errors', 1 );

		$iddet = $_POST["idt"];
		$tajustable = 0;
		parse_str( $_POST["frm_tallas"], $frm_tallas );
		if( isset( $frm_tallas["talla-ajustable"] ) ) $tajustable = 1;

		$tallas = json_decode( $_POST["modif_tallasdetprod"] );
		$data_r = editarTallasDetalleProducto( $dbh, $iddet, $tallas, $tajustable );
		
		if( $data_r["exito"] == 1 ){
			$res["exito"] = 1;
			$res["mje"] = "Datos de tallas actualizados con éxito";
		}
		if( $data_r["exito"] == 2 ){
			$tallas_elim = $data_r["tallas_e"];
			$data_e = eliminarRegistrosTallasDetalleProducto( $dbh, $iddet, $tallas_elim );
			if( $data_e["exito"] == 1 ){
				$res["exito"] = 1;
				$res["mje"] = "Datos de tallas actualizados con éxito";
			}
			if( $data_e["exito"] == -2 ){
				$res["exito"] = $data_e["exito"];
				$res["mje"] = "Existen tallas asociadas a pedidos: ".$data_e["t_asoc"];
			}
		}

		echo json_encode( $res );

	}
	/* ----------------------------------------------------------------------------------- */
	//Eliminación de imagen de detalle de producto
	if( isset( $_POST["elim_imgdetprod"] ) ){
		include( "bd.php" );	
		
		$id_img = $_POST["elim_imgdetprod"];
		$res = eliminarImagenDetalleProducto( $dbh, $id_img );

		if ( ( $res != 0 ) && ( $res != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Foto eliminada con éxito";
			$res["reg"] = NULL;
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al borrar foto";
			$res["reg"] = NULL;
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	//Agregar nuevas imágenes de detalle de producto ya existente
	if( isset( $_POST["form_nimgsdetp"] ) ){
		include( "bd.php" );	
		parse_str( $_POST["form_nimgsdetp"], $detalle );
		$idd = $_POST["idt"];
		
		procesarImagenes( $dbh, $idd, $detalle );
	}
	/* ----------------------------------------------------------------------------------- */
	//Ajuste de disponibilidad de producto dado el nivel 
	if( isset( $_POST["ajuste_disp"] ) ){ 
		//invoca: fn-product.js (actualizarDisponibilidadProducto)
		include( "bd.php" );

		$iddet 		= $_POST["id_dp"];				// Id detalle de producto
		$idta 		= $_POST["id_dettalla"];		// Id de talla
		$stat 		= $_POST["status"];				// Valor disponibilidad 1:disponible; 0: No disponible
		
		$detalle_p 	= obtenerRegistroDetalleProductoPorId( $dbh, $_POST["id_dp"] );

		if( $_POST["ajuste_disp"] == "talla" ){
			$idr 	= actualizarDisponibilidadTallaProducto( $dbh, $iddet, $idta, $stat );
			if( $stat == 0 )
				actualizarFechaNoDisponibilidad( $dbh, $iddet );
			actualizarDisponibilidadProductoPorAjuste( $dbh, $detalle_p["idp"] );
		}

		if ( ( $idr != 0 ) && ( $idr != "" ) ){
			$res["exito"] 	= 1;
			$res["mje"] 	= "Disponibilidad actualizada";
			$res["reg"] 	= NULL;
		} else {
			$res["exito"] 	= 0;
			$res["mje"] 	= "Error al actualizar producto";
			$res["reg"] 	= NULL;
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["file_sending"] ) ){
		//Maneja los datos de las imágenes recibidas para detalle de productos
		
		include( "bd.php" );
		if ( empty( $_FILES['images'] ) ) {
			$output = array('error' => 'No hay imágenes para cargar');
			echo json_encode( $output );
		} else {
			$images = $_FILES['images'];
			$info = uploadPictures( $dbh, $images, $_POST['id_producto'] );
			$output = array('initialPreview' => $info["html_markups"] );
			echo json_encode( $output );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["tallas_cat"] ) ){
		//Solicita las tallas de una categoría: reporte de imágenes de catálogo
		
		include( "bd.php" );
		include( "data-sizes.php" );

		$tallas = obtenerListaTallasCategoria( $dbh, $_POST["tallas_cat"] );
		//$talla0 = obtenerValoresTallaCero( $dbh );
		//$talla0["name"] = "Ajustable/Única";
		//array_unshift( $tallas, $talla0 );
		
		echo json_encode( $tallas );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["freposicion"] ) ){
		//Solicita la actualización de fecha de reposición
		
		include( "bd.php" );

		$iddet 		= $_POST["freposicion"];				// Id detalle de producto
		$idr 		= actualizarFechaReposicion( $dbh, $iddet );
		
		if ( ( $idr != 0 ) && ( $idr != "" ) ){
			$res["exito"] 	= 1;
			$res["mje"] 	= "Producto actualizado";
			$res["fecha"] 	= obtenerFechaReposicionDetalle( $dbh, $iddet );
		} else {
			$res["exito"] 	= 0;
			$res["mje"] 	= "Error al actualizar producto";
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["ubicacion"] ) ){
		//Solicita la actualización de ubicación
		
		include( "bd.php" );

		$ubicacion 		= $_POST["ubicacion"];				// Id detalle de producto
		$iddet 			= $_POST["id"];
		$idr 			= actualizarUbicacionDetalle( $dbh, $iddet, $ubicacion );
		
		if ( ( $idr != 0 ) && ( $idr != "" ) ){
			$res["exito"] 	= 1;
			$res["mje"] 	= "Ubicación de producto actualizada";
		} else {
			$res["exito"] 	= 0;
			$res["mje"] 	= "Error al actualizar producto";
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["chck_codf"] ) ){
		//Solicita la verificación de códigos de fabricantes repetidos
		
		include( "bd.php" );
		$idp = $_POST["chck_codf"] != "" ? $_POST["chck_codf"] : NULL;

		$codigos[0] = $_POST["cod1"];
		$codigos[1] = $_POST["cod2"];
		$codigos[2] = $_POST["cod3"];
		
		$productos = productosCodigosFabricantesRepetidos( $dbh, $codigos, $idp );
		echo json_encode( $productos );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["term"] ) ){
		//Solicita los ids de detalles de productos para autocompletar referencias de otro producto
		
		include( "bd.php" );
		$lista = obtenerIdsDetalleSubcategoria( $dbh, $_GET["term"], $_GET["cat"], $_GET["idactual"] );
		
		foreach( $lista as $r ) {
		   $temp_array = array();
		   $temp_array['value'] = $r["iddet"];
		   $temp_array['label'] = $r["iddet"];
		   $output[] = $temp_array;
		}

		echo json_encode( $output );

	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["prevw_iddet_ref"] ) ){
		//Devuelve los datos para vista previa de referencias de detalle de producto
		
		include( "bd.php" );
		$datos = obtenerDatosVistaPrevia( $dbh, $_POST["prevw_iddet_ref"] );

		$i = $datos[0]["image"]; $idp = $datos[0]["idp"]; $idd = $datos[0]["id"];
		$vista_previa = "<div class='thumb_detailproduct'><img src='$i' width='80'></div>";
		$vista_previa .= "<div>#$idp-$idd</div>";
		
		echo $vista_previa;
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["id_desuso"] ) ){
		//Actualiza el valor de producto en desuso de un detalle de producto
		
		include( "bd.php" );
		$val 	= $_POST["valor"];
		$id_org = $_POST["id_desuso"];
		$id_ref = $_POST["id_ref"];

		$ref_valida = validarReferenciaProductoDesuso( $dbh, $val, $id_org, $id_ref );
		
		if( $ref_valida["val"] ){

			$r = asignarDetalleProductoDesuso( $dbh, $val, $id_org, $id_ref );
			
			if( ( $r != 0 ) && ( $r != "" ) ) {
				$res["exito"] 	= 1;
				$res["mje"] 	= "Producto actualizado con éxito";
			}else{
				$res["exito"] 	= -1;
				$res["mje"] 	= "Error al actualizar producto";
			}

		}else{
			$res["exito"] 		= -1;
			$res["mje"] 		= $ref_valida["mje"];
		}

		echo json_encode( $res );

	}
	/* ----------------------------------------------------------------------------------- */
?>