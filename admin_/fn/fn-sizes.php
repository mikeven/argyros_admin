<?php 
	/* Argyros - Funciones de tallas */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerDatosTallaRegistrada( $iddet, $tid, $tallas_reg ){
		$data = array();
		$data["peso"] = "";
		$data["ldsp"] = "";
		$data["disp"] = "";

		//print_r($tallas_reg);

		foreach ( $tallas_reg as $tr ){
			
			if( $tr["idtalla"] == $tid ){

				$data["peso"] = $tr["peso"];
				$data["ldsp"] = obtenerEnlaceDisponibilidadTalla( $iddet, $tr["idtalla"], $tr["visible"] );
				$data["disp"] = obtenerEtiquetaDisponibilidadTalla( $tr["visible"] );
				break; 
			}
		}

		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerEnlaceDisponibilidadTalla( $iddet, $idtalla, $visible ){
		$lnk[1] = "<a href='#!' class='o-tdetp' data-idtalla='$idtalla' 
					data-idpdet='$iddet' data-st='0'><i class='fa fa-eye-slash'></i> Ocultar</a>";


		$lnk[0] = "<a href='#!' class='o-tdetp' data-idtalla='$idtalla' 
					data-idpdet='$iddet' data-st='1'><i class='fa fa-eye'></i> Mostrar</a>";

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
			if( $t["talla"] == 'N/A' ) return $t;	
		}
	}
	/* ----------------------------------------------------------------------------------- */
?>

<?php 
	if( isset( $_GET["agregar_talla-exito"] ) ){ ?>
	  <script>
	    notificar( "Tallas", "Talla agregada con éxito", "success" );
	  </script>
<?php } ?>

<?php 
	if( isset( $_GET["agregar_talla-nodisponible"] ) 
	  || isset( $_GET["editar_talla-nodisponible"] ) ){ ?>
	<script>
    	notificar( "Tallas", "Valores de talla ya existentes", "error" );
  	</script>
<?php } ?>

<?php 
	if( isset( $_GET["editar_talla-exito"] ) ) { ?>
  	<script>
    	notificar( "Tallas", "Los datos de la talla fueron modificados", 'success' );
  	</script>
<?php } ?>