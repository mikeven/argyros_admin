<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de baños */
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
	function agregarBano( $dbh, $nombre, $uname, $idmaterial ){
		//Agrega un registro de baño
		$q = "insert into treatments ( name, uname, material_id, created_at ) 
		values ( '$nombre', '$uname', $idmaterial, NOW() )";
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );	
	}
	/* ----------------------------------------------------------------------------------- */
	function editarBano( $dbh, $idb, $nombre, $idmaterial ){
		//Actualiza los datos de regristro de baño
		$q = "update treatments set name = '$nombre', material_id = $idmaterial, 
				updated_at = NOW() where id = $idb";
		
		$data = mysqli_query( $dbh, $q );
		return $data;	
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarBano( $dbh, $idb ){
		//Elimina un registro de baño
		$q = "delete from treatments where id = $idb";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function registrosAsociadosBano( $dbh, $idb ){
		//Determina si existe un registro de alguna tabla asociada a un baño
		//Tablas relacionadas: product_details

		return registroAsociadoTabla( $dbh, "product_details", "treatment_id", $idb );
	}
	/* ----------------------------------------------------------------------------------- */
	//Invoca a agregar un nuevo registro de baño
	if( isset( $_GET["ntreatment"] ) ){
		ini_set( 'display_errors', 1 );
		include( "bd.php" );
		include( "data-system.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );

		if( nombreDisponible( $dbh, "treatments", "name", $nombre, "", "" ) ){
			$uname = obtenerUname( $nombre );
			$idb = agregarBano( $dbh, $nombre, $uname, $_POST["material"] );
			if( ( $idb != 0 ) && ( $idb != "" ) ){
				header( "Location: ../treatments.php?agregar_bano-exito" );
			}
		}else{
			header( "Location: ../treatments.php?agregar_bano-nodisponible" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Invoca a editar un registro de baño
	if( isset( $_GET["mtreatment"] ) ){
		include( "bd.php" );
		include( "data-system.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$idb = $_POST["idbano"];

		if( nombreDisponible( $dbh, "treatments", "name", $nombre, $idb, "" ) ){
			$uname = obtenerUname( $nombre );
			$idr = editarBano( $dbh, $_POST["idbano"], $nombre, $_POST["material"] );
			if( ( $idr != 0 ) && ( $idr != "" ) ){
				header( "Location: ../treatments.php?editar_bano-exito" );
			}
		}
		else{
			header( "Location: ../treatments.php?editar_bano-nodisponible" );
		}	
	}
	
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	//Eliminar trabajo
	if( isset( $_POST["id_elim_bano"] ) ){
		include( "bd.php" );
		include( "data-system.php" );
		$idb = $_POST["id_elim_bano"];

		if( registrosAsociadosBano( $dbh, $idb ) == true ){
			$res["exito"] = -1;
			$res["mje"] = "Debe eliminar registros asociados al trabajo primero: detalle de producto";
		}else{
			$ret = eliminarBano( $dbh, $idb );
			$res["exito"] = $ret;
			$res["mje"] = "Baño eliminado con éxito";
		}
		echo json_encode( $res );
	}
?>