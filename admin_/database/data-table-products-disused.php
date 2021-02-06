<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de datos para tabla de productos en desuso */
	/* ----------------------------------------------------------------------------------- */
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
	function obtenerListadoProductosDesuso( $dbh ){
		//Devuelve todos los registros de detalles de productos en desuso

		$q = "select p.id as p_id, dp.id as d_id, p.code as codigo, p.name as nombre, p.description as descripcion,
		p.provider_id1 as idpvd1, p.provider_id2 as idpvd2, p.provider_id3 as idpvd3, p.manfact_code1 as codigof1, 
		p.manfact_code2 as codigof2, p.manfact_code3 as codigof3, ca.name as categoria, sc.name as subcategoria,
		dp.disused as desuso, date_format(dp.disused_at,'%d/%m/%Y %h:%i:%s %p') as fdesuso, 
		date_format(dp.unavailable_at,'%d/%m/%Y %h:%i:%s %p') as fagotado, 
		date_format(dp.created_at,'%d/%m/%Y %h:%i:%s %p') as fcreado     
		from product_details dp, products p, categories ca, subcategories sc 
		where dp.product_id = p.id and p.category_id = ca.id and p.subcategory_id = sc.id and dp.disused is not null 
		order by dp.unavailable_at desc";
		
		$lista = obtenerListaRegistros( mysqli_query( $dbh, $q ) );
		
		return $lista;
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
	function obtenerUltimaOCTallaProducto( $dbh, $dp, $idt ){
		// Devuelve la última orden de compra donde fue incluida una talla de producto
		$q = "select o.id as ido, doc.status as estado 
				from purchases o, purchase_details doc 
				where doc.size_id = $idt and product_detail_id = $dp[d_id] 
				and doc.purchase_id = o.id and o.status <> 'recibida' and o.status <> 'cancelada'
				group by o.id, doc.status order by o.created_at desc LIMIT 1";

		return mysqli_fetch_array( mysqli_query( $dbh, $q ) );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerEnlaceOCPorTalla( $oc ){
		// Devuelve el enlace a una orden de compra donde fue incluida una talla
		$lnk = "";

		$clase_st = array( 
			"pendiente" 	=> "it_oc_pen",
			"recibido"		=> "it_oc_rec",
			"no-recibido"	=> "it_oc_nor" 
		);

		if( $oc["ido"] != "" ){
			$clase = $clase_st[ $oc["estado"] ];
			$url = "purchase-data.php?purchase-id=$oc[ido]";
			$lnk = "<a href='$url' class='$clase' target='_blank'>#".$oc['ido']."</a>";
		}

		return $lnk;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerColoresDisponibilidadTallas( $dbh, $tallas, $dp ){
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
			$proveedor2 = obtenerDatosProveedorPorId( $dbh, $dp["idpvd2"] );
			$proveedor3 = obtenerDatosProveedorPorId( $dbh, $dp["idpvd3"] );
		}
		else $proveedor[number] = "";

		$codigo =	"<div>$dp[codigo]</div>";
		$codigo .=	"<div>$proveedor[number]-$dp[codigof1]</div>";
		 
		if( $proveedor2["number"] != "" || $dp["codigof2"] )
			$codigo .=	"<div>$proveedor2[number]-$dp[codigof2]</div>"; 
		if( $proveedor3["number"] != "" || $dp["codigof3"] )
			$codigo .=	"<div>$proveedor3[number]-$dp[codigof3]</div>"; 

		return $codigo;
	}
	
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Productos */
	/* ----------------------------------------------------------------------------------- */
	session_start();
	
	include( "bd.php" );
	
	$data_productos["data"] = array();
	$detalles_productos = obtenerListadoProductosDesuso( $dbh );

	foreach ( $detalles_productos as $dp ) {

		$tallas 		= obtenerTallasDetalleProducto( $dbh, $dp["d_id"] );
		$lnk_dp 		= "product-data.php?p=$dp[p_id]#$dp[d_id]";
		$html_det		= obtenerImagenDetalleProducto( $dbh, $dp["d_id"] );		
		$html_det 		.= "<div align='center'>
								<a href='".$lnk_dp."' target='_blank'>#".$dp["p_id"]."-".$dp["d_id"]."</a>
							</div>";
		$col_cod		= obtenerCodigosProducto( $dbh, $dp );
		$html_ta		= obtenerColoresDisponibilidadTallas( $dbh, $tallas, $dp );

		/*......................................................................*/
		
		$reg_prod["fdesuso"] 	= $dp["fdesuso"];
		$reg_prod["codigo"] 	= $col_cod;
		$reg_prod["nombre"] 	= "<a class='primary' href='".$lnk_dp."'>".$dp["nombre"]."</a>";
		$reg_prod["desc"] 		= $dp["descripcion"];
		$reg_prod["categ"] 		= $dp["categoria"]." > ".$dp["subcategoria"];
		$reg_prod["detalle"]	= $html_det;
		$reg_prod["tallas"] 	= $html_ta;
	
		/*......................................................................*/
		$data_productos["data"][] = $reg_prod;
		
	}

	echo json_encode( $data_productos );
	
	/* ----------------------------------------------------------------------------------- */
?>