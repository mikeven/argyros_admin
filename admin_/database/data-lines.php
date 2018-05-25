<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de líneas */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaLineas( $dbh ){
		//Devuelve la lista de líneas principales de productos
		$q = "Select id, name, description from plines order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_l = obtenerListaRegistros( $data );
		return $lista_l;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerLineaPorId( $dbh, $id ){
		//Devuelve el registro de línea dado su id
		$q = "select id, name, description from plines where id = $id";
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosLinea( $dbh, $idl ){
		//Devuelve la lista de productos pertenecientes a una línea dado su id
		$q = "select p.id, p.code, p.description from products p, plines l, line_product lp 
		where lp.product_id = p.id and lp.line_id = $idl group by p.id";
		
		$data = mysqli_query( $dbh, $q );
		$lista_l = obtenerListaRegistros( $data );
		return $lista_l;
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarLinea( $dbh, $idl, $nombre, $descripcion ){
		//Edita los datos de línea de producto
		$q = "update plines set name = '$nombre', description = '$descripcion', 
				updated_at = NOW() where id = $idl";
				
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarLinea( $dbh, $nombre, $descripcion ){
		//Agrega un registro de línea de producto
		$q = "insert into plines ( name, description, created_at ) values ( '$nombre', '$descripcion', NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Líneas */
	/* ----------------------------------------------------------------------------------- */
	
	//Registro de nueva línea
	if( isset( $_GET["nline"] ) ){
		
		include( "bd.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$descripcion = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$idl = agregarLinea( $dbh, $nombre, $descripcion );
		
		if( ( $idl != 0 ) && ( $idl != "" ) ){
			header( "Location: ../lines.php?addline&success" );
		}	
	} else {

	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["line-edit"] ) ){
		include( "bd.php" );
		$idl = $_POST["idlinea"];
		
		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$descripcion = mysqli_real_escape_string( $dbh, $_POST["nombre"] );

		$r = modificarLinea( $dbh, $idl, $nombre, $descripcion );
		
		if( ( $r != 0 ) && ( $r != "" ) ){
			header( "Location: ../line-edit.php?id=".$idl."&edit&success" );
		}
	}
	/* ----------------------------------------------------------------------------------- */

?>