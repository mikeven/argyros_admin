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
	function editarMaterial( $dbh, $idm, $nombre ){
		//Actualiza los datos de regristro de material
		$q = "update materials set name = '$nombre', updated_at = NOW() where id = $idm";
		
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerUname( $name ){
		//Devuelve el uname de nombre de registro
		$name = str_replace( "á", "a", $name );
		$name = str_replace( "é", "e", $name );
		$name = str_replace( "í", "i", $name );
		$name = str_replace( "ó", "o", $name );
		$name = str_replace( "ú", "u", $name );
		$name = str_replace( "ñ", "n", $name );

		return strtolower( str_replace( " ", "", $name) );
	}
	/* ----------------------------------------------------------------------------------- */
	function registroAsociadoTabla( $dbh, $tabla, $campo, $valor ){
		//Determina si existe un registro asociado a una tabla
		$asociado = false;
		$q = "select * from $tabla where $campo = $valor";
		$nrows = mysqli_num_rows( mysqli_query ( $dbh, $q ) );
		
		if( $nrows > 0 ) $asociado = true;

		return $asociado;
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
	function nombreDisponible( $dbh, $table, $campo, $valor, $k1, $k2 ){
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
	function eliminarMaterial( $dbh, $id ){
		//Elimina un registro de material
		$q = "delete from materials where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	//Agregar material
	if( isset( $_GET["nmaterial"] ) ){
		include( "bd.php" );
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
		$idm = $_POST["idmaterial"];
		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );

		if( nombreDisponible( $dbh, "materials", "name", $nombre, $idm, "" ) ){
			$idc = editarMaterial( $dbh, $_POST["idmaterial"], $nombre );
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