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

	function sopl( $lval_reg, $clave ){
		//Retorna un arreglo con los valores correspondientes a las opciones seleccionadas de 
		//una lista desplegable múltiple
		$idarr = array();
		foreach ( $lval_reg as $l ){
			$idarr[] = $l[$clave];	
		}
		echo json_encode( $idarr );
	}
?>