<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de líneas */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaLineas( $dbh ){
		//Devuelve la lista de líneas principales de productos
		$q = "Select id, name, description from plines order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_l = obtenerListaRegistros( $data );
		return $lista_l;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerLineaPorId( $dbh, $id ){
		//Devuelve el registro de línea dado su id
		$q = "select id, name, description from plines where id = $id";
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosLinea( $dbh, $idl ){
		//Devuelve la lista de productos pertenecientes a una línea dado su id
		$q = "select p.id, p.code, p.description from products p, plines l, line_product lp 
		where lp.product_id = p.id and lp.line_id = $idl group by p.id";
		
		$data = mysqli_query( $dbh, $q );
		$lista_l = obtenerListaRegistros( $data );
		return $lista_l;
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarLinea( $dbh, $idl, $nombre, $uname, $descripcion ){
		//Edita los datos de línea de producto
		$q = "update plines set name = '$nombre', uname = '$uname', description = '$descripcion', 
				updated_at = NOW() where id = $idl";
				
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarLinea( $dbh, $nombre, $uname, $descripcion ){
		//Agrega un registro de línea de producto
		$q = "insert into plines ( name, uname, description, created_at ) 
				values ( '$nombre', '$uname', '$descripcion', NOW() )";
		echo $q;
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}	
	/* ----------------------------------------------------------------------------------- */
	function registrosAsociadosLinea( $dbh, $idsc ){
		//Determina si existe un registro de alguna tabla asociada a una línea
		//Tablas relacionadas: line_product

		return registroAsociadoTabla( $dbh, "line_product", "line_id", $idsc );
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarLinea( $dbh, $id ){
		//Elimina un registro de línea
		$q = "delete from plines where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Líneas */
	/* ----------------------------------------------------------------------------------- */
	
	//Registro de nueva línea
	if( isset( $_GET["nline"] ) ){
		
		include( "bd.php" );
		include( "data-system.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );

		if( nombreDisponible( $dbh, "plines", "name", $nombre, "", "" ) ){
			$uname = obtenerUname( $nombre );
			$descripcion = mysqli_real_escape_string( $dbh, $_POST["descripcion"] );
			$idl = agregarLinea( $dbh, $nombre, $uname, $descripcion );
		}else{
			header( "Location: ../lines.php?agregar_linea-nodisponible" );
		}

		if( ( $idl != 0 ) && ( $idl != "" ) ){
			header( "Location: ../lines.php?agregar_linea-exito" );
		}	
	} else {

	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["line-edit"] ) ){
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
			header( "Location: ../line-edit.php?id=".$idl."&edit&success" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Eliminar línea
	if( isset( $_POST["id_elimlinea"] ) ){
		include( "bd.php" );	
		include( "data-system.php" );
		
		if( registrosAsociadosLinea( $dbh, $_POST["id_elimlinea"] ) == true ){
			$res["exito"] = -1;
			$res["mje"] = "Debe eliminar productos asociados a la línea primero.";
		}else{
			eliminarLinea( $dbh, $_POST["id_elimlinea"] );
			$res["exito"] = 1;
			$res["mje"] = "Línea eliminada con éxito";
		}
		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */

?>