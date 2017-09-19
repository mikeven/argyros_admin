<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de colores */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaColores( $dbh ){
		//Devuelve la lista de colores de productos
		$q = "select id, name from colors order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_l = obtenerListaRegistros( $data );
		return $lista_l;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerColorPorId( $dbh, $idc ){
		//Devuelve registro de color de producto por id
		$q = "select id, name, color_code from colors where id = $idc";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarColor( $dbh, $nombre ){
		//Agrega un registro de color
		$q = "insert into colors ( name, created_at ) values ( '$nombre', NOW() )";
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );	
	}
	/* ----------------------------------------------------------------------------------- */
	function editarColor( $dbh, $idc, $nombre ){
		//Actualiza los datos de regristro de color
		$q = "update colors set name = '$nombre', updated_at = NOW() where id = $idc";
		$data = mysqli_query( $dbh, $q );
		return $data;	
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	
	//Invoca a agregar un nuevo registro de color
	if( isset( $_GET["ncolor"] ) ){
		include( "bd.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$idc = agregarColor( $dbh, $nombre );

		if( ( $idc != 0 ) && ( $idc != "" ) ){
			header( "Location: ../colors.php?addcolor&success" );
		}	
	}
	/* ----------------------------------------------------------------------------------- */
	//Invoca a editar un registro de color
	if( isset( $_GET["mcolor"] ) ){
		include( "bd.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$r = editarColor( $dbh, $_POST["idcolor"], $nombre );

		if( ( $r != 0 ) && ( $r != "" ) ){
			header( "Location: ../colors.php?editcolor&success" );
		}	
	}
	/* ----------------------------------------------------------------------------------- */

?>