<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de categorías */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	ini_set( 'display_errors', 1 );
	function obtenerListaCategorias( $dbh ){
		//Devuelve la lista de categorías principales de productos
		$q = "Select id, name, uname from categories order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		$lista_c = filtrarNone( $lista_c, "id" );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarNone( $lista, $nid ){
		//Filtrar la categoría neutra del listado obtenido de BD
		$nlista = array();
		foreach ( $lista as $reg ) {
			if( $reg[$nid] != 0 ) $nlista[] = $reg;
		}

		return $nlista;
	}
	/* ----------------------------------------------------------------------------------- */
	function guardarCategoriasDestacadas( $dbh, $orden ){
		//Asigna el orden de las categorías destacadas

		$q0 = "update categories set home_order=0";
		$q1 = "update categories set home_order=1 where id = $orden[1]";
	
		$q2 = "update categories set home_order=2 where id = $orden[2]";
		$q3 = "update categories set home_order=3 where id = $orden[3]";
		$q4 = "update categories set home_order=4 where id = $orden[4]";

		$data = mysqli_query( $dbh, $q0 );
		$data = mysqli_query( $dbh, $q1 );
		$data = mysqli_query( $dbh, $q2 );
		$data = mysqli_query( $dbh, $q3 );
		$data = mysqli_query( $dbh, $q4 );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerCategoriasDestacadaPorOrden( $dbh, $orden ){
		//Devuelve el registro de categoría por su orden destacado
		$q = "select id, name, uname from categories where home_order = $orden";

		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerCategoriaPorId( $dbh, $id ){
		//Devuelve el registro de categoría por su id
		$q = "Select id, name from categories where id = $id";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerSubCategoriaPorId( $dbh, $id ){
		//Devuelve el registro de categoría por su id
		$q = "Select id, name, category_id as idcategoria from subcategories where id = $id";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaSubCategorias( $dbh ){
		//Devuelve la lista de categorías principales de productos
		$q = "Select s.id as idsc, s.name as name, c.id as idc, c.name as cname, s.uname as uname 
		from subcategories s, categories c where s.category_id = c.id order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		$lista_c = filtrarNone( $lista_c, "idsc" );

		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaSubCategoriasCategoria( $dbh, $idcateg ){
		//Devuelve la lista de subcategorías de una categoría padre
		$q = "select id, name from subcategories where category_id = $idcateg order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarCategoria( $dbh, $idcategoria, $nombre, $uname ){
		//Edita los datos de categoría principal
		$q = "update categories set name = '$nombre', uname = '$uname', updated_at = NOW() 
		where id = $idcategoria";

		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarSubCategoria( $dbh, $idsubcategoria, $nombre, $idcategoria, $uname ){
		//Edita los datos de subcategoría
		$q = "update subcategories set name = '$nombre', category_id = $idcategoria, 
				uname = '$uname', updated_at = NOW() where id = $idsubcategoria";
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarCategoria( $dbh, $nombre, $uname ){
		//Agrega un registro de categoría principal de producto

		$q = "insert into categories ( name, uname, created_at ) values ( '$nombre', '$uname', NOW() )";
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );	
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarSubcategoria( $dbh, $nombre, $uname, $idcategoria ){
		//Agrega un registro de subcategoría de producto
		$q = "insert into subcategories ( name, uname, category_id, created_at ) 
				values ( '$nombre', '$uname', $idcategoria, NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function registrosAsociadosCategoria( $dbh, $idc ){
		//Determina si existe un registro de alguna tabla asociada a una categoría
		//Tablas relacionadas: sizes, subcategories, products
		include( "data-system.php" );

		$a_talla 	= registroAsociadoTabla( $dbh, "sizes", "category_id", $idc );
		$a_subc 	= registroAsociadoTabla( $dbh, "subcategories", "category_id", $idc );
		$a_prod 	= registroAsociadoTabla( $dbh, "products", "category_id", $idc );

		if( ( $a_talla == false ) && ( $a_subc == false ) && ( $a_prod == false ) )
			$asociado = false;
		else
			$asociado = true;

		return $asociado;
	}
	/* ----------------------------------------------------------------------------------- */
	function registrosAsociadosSubcategoria( $dbh, $idsc ){
		//Determina si existe un registro de alguna tabla asociada a una categoría
		//Tablas relacionadas: products
		include( "data-system.php" );

		return registroAsociadoTabla( $dbh, "products", "subcategory_id", $idsc );
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarCategoria( $dbh, $id ){
		//Elimina un registro de categoría
		$q = "delete from categories where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarSubcategoria( $dbh, $id ){
		//Elimina un registro de categoría
		$q = "delete from subcategories where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Categorías */
	/* ----------------------------------------------------------------------------------- */
	//Obtener subcategorías de una categoría
	if( isset( $_POST["m_subcategs"] ) ){
		include( "bd.php" );
		$idc = $_POST["m_subcategs"];
		$subcategorias = obtenerListaSubCategoriasCategoria( $dbh, $idc );
		echo json_encode( $subcategorias );
	}
	/* ----------------------------------------------------------------------------------- */
	//Obtener subcategorías de una categoría
	if( isset( $_GET["categorias_destacadas"] ) ){
		include( "bd.php" );
		$orden[1] = $_POST["c_orden1"];
		$orden[2] = $_POST["c_orden2"];
		$orden[3] = $_POST["c_orden3"];
		$orden[4] = $_POST["c_orden4"];
		
		guardarCategoriasDestacadas( $dbh, $orden );
		header( "Location: ../categories.php?categoriasdestacadas&success" );
	}
	/* ----------------------------------------------------------------------------------- */
	//Invoca crear nuevo registro de categoría principal
	if( isset( $_GET["ncategoria"] ) ){
		include( "bd.php" );
		include( "data-system.php" );

		if( nombreDisponible( $dbh, "categories", "name", $_POST["nombre"], "", "" ) ){
			$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
			$uname = obtenerUname( $_POST["nombre"] );
			$idc = agregarCategoria( $dbh, $nombre, $uname );
			echo "IDC: ".$idc;
		}else{
			header( "Location: ../categories.php?agregar_categoria-nodisponible" );
		}
		
		if( ( $idc != 0 ) && ( $idc != "" ) ){
			header( "Location: ../categories.php?agregar_categoria-exito" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Invoca crear nuevo registro de subcategoría
	if( isset( $_GET["nsubcategoria"] ) ){
		include( "bd.php" );
		include( "data-system.php" );

		$id_categoria = $_POST["idcategoria"];

		if( nombreDisponible( $dbh, "subcategories", "name", $_POST["nombre"], "", $id_categoria ) ){
			$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
			$uname = obtenerUname( $nombre );
			$idsc = agregarSubcategoria( $dbh, $nombre, $uname, $id_categoria );
		}else{
			header( "Location: ../subcategories.php?agregar_subcategoria-nodisponible" );
		}

		if( ( $idsc != 0 ) && ( $idsc != "" ) ){
			header( "Location: ../subcategories.php?agregar_subcategoria-exito" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Editar datos de categoría principal
	if( isset( $_GET["category-edit"] ) ){
		include( "bd.php" );
		include( "data-system.php" );

		$idc = $_POST["idcategoria"];
		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );

		if( nombreDisponible( $dbh, "categories", "name", $nombre, $idc, "" ) ){
			$uname = obtenerUname( $nombre );
			$r = modificarCategoria( $dbh, $_POST["idcategoria"], $nombre, $uname );
		}else{
			header( "Location: ../category-edit.php?id=$idc&editar_categoria-nodisponible" );
		}
		if( ( $r != 0 ) && ( $r != "" ) ){
			header( "Location: ../category-edit.php?id=$idc&categories_edit_success" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Editar datos de subcategoría
	if( isset( $_GET["subcategory-edit"] ) ){
		include( "bd.php" );
		include( "data-system.php" );
		
		$idsc = $_POST["idsubcategoria"];
		$idc = $_POST["idcategoria"];
		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		
		if( nombreDisponible( $dbh, "subcategories", "name", $nombre, $idsc, $idc ) ){
			$uname = obtenerUname( $nombre );
			$r = modificarSubCategoria( $dbh, $idsc, $nombre, $idc, $uname );
		}else{
			header( "Location: ../subcategory-edit.php?id=$idsc&editar_subcategoria-nodisponible" );
		}
		if( ( $r != 0 ) && ( $r != "" ) ){
			header( "Location: ../subcategory-edit.php?id=".$idsc."&subcategories_edit_success" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Eliminar categoría
	if( isset( $_POST["id_elim_cat"] ) ){
		include( "bd.php" );	
		if( registrosAsociadosCategoria( $dbh, $_POST["id_elim_cat"] ) == true ){
			$res["exito"] = -1;
			$res["mje"] = "Debe eliminar registros relacionados con esta categoría primero: tallas, subcategorías o productos";
		}else{
			eliminarCategoria( $dbh, $_POST["id_elim_cat"] );
			$res["exito"] = 1;
			$res["mje"] = "Categoría eliminada con éxito";
		}
		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	//Eliminar subcategoría
	if( isset( $_POST["id_elim_subcat"] ) ){
		include( "bd.php" );	
		if( registrosAsociadosSubcategoria( $dbh, $_POST["id_elim_subcat"] ) == true ){
			$res["exito"] = -1;
			$res["mje"] = "Debe eliminar productos asociados a la subcategoría primero.";
		}else{
			eliminarSubcategoria( $dbh, $_POST["id_elim_subcat"] );
			$res["exito"] = 1;
			$res["mje"] = "Subcategoría eliminada con éxito";
		}
		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
?>