<?php 
	/* Argyros - Funciones de órdenes ( pedidos ) */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerIconoEstado( $estado, $x ){
		//Devuelve el ícono asociado al estado de un pedido
		$iconos = array( 
			"pendiente" 	=> "<i class='fa fa-clock-o $x'></i>",
			"cancelado" 	=> "<i class='fa fa-ban $x' title='Cancelado'></i>",
			"revisado"		=> "<i class='fa fa-eye $x' title='Revisado'></i>",
			"confirmado"	=> "<i class='fa fa-bell $x' title='Confirmado'></i>",
			"entregado"		=> "<i class='fa fa-arrow-right $x' title='Entregado'></i>",
		);

		return $iconos[$estado];
	}
	/* ----------------------------------------------------------------------------------- */
	function activarIconoRevision( $estado_item, $estado_icono ){
		$res = "marked";
		if( $estado_item != $estado_icono ) 
			$res = "";
		return $res;
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["id"] ) ){
        $ido = $_GET["id"];
        $data_o = obtenerOrdenPorId( $dbh, $ido );
        $orden = $data_o["orden"];
        $dorden = $data_o["detalle"];
        $iconoe = obtenerIconoEstado( $orden["estado"], "fa-2x" );
    }
?>