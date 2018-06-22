<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de usuarios */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function ultimaActualizacion( $dbh, $idu ){
		//Retorna la fecha donde se realizó la última actualización de documentos de usuario
		$q = "select date_format(ultima_act_doc,'%Y-%m-%d') as fecha from usuario 
			where idUsuario = $idu";
		$data = mysql_fetch_array( mysql_query ( $q, $dbh ) );
		return $data["fecha"];
	}
	/* ----------------------------------------------------------------------------------- */
	function chequearActualizacion( $dbh, $hoy, $idu ){
		//Chequea el estado de actualización de documentos e invoca a su revisión
		include("bd/data-documento.php");
		$fult_act_docs = ultimaActualizacion( $dbh, $idu );
		
		if( $fult_act_docs < $hoy ){
			revisarEstadoDocumentos( $dbh, $idu, $hoy );
		}		
	}
	/* ----------------------------------------------------------------------------------- */
	function checkSession( $page ){
		if( isset( $_SESSION["login"] ) ){
			if( $page == "index" ) 
				echo "<script> window.location = 'home.php'</script>";
		}else{
			if( $page == "" )
				echo "<script> window.location = 'index.php'</script>";		
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function usuarioValido( $usuario, $dbh ){
		$valido = true;

		$q = "select usuario from usuario where usuario = '$usuario'";
		$data_user = mysql_fetch_array( mysql_query ( $q, $dbh ) );
		if( $usuario == $data_user["usuario"] ) $valido = false;

		return $valido;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaUsuarios( $dbh ){
		//Devuelve la lista de usuarios
		$q = "Select u.id, u.first_name as nombre, u.last_name as apellido, u.email, 
		u.phone, r.id as idrol, r.name as rol, r.display_name as nombre_rol, 
		r.description as descripcion_rol, date_format(u.created_at,'%d/%m/%Y') as fcreacion 
		from users u, role_user ru, roles r where ru.user_id = u.id and ru.role_id 
		and ru.role_id = r.id order by nombre ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaRoles( $dbh ){
		//Devuelve la lista de roles
		$q = "Select id, name as nombre, description, display_name as nombre_rol 
				from roles order by nombre ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerUsuarioPorId( $dbh, $idu ){
		$sql = "select * from users where id = $idu";
		$data_user = mysqli_fetch_array( mysqli_query ( $dbh, $sql ) );
		return $data_user;					
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarInicioSesion( $usuario, $dbh ){
		$adj_time = 96; // Tiempo para ajustar diferencia con hora de servidor ( minutos )
		$adjsql = "NOW() + INTERVAL $adj_time MINUTE";
		$query = "insert into ingreso values ('', $usuario[idUsuario], $adjsql )";
		$Rs = mysqli_query ( $dbh, $query );
		return mysqli_insert_id( $dbh );	
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarUsuario( $usuario, $pass, $dbh ){
		$query = "insert into usuario (usuario, password) values ( '$usuario', '$pass' )";
		//echo $query;
		$Rs = mysql_query ( $dbh, $query );
		
		return mysql_insert_id();	
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarRolUsuario( $dbh, $usuario ){
		//Modifica el rol de un usuario dado su id
		$q = "update role_user set role_id = $usuario[idrol] where user_id = $usuario[id]";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerRolUsuario( $dbh, $idu ){
		//Devuelve el rol de un usuario dado su id
		$q = "select r.id as id, r.name nombre, r.display_name as rol, r.description as descripcion 
		from roles r, role_user ru where ru.role_id = r.id and ru.user_id = $idu";
		$data_user = mysqli_fetch_array( mysqli_query( $dbh, $q ) );

		return $data_user;
	}
	/* ----------------------------------------------------------------------------------- */
	function esAdministrador( $dbh, $idu ){
		//Determina si un usuario, dado su id, es administrador
		$admin = false;
		$rol = obtenerRolUsuario( $dbh, $idu );
		if ( $rol["id"] == 1 || $rol["id"] == 2 )
			$admin = true;

		return $admin;
	}
	/* ----------------------------------------------------------------------------------- */
	function iniciarSesion( $email, $pass, $lnk ){
		session_start();
		$idresult = 0; 
		$sql = "select * from users where email = '$email' and password='$pass'";
		//echo $sql;
		$data = mysqli_query( $lnk, $sql );
		$data_user = mysqli_fetch_array( $data );
		$nrows = mysqli_num_rows( $data );
		
		if( $nrows > 0 ){
			if( esAdministrador ( $lnk, $data_user["id"] ) ){
				$_SESSION["login"] = 1;
				$_SESSION["user"] = $data_user;
				//registrarInicioSesion( $data_user, $dbh );
				$idresult = 1;
			}else{
				$idresult = -1;	
			}
		}
		
		return $idresult;
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarDatosUsuario( $dbh, $usuario ){
		//Actualiza los datos de usuario administrador
		$actualizado = 1;
		$q = "update users set first_name = '$usuario[nombre]', 
		last_name = '$usuario[apellido]', email = '$usuario[email]' where id = $usuario[id]";
		echo $q;

		mysqli_query( $dbh, $q );
		if( mysqli_affected_rows( $dbh ) == -1 ) $actualizado = 0;
		
		return $actualizado;
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarPassword( $usuario, $dbh ){
		//Actualiza el valor de contraseña de usuario
		$actualizado = 1;
		$q = "update usuario set password = '$usuario[password]' where idUsuario = $usuario[id]";
		//echo $q;
		
		$data = mysql_query( $q, $dbh );
		
		if( mysql_affected_rows() != 1 )
			$actualizado = 0;
		
		return $actualizado;
	}
	/* ----------------------------------------------------------------------------------- */
	function emailDisponible( $dbh, $table, $campo, $valor, $k1, $k2 ){
		//Devuelve si un nombre está disponible especificando tabla y campo a consultar
		//k1: indica id excluyente directo, usado para excluir resultado de búsqueda en la misma tabla
		//k2: indica id excluyente indirecto, usado para excluir resultado de búsqueda
		
		$disp = true;
		$param = "";

		if( $k1 != "" ) $param = "and id <> $k1";

		$q = "select * from $table where $campo = '$valor' $param";
		
		$resultado = mysqli_query ( $dbh, $q );
		$nrows = mysqli_num_rows( $resultado );
		
		if( $nrows > 0 ) $disp = false;

		if( $k2 != "" )
			$disp = chequeoExclusionIndirecta( $dbh, $resultado, $table, $k2 );

		return $disp;
	}
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de usuarios */
	/* ----------------------------------------------------------------------------------- */
	//Inicio de sesión (asinc)
	if( isset( $_POST["login"] ) ){
		include( "bd.php" );
		$usuario = $_POST["email"];
		$pass = $_POST["password"];

		$return = iniciarSesion( $usuario, $pass, $dbh );

		if( $return == 1 ){
			$res["exito"] = $return;
			$res["mje"] = "Registro exitoso";
		}
		if( $return == 0 ){
			$res["exito"] = 0;
			$res["mje"] = "Verifica usuario y contraseña";
		}
		if( $return == -1 ){
			$res["exito"] = -1;
			$res["mje"] = "Usuario no válido para ingreso";
		}

		echo json_encode( $res );

	}
	/* ----------------------------------------------------------------------------------- */
	//Registro de nuevo usuario (asinc)
	if( isset( $_POST["registro"] ) ){
		include( "bd.php" );
		$usuario = $_POST["rusuario"];
		$pass = $_POST["rpassw1"];
		
		if( usuarioValido( $usuario, $dbh ) == true ){
			$return = registrarUsuario($usuario, $pass, $dbh );
			//echo $return;
			if( $return =! 0 ){
				$res["exito"] = 1;
				$res["mje"] = "El usuario ha sido registrado con éxito";
			}else{
				$res["exito"] = 0;
				$res["mje"] = "Error al registrar usuario";
			}
		}else{
			$res["exito"] = 0;
			$res["mje"] = "Este usuario ya existe";
		}

		echo json_encode( $res );
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes POST al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */

	//Modificar datos de usuario
	if( isset( $_GET["musuario"] ) ){
		ini_set( 'display_errors', 1 );
		include( "bd.php" );

		$idu 					= $_POST["idusuario"];
		$usuario["nombre"] 		= mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$usuario["apellido"] 	= mysqli_real_escape_string( $dbh, $_POST["apellido"] );
		$usuario["email"] 		= mysqli_real_escape_string( $dbh, $_POST["email"] );		 

		$usuario["id"] = $idu; $usuario["idrol"] = $_POST["rol"];

		if( emailDisponible( $dbh, "users", "email", $usuario["email"], $idu, "" ) ){
			$idr = modificarDatosUsuario( $dbh, $usuario );
			modificarRolUsuario( $dbh, $usuario );
		}else{
			header( "Location: ../user-edit.php?id=$idu&editar_usuario-emailnodisponible" );
		}
		
		if( ( $idr != 0 ) && ( $idr != "" ) && ( $idr != -1 ) ){
			header( "Location: ../user-edit.php?id=$idu&edit_usuario-exito" );
		}
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	//Inicio de sesión
	if( isset( $_SESSION["login"] ) ){
		$idu = $_SESSION["user"]["id"];
	}else $idu = NULL;
	
	/* ----------------------------------------------------------------------------------- */
	//Cierre de sesión
	if( isset( $_GET["logout"] ) ){
		//include( "bd.php" );
		unset( $_SESSION["login"] );
		echo "<script> window.location = 'index.php'</script>";		
	}	
	/* ----------------------------------------------------------------------------------- */
	//Modificar datos de usuario. Bloque: contraseña (asinc)
	if( isset( $_POST["mod_passw"] ) ){
		
		include("bd.php");
		$usuario["id"] 		= $_POST["idUsuario"];
		$usuario["password"] 	= $_POST["password1"];
		
		$res["exito"] = modificarPassword( $usuario, $dbh );
		
		if( $res["exito"] == 1 )
			$res["mje"] = "Contraseña actualizada con éxito";
		else
			$res["mje"] = "Error al actualizar contraseña";
		
		echo json_encode( $res );	
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["id_cambio_rol"] ) ){
		
		include("bd.php");
		$usuario["id"] 		= $_POST["id_usuario"];
		$usuario["idrol"] 	= $_POST["id_cambio_rol"];
		
		$res["exito"] = modificarRolUsuario( $dbh, $usuario );
		
		if( $res["exito"] == 1 ){
			$res["mje"] = "Rol de usuario actualizado con éxito";
			$res["idrol"] = $usuario["idrol"];
		}
		else
			$res["mje"] = "Error al actualizar rol de usuario";
		
		echo json_encode( $res );	
	}

?>