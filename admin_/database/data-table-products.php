<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de datos para tabla general de productos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaProductos( $dbh ){
		//Devuelve la lista de productos en general
		$q = "select p.id, p.code as codigo, p.name as nombre, p.description as descripcion, 
		p.visible as visible, ca.name as categoria, sc.name as subcategoria, 
		p.provider_id1 as idpvd1, p.manfact_code1 as codigof1 FROM products p, categories ca, subcategories sc 
		where p.category_id = ca.id and p.subcategory_id = sc.id order by p.id DESC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenesDetalleProducto( $dbh, $idd ){
		//Devuelve los registros de imágenes de dado el id de producto
		$q = "select i.path as image FROM images i, product_details d 
		where i.product_detail_id = d.id and d.id = $idd LIMIT 1";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetalleProductoPorId( $dbh, $idp ){
		//Devuelve los registros detalles asociados a un producto dado su id
		$q = "select dp.id as id, location as ubicacion, disused as desuso FROM product_details dp 
				WHERE dp.product_id = $idp ORDER BY dp.id DESC";
		
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
	function obtenerAccionVisibilidad( $p, $clp, $ccol, $accion ){
		// Devuelve las acciones de mostrar/ocultar productos.

		$visible = "<div align='center'>
			            <i id='im".$p['id']."' class='fa fa-eye".$clp." fa-2x ".$ccol."'></i>
			        </div>
			        <hr>
			        <div align='center'>
			            <a href='#!' class='bt-prod-act' data-idp='".$p['id']."' data-op='".$p['visible']."' 
			            data-toggle='modal' data-target='#confirmar-accion'>".$accion."</a>
			        </div>";

		return $visible;
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
	function obtenerCodigoDisponibilidad( $dbh, $idd ){
		// Devuelve la clase de color según nivel de disponibilidad de un detalle de producto
		$tallas 		= obtenerTallasDetalleProducto( $dbh, $idd );
		$cant_tallas 	= count( $tallas );
		$disponibles 	= 0;

		foreach ( $tallas as $t ) {
			if( $t["visible"] == 1 ) $disponibles++;
		}

		if( $disponibles == $cant_tallas ) 	$class = "dsp_total";
		if( $disponibles == 0 ) 			$class = "dsp_agotado";
		if( ( $disponibles > 0 ) && ( $disponibles < $cant_tallas ) ) 
											$class = "dsp_parcial";

		return $class;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerCodigosProducto( $dbh, $p ){
		// Devuelve los datos para la columna de código
		if( $p["idpvd1"] != "" ){
			$proveedor = obtenerDatosProveedorPorId( $dbh, $p["idpvd1"] );
		}
		else $proveedor["number"] = "";

		$codigo =	"<div>".$p['codigo']."</div>";
		$codigo .=	"<div>$proveedor[number]-$p[codigof1]</div>"; 

		return $codigo;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerEtiquetaProductoDesuso( $detalle ){
		// Devuelve los datos para la columna de código
		$etiqueta = "";

		if( $detalle["desuso"] )
			$etiqueta = "<div align='center'><span class='badge badge-secondary' title='En desuso'>
								<i class='fa fa-history'></i> En desuso</span></div>";

		return $etiqueta;
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Productos */
	/* ----------------------------------------------------------------------------------- */
	include( "bd.php" );
	ini_set( 'display_errors', 1 );
	$productos = obtenerListaProductos( $dbh );
	
	foreach ( $productos as $p ) {
		
		$lnk_p 			= "product-data.php?p=$p[id]";
		
		$drdet 			= obtenerDetalleProductoPorId( $dbh, $p["id"] );

		$col_cod		= obtenerCodigosProducto( $dbh, $p );

		$html_det = "";

		foreach ( $drdet as $dp ) {

			$cod_color 	= obtenerCodigoDisponibilidad( $dbh, $dp["id"] );
			$lnk_dp 	= "product-data.php?p=$p[id]#$dp[id]";
			$etq_desuso = obtenerEtiquetaProductoDesuso( $dp );
			$html_det	.= obtenerImagenDetalleProducto( $dbh, $dp["id"] );		
			$html_det 	.= "<div align='center'>
								<a href='".$lnk_dp."' class='badge $cod_color'>#".$dp['id']."</a>
							</div>";
			$html_det 	.= $etq_desuso;
			
			$html_det 	.= "<div align='center'><i class='fa fa-archive'></i> $dp[ubicacion]</div>";
		}
		/*......................................................................*/
		$reg_prod["id"]			= "<a class='primary' href='".$lnk_p."' target='_blank'>".$p["id"]."</a>";
		$reg_prod["rdets"] 		= $html_det;
		$reg_prod["codigo"] 	= $col_cod;
		$reg_prod["nombre"] 	= "<a class='primary' href='".$lnk_p."'>".$p["nombre"]."</a>";
		$reg_prod["desc"] 		= $p["descripcion"];
		$reg_prod["categ"] 		= $p["categoria"];
		//$reg_prod["visible"]	= $visibilidad;
		/*......................................................................*/
		$data_productos["data"][] = $reg_prod;

	}

	echo json_encode( $data_productos );
	
	/* ----------------------------------------------------------------------------------- */
?>