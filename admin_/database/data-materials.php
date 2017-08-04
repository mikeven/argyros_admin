<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de líneas */
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
	/* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	//Inicio de sesión
	if( isset( $_SESSION["login"] ) ){
		$idu = $_SESSION["user"]["id"];
	}else $idu = NULL;
	/* ----------------------------------------------------------------------------------- */

?>