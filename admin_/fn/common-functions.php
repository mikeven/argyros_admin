<?php 
	/* Argyros - Funciones comúnes */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function sop( $val_list, $val_reg ){
		//Retorna el parámetro 'selected' para opciones de listas desplegables: marcar como seleccionada
		$sel = "";
		if( $val_list == $val_reg ) $sel = "selected";
		return $sel;
	}
?>