<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de tallas */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaTallas( $dbh ){
		//Devuelve la lista de tallas de productos
		$q = "Select s.id, s.name as name, s.unit as unidad, c.id as cid, c.name as cname 
		from sizes s, categories c where s.category_id = c.id order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaTallasCategoria( $dbh, $id_categoria ){
		//Devuelve la lista de tallas de productos asociadas a una categoría
		$q = "Select s.id as id, s.name as name, c.name as cname from sizes s, categories c 
		where s.category_id = c.id and s.category_id = $id_categoria order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTallaPorId( $dbh, $idt ){
		//Devuelve la lista de tallas de productos
		$q = "Select s.id, s.name as name, s.unit as unidad, c.id as idcategoria, c.name as cname 
		from sizes s, categories c where s.category_id = c.id and s.id = $idt";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerValoresTallaCero( $dbh ){
		//Devuelve los valores de la talla por defecto del sistema
		$q = "Select id, name from sizes where name = '0'";
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function productoAsociado( $dbh, $idtalla ){
		//Determina si existe un producto asociada a una talla
		$asociado = false;
		$q = "select * from size_product_detail where size_id = $idtalla";
		$nrows = mysqli_num_rows( mysqli_query ( $dbh, $q ) );
		
		if( $nrows > 0 ) $asociado = true;

		return $asociado;
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarTalla( $dbh, $valor, $unidad, $idcategoria ){
		//Agrega un registro de talla
		$q = "insert into sizes ( name, unit, category_id, created_at ) 
				values ( '$valor', '$unidad', $idcategoria, NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarTalla( $dbh, $idtalla, $nombre, $unidad, $categoria ){
		//Edita los datos de un registro de talla
		$q = "update sizes set name = '$nombre', unit='$unidad', category_id = $categoria, 
		updated_at = NOW() where id = $idtalla";
		
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarTalla( $dbh, $id ){
		//Elimina un registro de talla
		$q = "delete from sizes where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	//Editar datos de talla
	if( isset( $_GET["mtalla"] ) ){
		include( "bd.php" );
		$nombre = mysqli_real_escape_string( $dbh, $_POST["talla"] );
		$unidad = mysqli_real_escape_string( $dbh, $_POST["unidad"] );
	
		$r = modificarTalla( $dbh, $_POST["idtalla"], $nombre, $unidad, $_POST["categoria"] );
		
		if( ( $r != 0 ) && ( $r != "" ) ){
			header( "Location: ../sizes.php?size_edit_success" );
		}
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	
	//Invoca crear nuevo registro de talla
	if( isset( $_GET["nsize"] ) ){
		include( "bd.php" );
		
		$valor = mysqli_real_escape_string( $dbh, $_POST["talla"] );
		$unidad = mysqli_real_escape_string( $dbh, $_POST["unidad"] );
		$idt = agregarTalla( $dbh, $valor, $unidad, $_POST["categoria"] );
		echo "ID: ".$idt;
		if( ( $idt != 0 ) && ( $idt != "" ) ){
			header( "Location: ../sizes.php?addsize&success" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Invocación para eliminar talla
	if( isset( $_POST["id_elimtalla"] ) ){
		include( "bd.php" );	
		if( productoAsociado( $dbh, $_POST["id_elimtalla"] ) == true ){
			$res["exito"] = -1;
			$res["mje"] = "Debe eliminar productos relacionados con esta talla primero";
		}else{
			eliminarTalla( $dbh, $_POST["id_elimtalla"] );
			$res["exito"] = 1;
			$res["mje"] = "Talla eliminada con éxito";
		}
		echo json_encode( $res );
	}

?>