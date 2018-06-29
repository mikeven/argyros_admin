<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de materiales */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaMateriales( $dbh ){
		//Devuelve la lista de líneas principales de productos
		$q = "Select id, name from materials order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_l = obtenerListaRegistros( $data );
		return $lista_l;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerMaterialPorId( $dbh, $idm ){
		//Devuelve un regristro de material por id
		$q = "select id, name from materials where id = $idm";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarMaterial( $dbh, $nombre, $uname ){
		//Agrega un registro de material
		$q = "insert into materials ( name, uname, created_at ) 
				values ( '$nombre', '$uname', NOW() )";

		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );	
	}
	/* ----------------------------------------------------------------------------------- */
	function editarMaterial( $dbh, $idm, $nombre, $uname ){
		//Actualiza los datos de regristro de material
		$q = "update materials set name = '$nombre', uname='$uname', updated_at = NOW() where id = $idm";
		
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosMateriales( $dbh, $idm ){
		//Devuelve la lista de productos pertenecientes a una línea dado su id
		$q = "select p.id, p.name as nombre, p.code, p.description 
		from products p where material_id = $idm";
		
		$data = mysqli_query( $dbh, $q );
		$lista_l = obtenerListaRegistros( $data );
		return $lista_l;
	}
	/* ----------------------------------------------------------------------------------- */
	function registrosAsociadosMaterial( $dbh, $idm ){
		//Determina si existe un registro de alguna tabla asociada a un material
		//Tablas relacionadas: treatments, products
		$a_bano 	= registroAsociadoTabla( $dbh, "treatments", "material_id", $idm );
		$a_prod 	= registroAsociadoTabla( $dbh, "products", "material_id", $idm );

		if( ( $a_bano == false ) && ( $a_prod == false ) )
			$asociado = false;
		else
			$asociado = true;

		return $asociado;
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarMaterial( $dbh, $id ){
		//Elimina un registro de material
		$q = "delete from materials where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	//Agregar material
	if( isset( $_GET["nmaterial"] ) ){
		include( "bd.php" );
		include( "data-system.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );

		if( nombreDisponible( $dbh, "materials", "name", $nombre, "", "" ) ){
			$uname = obtenerUname( $nombre );
			$idc = agregarMaterial( $dbh, $nombre, $uname );
		}else{
			header( "Location: ../materials.php?agregar_material-nodisponible" );
		}
		
		if( ( $idc != 0 ) && ( $idc != "" ) ){
			header( "Location: ../materials.php?agregar_material-exito" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Modificar material
	if( isset( $_GET["mmaterial"] ) ){
		
		include( "bd.php" );
		include( "data-system.php" );

		$idm = $_POST["idmaterial"];
		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );

		if( nombreDisponible( $dbh, "materials", "name", $nombre, $idm, "" ) ){
			$uname = obtenerUname( $nombre );
			$idc = editarMaterial( $dbh, $idm, $nombre, $uname );
		}else{
			header( "Location: ../materials.php?editar_material-nodisponible" );
		}
		
		if( ( $idc != 0 ) && ( $idc != "" ) ){
			header( "Location: ../materials.php?edit_material-exito" );
		}
	}

	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
		 /* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	//Eliminar material
	if( isset( $_POST["id_elim_material"] ) ){
		include( "bd.php" );
		include( "data-system.php" );

		if( registrosAsociadosMaterial( $dbh, $_POST["id_elim_material"] ) == true ){
			$res["exito"] = -1;
			$res["mje"] = "Debe eliminar registros asociados al material primero: productos, baños";
		}else{
			eliminarMaterial( $dbh, $_POST["id_elim_material"] );
			$res["exito"] = 1;
			$res["mje"] = "Línea eliminada con éxito";
		}
		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */

?>