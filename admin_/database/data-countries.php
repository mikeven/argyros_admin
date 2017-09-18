<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de países */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
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
	/* Solicitudes asíncronas al servidor para procesar información de Países */
	/* ----------------------------------------------------------------------------------- */
	
	//Editar condición país productor
	if( isset( $_POST["act_pprod"] ) ){
		include( "bd.php" );
		$idp = $_POST["act_pprod"];
		
		$estado = obtenerEstadoActualizablePaisProductor( $dbh, $idp );
		actualizarPaisProductor( $dbh, $idp, $estado );
		echo $estado; 
	}
	/* ----------------------------------------------------------------------------------- */

?>