<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de colores */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaColores( $dbh ){
		//Devuelve la lista de colores de productos
		$q = "select id, name from colors order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_l = obtenerListaRegistros( $data );
		return $lista_l;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerColorPorId( $dbh, $idc ){
		//Devuelve registro de color de producto por id
		$q = "select id, name, color_code from colors where id = $idc";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarColor( $dbh, $nombre, $uname ){
		//Agrega un registro de color
		$q = "insert into colors ( name, uname, created_at ) values ( '$nombre', '$uname', NOW() )";
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );	
	}
	/* ----------------------------------------------------------------------------------- */
	function editarColor( $dbh, $idc, $nombre, $uname ){
		//Actualiza los datos de regristro de color
		$q = "update colors set name = '$nombre', uname = '$uname', updated_at = NOW() where id = $idc";
		$data = mysqli_query( $dbh, $q );

		return $data;	
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarColor( $dbh, $idc ){
		//Elimina un registro de color
		$q = "delete from colors where id = $idc";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosColor( $dbh, $idc ){
		//Devuelve la lista de productos que tienen en su detalle registros con baños del id indicado
		$q = "select p.id, p.name as nombre, p.code, p.description 
		from products p where p.id in (select product_id from product_details where 
		color_id = $idc) order by p.name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_l = obtenerListaRegistros( $data );
		return $lista_l;
	}
	/* ----------------------------------------------------------------------------------- */
	function registrosAsociadosColor( $dbh, $idc ){
		//Determina si existe un registro de alguna tabla asociada a un color
		//Tablas relacionadas: product_details

		return registroAsociadoTabla( $dbh, "product_details", "color_id", $idc );
	}
	/* ----------------------------------------------------------------------------------- */
	//Invoca a agregar un nuevo registro de color
	if( isset( $_GET["ncolor"] ) ){
		include( "bd.php" );
		include( "data-system.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );

		if( nombreDisponible( $dbh, "colors", "name", $nombre, "", "" ) ){
			$uname = obtenerUname( $nombre );
			$idc = agregarColor( $dbh, $nombre, $uname );
			if( ( $idc != 0 ) && ( $idc != "" ) ){
				header( "Location: ../colors.php?agregar_color-exito" );
			}
		}else{
			header( "Location: ../colors.php?agregar_color-nodisponible" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Invoca a editar un registro de color
	if( isset( $_GET["mcolor"] ) ){
		include( "bd.php" );
		include( "data-system.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$idc = $_POST["idcolor"];

		if( nombreDisponible( $dbh, "colors", "name", $nombre, $idc, "" ) ){
			$uname = obtenerUname( $nombre );
			$idr = editarColor( $dbh, $idc, $nombre, $uname );
			if( ( $idr != 0 ) && ( $idr != "" ) ){
				header( "Location: ../colors.php?editar_color-exito" );
			}
		}
		else{
			header( "Location: ../colors.php?editar_color-nodisponible" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Colores */
	/* ----------------------------------------------------------------------------------- */

	//Eliminar color
	if( isset( $_POST["id_elim_color"] ) ){
		include( "bd.php" );
		include( "data-system.php" );
		$idc = $_POST["id_elim_color"];

		if( registrosAsociadosColor( $dbh, $idc ) == true ){
			$res["exito"] = -1;
			$res["mje"] = "Debe eliminar registros asociados al color primero: detalle de producto";
		}else{
			$ret = eliminarColor( $dbh, $idc );
			$res["exito"] = $ret;
			$res["mje"] = "Color eliminado con éxito";
		}
		echo json_encode( $res );
	}
?>