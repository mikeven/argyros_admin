}<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de pedidos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerOrdenesUsuarios( $dbh ){
		//Devuelve el registro de las órdenes asociadas a un usuario
		$q = "select o.id, o.user_id as idu, o.total_price as total, o.order_status as estado, 
		date_format( o.created_at,'%d-%m-%Y') as fecha, u.id as cid, u.first_name nombre, 
		u.last_name as apellido from orders o, users u where o.user_id = u.id order by fecha DESC";
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Líneas */
	/* ----------------------------------------------------------------------------------- */
	
	//Registro de nueva línea
	if( isset( $_GET["nline"] ) ){
		
		include( "bd.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$descripcion = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$idl = agregarLinea( $dbh, $nombre, $descripcion );
		
		if( ( $idl != 0 ) && ( $idl != "" ) ){
			header( "Location: ../lines.php?addline&success" );
		}	
	} else {

	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["line-edit"] ) ){
		include( "bd.php" );
		$idl = $_POST["idlinea"];
		
		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$descripcion = mysqli_real_escape_string( $dbh, $_POST["nombre"] );

		$r = modificarLinea( $dbh, $idl, $nombre, $descripcion );
		
		if( ( $r != 0 ) && ( $r != "" ) ){
			header( "Location: ../line-edit.php?id=".$idl."&edit&success" );
		}
	}
	/* ----------------------------------------------------------------------------------- */

?>