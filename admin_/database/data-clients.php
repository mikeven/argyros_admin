<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de tallas */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaClientes( $dbh ){
		//Devuelve la lista de clientes
		$q = "Select u.id, u.first_name as nombre, u.last_name as apellido, u.email, u.phone,  
		ug.name as grupo, c.name as pais, date_format(u.created_at,'%d/%m/%Y') as fcreacion  
		from users u, user_group ug, role_user ru, countries c 
		where u.user_group_id = ug.id and ru.user_id = u.id and ru.role_id = 4 
		and u.country_code = c.code order by nombre ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}

	function obtenerListaGruposClientes( $dbh ){
		//Devuelve la lista de clientes
		$q = "select * from user_group order by name ASC";
		
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