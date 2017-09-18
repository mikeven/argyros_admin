<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de líneas */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaBanos( $dbh ){
		//Devuelve la lista de baños
		$q = "Select t.id as id, t.name as name, m.name as material 
		from treatments t, materials m where t.material_id = m.id order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_b = obtenerListaRegistros( $data );
		return $lista_b;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaBanosMaterial( $dbh, $id_material ){
		//Devuelve la lista de baños asociados a un material
		$q = "Select id, name from treatments where material_id = $id_material order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_b = obtenerListaRegistros( $data );
		return $lista_b;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerBanoPorId( $dbh, $idb ){
		//Devuelve un registro de baño dado su id

		$q = "select t.id as id, t.name as nombre, m.id as idmaterial, m.name as material 
		from treatments t, materials m where t.material_id = m.id and t.id = $idb";
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );		
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarBano( $dbh, $nombre, $idmaterial ){
		//Agrega un registro de baño
		$q = "insert into treatments ( name, material_id, created_at ) 
		values ( '$nombre', $idmaterial, NOW() )";
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );	
	}
	/* ----------------------------------------------------------------------------------- */
	function editarBano( $dbh, $idb, $nombre, $idmaterial ){
		//Actualiza los datos de regristro de baño
		$q = "update treatments set name = '$nombre', material_id = $idmaterial, 
				updated_at = NOW() where id = $idb";
		echo $q;
		$data = mysqli_query( $dbh, $q );
		return $data;	
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	
	//Invoca a agregar un nuevo registro de baño
	if( isset( $_GET["ntreatment"] ) ){
		include( "bd.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$idb = agregarBano( $dbh, $nombre, $_POST["material"] );

		if( ( $idb != 0 ) && ( $idb != "" ) ){
			header( "Location: ../treatments.php?addtreatment&success" );
		}	
	}
	/* ----------------------------------------------------------------------------------- */
	//Invoca a editar un registro de baño
	if( isset( $_GET["mtreatment"] ) ){
		include( "bd.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$idb = editarBano( $dbh, $_POST["idbano"], $nombre, $_POST["material"] );

		if( ( $idb != 0 ) && ( $idb != "" ) ){
			header( "Location: ../treatments.php?addtreatment&success" );
		}	
	}
	/* ----------------------------------------------------------------------------------- */

?>