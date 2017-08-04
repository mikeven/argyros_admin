<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de colores */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaColores( $dbh ){
		//Devuelve la lista de colores de productos
		$q = "Select id, name from colors order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_l = obtenerListaRegistros( $data );
		return $lista_l;	
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Usuarios */
	/* ----------------------------------------------------------------------------------- */
	
	if( isset( $_POST["el_cuenta"] ) ){
		
		include("bd.php");
		$idc = $_POST["el_cuenta"];
		$rsl = eliminarCuentaBancaria( $dbh, $idc );
		
		if( ( $rsl == 1 ) ){
			$res["exito"] = 1;
			$res["mje"] = "Cuenta eliminada";
			$cuenta["id"] = $idc;
			$res["registro"] = $cuenta;
		}else{
			$res["exito"] = 0;
			$res["mje"] = "Error al eliminar cuenta";
		}
		echo json_encode( $res );	
	}

	/* ----------------------------------------------------------------------------------- */

?>