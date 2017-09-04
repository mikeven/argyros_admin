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
	GROUP BY pais, categoria, subcategoria, material order by nombre ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_p = obtenerListaRegistros( $data );
		return $lista_p;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductoPorId( $dbh, $idp ){
		//Devuelve los datos de un producto dado su id
		$q = "select p.id, p.code as codigo, p.name as nombre, p.description as descripcion, p.category_id as cid,  
		p.is_visible as visible, co.name as pais, ca.name as categoria, sc.name as subcategoria, 
		m.name as material FROM products p, categories ca, subcategories sc, countries co, materials m 
		where p.category_id = ca.id and p.subcategory_id = sc.id and p.material_id = m.id 
		and p.country_code = co.code and p.id = $idp";

		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );		
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
		$lista_d = obtenerListaRegistros( $data );
		return $lista_d;		
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
	function obtenerImagenesDetalleProducto( $dbh, $idd ){
		//Devuelve los registros de imágenes de detalle de producto
		$q = "select path from images where product_detail_id = $idd";
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		$lista_d = obtenerListaRegistros( $data );
		return $lista_d;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTallasDetalleProducto( $dbh, $idd ){
		//Devuelve los registros de tallas de detalle de producto
		$q = "select spd.size_id as idtalla, s.name as talla, spd.weight as peso from size_product_detail spd, sizes s 
		where spd.size_id = s.id and spd.product_detail_id = $idd";
		
		$data = mysqli_query( $dbh, $q );
		$lista_d = obtenerListaRegistros( $data );
		return $lista_d;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDatosDetalleProductoPorId( $dbh, $idd ){
		//
		$detalle["datos"]		= obtenerRegistroDetalleProductoPorId( $dbh, $idd );
		$detalle["tallas"] 		= obtenerTallasDetalleProducto( $dbh, $idd );
		$detalle["imagenes"] 	= obtenerImagenesDetalleProducto( $dbh, $idd );

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
		
		echo $q;
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function editarDatosDetalleProducto( $dbh, $detalle ){
		//Actualiza los datos de detalle de producto
		$q = "update product_details set color_id = $detalle[color], treatment_id = $detalle[bano], 
		price_type = '$detalle[tprecio]', piece_price_value = $detalle[valor_pieza], manufacture_value = $detalle[valor_mano_obra], 
		weight_price_value = $detalle[valor_gramo], updated_at = NOW() where id = $detalle[iddetalle]";


		echo $q;
	}
	/* ----------------------------------------------------------------------------------- */
	function guardarTallasDetalleProducto( $dbh, $idd, $idtalla, $peso ){
		//Guarda el registro de tallas y pesos de un detalle de producto
		$q = "insert into size_product_detail ( weight, size_id, product_detail_id ) 
				values ( $peso, $idtalla, $idd )";
		//echo $q;
		$data = mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarTallasDetalleProducto( $dbh, $idd, $tallas ){
		//Procesa los datos de tallas-peso del detalle de producto para almacenar en la BD
		foreach ( $tallas as $reg ) {
			guardarTallasDetalleProducto( $dbh, $idd, $reg->idt, $reg->peso );
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
	function registrarAsociaciones( $dbh, $producto ){
		
		//Asociar producto-líneas:
		$lineas = $producto["linea"];
		foreach ( $lineas as $idl ) {
			asociarLineaProducto( $dbh, $idl, $producto["id"] );
		}
		//Asociar producto-trabajos:
		$trabajos = $producto["trabajo"];
		foreach ( $trabajos as $idt ) {
			asociarTrabajoProducto( $dbh, $idt, $producto["id"] );
		}

	}
	/* ----------------------------------------------------------------------------------- */
	function moverArchivoImagenProducto( $archivo, $nombre ){
		//Mueve los archivos de imágenes de la carpeta de carga a la carpeta de catálogo 
		$destino = "../catalog/".$nombre;
		rename( $archivo, $destino );

		return $nombre;
	}
	/* ----------------------------------------------------------------------------------- */
	function guardarImagenesDetalleProducto( $dbh, $idd, $img ){
		
		$nombre = explode( '../uploads/', $img );
		$url = moverArchivoImagenProducto( $img, $nombre[1] );
		agregarImagenDetalleProducto( $dbh, $idd, $url );

	}
	/* ----------------------------------------------------------------------------------- */
	function procesarImagenes( $dbh, $idd, $data ){
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
	
	//Registro de nuevo producto
	if( isset( $_POST["form_np"] ) ){
		include( "bd.php" );	
		parse_str( $_POST["form_np"], $producto );

		//print_r( $producto );
		$idp = agregarProducto( $dbh, $producto );
		$producto["id"] = $idp;
		registrarAsociaciones( $dbh, $producto );

		if( ( $idp != 0 ) && ( $idp != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Registro exitoso";
			$res["reg"] = $producto;
		}else{
			$res["exito"] = 0;
			$res["mje"] = "Error al registrar producto";
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
		procesarImagenes( $dbh, $idd, $detalle );
	}

	//Edición de datos de detalle de producto
	if( isset( $_POST["form_modif_detprod"] ) ){
		include( "bd.php" );	
		parse_str( $_POST["form_modif_detprod"], $detalle );

		$idd = editarDatosDetalleProducto( $dbh, $detalle );
	}

	//Edición de datos de detalle de producto
	if( isset( $_POST["form_modif_detprod"] ) ){
		include( "bd.php" );	
		parse_str( $_POST["form_modif_detprod"], $detalle );

		$idd = editarDatosDetalleProducto( $dbh, $detalle );
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