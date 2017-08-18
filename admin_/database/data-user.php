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
	function obtenerUsuarioPorId( $idu, $dbh ){
		$sql = "select * from usuario where idUsuario = $idu";
		$data_user = mysql_fetch_array( mysql_query ( $sql, $dbh ) );
		return $data_user;					
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarInicioSesion( $usuario, $dbh ){
		$adj_time = 96; // Tiempo para ajustar diferencia con hora de servidor ( minutos )
		$adjsql = "NOW() + INTERVAL $adj_time MINUTE";
		$query = "insert into ingreso values ('', $usuario[idUsuario], $adjsql )";
		$Rs = mysql_query ( $query, $dbh );
		return mysql_insert_id();	
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarUsuario( $usuario, $pass, $dbh ){
		$query = "insert into usuario (usuario, password) values ( '$usuario', '$pass' )";
		//echo $query;
		$Rs = mysql_query ( $query, $dbh );
		
		return mysql_insert_id();	
	}
	/* ----------------------------------------------------------------------------------- */
	function login( $email, $pass, $lnk ){
		session_start();
		$idresult = 0; 
		$sql = "select * from users where email = '$email' and password='$pass'";
		//echo $sql;
		$data = mysqli_query ( $lnk, $sql );
		$data_user = mysqli_fetch_array( $data );
		$nrows = mysqli_num_rows( $data );
		
		if( $nrows > 0 ){
			$_SESSION["login"] = 1;
			$_SESSION["user"] = $data_user;
			//registrarInicioSesion( $data_user, $dbh );
			$idresult = 1; 
		}
		
		return $idresult;
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarDatosUsuario( $usuario, $dbh ){
		//Actualiza los datos de cuenta de usuario
		$actualizado = 1;
		$q = "update usuario set usuario = '$usuario[usuario]', nombre = '$usuario[nombre]' 
		where idUsuario = $usuario[id]";
		//echo $q;
		
		mysql_query( $q, $dbh );
		if( mysql_affected_rows() == -1 ) $actualizado = 0;
		
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
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de usuarios */
	/* ----------------------------------------------------------------------------------- */
	//Inicio de sesión (asinc)
	if( isset( $_POST["login"] ) ){
		include( "bd.php" );
		$usuario = $_POST["email"];
		$pass = $_POST["password"];
		$return = login( $usuario, $pass, $dbh );
		
		echo $return;
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

	function obtenerListaBancos(){
		$bancos = array( "Banesco", "Mercantil", "Provincial", "BFC", "Venezuela", "BNC", 
					"BOD", "Exterior", "Venezolano de Crédito", "Bancaribe", "Bicentenario", 
					"Del Tesoro", "Caroní", "Banplus", "Bancrecer", "Plaza", "100% Banco", 
					"Sofitasa");
		return $bancos;
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
	//Modificar datos de usuario. Bloque: empresa
	if( isset( $_POST["mod_empresa"] ) ){
		
		include("bd.php");
		$usuario["id"] 			= $_POST["idUsuario"];
		$usuario["empresa"] 	= $_POST["empresa"];
		$usuario["subtitulo"] 	= $_POST["subtitulo"];
		$usuario["rif"] 		= $_POST["rif"];
		$usuario["email"] 		= $_POST["email"];
		$usuario["direccion1"] 	= $_POST["direccion1"];
		$usuario["direccion2"] 	= $_POST["direccion2"];
		$usuario["telefonos"] 	= $_POST["telefonos"];
		$usuario["vendedor"] 	= $_POST["vendedor"];
		
		$res["exito"] = modificarDatosEmpresa( $usuario, $dbh );
		
		if( $res["exito"] == 1 )
			$res["mje"] = "Datos de usuario modificados con éxito";
		else
			$res["mje"] = "Error al modificar datos de usuario";
		
		echo json_encode( $res );	
	}
	/* ----------------------------------------------------------------------------------- */
	//Modificar datos de usuario. Bloque: datos personales
	if( isset( $_POST["mod_usuario"] ) ){
		include( "bd.php" );
		$usuario["id"] 			= $_POST["idUsuario"];
		$usuario["usuario"] 	= $_POST["usuario"];
		$usuario["nombre"] 		= $_POST["nombre"];
		
		$res["exito"] = modificarDatosUsuario( $usuario, $dbh );
		
		if( $res["exito"] == 1 )
			$res["mje"] = "Datos de usuario modificados con éxito";
		else
			$res["mje"] = "Error al modificar datos de usuario";
		
		echo json_encode( $res );
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
	//Agregar cuenta bancaria (asinc)
	if( isset( $_POST["el_cuenta"] ) ){
		
		include("bd.php");
		$idc = $_POST["el_cuenta"];
		$rsl = eliminarCuentaBancaria( $dbh, $idc );
		
		if( ( $rsl == 1 ) ){
			$res["exito"] = 1;
			$res["mje"] = "Cuenta eliminada";
			$cuenta["id"] = $idc;
			$res["registro"] = $cuenta;
		}else{
			$res["exito"] = 0;
			$res["mje"] = "Error al eliminar cuenta";
		}
		echo json_encode( $res );	
	}

	/* ----------------------------------------------------------------------------------- */

?>