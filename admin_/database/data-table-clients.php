<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones sobre datos de tabla de clientes */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaClientes( $dbh ){
		//Devuelve la lista de clientes
		$q = "Select c.id, c.first_name as nombre, c.last_name as apellido, c.email, c.phone,  
		ug.name as grupo, p.name as pais, c.city as ciudad, c.verified as verificado, 
		c.company_type as tipo, c.company as esempresa, c.company_name as nempresa, ug.name as grupo,  
		date_format(c.created_at,'%d/%m/%Y') as fcreacion,
		date_format(c.last_login,'%d/%m/%Y') as flogin,
		c.blocked as bloqueado from clients c, client_group ug, countries p 
		where c.client_group_id = ug.id and c.country_id = p.id order by c.id DESC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerIngresosCliente( $dbh, $idc ){
		//Devuelve la lista de ingresos al sistema de los clientes
		$q = "select date_format(date,'%d/%m/%Y') as flogin from client_logins 
				where fk_client = $idc order by date DESC";
		
		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaGruposClientes( $dbh ){
		//Devuelve la lista de clientes
		$q = "select * from client_group order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function sop( $val_list, $val_reg ){
		//Retorna el parámetro 'selected' para opciones de listas desplegables: marcar como seleccionada
		$sel = "";
		if( $val_list == $val_reg ) $sel = "selected";

		return $sel;
	}
	/* ----------------------------------------------------------------------------------- */
	function etiquetaEstadoCliente( $v ){
	    //Devuelve la etiqueta correspondiente al estado de verificación de una cuenta de cliente
	    $estados = array(
	      1     => "Verificado",
	      NULL  => "No verificado"
	    );

	    return $estados[$v];
	 }
	/* ----------------------------------------------------------------------------------- */
	function obtenerContenidoListaGrupos( $c, $grupos ){
		// Devuelve el contenido HTML para desplegar la lista de grupo de clientes
		
		/*$lista = "<select class='form-control selec_grupo_perfil selectpicker' data-idc='".$c["id"]."'>
            		<option disabled>Seleccione</option>";*/

        $lista = "<select class='form-control selec_grupo_perfil selectpicker' data-idc='11'>
            		<option disabled>Seleccione</option>";
        foreach ( $grupos as $g ) {
        	$sel = sop( $c["grupo"], $g["name"] );
            //$lista .= "<option $sel class='cambio_perfil' data-trg='".$c["id"]."' value='".$g["id"]."'>$g[name]</option>";
            $lista .= "<option class='cambio_perfil' data-trg='22' value='44'>NAME</option>";
        }

        $lista .= "</select>";

        return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function enlaceAccion( $c, $cll, $blq_tx, $data_bl ){
		// Devuelve el enlace de la columna acción de clientes

		if( $c["verificado"] != 1 ) {
            $lnk = "<a href='#!' class='elim-cliente' data-toggle='modal' 
            data-idc='".$c["id"]."' data-target='#confirmar-accion'>Borrar</a>";
        } else {
            $lnk = "<a href='#!' class='bloq-cliente $cll' data-toggle='modal' 
              data-bl='".$data_bl."' data-idc='".$c["id"]."' data-target='#confirmar-accion'>$blq_tx</a>";
        }

        return $lnk;
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Clientes */
	/* ----------------------------------------------------------------------------------- */
	ini_set( 'display_errors', 1 );
	include( "bd.php" );
	$clientes 	= obtenerListaClientes( $dbh );
	$grupos 	= obtenerListaGruposClientes( $dbh );

	foreach ( $clientes as $c ) {

		$lnk_c = "client-data.php?id=".$c["id"];
		$lnk_e = "client-edit.php?id=".$c["id"];
        $nombre_empresa = "";

        if( $c["esempresa"] == 1 ) $nombre_empresa = "(".trim($c["nempresa"]).")";
        if( $c["bloqueado"] == 1 ) {

         	$data_bl = 0; $cll = "blocked_user";
        	$blq_tx = "Desbloquear";

        }else{

          $data_bl = 1; $cll = "";
          $blq_tx = "Bloquear";

        }

        $ingresos_cliente   		= obtenerIngresosCliente( $dbh, $c["id"] );
        $lista_grupos 				= obtenerContenidoListaGrupos( $c, $grupos );
		
		$reg_cliente["id"] 			= "<a class='primary' href='".$lnk_c."' target='_blank'>".$c["id"]."</a>";
		$reg_cliente["nombre"] 		= "<a class='primary' href='".$lnk_c."'>".$c["nombre"]." ".$c["apellido"]."</a>";
		$reg_cliente["email"] 		= $c["email"];
		$reg_cliente["pais"] 		= $c["pais"];
		$reg_cliente["flogin"] 		= $ingresos_cliente[0]["flogin"];
		$reg_cliente["tipo"] 		= $c["tipo"].$nombre_empresa;
		$reg_cliente["grupo"] 		= $c["grupo"];
		$reg_cliente["fcreacion"] 	= $c["fcreacion"];
		$reg_cliente["estado"] 		= etiquetaEstadoCliente( $c["verificado"] );
		//$reg_cliente["editar"] 		= "<a href='".$lnk_e."'>Editar</a>";
		$reg_cliente["accion"] 		= enlaceAccion( $c, $cll, $blq_tx, $data_bl );
		
		$data_clientes["data"][] = $reg_cliente;
	}

	/*......................................................................*/

	echo json_encode( $data_clientes );
	
	/* ----------------------------------------------------------------------------------- */
?>