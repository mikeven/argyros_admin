<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Generación de imágenes de catálogo con texto */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	ini_set( 'display_errors', 1 );
	/* ----------------------------------------------------------------------------------- */
	function GI( $im0, $n, $id, $pr ){
		$imagen 			= imagecreatefromjpeg( $im0 );
		$longitud 			= imagesx( $imagen ); 
		$altura 			= imagesy( $imagen ); 
		$generada 			= imagecreatetruecolor( $longitud, $altura ); 	
		
		$color_1 			= imagecolorallocate( $generada, 0, 0, 0 );
		$color_2 			= imagecolorallocatealpha( $generada, 255, 255, 255, 20 );

		$x1 = 0; $x2 = $longitud;
		$y1 = $altura - 50; $y2 = $altura - 10;
		
		imagecopyresampled( $generada, $imagen, 0, 0, 0, 0, $longitud, $altura, $longitud, $altura );
		imagefilledrectangle ( $generada , $x1 , $y1 , $x2 , $y2 , $color_2 );
		//img, tam, ang, x, y, color, font, texto
		
		imagettftext( $generada, 18, 0, 70, 70, $color_1, '../fonts/futura medium bt.ttf', $id );
		imagettftext( $generada, 18, 0, 70, 90, $color_1, '../fonts/futura medium bt.ttf', $n );
		imagettftext( $generada, 18, 0, 70, 110, $color_1, '../fonts/futura medium bt.ttf', $pr );
		
		imagepng( $generada, "../salidas/$n.png", 9 ); 
		imagedestroy( $generada );
	}
	/* ----------------------------------------------------------------------------------- */
	function idP( $r ){
		
		return "#".$r["data"]["id"]."-".$r["data"]["id_det"];
	}

	function nombreP( $r ){
		return $r["data"]["name"];
	}

	function imgP( $r ){
		$i = ""; $prefijo = "../";
		$imagenes = $r["imagenes"];
		if( isset( $imagenes[0] ) ) 
			$i = $prefijo.$imagenes[0]["path"];
		
		return $i;
	}

	function pesoP( $r ){
		$det = $r["detalle"];
		$vcampo = array( 'p' => 'precio_pieza', 'g' => 'precio_peso', 'mo' => 'precio_mo' );
		$precio = "$ ".$det[ $vcampo[ $det["tipo_precio"] ] ];
		
		return $precio;
	}

	function precioP( $r ){
		$det = $r["detalle"];
		$vcampo = array( 'p' => 'precio_pieza', 'g' => 'precio_peso', 'mo' => 'precio_mo' );
		$precio = "$ ".$det[ $vcampo[ $det["tipo_precio"] ] ];
		
		return $precio;
	}
	/* ----------------------------------------------------------------------------------- */
	function linkImg( $n ){
		//
		$lnk = "<a class='lnkig' href='salidas/$n.png' target='_blank'>IMG</a>";
		return $lnk;
	}
	/* ----------------------------------------------------------------------------------- */
	function escribirImagenes( $productos ){
		// 
		$enl = "";
		foreach ( $productos as $p ) {

			$img = imgP( $p ); 	$nombre = nombreP( $p ); 
			$id = idP( $p ); 	$precio = precioP( $p );
			$enl .= linkImg( $nombre );
			GI( $img, $nombre, $id, $precio );
		}
		echo $enl;
	}
	/* ----------------------------------------------------------------------------------- */
?>