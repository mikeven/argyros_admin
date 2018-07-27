<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de clientes */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaClientes( $dbh ){
		//Devuelve la lista de clientes
		$q = "Select c.id, c.first_name as nombre, c.last_name as apellido, c.email, c.phone,  
		ug.name as grupo, p.name as pais, c.city as ciudad, c.verified as verificado, 
		date_format(c.created_at,'%d/%m/%Y') as fcreacion, blocked as bloqueado 
		from clients c, client_group ug, countries p 
		where c.client_group_id = ug.id and c.country_id = p.id order by nombre ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaGruposClientes( $dbh ){
		//Devuelve la lista de clientes
		$q = "select * from client_group order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerIdGrupoClientePorNombre( $dbh, $nombre ){
		//Devuelve el id del grupo de cliente dado su nombre
		$nombre = addslashes( $nombre );
		$q = "select id from client_group where name = '$nombre'";

		$data = mysqli_fetch_array( mysqli_query( $dbh, $q ) );
		return $data["id"];
	}
	/* ----------------------------------------------------------------------------------- */
	function editarGrupoCliente( $dbh, $grupo ){
		//Modifica los datos de un registro de grupo de cliente
		$q = "update client_group set name = '$grupo[nombre]', variable_a = $grupo[var_a], 
		variable_b = $grupo[var_b], variable_c = $grupo[var_c], variable_d = $grupo[var_d], 
		material = $grupo[material] where id = $grupo[id]";

		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarGrupoCliente( $dbh, $id ){
		//Elimina un registro de grupo de cliente
		$q = "delete from client_group where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarCliente( $dbh, $id ){
		//Elimina un registro de cliente
		$q = "delete from clients where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function bloquearCliente( $dbh, $idc, $accion ){
		//Elimina un registro de cliente
		$q = "update clients set blocked = $accion where id = $idc";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerGrupoPorId( $dbh, $idg ){
		//Devuelve el registro del grupo dado por
		
		$q = "select id, name, variable_a, variable_b, variable_c, variable_d, material 
		from client_group where id = $idg";

		$data = mysqli_fetch_array( mysqli_query( $dbh, $q ) );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerClientePorId( $dbh, $idc ){
		//Devuelve el registro de cliente dado por id
		$q = "Select c.id, c.first_name as nombre, c.last_name as apellido, c.email, 
		c.phone as telefono, c.address as direccion, cg.name as grupo, p.name as pais, p.id as idpais, 
		date_format(c.created_at,'%d/%m/%Y') as fcreacion, 
		date_format(c.updated_at,'%d/%m/%Y') as fmodificacion, c.company as escompania, 
		c.company_name as ncompania, c.company_type as tcompania, c.city as ciudad, 
		c.blocked as bloqueado from clients c, client_group cg, countries p 
		where c.client_group_id = cg.id and c.country_id = p.id and c.id = $idc";

		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function editarCliente( $dbh, $cliente ){
		//Modifica los datos de un cliente

		$q = "update clients set first_name = '$cliente[nombre]', last_name = '$cliente[apellido]', 
		email = '$cliente[email]', address='$cliente[direccion]', phone='$cliente[telefono]', 
		country_id = $cliente[pais], city = '$cliente[ciudad]', client_group_id = $cliente[grupo] 
		where id = $cliente[id]";

		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarGrupoUsuarioCliente( $dbh, $idu, $idgrupo ){
		//Actualiza el grupo al que pertenece un cliente
		$q = "update clients set client_group_id = $idgrupo where id = $idu";

		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarGrupoCliente( $dbh, $grupo ){
		//Guarda el registro grupo de cliente
		$q = "insert into client_group ( name, variable_a, variable_b, variable_c, 
		variable_d, material, created_at ) values ( '$grupo[nombre]', $grupo[var_a], $grupo[var_b],  
		$grupo[var_c], $grupo[var_d], $grupo[material], NOW() )";
		
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function clienteAsociado( $dbh, $idgrupo ){
		//Determina si un perfil de cliente tiene registros asociados
		$asociado = false;
		$q = "select * from clients where client_group_id = $idgrupo";
		$nrows = mysqli_num_rows( mysqli_query ( $dbh, $q ) );
		
		if( $nrows > 0 ) $asociado = true;

		return $asociado;
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes POST al servidor para procesar información de Clientes */
	/* ----------------------------------------------------------------------------------- */

	if( isset( $_GET["mclientgroup"] ) ){
		include( "bd.php" );
		$grupo["id"] = $_POST["idgrupocliente"];
		$grupo["nombre"] = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$grupo["var_a"] = mysqli_real_escape_string( $dbh, $_POST["var_a"] );
		$grupo["var_b"] = mysqli_real_escape_string( $dbh, $_POST["var_b"] );
		$grupo["var_c"] = mysqli_real_escape_string( $dbh, $_POST["var_c"] );
		$grupo["var_d"] = mysqli_real_escape_string( $dbh, $_POST["var_d"] );
		$grupo["material"] = mysqli_real_escape_string( $dbh, $_POST["material"] );

		$idg = editarGrupoCliente( $dbh, $grupo );
		
		if( ( $idg != 0 ) && ( $idg!= "" ) ) {
			header( "Location: ../client-groups-edit.php?id=$grupo[id]&editgroupsuccess" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Modificar datos de cliente
	if( isset( $_GET["mcliente"] ) ){

		include( "bd.php" );

		$cliente["id"] 			= $_POST["idcliente"];
		$cliente["nombre"] 		= mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$cliente["apellido"] 	= mysqli_real_escape_string( $dbh, $_POST["apellido"] );
		$cliente["email"] 		= mysqli_real_escape_string( $dbh, $_POST["email"] );
		$cliente["direccion"] 	= mysqli_real_escape_string( $dbh, $_POST["direccion"] );
		$cliente["telefono"] 	= mysqli_real_escape_string( $dbh, $_POST["telefono"] );
		$cliente["pais"] 		= $_POST["pais"];
		$cliente["ciudad"] 		= mysqli_real_escape_string( $dbh, $_POST["ciudad"] );
		$cliente["grupo"] 		= mysqli_real_escape_string( $dbh, $_POST["grupo"] );

		$idc = editarCliente( $dbh, $cliente );
		if( ( $idc != 0 ) && ( $idc != "" ) ){
			header( "Location: ../client-edit.php?id=$cliente[id]&editar_usuario-exito" );
		}		
		
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
	/* ----------------------------------------------------------------------------------- */
	//Invocación para modificar el grupo al que pertenece un cliente
	if( isset( $_POST["grupo_valor"] ) ){
		include( "bd.php" );	
	
		$idg = modificarGrupoUsuarioCliente( $dbh, $_POST["id_c"], $_POST["grupo_valor"] );
		if( ( $idg != 0 ) && ( $idg != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Cambio de grupo de cliente con éxito";
		}else{
			$res["exito"] = 0;
			$res["mje"] = "Error al editar grupo de usuario";
		}
		
		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	//Invocación para eliminar un grupo de clientes, perfil de cliente
	if( isset( $_POST["id_elimg"] ) ){
		include( "bd.php" );	
		if( clienteAsociado( $dbh, $_POST["id_elimg"] ) == true ){
			$res["exito"] = -1;
			$res["mje"] = "Debe eliminar clientes asociados al grupo primero";
		}else{
			eliminarGrupoCliente( $dbh, $_POST["id_elimg"] );
			$res["exito"] = 1;
			$res["mje"] = "Perfil eliminado con éxito";
		}
		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["id_elim_cl"] ) ){
		include( "bd.php" );	
		
		$res["exito"] = eliminarCliente( $dbh, $_POST["id_elim_cl"] );
		
		if( $res["exito"] == 1 ){			
			$res["mje"] = "Cliente eliminado con éxito";
		}else{
			$res["mje"] = "Error al eliminar cliente";
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["id_bloq_c"] ) ){
		include( "bd.php" );	
		
		$res["exito"] = bloquearCliente( $dbh, $_POST["id_bloq_c"], $_POST["accion_b"] );
		
		if( $res["exito"] == 1 ){			
			$res["mje"] = "Cambios realizados con éxito";
		} else {
			$res["mje"] = "Error al modificar datos de cliente";
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
?>