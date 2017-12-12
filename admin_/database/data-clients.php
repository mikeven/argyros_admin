<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de clientes */
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
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaGruposClientes( $dbh ){
		//Devuelve la lista de clientes
		$q = "select * from user_group order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerIdGrupoClientePorNombre( $dbh, $nombre ){
		//Devuelve el id del grupo de cliente dado su nombre
		$q = "select id from user_group where name = '$nombre'";

		$data = mysqli_fetch_array( mysqli_query( $dbh, $q ) );
		return $data["id"];
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerClientePorId( $dbh, $idc ){
		//Devuelve el registro de cliente dado por id
		$q = "Select u.id, u.first_name as nombre, u.last_name as apellido, u.email, u.phone,
		u.address as direccion, ug.name as grupo, c.name as pais, 
		date_format(u.created_at,'%d/%m/%Y') as fcreacion, 
		date_format(u.updated_at,'%d/%m/%Y') as fmodificacion, u.company as escompania, 
		u.company_name as ncompania, u.company_type as tcompania, u.city as ciudad, 
		u.reference as referencia from users u, user_group ug, role_user ru, countries c 
		where u.user_group_id = ug.id and ru.user_id = u.id and ru.role_id = 4 
		and u.country_code = c.code and u.id = $idc";

		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarGrupoUsuarioCliente( $dbh, $idu, $idgrupo ){
		//Actualiza el grupo al que pertenece un cliente
		$q = "update users set user_group_id = $idgrupo where id = $idu";
		$data = mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarGrupoCliente( $dbh, $grupo ){
		//Guarda el registro grupo de cliente
		$q = "insert into user_group ( name, variable_a, variable_b, variable_c, 
		variable_d, material, created_at ) values ( '$grupo[nombre]', $grupo[var_a], $grupo[var_b],  
		$grupo[var_c], $grupo[var_d], $grupo[material], NOW() )";
		
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Clientes */
	/* ----------------------------------------------------------------------------------- */
	
	//Invocación a crear nuevo registro de grupo de cliente
	if( isset( $_POST["form_ngrupo"] ) ){
		include( "bd.php" );	
		parse_str( $_POST["form_ngrupo"], $grupo );

		//print_r( $grupo );
		$grupo["nombre"] = mysqli_real_escape_string( $dbh, $grupo["nombre"] );
		$idg = agregarGrupoCliente( $dbh, $grupo );
		$grupo["idgrupo"] = $idg;

		if( ( $idg != 0 ) && ( $idg != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Registro exitoso";
			$res["reg"] = $grupo;
		}else{
			$res["exito"] = 0;
			$res["mje"] = "Error al registrar grupo";
			$res["reg"] = NULL;
		}

		echo json_encode( $res );
	}

	//Invocación para modificar el grupo al que pertenece un cliente
	if( isset( $_POST["grupo_valor"] ) ){
		include( "bd.php" );	
		$idg = obtenerIdGrupoClientePorNombre( $dbh, $_POST["grupo_valor"] );
		modificarGrupoUsuarioCliente( $dbh, $_POST["id_c"], $idg );
		
	}
	/* ----------------------------------------------------------------------------------- */

?>