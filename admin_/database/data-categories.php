<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de países */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaCategorias( $dbh ){
		//Devuelve la lista de categorías principales de productos
		$q = "Select id, name from categories order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaSubCategorias( $dbh ){
		//Devuelve la lista de categorías principales de productos
		$q = "Select s.id, s.name as name, c.name as cname from subcategories s, categories c 
		where s.category_id = c.id order by name ASC";
		
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

	function agregarCategoria( $dbh, $nombre ){
		//Devuelve la lista de subcategorías de una categoría padre
		$q = "insert into categories (name, created_at ) values ('$nombre', NOW())";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );	
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	//Obtener subcategorías de una categoría
	if( isset( $_POST["m_subcategs"] ) ){
		include( "bd.php" );
		$idc = $_POST["m_subcategs"];
		$subcategorias = obtenerListaSubCategoriasCategoria( $dbh, $idc );
		echo json_encode( $subcategorias );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["ncategoria"] ) ){
		include( "bd.php" );
		$idc = agregarCategoria( $dbh, $_POST["nombre"] );
		echo "id: ".$idc;
		if( ( $idc != 0 ) && ( $idc != "" ) ){
			header( "Location: ../categories.php?agregar_categoria&success" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
?>