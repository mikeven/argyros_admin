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
	function obtenerImagenesDetalleProducto( $dbh, $idd ){
		//Devuelve los registros de imágenes de dado el id de producto
		$q = "select i.path as image FROM images i, product_details d 
		where i.product_detail_id = d.id and d.id = $idd";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetallesProductoPorId( $dbh, $idp ){
		//Devuelve los registros detalles asociados a un producto dado su id
		$q = "select p.id as p_id, dp.id as d_id, p.code as codigo, p.name as nombre, p.description as descripcion,
		p.provider_id1 as idpvd1, p.manfact_code1 as codigof1, ca.name as categoria, sc.name as subcategoria, 
		date_format(dp.unavailable_at,'%d/%m/%Y %h:%i:%s %p') as fagotado, 
		date_format(dp.created_at,'%d/%m/%Y %h:%i:%s %p') as fcreado     
		FROM product_details dp, products p, categories ca, subcategories sc 
		WHERE dp.product_id = p.id and p.category_id = ca.id and p.subcategory_id = sc.id  and 
		dp.product_id = $idp ORDER BY dp.unavailable_at DESC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;		
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
	function obtenerDatosProveedorPorId( $dbh, $id ){
		//Devuelve el registro de proveedor dado su id
		$q = "select id, name, number from providers where id = $id";
		return mysqli_fetch_array( mysqli_query( $dbh, $q ) );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListadoGeneralDetallesProductos( $dbh, $productos ){
		// Devuelve un vector formado por la unión de todos los detalles de productos
		$detalles = array();
		foreach ( $productos as $p ) {
			$reg_det 		= obtenerDetallesProductoPorId( $dbh, $p["id"] );
			$detalles		= array_merge( $detalles, $reg_det );
		}
		
		return $detalles;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListadoCompletoDetallesProductos( $dbh ){
		// Devuelve los registros de todos los detalles de productos
		$q = "select p.id as p_id, dp.id as d_id, p.code as codigo, p.name as nombre, p.description as descripcion,
		p.provider_id1 as idpvd1, p.manfact_code1 as codigof1, ca.name as categoria, sc.name as subcategoria, 
		date_format(dp.unavailable_at,'%d/%m/%y %h:%i:%s %p') as fagotado, 
		date_format(dp.created_at,'%d/%m/%y %h:%i:%s %p') as fcreado     
		from product_details dp, products p, categories ca, subcategories sc 
		where dp.product_id = p.id and p.category_id = ca.id and p.subcategory_id = sc.id 
		order by dp.unavailable_at desc";
		
		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenDetalleProducto( $dbh, $idd ){
		// Devuelve la primera imagen del detalle de producto.
		$images 	= obtenerImagenesDetalleProducto( $dbh, $idd );
		
		$url_img	= $images[0]["image"];
		$html_img 	= "<div align='center'><a href='#!' class='pop-img-p' data-toggle='modal' 
						data-src='".$url_img."' data-target='#img-product-pop'>
						<img src='".$url_img."' width='60px'></a></div>";

		return $html_img;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerColoresDisponibilidadTallas( $tallas ){
		// Devuelve la clase de color según nivel de disponibilidad de un detalle de producto
		$html_ta 	= "";

		foreach ( $tallas as $t ) {
			if( $t["visible"] == 1 )  $class = "dsp_total"; else $class = "dsp_agotado";

			$html_ta .= "<div align='center'>
							<a href='#!' class='badge $class'>".$t['talla']." ".$t['unidad']."</a>
							<span>".$t['peso']."</span>
						</div>";
				
		}

		return $html_ta;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerCodigosProducto( $dbh, $dp ){
		// Devuelve los datos para la columna de código
		if( $dp["idpvd1"] != "" ){
			$proveedor = obtenerDatosProveedorPorId( $dbh, $dp["idpvd1"] );
		}
		else $proveedor[number] = "";

		$codigo =	"<div>$dp[codigo]</div>";
		$codigo .=	"<div>$proveedor[number]-$dp[codigof1]</div>"; 

		return $codigo;
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Productos */
	/* ----------------------------------------------------------------------------------- */
	include( "bd.php" );
	$detalles_productos = obtenerListadoCompletoDetallesProductos( $dbh );

	foreach ( $detalles_productos as $dp ) {
		
		if( !$dp["fagotado"] ) $fagotado = $dp["fcreado"]; else $fagotado = $dp["fagotado"];
		/*if( $fagotado != "-" ){*/
			$tallas 		= obtenerTallasDetalleProducto( $dbh, $dp["d_id"] );
			$lnk_dp 		= "product-data.php?p=$dp[p_id]#$dp[d_id]";
			$html_det		= obtenerImagenDetalleProducto( $dbh, $dp["d_id"] );		
			$html_det 		.= "<div align='center'>
									<a href='".$lnk_dp."' target='_blank'>#".$dp["p_id"]."-".$dp["d_id"]."</a>
								</div>";
			$col_cod		= obtenerCodigosProducto( $dbh, $dp );
			$html_ta		= obtenerColoresDisponibilidadTallas( $tallas );

			/*......................................................................*/
			
			$reg_prod["fagotado"] 	= $fagotado;
			$reg_prod["codigo"] 	= $col_cod;
			$reg_prod["nombre"] 	= "<a class='primary' href='".$lnk_dp."'>".$dp["nombre"]."</a>";
			$reg_prod["desc"] 		= $dp["descripcion"];
			$reg_prod["categ"] 		= $dp["categoria"]." > ".$dp["subcategoria"];
			$reg_prod["detalle"]	= $html_det;
			$reg_prod["tallas"] 	= $html_ta;
		
			/*......................................................................*/
			$data_productos["data"][] = $reg_prod;
		/*}*/
	}

	echo json_encode( $data_productos );
	
	/* ----------------------------------------------------------------------------------- */
?>