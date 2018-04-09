<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de productos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaProductos( $dbh ){
		//Devuelve la lista de productos en general
		$q = "select p.id, p.code as codigo, p.name as nombre, p.description as descripcion, 
		p.is_visible as visible, co.name as pais, ca.name as categoria, sc.name as subcategoria, 
		m.name as material FROM products p, categories ca, subcategories sc, countries co, materials m 
		where p.category_id = ca.id and p.subcategory_id = sc.id and p.material_id = m.id and p.country_code = co.code 
		order by p.id DESC";
		
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
		$q = "select p.id, p.code as codigo, p.name as nombre, p.description as descripcion, p.category_id as cid, 
		p.subcategory_id as scid, p.is_visible as visible, co.code as codpais, co.name as pais, ca.name as categoria, 
		sc.name as subcategoria, m.id as idmaterial, m.name as material FROM products p, categories ca, 
		subcategories sc, countries co, materials m 
		where p.category_id = ca.id and p.subcategory_id = sc.id and p.material_id = m.id 
		and p.country_code = co.code and p.id = $idp";

		$data = mysqli_query( $dbh, $q );
		if( $data )
			return mysqli_fetch_array( $data );

	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerLineasDeProductoPorId( $dbh, $idp ){
		//Devuelve los datos de las líneas a las que pertenece un producto
		$q = "select l.id as idlinea, l.name as nombre, l.description as descripcion 
		from plines l, line_product lp where lp.line_id = l.id and lp.product_id = $idp order by nombre ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTrabajosDeProductoPorId( $dbh, $idp ){
		//Devuelve los datos de las líneas a las que pertenece un producto
		$q = "select t.id as idtrabajo, t.name as nombre 
		from makings t, making_product tp where tp.making_id = t.id and tp.product_id = $idp order by nombre ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetalleProductoPorId( $dbh, $idp ){
		//Devuelve los registros detalles asociados a un producto dado su id
		$q = "select dp.id as id, c.name as color, t.name as bano, dp.price_type as tipo_precio, dp.weight as peso, 
		dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, 
		dp.weight_price_value as precio_peso FROM product_details dp, treatments t, colors c 
		where dp.color_id = c.id and dp.treatment_id = t.id and dp.product_id = $idp";
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;		
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerRegistroDetalleProductoPorId( $dbh, $idd ){
		//Devuelve un registro de detalle de producto dado su id
		$q = "select dp.id as id, c.id as color, t.id as bano, dp.price_type as tipo_precio, dp.weight as peso, 
		dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, dp.product_id as pid, 
		dp.weight_price_value as precio_peso FROM product_details dp, treatments t, colors c 
		where dp.color_id = c.id and dp.treatment_id = t.id and dp.id = $idd";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );		
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenesProducto( $dbh, $id ){
		//Devuelve los registros de imágenes de dado el id de producto
		$q = "select i.path as image FROM images i, product_details d 
		where i.product_detail_id = d.id and d.product_id = $id";
		//echo $q;

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
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenDetalleProductoPorId( $dbh, $id_img ){
		//Devuelve el registro de imagen de detalle de producto
		$q = "select id, path from images where id = $id_img";
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTallasDetalleProducto( $dbh, $idd ){
		//Devuelve los registros de tallas de detalle de producto
		$q = "select spd.size_id as idtalla, s.name as talla, spd.weight as peso, spd.visible as visible 
		from size_product_detail spd, sizes s where spd.size_id = s.id and spd.product_detail_id = $idd";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDatosDetalleProductoPorId( $dbh, $idd ){
		//
		$detalle["datos"]		= obtenerRegistroDetalleProductoPorId( $dbh, $idd );
		$detalle["tallas"] 		= obtenerTallasDetalleProducto( $dbh, $idd );
		$detalle["imagenes"] 	= obtenerImagenesDetalleProducto( $dbh, $idd, "" );

		return $detalle;
		
	}
	/* ----------------------------------------------------------------------------------- */
	function asociarLineaProducto( $dbh, $idl, $idp ){
		//
		$q = "insert into line_product ( line_id, product_id ) values ( $idl, $idp )";
		$data = mysqli_query( $dbh, $q );

	}
	/* ----------------------------------------------------------------------------------- */
	function asociarTrabajoProducto( $dbh, $idt, $idp ){
		//
		$q = "insert into making_product ( making_id, product_id ) values ( $idt, $idp )";
		$data = mysqli_query( $dbh, $q );

	}
	/* ----------------------------------------------------------------------------------- */
	function agregarProducto( $dbh, $producto ){
		//Guarda el registro de un producto
		$q = "insert into products ( code, name, description, country_code, category_id, 
		subcategory_id, material_id ) values ( '$producto[codigo]', '$producto[nombre]', '$producto[descripcion]',
		'$producto[pais]', $producto[categoria], $producto[subcategoria], $producto[material] )";

		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarDetalleProducto( $dbh, $detalle ){
		//Guarda el registro de detalle de un producto
		$q = "insert into product_details ( product_id, color_id, treatment_id, price_type, piece_price_value, 
		manufacture_value, weight_price_value, created_at ) values ( $detalle[idproducto], $detalle[color], 
		$detalle[bano], '$detalle[tprecio]', $detalle[valor_pieza], $detalle[valor_mano_obra], $detalle[valor_gramo], NOW())";
		
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function editarProducto( $dbh, $producto ){
		//Actualiza los datos de producto
		$q = "update products set code = '$producto[codigo]', name = '$producto[nombre]', description = '$producto[descripcion]', 
		country_code = '$producto[pais]', category_id = $producto[categoria], subcategory_id = $producto[subcategoria], 
		material_id = $producto[material], updated_at = NOW() where id = $producto[idproducto]";
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function editarDatosDetalleProducto( $dbh, $detalle ){
		//Actualiza los datos de detalle de producto
		$q = "update product_details set color_id = $detalle[color], treatment_id = $detalle[bano], 
		price_type = '$detalle[tprecio]', piece_price_value = $detalle[valor_pieza], manufacture_value = $detalle[valor_mano_obra], 
		weight_price_value = $detalle[valor_gramo], updated_at = NOW() where id = $detalle[iddetalle]";
		
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
		$q = "select * from size_product_detail where size_id = $id_talla and product_detail_id = $iddet";
		$data = mysqli_query( $dbh, $q );
		$nregs = mysqli_num_rows( $data );
		
		if( $nregs > 0 )
			$existe = true;
		
		return $existe;
	}
	/* ----------------------------------------------------------------------------------- */
	function editarTallasDetalleProducto( $dbh, $iddet, $tallas ){
		//Actualiza los datos de tallas en detalle de producto
		foreach ( $tallas as  $reg ) {
			$e = existeRegistroTallaDetalle( $dbh, $iddet, $reg->idt );
			if( $e == true ){
				actualizarTallasDetalleProducto( $dbh, $iddet, $reg->idt, $reg->peso );
			} else {
				guardarTallaDetalleProducto( $dbh, $iddet, $reg->idt, $reg->peso );
			}
		}
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
		print_r( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	function guardarTallaDetalleProducto( $dbh, $idd, $idtalla, $peso ){
		//Guarda el registro de tallas y pesos de un detalle de producto
		$q = "insert into size_product_detail ( weight, size_id, product_detail_id ) 
			   values ( $peso, $idtalla, $idd )";
		//echo $q;
		$data = mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarTallasDetalleProducto( $dbh, $iddet, $idtalla, $peso ){
		//Actualiza el valor talla-peso de un detalle de producto
		$q = "update size_product_detail set weight = $peso where size_id = $idtalla and 
		product_detail_id = $iddet";
		
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarTallasDetalleProducto( $dbh, $idd, $tallas ){
		//Procesa los datos de tallas-peso del detalle de producto para almacenar en la BD
		foreach ( $tallas as $reg ) {
			guardarTallaDetalleProducto( $dbh, $idd, $reg->idt, $reg->peso );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarImagenDetalleProducto( $dbh, $idd, $image ){
		//Guarda el registro de una imagen asociada a un detalle de un producto dado por idd
		$q = "insert into images ( path, image_path_300x300, thumb_path_50x50, product_detail_id, created_at ) 
		values ( '$image', '', '', $idd, NOW() )";
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

		$html_img = "<img src='{url}' class='file-preview-image' alt='Desert' title='Desert'>";
		
		for( $i = 0; $i < count( $filenames ); $i++ ){
			$data_ext = explode( '.', basename( $filenames[$i] ) );
			$ext = array_pop( $data_ext ); $fname = array_pop( $data_ext );
			$md5 =  md5( uniqid() );
			$target = $url_dest . $fname.$md5 . "." . $ext;
			$target_show = $url_dest_show . $fname.$md5 . "." . $ext;
			
			if( move_uploaded_file( $images['tmp_name'][$i], $target ) ) {
				$success = true;
				$paths[] = $target;
				$html_markups[] = "<img src='".$target_show."' class='file-preview-image fpiup' alt='".
									$filenames[$i]."' title='Desert' data-uimg='".$target."'>";
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
	/* Solicitudes asíncronas al servidor para procesar información de Productos */
	/* ----------------------------------------------------------------------------------- */
	
	if( isset( $_POST["chcodigo"] ) ){
		include( "bd.php" );
		$r = codigoDisponible( $dbh, $_POST["chcodigo"] );
		echo $r;
	}

	/* ----------------------------------------------------------------------------------- */
	
	//Registro de nuevo producto
	if( isset( $_POST["form_np"] ) ){
		include( "bd.php" );	
		parse_str( $_POST["form_np"], $producto );

		//print_r( $producto );
		$idp = agregarProducto( $dbh, $producto );
		$producto["idproducto"] = $idp;
		
		registrarAsociacionesTrabajosLineas( $dbh, $producto );

		if( ( $idp != 0 ) && ( $idp != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Registro exitoso";
			$res["reg"] = $producto;
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al registrar producto";
			$res["reg"] = NULL;
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	//Edición de datos de producto
	if( isset( $_POST["form_mp"] ) ){
		include( "bd.php" );	
		parse_str( $_POST["form_mp"], $producto );

		//print_r( $producto );
		$r = editarProducto( $dbh, $producto );
		eliminarAsociacionesTrabajosLineas( $dbh, $producto );
		registrarAsociacionesTrabajosLineas( $dbh, $producto );
		$producto["id"] = $producto["idproducto"];

		if( ( $r != 0 ) && ( $r != "" ) ) {
			$res["exito"] = 1;
			$res["mje"] = "Actualización exitoso";
			$res["reg"] = $producto;
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al modificar producto";
			$res["reg"] = NULL;
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	//Registro de nuevo detalle de producto
	if( isset( $_POST["form_ndetp"] ) ){
		include( "bd.php" );	
		parse_str( $_POST["form_ndetp"], $detalle );
		$tallas = json_decode( $_POST["vtallas"] );

		$idd = agregarDetalleProducto( $dbh, $detalle );
		registrarTallasDetalleProducto( $dbh, $idd, $tallas );
		
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
		
		$iddet = $_POST["idt"];
		$tallas = json_decode( $_POST["modif_tallasdetprod"] );
		$idd = editarTallasDetalleProducto( $dbh, $iddet, $tallas );
		
		$res["exito"] = 1;
		$res["mje"] = "Datos de tallas actualizados con éxito";
		$res["reg"] = $tallas;

		echo json_encode( $res );

	}
	/* ----------------------------------------------------------------------------------- */
	//Eliminación de imagen de detalle de producto
	if( isset( $_POST["elim_imgdetprod"] ) ){
		include( "bd.php" );	
		
		$id_img = $_POST["elim_imgdetprod"];
		$res = eliminarImagenDetalleProducto( $dbh, $id_img );

		/*if ( ( $res != 0 ) && ( $res != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Foto eliminada con éxito";
			$res["reg"] = NULL;
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al borrar foto";
			$res["reg"] = NULL;
		}

		echo json_encode( $res ); */
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
	if( isset( $_POST["file_sending"] ) ){
		include( "bd.php" );
		//Maneja los datos de las imágenes recibidas para detalle de productos
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
?>