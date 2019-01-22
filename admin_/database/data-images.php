<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Generación de imágenes de catálogo con texto */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	ini_set( 'display_errors', 1 );
	/* ----------------------------------------------------------------------------------- */
	function alturaInfo( $valores ){
		$a_l = 20;	$h = 0;
		foreach ( $valores as $v ){
			if( $v != NULL && $h < 60 )
				$h += $a_l;	
		} 
		return $h + 10;
	}
	/* ----------------------------------------------------------------------------------- */
	function GI( $img, $nombre_img, $nombre, $id_p, $id, $precio, $peso, $tallas ){
		ini_set("memory_limit","200M");
		
		$ai 				= alturaInfo( array( $nombre, $id, $precio, $peso, $tallas ) );
		$orig 				= imagecreatefromjpeg( $img );
		$ancho_o 			= imagesx( $orig ); 
		$alto_o 			= imagesy( $orig ); 
		$nw 				= 500;
		$nh 				= intval( ( $alto_o / $ancho_o ) * $nw ) + $ai;

		$nva 				= imagecreatetruecolor( $nw, $nh ); 	
		$color_1 			= imagecolorallocate( $nva, 0, 0, 0 );
		$color_2 			= imagecolorallocatealpha( $nva, 255, 255, 255, 10 );

		$x1 = 0; 	$x2 = $nw;
		$y1 = $nh; 	$y2 = $nh - $ai;
		
		imagecopyresampled( $nva, $orig, 0, 0, 0, 0, $nw, $nh, $ancho_o, $alto_o );
		imagefilledrectangle ( $nva , $x1 , $y1 , $x2 , $y2 , $color_2 );
		//img, tam, ang, x, y, color, font, texto
		$tam = 12; $typ = '../fonts/futura medium bt.ttf';
		$lin = $y2 + 20;

		if( $peso != NULL ){
			imagettftext( $nva, $tam, 0, 20, $lin, $color_1, $typ, $peso );
			$lin += 20;
		}
		if( $precio != NULL ){
			imagettftext( $nva, $tam, 0, 20, $lin, $color_1, $typ, $precio );
			$lin += 20;
		}
		if( $nombre != NULL ){
			imagettftext( $nva, $tam, 0, 20, $lin, $color_1, $typ, $nombre );
			$lin += 20;
		}
		if( $id != NULL ){
			$lin = $y2 + 20;
			$x = $nw / 2;
			imagettftext( $nva, $tam, 0, $x, $lin, $color_1, $typ, $id );
			$lin += 20;
		}
		if( $tallas != NULL ){
			if( $id == NULL ) $lin = $y2 + 20;
			$x = $nw / 2;
			imagettftext( $nva, $tam-2, 0, $x, $lin, $color_1, $typ, $tallas );
		}

		$archivo = substr( $id_p, 1 );
		imagepng( $nva, "../salidas/$archivo.png", 9 ); 
		imagedestroy( $nva );
	}
	/* ----------------------------------------------------------------------------------- */
	function idP( $r, $f, $m ){
		$idp = NULL;
		if( isset( $f["p_idp"] ) || $m )
			$idp = "#".$r["data"]["id"]."-".$r["data"]["id_det"];

		return $idp;
	}
	/* ---------------------------------------- */
	function nombreP( $r, $f, $m ){
		$nombre = NULL;
		if( isset( $f["p_nop"] ) || $m ) 
			$nombre = $r["data"]["name"];
		
		return $nombre;
	}
	/* ---------------------------------------- */
	function imgP( $r ){
		$i = ""; $prefijo = "../";
		$imagenes = $r["imagenes"];
		if( isset( $imagenes[0] ) ) 
			$i = $prefijo.$imagenes[0]["path"];
		
		return $i;
	}
	/* ---------------------------------------- */
	function pesoP( $r, $f ){
		$peso = NULL;
		if( isset( $f["p_pep"] ) ){
			$rt 	= $r["tallas"];
			$peso 	= $rt[0]["peso"]."g";
		}
		
		return $peso;
	}
	/* ---------------------------------------- */
	function precioP( $r, $f ){
		$precio = NULL;
		if( isset( $f["p_prp"] ) ){
			$det 	= $r["detalle"];
			$und 	= array( 'p' => 'p', 'g' => 'g', 'mo' => 'g' );
			$vcampo = array( 'p' => 'precio_pieza', 'g' => 'precio_peso', 'mo' => 'precio_mo' );
			$precio = $det[ $vcampo[ $det["tipo_precio"] ] ]."$/".$und[ $det["tipo_precio"] ];
		}
		
		return $precio;
	}
	/* ---------------------------------------- */
	function tallasP( $r, $f ){
		$v_tallas = NULL;
		if( isset( $f["p_tal"] ) ){
			$v_tallas = "T: ";
			$rt 	= $r["tallas"];
			foreach ( $rt as $t ) 
				$v_tallas .= $t["talla"].$t["unidad"].", ";
		}
		return substr( $v_tallas, 0, -2 ); 
	}
	/* ---------------------------------------- */
	function linkImg( $n ){
		//
		$lnk = "<a class='lnkig' href='salidas/$n.png' target='_blank'>IMG</a>";
		return $lnk;
	}
	/* ----------------------------------------------------------------------------------- */
	function escribirImagenes( $productos, $frm ){
		// 
		$enl = "";
		foreach ( $productos as $p ) {
			//print_r($p);
			$img 		= 	imgP( $p ); 	
			$nombre 	= 	nombreP( $p, $frm, false ); 
			$nombre_i	=	nombreP( $p, $frm, true );
			$peso 		= 	pesoP( $p, $frm ); 
			$id 		= 	idP( $p, $frm, false );
			$id_p 		= 	idP( $p, $frm, true ); 	
			$precio 	= 	precioP( $p, $frm );
			$tallas 	= 	tallasP( $p, $frm );
			$enl 		.= 	linkImg( substr( $id_p, 1 ) );

			GI( $img, $nombre_i, $nombre, $id_p, $id, $precio, $peso, $tallas );
		}

		echo $enl;
	}
	/* ----------------------------------------------------------------------------------- */
?>