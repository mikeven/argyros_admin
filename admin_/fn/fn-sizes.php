<?php 
	/* Argyros - Funciones comúnes */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerDatosTallaRegistrada( $tid, $tallas_reg ){
		$data = array();
		foreach ( $tallas_reg as $tr ) {
			
			if( $tr["idtalla"] == $tid ){
				$data["peso"] = $tr["peso"];
				$data["ldsp"] = obtenerEnlaceDisponibilidadTalla( $tr["visible"] );
				$data["disp"] = obtenerEtiquetaDisponibilidadTalla( $tr["visible"] );
			}
		}
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerEnlaceDisponibilidadTalla( $visible ){
		$lnk[1] = "<a href='#!'><i class='fa fa-eye-slash'></i> Ocultar</a>";
		$lnk[0] = "<a href='#!'><i class='fa fa-eye'></i> Mostrar</a>";

		return $lnk[$visible];
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerEtiquetaDisponibilidadTalla( $visible ){
		$etq[1] = "Disponible";
		$etq[0] = "No disponible";

		return $etq[$visible];
	}
	/* ----------------------------------------------------------------------------------- */
?>