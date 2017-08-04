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
	/* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	
	//I
	if( isset( $_GET[""] ) ){
		
	}else {};
	/* ----------------------------------------------------------------------------------- */

?>