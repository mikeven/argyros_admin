<?php 
	/* Argyros - Funciones comúnes */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerOpcionesPrecios(){
		$tipo_precios = array(
			array("tipo" => "p",  "etiqueta" => "Por pieza"),
			array("tipo" => "g",  "etiqueta" => "Por gramo"),
			array("tipo" => "mo", "etiqueta" => "Mano de obra")
		);
		return $tipo_precios;
	}
?>