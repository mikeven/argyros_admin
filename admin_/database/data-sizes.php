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
		$q = "Select id, name from sizes where name = 'N/A'";
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosTalla( $dbh, $idt ){
		//Devuelve la lista de productos que tienen en su detalle registros con talla indicada en el id
		$q = "select p.id, p.name as nombre, p.code, p.description from products p 
		where p.id in (select product_id from product_details where id in 
			(select product_detail_id from size_product_detail where size_id = $idt ) 
		) order by p.name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_l = obtenerListaRegistros( $data );
		return $lista_l;
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
	function validarTalla( $dbh, $valor, $unidad, $categoria, $k1 ){
		//Chequea las condiciones para agregar/editar un registro de talla

		$disp = true;
		$param = "";

		if( $k1 != "" ) $param = "and id <> $k1";

		$q = "select * from sizes where name = '$valor' and unit = '$unidad' and 
				category_id = $categoria $param";

		echo $q;
		
		$resultado = mysqli_query( $dbh, $q );
		$nrows = mysqli_num_rows( $resultado );

		if( $nrows > 0 ) $disp = false;

		return $disp;
	}
	/* ----------------------------------------------------------------------------------- */
	//Editar datos de talla
	if( isset( $_GET["mtalla"] ) ){
		include( "bd.php" );
		$talla = mysqli_real_escape_string( $dbh, $_POST["talla"] );
		$unidad = mysqli_real_escape_string( $dbh, $_POST["unidad"] );
		$idtalla = $_POST["idtalla"];
		$categoria = $_POST["categoria"];

		if( validarTalla( $dbh, $talla, $unidad, $categoria, $idtalla ) == true ){
			$r = modificarTalla( $dbh, $idtalla, $nombre, $unidad, $categoria );
			if( ( $r != 0 ) && ( $r != "" ) ){
				header( "Location: ../sizes.php?editar_talla-exito" );
			}
		}else{
			header( "Location: ../sizes.php?editar_talla-nodisponible" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Invoca crear nuevo registro de talla
	if( isset( $_GET["nsize"] ) ){
		include( "bd.php" );
		
		$valor = mysqli_real_escape_string( $dbh, $_POST["talla"] );
		$unidad = mysqli_real_escape_string( $dbh, $_POST["unidad"] );
		$categoria =  $_POST["categoria"];

		if( validarTalla( $dbh, $valor, $unidad, $categoria, "" ) == true ){
			$idt = agregarTalla( $dbh, $valor, $unidad, $categoria );
			if( ( $idt != 0 ) && ( $idt != "" ) )
				header( "Location: ../sizes.php?agregar_talla-exito" );
		}else{
			header( "Location: ../sizes.php?agregar_talla-nodisponible" );
		}
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */

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