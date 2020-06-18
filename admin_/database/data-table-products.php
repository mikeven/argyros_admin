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
	function obtenerImagenesProducto( $dbh, $id ){
		//Devuelve los registros de imágenes de dado el id de producto
		$q = "select i.path as image FROM images i, product_details d 
		where i.product_detail_id = d.id and d.product_id = $id";

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
		$reg_prod["img"] 		= "<a href='#!' class='pop-img-p' data-toggle='modal' 
									data-src='".$url_img."' data-target='#img-product-pop'>
									<img src='".$url_img."' width='60px'></a>";
		$reg_prod["id"]			= "<a class='primary' href='".$lnk_p."' target='_blank'>".$p["id"]."</a>";
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

	echo json_encode( $data_productos );
	
	/* ----------------------------------------------------------------------------------- */
?>