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
	function obtenerDetalleProductoPorId( $dbh, $idp ){
		//Devuelve los registros detalles asociados a un producto dado su id
		$q = "select dp.id as id, c.name as color, t.name as bano, dp.price_type as tipo_precio, 
		dp.weight as peso, dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, 
		dp.weight_price_value as precio_peso FROM product_details dp
		LEFT JOIN treatments t ON t.id = dp.treatment_id LEFT JOIN colors c ON dp.color_id = c.id 
		WHERE dp.product_id = $idp ORDER BY dp.id DESC";
		
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
	function obtenerTablaDetallesProducto( $p, $dp, $lnk_dp, $url_img ){
		// Devuelve la tabla con los detalles de un producto

		$html_tabla = "<div>
              			<table class='seleccion-detalle-juego' width='100%' align='center'>
                			<tr>
                  				<th width='33.3%'>
                  					<a href='".$lnk_dp."' target='_blank'>#".$p["id"]."-".$dp["id"]."</a>
                  				</th>
                  				<th width='33.3%'>
                    				<img id='img".$dp["id"]."' src='".$url_img."' width='60px'>
                  				</th>
                  				<th width='33.3%'>
                    				<a href='#!' class='sel-pj' data-idd='".$dp["id"]."'>
                      					<i class='fa fa-2x fa-plus-square'></i>
                    				</a>
                  				</th>
                			</tr>
              			</table>
            		</div>";

        return $html_tabla;
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Productos */
	/* ----------------------------------------------------------------------------------- */
	include( "bd.php" );
	$productos = obtenerListaProductos( $dbh );

	foreach ( $productos as $p ) {
    	$lnk_p = "product-data.php?p=$p[id]";
    	$drdet = obtenerDetalleProductoPorId( $dbh, $p["id"] );

    	$detalles = "";
		foreach ( $drdet as $dp ) {
			$lnk_dp = "product-data.php?p=$p[id]#$dp[id]"; 
			$imgs = obtenerImagenesDetalleProducto( $dbh, $dp["id"], "" );
			$url_img = "";
			
			if( isset( $imgs[0] ) ){
				$url_img = $imgs[0]["path"];
			}

			$detalles .= obtenerTablaDetallesProducto( $p, $dp, $lnk_dp, $url_img );
		}
		/*......................................................................*/
		$reg_prod["categoria"] 		= $p["categoria"];
		$reg_prod["subcategoria"] 	= $p["subcategoria"];
		$reg_prod["producto"] 		= $p["nombre"];
		$reg_prod["detalles"] 		= $detalles;
		/*......................................................................*/
		$data_productos["data"][] 	= $reg_prod;
	}

	echo json_encode( $data_productos );
	
	/* ----------------------------------------------------------------------------------- */
?>