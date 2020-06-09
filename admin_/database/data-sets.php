<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de juegos de productos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerJuegosProductos( $dbh ){
		//Devuelve los registros de juegos de producto
		$q = "select id, date_format( created_at,'%d/%m/%Y') as fecha from sets order by id DESC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_j = obtenerListaRegistros( $data );
		return $lista_j;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetallesProductoPorJuego( $dbh, $idj ){
		//Devuelve la lista de ids de detalles de productos asociados a un juego
		$q = "select dp.product_id as idp, spd.product_detail_id as idd 
				from set_product_details spd, product_details dp 
				where dp.id = product_detail_id and spd.set_id = $idj";
		$data = mysqli_query( $dbh, $q );
		$lista_j = obtenerListaRegistros( $data );
		return $lista_j;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerNumeroNuevoJuego( $dbh ){
		//Devuelve la lista de productos en general
		$q = "select MAX(id) AS numero from sets";
		
		$data = mysqli_fetch_array( mysqli_query( $dbh, $q ) );
		if( $data["numero"] == NULL )
			$data["numero"] = 1;
		else
			$data["numero"] += 1;
		return $data;
	}	
	/* ----------------------------------------------------------------------------------- */
	function agregarJuego( $dbh ){
		//Agrega un registro de juego de producto
		$q = "insert into sets ( created_at ) values ( NOW() )";

		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}	
	/* ----------------------------------------------------------------------------------- */
	function agregarProductoJuego( $dbh, $idj, $iddet ){
		//Agrega un registro de detalle de producto asociado a un juego
		$q = "insert into set_product_details( set_id, product_detail_id ) values ( $idj, $iddet )";

		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaJuegosProductos( $dbh ){
		//Devuelve una lista de detalles de productos agrupados por juego
		$lista = array();
		$juegos = obtenerJuegosProductos( $dbh );
		foreach ( $juegos as $j ) {
			$j["detalles"] = obtenerDetallesProductoPorJuego( $dbh, $j["id"] );
			$lista[] = $j;
		}

		return $lista;
	}	
	/* ----------------------------------------------------------------------------------- */
	function eliminarProductoJuego( $dbh, $iddpj, $idj ){
		//Elimina un detalle de producto de un juego de productos
		$q = "delete from set_product_details where set_id = $idj and product_detail_id = $iddpj";
		
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarJuego( $dbh, $idj ){
		//Elimina un detalle de producto de un juego de productos
		$q1 = "delete from set_product_details where set_id = $idj";
		$q2 = "delete from sets where id = $idj";

		mysqli_query( $dbh, $q1 );
		
		return mysqli_query( $dbh, $q2 );
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarProductosJuego( $dbh, $idj ){
		//Elimina todas los registros de productos asociados a un juego dado por id 
		$q = "delete from set_product_details where set_id = $idj";
		
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	ini_set( 'display_errors', 1 );
	//Agregar nuevo juego de productos
	if( isset( $_GET["nset"] ) ){
		include( "bd.php" );

		$iddetalles = $_POST["iddp"];	//Conjunto de campos ocultos generados dinámicamente
		$idj = agregarJuego( $dbh );
		foreach ( $iddetalles as $id ) {
			echo agregarProductoJuego( $dbh, $idj, $id );
		}
		if( ( $idj != 0 ) && ( $idj != "" ) ){
			header( "Location: ../sets.php?agregar_juego-exito" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	// Modificar juego de productos
	if( isset( $_GET["mset"] ) ){
		include( "bd.php" );
		$idj = $_POST["idjuego"];
		$iddetalles = $_POST["iddp"]; //Conjunto de campos ocultos generados dinámicamente
		eliminarProductosJuego( $dbh, $idj );
		foreach ( $iddetalles as $id ) {
			echo agregarProductoJuego( $dbh, $idj, $id );
		}
		if( ( $idj != 0 ) && ( $idj != "" ) ){
			header( "Location: ../sets.php?editar_juego-exito" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Eliminar producto de un juego
	if( isset( $_POST["id_elim_dpj"] ) ){
		include( "bd.php" );	
		include( "data-system.php" );
		
		eliminarProductoJuego( $dbh, $_POST["id_elim_dpj"], $_POST["id_juego"] );
		$res["exito"] = 1;
		$res["mje"] = "Producto quitado con éxito";

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["id_elim_j"] ) ){
		include( "bd.php" );	
		include( "data-system.php" );
		
		eliminarJuego( $dbh, $_POST["id_elim_j"] );
		$res["exito"] = 1;
		$res["mje"] = "Juego eliminado con éxito";

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	
?>