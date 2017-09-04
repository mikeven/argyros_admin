<?php 
	/* Argyros - Funciones comúnes */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerPesoTallaRegistrado( $tid, $tallas_reg ){
		$vpeso = "";
		foreach ( $tallas_reg as $tr ) {
			echo $tr["idtalla"] ." == ". $tid;
			if( $tr["idtalla"] == $tid )
				$vpeso = $tr["peso"];
		}
		return $vpeso;
	}
?>