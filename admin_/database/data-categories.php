<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de categorías */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaCategorias( $dbh ){
		//Devuelve la lista de categorías principales de productos
		$q = "Select id, name, uname from categories order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
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
		$q = "Select s.id, s.name as name, c.name as cname, s.uname as uname 
		from subcategories s, categories c where s.category_id = c.id order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
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
	function modificarCategoria( $dbh, $idcategoria, $nombre ){
		//Edita los datos de categoría principal
		$q = "update categories set name = '$nombre', updated_at = NOW() where id = $idcategoria";
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarSubCategoria( $dbh, $idsubcategoria, $nombre, $idcategoria ){
		//Edita los datos de subcategoría
		$q = "update subcategories set name = '$nombre', category_id = $idcategoria, 
				updated_at = NOW() where id = $idsubcategoria";
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
	function unameDisponible( $dbh, $table, $uname ){
		//Devuelve si un uname está disponible
		$disp = true;
		$q = "select * from $table where uname = '$uname'";
		$nrows = mysqli_num_rows( mysqli_query ( $dbh, $q ) );
		
		if( $nrows > 0 ) $disp = false;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerUname( $name ){
		//Devuelve el uname de una categoría o subcategoría
		$name = str_replace( "á", "a", $name );
		$name = str_replace( "é", "e", $name );
		$name = str_replace( "í", "i", $name );
		$name = str_replace( "ó", "o", $name );
		$name = str_replace( "ú", "u", $name );
		return strtolower( str_replace( " ", "", $name) );
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
	//Invoca crear nuevo registro de categoría principal
	if( isset( $_GET["ncategoria"] ) ){
		include( "bd.php" );

		$uname = obtenerUname( $_POST["nombre"] );
		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$idc = agregarCategoria( $dbh, $nombre, $uname );
		
		if( ( $idc != 0 ) && ( $idc != "" ) ){
			header( "Location: ../categories.php?agregar_categoria&success" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Invoca crear nuevo registro de subcategoría
	if( isset( $_GET["nsubcategoria"] ) ){
		include( "bd.php" );
		
		$uname = obtenerUname( $_POST["nombre"] );
		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$idsc = agregarSubcategoria( $dbh, $nombre, $uname, $_POST["idcategoria"] );
		
		if( ( $idsc != 0 ) && ( $idsc != "" ) ){
			header( "Location: ../subcategories.php?addsubcategory&success" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Editar datos de categoría principal
	if( isset( $_GET["category-edit"] ) ){
		include( "bd.php" );
		$idc = $_POST["idcategoria"];
		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$r = modificarCategoria( $dbh, $_POST["idcategoria"], $nombre );
		
		if( ( $r != 0 ) && ( $r != "" ) ){
			header( "Location: ../categories.php?id=".$idc."&edit&success" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Editar datos de subcategoría
	if( isset( $_GET["subcategory-edit"] ) ){
		include( "bd.php" );
		$idsc = $_POST["idsubcategoria"];
		$idc = $_POST["idcategoria"];
		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$r = modificarSubCategoria( $dbh, $idsc, $nombre, $idc );
		
		if( ( $r != 0 ) && ( $r != "" ) ){
			header( "Location: ../subcategory-edit.php?id=".$idsc."&edit&success" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
?>