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
		$q = "select p.id, p.code as codigo, p.name as nombre, p.description as descripcion, 
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
		$q = "select dp.id, c.name as color, t.name as bano, dp.price_type as tipo_precio, dp.weight as peso, 
		dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, 
		dp.weight_price_value as precio_peso FROM product_details dp, treatments t, colors c 
		where dp.color_id = c.id and dp.treatment_id = t.id and dp.product_id = $idp";

		$data = mysqli_query( $dbh, $q );
		$lista_d = obtenerListaRegistros( $data );
		return $lista_d;		
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
	/* Solicitudes asíncronas al servidor para procesar información de Productos */
	/* ----------------------------------------------------------------------------------- */
	
	//
	if( isset( $_POST["form_np"] ) ){
		include( "bd.php" );	
		parse_str( $_POST["form_np"], $producto );

		//print_r( $producto );
		$idp = agregarProducto( $dbh, $producto );
		$producto["id"] = $idp;
		registrarAsociaciones( $dbh, $producto );
		echo $idp;
	}
	else {

	}
	/* ----------------------------------------------------------------------------------- */

?>