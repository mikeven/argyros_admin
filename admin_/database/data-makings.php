<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de trabajos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaTrabajos( $dbh ){
		//Devuelve la lista de tallas de productos
		$q = "Select id, name from makings order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTrabajoPorId( $dbh, $idt ){
		//Devuelve un registro de trabajo de producto
		$q = "select id, name from makings where id = $idt";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarTrabajo( $dbh, $nombre ){
		//Agrega un registro de trabajo de producto
		$q = "insert into makings ( name, created_at ) values ( '$nombre', NOW() )";
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );	
	}
	/* ----------------------------------------------------------------------------------- */
	function editarTrabajo( $dbh, $idtrabajo, $nombre ){
		//Edita los datos de trabajo de producto
		$nombre = mysqli_real_escape_string( $dbh, $nombre );
		$q = "update makings set name = '$nombre', updated_at = NOW() where id = $idtrabajo";
		echo $q;
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	
	if( isset( $_GET["ntrabajo"] ) ){
		include( "bd.php" );
		$nombre = mysqli_real_escape_string( $dbh, $nombre );
		$idt = agregarTrabajo( $dbh, $nombre );
		
		if( ( $idt != 0 ) && ( $idt != "" ) ){
			header( "Location: ../makings.php?addmaking&success" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["mtrabajo"] ) ){
		include( "bd.php" );
		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$idt = editarTrabajo( $dbh, $_POST["idtrabajo"], $nombre );
		
		if( ( $idt != 0 ) && ( $idt != "" ) ) {
			header( "Location: ../makings.php?editmaking&success" );
		}
	}

	/* ----------------------------------------------------------------------------------- */

?>