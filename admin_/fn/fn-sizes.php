<?php 
	/* Argyros - Funciones comúnes */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerDatosTallaRegistrada( $tid, $tallas_reg ){
		$data = array();
		$data["peso"] = "";
		$data["ldsp"] = "";
		$data["disp"] = "";
		foreach ( $tallas_reg as $tr ) {
			
			//echo $tid." = ".$tr["idtalla"];
			
			if( $tr["idtalla"] == $tid ){
				$data["peso"] = $tr["peso"];
				$data["ldsp"] = obtenerEnlaceDisponibilidadTalla( $tr["visible"] );
				$data["disp"] = obtenerEtiquetaDisponibilidadTalla( $tr["visible"] );
				break; 
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
	function obtenerValorTallaCeroDetalleProducto( $tallas ){
		foreach ( $tallas as $t ) {
			if( $t["talla"] == 0 ) return $t;	
		}
	}


?>
	<?php if( isset( $_GET["size_edit_success"] ) ){ ?>
	  <script>
	    notificar( "Tallas", "Datos de talla modificados", "success" );
	  </script>
	<?php } ?>