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
	/* Solicitudes asíncronas al servidor para procesar información de Países */
	/* ----------------------------------------------------------------------------------- */
	
	//I
	if( isset( $_GET[""] ) ){
		
	}else {};
	/* ----------------------------------------------------------------------------------- */

?>