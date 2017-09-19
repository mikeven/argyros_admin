<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de materiales */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaMateriales( $dbh ){
		//Devuelve la lista de líneas principales de productos
		$q = "Select id, name from materials order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_l = obtenerListaRegistros( $data );
		return $lista_l;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerMaterialPorId( $dbh, $idm ){
		//Devuelve un regristro de material por id
		$q = "select id, name from materials where id = $idm";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarMaterial( $dbh, $nombre ){
		//Agrega un registro de material
		$q = "insert into materials ( name, created_at ) values ( '$nombre', NOW() )";
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );	
	}
	/* ----------------------------------------------------------------------------------- */
	function editarMaterial( $dbh, $idm, $nombre ){
		//Actualiza los datos de regristro de material
		$q = "update materials set name = '$nombre', updated_at = NOW() where id = $idm";
		
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	
	/* ----------------------------------------------------------------------------------- */
		 /* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	
	if( isset( $_GET["nmaterial"] ) ){
		include( "bd.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$idc = agregarMaterial( $dbh, $nombre );
		
		if( ( $idc != 0 ) && ( $idc != "" ) ){
			header( "Location: ../materials.php?addmaterial&success" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["mmaterial"] ) ){
		include( "bd.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$idc = editarMaterial( $dbh, $_POST["idmaterial"], $nombre );
		
		if( ( $idc != 0 ) && ( $idc != "" ) ){
			header( "Location: ../materials.php?editmaterial&success" );
		}
	}

	/* ----------------------------------------------------------------------------------- */

?>