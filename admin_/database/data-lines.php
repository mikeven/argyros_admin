<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de líneas */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaLineas( $dbh ){
		//Devuelve la lista de líneas principales de productos
		$q = "Select id, name from plines order by name ASC";
		
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