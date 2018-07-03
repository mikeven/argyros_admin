<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de países */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	ini_set( 'display_errors', 1 );
	function ajustarDataManufactura( $lista ){
		$lista_a = array();
		foreach ( $lista as $p ) {
			if( $p["manufacture"] == 0 )
				$p["is_manufacture"] = "No";
			if( $p["manufacture"] == 1 )
				$p["is_manufacture"] = "Sí";
			$lista_a[] = $p;
		}
		return $lista_a;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaPaises( $dbh ){
		//Devuelve la lista de países registrados
		$q = "Select id, name, manufacture from countries order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return ajustarDataManufactura( $lista_c );	
	}
	/* ----------------------------------------------------------------------------------- */
	function registrosAsociadosPais( $dbh, $idp ){
		//Determina si existe un registro de alguna tabla asociada a un país
		//Tablas relacionadas: products

		return registroAsociadoTabla( $dbh, "products", "country_id", $idp );
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarPais( $dbh, $nombre, $productor ){
		//Agrega un nuevo registro de país
		$q = "insert into countries ( name, code, manufacture, created_at ) 
		values ( '$nombre', 0, $productor, NOW() )";

		//echo $q;
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaPaisesProductores( $dbh ){
		//Devuelve la lista de países registrados identificados como productores
		$q = "Select id, code, name, manufacture from countries where manufacture = 1 order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_p = obtenerListaRegistros( $data );
		return $lista_p;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerEstadoActualizablePaisProductor( $dbh, $idp ){
		//Devuelve el estado opuesto al actual de país productor para tomar este valor.
		//Si estado = 1, devuelve 0. Si estado = 0, devuelve 1 
		$estado = 1;
		$q = "select manufacture from countries where id = $idp";
		
		$data = mysqli_fetch_array( mysqli_query( $dbh, $q ) );
		$status = $data["manufacture"];
		if( $status == 1 ) $estado = 0;
		
		return $estado;	
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarPaisProductor( $dbh, $idp, $estado ){
		$q = "update countries set manufacture = $estado, updated_at = NOW() where id = $idp";
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarPais( $dbh, $idp ){
		//Elimina un registro de país
		$q = "delete from countries where id = $idp";
		return mysqli_query( $dbh, $q );
	}

	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	/* ----------------------------------------------------------------------------------- */
	//Agregar trabajo
	if( isset( $_GET["npais"] ) ){
		include( "bd.php" );
		include( "data-system.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$productor = $_POST["productor"];

		if( nombreDisponible( $dbh, "countries", "name", $nombre, "", "" ) ){
			$idp = agregarPais( $dbh, $nombre, $productor );
		}else{
			header( "Location: ../countries.php?agregar_pais-nodisponible" );
		}
		
		if( ( $idp != 0 ) && ( $idp != "" ) ){
			header( "Location: ../countries.php?agregar_pais-exito" );
		}
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Países */
	/* ----------------------------------------------------------------------------------- */
	
	//Editar condición país productor
	if( isset( $_POST["act_pprod"] ) ){
		include( "bd.php" );
		$idp = $_POST["act_pprod"];
		
		$estado = obtenerEstadoActualizablePaisProductor( $dbh, $idp );
		$r_edo["rslt"] = actualizarPaisProductor( $dbh, $idp, $estado );
		$r_edo["estado"] = $estado;
		
		echo json_encode( $r_edo );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["id_elim_pais"] ) ){
		include( "bd.php" );
		include( "data-system.php" );
		$idp = $_POST["id_elim_pais"];

		if( registrosAsociadosPais( $dbh, $idp ) == true ){
			$res["exito"] = -1;
			$res["mje"] = "Debe eliminar registros asociados al país primero: productos";
		}else{
			$ret = eliminarPais( $dbh, $idp );
			$res["exito"] = $ret;
			$res["mje"] = "País eliminado con éxito";
		}
		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */

?>