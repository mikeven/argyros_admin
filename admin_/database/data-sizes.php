<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de tallas */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaTallas( $dbh ){
		//Devuelve la lista de tallas de productos
		$q = "Select s.id, s.name as name, c.name as cname from sizes s, categories c 
		where s.category_id = c.id order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	
	//I
	if( isset( $_GET[""] ) ){
		
	}else {};
	/* ----------------------------------------------------------------------------------- */

?>