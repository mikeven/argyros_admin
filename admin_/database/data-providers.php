<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de proveedores */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaProveedores( $dbh ){
		//Devuelve la lista de todos los proveedores
		$q = "Select id, name as nombre, number as numero from providers order by number ASC";
	
		$data = mysqli_query( $dbh, $q );
		return obtenerListaRegistros( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProveedorPorId( $dbh, $id ){
		//Devuelve el registro de proveedor dado su id
		$q = "select id, name, number from providers where id = $id";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarProveedor( $dbh, $id, $nombre, $numero ){
		//Edita los datos de proveedor
		$q = "update providers set name = '$nombre', name = '$nombre', description = '$descripcion', 
				updated_at = NOW() where id = $id";
				
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarProveedor( $dbh, $nombre, $numero ){
		//Agrega un registro de proveedor
		$q = "insert into providers ( name, number, created_at ) values ( '$nombre', '$numero', NOW() )";
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}	
	/* ----------------------------------------------------------------------------------- */
	function eliminarProveedor( $dbh, $id ){
		//Elimina un registro de proveedor
		$q = "delete from providers where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function tieneProductosAsociados( $dbh, $idprv ){
		// Devuelve verdadero si un id de proveedor posee productos asociados
		$asociado = false;
		$q = "select count(*) as nregs from products where 
				provider_id1 = $idprv or provider_id2 = $idprv or provider_id3 = $idprv";

		$data = mysqli_fetch_array( mysqli_query( $dbh, $q ) );
		if( $data["nregs"] > 0 )
			$asociado = true;

		return $asociado;
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes vía POST al servidor para procesar información de proveedores */
	/* ----------------------------------------------------------------------------------- */
	
	//Registro de nueva proveedor
	if( isset( $_GET["nprovider"] ) ){
		
		include( "bd.php" );
		include( "data-system.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$numero = mysqli_real_escape_string( $dbh, $_POST["numero"] );

		if( nombreDisponible( $dbh, "providers", "number", $numero, "", "" ) ){
			$idp = agregarProveedor( $dbh, $nombre, $numero );
		}else{
			header( "Location: ../providers.php?agregar_proveedor-nodisponible" );
		}

		if( ( $idp != 0 ) && ( $idp != "" ) ){
			header( "Location: ../providers.php?agregar_proveedor-exito" );
		}	
	} else {

	}
	/* ----------------------------------------------------------------------------------- */
	//Modificar datos de proveedor
	if( isset( $_GET["edit_provider"] ) ){
		include( "bd.php" );
		include( "data-system.php" );

		$idl = $_POST["idlinea"];
		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		
		if( nombreDisponible( $dbh, "plines", "name", $nombre, $idl, "" ) ){
			$uname = obtenerUname( $nombre );
			$descripcion = mysqli_real_escape_string( $dbh, $_POST["descripcion"] );
			$r = modificarLinea( $dbh, $idl, $nombre, $uname, $descripcion );
		}else{
			header( "Location: ../line-edit.php?id=$idl&editar_linea-nodisponible" );
		}
		if( ( $r != 0 ) && ( $r != "" ) ){
			header( "Location: ../line-edit.php?id=".$idl."&editar_linea-exito" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de proveedores */
	/* ----------------------------------------------------------------------------------- */
	//Eliminar proveedor
	if( isset( $_POST["elimprovider"] ) ){
		include( "bd.php" );	
		
		if( tieneProductosAsociados( $dbh, $_POST["elimprovider"] ) == true ){
			$res["exito"] = -1;
			$res["mje"] = "Debe eliminar productos asociados al proveedor primero";
		}else{
			eliminarProveedor( $dbh, $_POST["elimprovider"] );
			$res["exito"] = 1;
			$res["mje"] = "Proveedor eliminado con éxito";
		}

		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
?>