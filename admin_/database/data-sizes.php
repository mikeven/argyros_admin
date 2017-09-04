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
	function obtenerListaTallasCategoria( $dbh, $id_categoria ){
		//Devuelve la lista de tallas de productos asociadas a una categoría
		$q = "Select s.id as id, s.name as name, c.name as cname from sizes s, categories c 
		where s.category_id = c.id and s.category_id = $id_categoria order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerValoresTallaCero( $dbh ){
		//Devuelve los valores de la talla por defecto del sistema
		$q = "Select id, name from sizes where name = '0'";
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	
	//I
	if( isset( $_GET[""] ) ){
		
	}else {};
	/* ----------------------------------------------------------------------------------- */

?>