<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros -  */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
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
		$q = "select p.id, p.code, p.name, p.description, p.is_visible as visible, 
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
		$q = "select p.id, p.code, p.name, p.description, p.is_visible as visible 
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
		m.id as idmaterial, m.name as material, date_format(p.created_at,'%d/%m/%Y') as fcreacion 
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
		dp.weight as peso, dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, 
		dp.weight_price_value as precio_peso FROM product_details dp
		LEFT JOIN treatments t ON t.id = dp.treatment_id LEFT JOIN colors c ON dp.color_id = c.id 
		WHERE dp.product_id = $idp ORDER BY dp.id DESC";

		/*SELECT dp.id AS id, c.name AS color, t.name AS bano, dp.price_type AS tipo_precio, 
		dp.weight AS peso, dp.piece_price_value AS precio_pieza, 
		dp.manufacture_value AS precio_mo, dp.weight_price_value AS precio_peso 
		FROM product_details dp, treatments t, colors c 
		WHERE dp.color_id = c.id AND dp.treatment_id = t.id AND dp.product_id = 2
		ORDER BY dp.id DESC*/
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;		
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerRegistroDetalleProductoPorId( $dbh, $idd ){
		//Devuelve un registro de detalle de producto dado id de detalle
		$q = "select dp.id as id, dp.product_id as idp, c.id as color, t.id as bano, 
		dp.price_type as tipo_precio, dp.weight as peso, dp.piece_price_value as precio_pieza, 
		dp.manufacture_value as precio_mo, dp.product_id as pid, dp.weight_price_value as precio_peso 
		FROM product_details dp LEFT JOIN treatments t ON t.id = dp.treatment_id 
		LEFT JOIN colors c ON dp.color_id = c.id where dp.id = $idd";
		
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
		$q = "insert into products ( code, name, description, country_id, category_id, 
		subcategory_id, material_id, created_at ) values ( '$producto[codigo]', '$producto[nombre]', 
		'$producto[descripcion]', $producto[pais], $producto[categoria], $producto[subcategoria], 
		$producto[material], NOW() )";

		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarDetalleProducto( $dbh, $detalle ){
		//Guarda el registro de detalle de un producto
		$q = "insert into product_details ( product_id, color_id, treatment_id, price_type, 
		piece_price_value, manufacture_value, weight_price_value, created_at ) 
		values ( $detalle[idproducto], $detalle[color], $detalle[bano], '$detalle[tprecio]', 
		$detalle[valor_pieza], $detalle[valor_mano_obra], $detalle[valor_gramo], NOW())";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function editarProducto( $dbh, $producto ){
		//Actualiza los datos de producto
		$q = "update products set code = '$producto[codigo]', name = '$producto[nombre]', 
		description = '$producto[descripcion]', country_id = '$producto[pais]', 
		category_id = $producto[categoria], subcategory_id = $producto[subcategoria], 
		material_id = $producto[material], updated_at = NOW() where id = $producto[idproducto]";
		
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
	function actualizarBañoDetalleProducto( $dbh, $idd, $valor ){
		//Actualiza el valor de un baño de detalle de producto
		$q = "update product_details set treatment_id = $valor where id = $idd";
		$data = mysqli_query( $dbh, $q );
		return $data;
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
	/* Solicitudes asíncronas al servidor para procesar información de Productos */
	/* ----------------------------------------------------------------------------------- */
	include( "bd.php" );
	$productos = obtenerListaProductos( $dbh );

	foreach ( $productos as $p ) {

		$lnk_p = "product-data.php?p=$p[id]";
		$imgs = obtenerImagenesProducto( $dbh, $p["id"]);
		$drdet = obtenerDetalleProductoPorId( $dbh, $p["id"] );
		$url_img = "";
		
		if( isset( $imgs[0] ) ){
			$url_img = $imgs[0]["image"];
		}

		if( $p["visible"] == 1 ) {
			$clp = ""; $accion = "Ocultar"; $ccol = "pstat_";
		}else{ 
			$clp = "-slash"; $accion = "Mostrar"; $ccol = "pstat_o"; 
		}
		
		$html_det = "";

		foreach ( $drdet as $dp ) {
			$lnk_dp 	= "product-data.php?p=$p[id]#$dp[id]";
			$html_det 	.= "<div><a href='".$lnk_dp."'>#".$dp['id']."</a></div>";
		}
		/*......................................................................*/
		$reg_prod["img"] 		= "<a href='#!' class='pop-img-p' data-toggle='modal' data-src='".$url_img.
									"data-target='#img-product-pop'><img src='".$url_img."' width='60px'></a>";
		$reg_prod["id"]			= "<a class='primary' href='".$lnk_p."'>".$p["id"]."</a>";
		$reg_prod["codigo"] 	= $p["codigo"];
		$reg_prod["nombre"] 	= "<a class='primary' href='".$lnk_p."'>".$p["nombre"]."</a>";
		$reg_prod["desc"] 		= $p["descripcion"];
		$reg_prod["categ"] 		= $p["categoria"];
		$reg_prod["rdets"] 		= $html_det;
		$reg_prod["editar"] 	= "<a href='product-edit.php?id=".$p["id"]."'><i class='fa fa-edit'></i></a>";

		$reg_prod["accion"] 	= "<div align='center'>
            						<i id='im".$p["id"]."' class='fa fa-eye".$clp." fa-2x ". $ccol."'></i></div>
          							<hr>
          							<div align='center'>
          								<a href='#!' class='bt-prod-act' data-idp='".$p["id"]."' 
          								data-op='".$p["visible"]."' data-toggle='modal' 
          								data-target='#confirmar-accion'>".$accion."</a></div>";
		/*......................................................................*/
		$data_productos["data"][] = $reg_prod;
	}

	/*$vector = array(
		"campo1"=>"1", "campo2"=>"2", "campo3"=>"3", "campo4"=>"4", "campo5"=>"5", 
		"campo6"=>"6", "campo7"=>"7", "campo8"=>"8", "campo9"=>"9nueve"
	);
	for ($i = 0; $i < 8; $i++ ) { 
		$arreglo["data"][] = $vector;
	}*/

	echo json_encode( $data_productos );
	
	/* ----------------------------------------------------------------------------------- */
?>