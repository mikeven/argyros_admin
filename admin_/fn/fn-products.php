<?php 
	/* Argyros - Funciones sobre productos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function mostrarLineasProducto( $datos ){
		//
		$bloque = "";
		foreach ( $datos as $d ) {
			$bloque .= "<div class=''>".$d["nombre"]."</div>";
		}

		return $bloque;
	}
	/* ----------------------------------------------------------------------------------- */
	function mostrarTrabajosProducto( $datos ){
		//
		$bloque = "";
		foreach ( $datos as $d ) {
			$bloque .= "<div class=''>".$d["nombre"]."</div>";
		}

		return $bloque;
	}
	/* ----------------------------------------------------------------------------------- */
	function txEstado( $estado ){
		//Devuelve la etiqueta asociada al estado de disponibilidad de un registro de talla de detalle de producto
		$tx = array( 
			1 	=> "Disponible",
			0 	=> "No disponible"
		);

		return $tx[$estado];
	}
	/* ----------------------------------------------------------------------------------- */
	function txTipoPeso( $tipo ){
		//Devuelve la etiqueta asociada al tipo de precio dependiendo del valor del tipo precio
		$tx = array( 
			"" 		=> "No definido",
			"p" 	=> "Por pieza",
			"g" 	=> "Por peso",
			"mo"	=> "Por mano de obra"
		);

		return $tx[$tipo];
	}
	/* ----------------------------------------------------------------------------------- */
?>