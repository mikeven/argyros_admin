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
	function agregarTrabajo( $dbh, $nombre, $uname ){
		//Agrega un registro de trabajo de producto
		$q = "insert into makings ( name, uname, created_at ) values ( '$nombre', '$uname', NOW() )";
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );	
	}
	/* ----------------------------------------------------------------------------------- */
	function editarTrabajo( $dbh, $idtrabajo, $nombre, $uname ){
		//Edita los datos de trabajo de producto
		$q = "update makings set name = '$nombre', uname='$uname', 
		updated_at = NOW() where id = $idtrabajo";
		
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarTrabajo( $dbh, $idt ){
		//Elimina un registro de material
		$q = "delete from makings where id = $idt";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function registrosAsociadosTrabajo( $dbh, $idt ){
		//Determina si existe un registro de alguna tabla asociada a un trabajo
		//Tablas relacionadas: making_product

		return registroAsociadoTabla( $dbh, "making_product", "making_id", $idt );
	}
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	//Agregar trabajo
	if( isset( $_GET["ntrabajo"] ) ){
		include( "bd.php" );
		include( "data-system.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );

		if( nombreDisponible( $dbh, "makings", "name", $nombre, "", "" ) ){
			$uname = obtenerUname( $nombre );
			$idt = agregarTrabajo( $dbh, $nombre, $uname );
		}else{
			header( "Location: ../makings.php?agregar_trabajo-nodisponible" );
		}
		
		if( ( $idt != 0 ) && ( $idt != "" ) ){
			header( "Location: ../makings.php?agregar_trabajo-exito" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	//Modificar trabajo
	if( isset( $_GET["mtrabajo"] ) ){
		include( "bd.php" );
		include( "data-system.php" );

		$nombre = mysqli_real_escape_string( $dbh, $_POST["nombre"] );
		$idt = $_POST["idtrabajo"];

		if( nombreDisponible( $dbh, "makings", "name", $nombre, $idt, "" ) ){
			$uname = obtenerUname( $nombre );
			$idr = editarTrabajo( $dbh, $idt, $nombre, $uname );
			if( ( $idr != 0 ) && ( $idr != "" ) ) {
				header( "Location: ../makings.php?editar_trabajo-exito" );
			}
		}else{
			header( "Location: ../makings.php?editar_trabajo-nodisponible" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
		 /* Solicitudes asíncronas al servidor para procesar información de Trabajos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	//Eliminar trabajo
	if( isset( $_POST["id_elim_trabajo"] ) ){
		include( "bd.php" );
		include( "data-system.php" );
		$idt = $_POST["id_elim_trabajo"];

		if( registrosAsociadosTrabajo( $dbh, $idt ) == true ){
			$res["exito"] = -1;
			$res["mje"] = "Debe eliminar registros asociados al trabajo primero: productos";
		}else{
			$ret = eliminarTrabajo( $dbh, $idt );
			$res["exito"] = $ret;
			$res["mje"] = "Trabajo eliminado con éxito";
		}
		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */

?>