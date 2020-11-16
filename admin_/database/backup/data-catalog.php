<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de productos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function mostrarProductosConsulta( $productos ){
		// Devuelve la estructura HTML del resultado de la consulta de productos

		$resultado = "";
		$bloque_img = file_get_contents( "../sections/image-catalog-report.php" );
		if( $productos != NULL ){
			foreach ( $productos as $reg ) {

				$data_p = $reg["data"];
				$imgs 	= $reg["imagenes"];
				$idr 	= $data_p["id"]."-".$data_p["id_det"];
				$link	= "product-data.php?p=".$data_p["id"]."#".$data_p["id_det"];
				
				if( isset( $imgs[0] ) ) $image = $imgs[0]["path"]; else $image = "";

				$bloque_img = file_get_contents( "../sections/image-catalog-report.php" );

				$bloque_img = str_replace( "{id}", 		$idr, 				$bloque_img );
				$bloque_img = str_replace( "{nombre}", 	$data_p["name"], 	$bloque_img );
				$bloque_img = str_replace( "{image}", 	$image, 			$bloque_img );
				$bloque_img = str_replace( "{desc}", 	$data_p["description"], $bloque_img );
				$bloque_img = str_replace( "{link}", 	$link, 				$bloque_img );
				
				$resultado .= $bloque_img;
			}
		} else $resultado = "Error al obtener resultados";

		return $resultado;
	}
	/* ----------------------------------------------------------------------------------- */
	function condicionIntervalo( $valor, $min, $max ){
		// Devuelve verdadero o falso evaluando un valor en un intérvalo de mín y máx
		$condicion = false;

		if( ( $min == "" ) && ( $max != "" ) )	// $valor < $max
			if( $valor <= $max  ) $condicion = true;

		if( ( $min != "" ) && ( $max == "" ) )	// $valor > $min
			if( $valor >= $min  ) $condicion = true;

		if( ( $min != "" ) && ( $max != "" ) )	// $valor > $min
			if( ( $valor >= $min ) && ( $valor <= $max )  ) $condicion = true;

		return $condicion;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarNivelTalla( $registros, $visible ){
		// Devuelve los registros que cumplen condiciones de disponibilidad a nivel de tallas
		$productos = array();
		$id_reg_ag = array();

		foreach ( $registros as $reg ) {
			$data = $reg["data"];
			$tallas = $reg["tallas"];
			foreach ( $tallas as $t ) {
				if( $t["visible"] == $visible ){
					if ( !in_array( $data["id_det"], $id_reg_ag ) ){
						$id_reg_ag[] = $data["id_det"];
						$productos[] = $reg;
					}
				}
			}
		}
		
		return $productos;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosPeso( $registros, $form ){
		// Devuelve los registros que cumplen con los filtros de: peso
		$productos = array();
		$id_reg_ag = array();
		$min = $form["peso_min"]; $max = $form["peso_max"];

		foreach ( $registros as $reg ) {
			$data = $reg["data"];
			$tallas = $reg["tallas"];
			foreach ( $tallas as $t ) {
				if( condicionIntervalo( $t["peso"], $min, $max ) ){
					if( isset( $form["tallas"] ) ){
						if ( !in_array( $data["id_det"], $id_reg_ag ) &&
							  in_array( $t["idtalla"], $form["tallas"] ) ){
							$id_reg_ag[] = $data["id_det"];
							$productos[] = $reg;
						}
					}else{
						if ( !in_array( $data["id_det"], $id_reg_ag ) ){
							$id_reg_ag[] = $data["id_det"];
							$productos[] = $reg;
						}
					}
				}
			}
		}

		return $productos;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosPrecio( $registros, $form, $tipo_filtro_precio ){
		// Devuelve los registros que cumplen con los filtros de: precio por pieza/peso
		$productos = array();
		$id_reg_ag = array();

		if( $tipo_filtro_precio == "pieza" ){
			
			$min = $form["prepza_min"]; $max = $form["prepza_max"];
			foreach ( $registros as $reg ) {
				$data = $reg["data"];
				$tallas = $reg["tallas"];
				foreach ( $tallas as $t ) {
					if( condicionIntervalo( $t["precio"], $min, $max ) ){
						if( isset( $form["tallas"] ) ){
							if ( !in_array( $data["id_det"], $id_reg_ag ) &&
								  in_array( $t["idtalla"], $form["tallas"] ) ){
								$id_reg_ag[] = $data["id_det"];
								$productos[] = $reg;
							}
						}else{
							if ( !in_array( $data["id_det"], $id_reg_ag ) ){
								$id_reg_ag[] = $data["id_det"];
								$productos[] = $reg;
							}
						}
					}
				}
			}

		}

		if( $tipo_filtro_precio == "peso" ){
			
			$min = $form["prepes_min"]; $max = $form["prepes_max"];
			foreach ( $registros as $reg ) {
				$det = $reg["detalle"];

				if( $det["tipo_precio"] == 'g' ){
					if( condicionIntervalo( $det["precio_peso"], $min, $max ) ){
						$productos[] = $reg;
					}
				}
				if( $det["tipo_precio"] == 'mo' ){
					if( condicionIntervalo( $det["precio_mo"], $min, $max ) ){
						$productos[] = $reg;
					}
				}
			}
		}

		return $productos;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosOcultos( $registros ){
		// Devuelve los productos que estén ocultos o tengan tallas no disponibles.
		$productos = array();
		$id_reg_ag = array();
		
		foreach ( $registros as $reg ) {
			$data = $reg["data"];
			
			if( $data["visible"] == 0 ){
				if ( !in_array( $data["id_det"], $id_reg_ag ) ){
					$id_reg_ag[] = $data["id_det"];
					$productos[] = $reg;
				}
			}

			$tallas = $reg["tallas"];
			foreach ( $tallas as $t ) {
				if( $t["visible"] == 0 ){
					if ( !in_array( $data["id_det"], $id_reg_ag ) ){
						$id_reg_ag[] = $data["id_det"];
						$productos[] = $reg;
					}
				}
			}
		}


		return $productos;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosVisibles( $registros ){
		// Devuelve los productos visibles
		$productos = array();
		$id_reg_ag = array();

		foreach ( $registros as $reg ) {
			$data = $reg["data"];
			if( $data["visible"] == 1 ){
				if ( !in_array( $data["id_det"], $id_reg_ag ) ){
					$id_reg_ag[] = $data["id_det"];
					$productos[] = $reg;
				}
			}
		}

		return filtrarNivelTalla( $productos, 1 );
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosConsulta( $form, $registros ){
		// Devuelve los registros que cumplen con los filtros de: peso, precio
		
		$resultados = $registros;

		if( $form["peso_min"] != "" || $form["peso_max"] != "" ){
			$resultados = filtrarProductosPeso( $registros, $form );	
		}

		if( $form["prepza_min"] != "" || $form["prepza_max"] != "" ){
			$resultados = filtrarProductosPrecio( $resultados, $form, "pieza" );	
		}

		if( $form["prepes_min"] != "" || $form["prepes_max"] != "" ){
			$resultados = filtrarProductosPrecio( $resultados, $form, "peso" );		
		}

		if( isset( $form["p_ocultos"] ) )
			$resultados = filtrarProductosOcultos( $resultados );		
		else
			$resultados = filtrarProductosVisibles( $resultados );

		return $resultados;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerRegistroQuery( $dbh, $q ){
		// Devuelve los registros solicitados a través de la consulta dinámica
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerSubQueryValor( $qvalor, $valores ){
		// Construye la cadena and campo = valor or campo = valor para un query

		if( count( $valores ) > 0 ){
			$q = "and (";  
			$conn = " or ";
			$i = 0;
			foreach ( $valores as $v ) {
				$i++;
				$q .= $qvalor." = ".$v;
				if( count( $valores ) - $i > 0 )
				$q .= $conn; 
			}
			$q .= ")";
		} 
		else $q = "";

		return $q;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerSubQueryParam( $qparam, $qvalor, $valores ){
		// 
	
		$q = "";
		if( count( $valores ) > 0 ){
			$qv = obtenerSubQueryValor( $qvalor, $valores );
			$q = "and ".$qparam." ".$qv;
		}
		return $q;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerSubQueryValorUnico( $campo, $valor ){
		// 
		if( count( $valor ) > 0 ){
			$q = "and ".$campo." = ".$valor;
		} 
		else $q = "";

		return $q;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerSubqueryProductosOcultos( $frm ){
		// Devuelve la subcadena de query para indicar si se obtienen solo productos ocultos
		$q_po = "and p.visible = 1";
		
		if( isset( $frm["p_ocultos"] ) )
			$q_po = "and p.visible = 0";
			
		return $q_po;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerQueryConsulta( $form ){
		// Devuelve la consulta a bd de manera dinámica según los datos del formulario

		ini_set( 'display_errors', 1 );
		$t_spd 	= ""; 	//Tabla: size_product_detail	(talla-detalle producto)
		$t_mp 	= "";	//Tabla: making_product			(trabajo-producto) 
		$t_lp 	= "";	//Tabla: line_product			(línea-producto) 
		$idt 	= "";	//atributo: id talla
		$q_jta 	= "";	//sub-query: unión talla - detalle_producto 
		$qdet 	= "";	//sub-query: condiciones para detalle de producto 
		$q_sc 	= "";	//sub-query: subcategoría
		$q_pa	= "";	//sub-query: país

		$idc = $form["categoria"];
		$idsc = $form["subcategoria"];

		//$q_po = obtenerSubqueryProductosOcultos( $form );

		$q_l = obtenerSubQueryParam( "lp.product_id = p.id", "lp.line_id", $form["linea"] );
		$q_t = obtenerSubQueryParam( "tp.product_id = p.id", "tp.making_id", $form["trabajo"] );

		$q_m = obtenerSubQueryValorUnico( "p.material_id", $form["material"] );
		if( $form["subcategoria"] != "todos" )
			$q_sc = obtenerSubQueryValorUnico( "p.subcategory_id", $form["subcategoria"] );
		
		$q_b = obtenerSubQueryValor( "dp.treatment_id", $form["bano"] );
		$q_co = obtenerSubQueryValor( "dp.color_id", $form["color"] );
		$q_ta = obtenerSubQueryValor( "spd.size_id", $form["tallas"] );

		if( $q_ta != "" ){
			$idt = ", spd.size_id as idt";
			$t_spd = "size_product_detail spd,";
			$q_jta = "and spd.product_detail_id = dp.id";
		}

		if( $q_l != "" ) $t_lp = "line_product lp, ";
		if( $q_t != "" ) $t_mp = "making_product tp, ";

		if( $q_b != "" || $q_co != "" || $q_ta != "" ){ 
			$qdet = " $q_b $q_co $q_jta $q_ta";
		}

		$query = "select p.id, p.code, p.name, p.description, p.visible, dp.id as id_det $idt  
					from products p, $t_spd $t_mp $t_lp product_details dp 
					where p.category_id = $idc $q_sc $q_m $q_l $q_t 
					and dp.product_id = p.id $qdet";

		//echo $query;

		return $query;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerQueryIdentificador( $form ){
		// Devuelve la consulta a bd en función de idproducto-iddetalle
		$ids = array_pad(explode('-', $form["identificador"], 2 ), 2, null);;
		
		list( $idp, $iddet ) = $ids;
		if( $idp != "" && $iddet != "" ){
			$query = "select p.id, p.code, p.name, p.description, p.visible, dp.id as id_det 
						from products p, product_details dp where p.id = $idp and 
						dp.id = $iddet and p.visible = 1";
		}
		else $query = -1;

		return $query;
	}
	/* ----------------------------------------------------------------------------------- */
	function ajustarValores( $datos ){
		//Devuelve la estructura de datos del formulario de consulta ajustado asignando 
		// arreglos vacíos en los parámetros que no hayan sido indicados en el formulario.

		if( !isset( $datos["linea"] ) ) 	$datos["linea"]			= array();
		if( !isset( $datos["trabajo"] ) ) 	$datos["trabajo"] 		= array();
		if( !isset( $datos["bano"] ) ) 		$datos["bano"] 			= array();
		if( !isset( $datos["color"] ) ) 	$datos["color"] 		= array();
		if( !isset( $datos["tallas"] ) ) 	$datos["tallas"] 		= array();
		
		if( $datos["material"] == "" )		$datos["material"]		= array();
		if( $datos["subcategoria"] == "" )	$datos["subcategoria"]	= array();

		return $datos;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPrecioPorPieza( $varg, $precio_pieza ){
		//Devuelve el valor del precio del gramo de acuerdo al perfil de cliente
		$precio = $precio_pieza * $varg["variable_a"];
		
		return number_format( $precio, 2, ".", "" );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPrecioPorGramo( $varg, $precio_gramo ){
		//Devuelve el valor del precio del gramo de acuerdo al perfil de cliente
		$precio = $precio_gramo * $varg["variable_b"];
		
		return number_format( $precio, 2, ".", "" );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPrecioPorGramoMO( $varg, $valor_mo ){
		//Devuelve el valor del precio del gramo en productos de tipo mano de obra 
		//de acuerdo al perfil de cliente
		$precio = ( ( $valor_mo * $varg["variable_c"] ) + $varg["material"] ) * $varg["variable_d"];
		
		return number_format( $precio, 2, ".", "" );	
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarPrecioUnitario( $dbh, $reg, $varg ){
		//Devuelve el precio de un detalle de producto de acuerdo al perfil de cliente
		
		if( $reg["tipo_precio"] == "g" )
			$reg["precio_peso"] = obtenerPrecioPorGramo( $varg, $reg["precio_peso"] );
		if( $reg["tipo_precio"] == "p" )
			$reg["precio_pieza"] = obtenerPrecioPorPieza( $varg, $reg["precio_pieza"] );
		if( $reg["tipo_precio"] == "mo" )
			$reg["precio_mo"] = obtenerPrecioPorGramoMO( $varg, $reg["precio_mo"] );
		
		return $reg;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPrecioRegistroTalla( $varg, $tipo_precio, $peso, $precio_u ){
		//Devuelve el precio de un detalle de producto de acuerdo al peso y el perfil de cliente

		if( $tipo_precio == "g" )
			$precio = number_format( $peso * $precio_u, 2, ".", "" );
		
		if ( $tipo_precio == "mo" )
			$precio = number_format( $precio_u * $peso, 2, ".", "" );
		
		if( $tipo_precio == "p" )
			$precio = number_format( $precio_u, 2, ".", "" );

		return $precio;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPreciosEnTallas( $dbh, $detalle, $tallas, $varg ){
		//

		$ntallas = array();
		foreach ( $tallas as $rt ) {
			
			if( $detalle["tipo_precio"] == "g" )
				$rt["precio"] = obtenerPrecioRegistroTalla( $varg, $detalle["tipo_precio"], 
															$rt["peso"], $detalle["precio_peso"] );
			
			if( $detalle["tipo_precio"] == "mo" )
				$rt["precio"] = obtenerPrecioRegistroTalla( $varg, $detalle["tipo_precio"], 
															$rt["peso"], $detalle["precio_mo"] );
			
			if( $detalle["tipo_precio"] == "p" )
				$rt["precio"] = obtenerPrecioRegistroTalla( $varg, $detalle["tipo_precio"], 
															"", $detalle["precio_pieza"] );
			
			$ntallas[] = $rt;
		}

		return $ntallas;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListadoProductosConsulta( $dbh, $registros_base, $form, $varg ){
		// Devuelve la lista de productos de la consulta 
		// con su correspondiente detalle, tallas e imágenes
		// Cada registro devuelve la estructura [ producto, detalle, tallas[], imagenes[] ]
		
		include( "data-products.php" );
		$lproductos = array();
		
		foreach ( $registros_base as $reg ) {
			
			$producto["data"] 		= $reg;
			
			$producto["detalle"]	= obtenerRegistroDetalleProductoPorId( $dbh, $reg["id_det"] );
			$producto["detalle"]	= actualizarPrecioUnitario( $dbh, $producto["detalle"], $varg );
									// data-products.php
			$producto["tallas"]		= obtenerTallasDetalleProducto( $dbh, $reg["id_det"] );
									// data-products.php

			$producto["tallas"]		= obtenerPreciosEnTallas( $dbh, $producto["detalle"], 
														      $producto["tallas"], $varg );
									//data-catalog.php
			$producto["imagenes"]	= obtenerImagenesDetalleProducto( $dbh, $reg["id_det"], "" );
									// data-products.php

			$lproductos[] = $producto;			
		}

		return $lproductos; 
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerVARG( $dbh, $form ){
		// Devuelve las variables de grupo de cliente según la selección del formulario

		$gcliente = $form["cgcliente"];
		if( isset ( $form["ch_busq_id"] ) ){
			$gcliente = $form["cgcliente_id"];
		}
		
		if( $gcliente != "" ) 
			$varg = obtenerGrupoPorId( $dbh, $gcliente );
		else $varg = obtenerValoresGrupoUsuarioDefecto( $dbh );

		return $varg;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosConsulta( $dbh, $form ){
		//Construye la consulta dinámica y obtiene los registros de los productos consultados

		include( "data-clients.php" );
		ini_set( 'display_errors', 1 );
		
		$datos = ajustarValores( $form );
		$varg = obtenerVARG( $dbh, $form );
		
		if( isset ( $form["ch_busq_id"] ) )
			$query_base = obtenerQueryIdentificador( $datos );
		else
			$query_base = obtenerQueryConsulta( $datos );
		
		if( $query_base != -1 ){
			$registros_base = obtenerRegistroQuery( $dbh, $query_base );
			$lproductos = obtenerListadoProductosConsulta( $dbh, $registros_base, $form, $varg );
			$lproductos = filtrarProductosConsulta( $form, $lproductos );
		} else 
			$lproductos = NULL;

		return $lproductos; 
	}
	/* ----------------------------------------------------------------------------------- */
	function generarArchivosImagenes( $productos, $frm ){
		// Inovoca la generación de imágenes y devuelve el archivo comprimido
		include( "data-images.php" );
		escribirImagenes( $productos, $frm );
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Productos */
	/* ----------------------------------------------------------------------------------- */
	
	if( isset( $_POST["img_catal"] ) ){
		session_start();
		ini_set( 'display_errors', 1 );
		//Solicita la lista de productos de la consulta: reporte de imágenes de catálogo
		
		include( "bd.php" );
		include( "data-sizes.php" );
		$descarga = $_POST["descarga"];
		parse_str( $_POST["img_catal"], $form );

		if( $descarga != "" ){
			echo generarArchivosImagenes( $_SESSION["regs_img_catal"], $form );
		}
		else{
			
			$productos = obtenerProductosConsulta( $dbh, $form );
			$_SESSION["regs_img_catal"] = $productos;
			session_write_close();
			echo mostrarProductosConsulta( $productos );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["progreso"] ) ){
		ini_set( 'display_errors', 1 );
		session_start();
		$procesadas = 0;
		
		$n = $_SESSION["nimages"];
		$images = $_SESSION["images"];
		session_write_close();
		foreach( $images as $i ){
			$procesadas++;
		}
		echo intval( ( $procesadas / $n ) * 100 );
	}
?>