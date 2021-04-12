<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Generación de imágenes de catálogo con texto */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	ini_set( 'display_errors', 1 );

	/* ----------------------------------------------------------------------------------- */
	function crearImagenDesdeArchivo( $img ){
		// Devuelve la creación de imagen a partir de la imagen original de acuerdo a su formato.
		$formato = substr( $img, -3 );
		if( $formato == "jpg" )
			$imagen = imagecreatefromjpeg( $img );
		if( $formato == "png" )
			$imagen = imagecreatefrompng( $img );

		return $imagen;
	}
	/* ----------------------------------------------------------------------------------- */
	function alturaInfoImagen( $dataf, $alt_lin ){
		// Devuelve la altura del bloque de datos de acuerdo al número de elementos a imprimir
		$nelems = 0;
		$altura = 0;
		foreach ( $dataf as $dato ) 
			if( $dato != NULL ) $nelems++;
		
		if( $nelems == 1 || $nelems == 2 ) $altura = $alt_lin * 1; 
		if( $nelems == 3 || $nelems == 4 ) $altura = $alt_lin * 2;
		if( $nelems == 5 || $nelems == 6 ) $altura = $alt_lin * 3; 

		return $altura;
	}
	/* ----------------------------------------------------------------------------------- */
	function xyDato( $n, $px, $py, $nw, $al ){
		// Devuelve los parámetros de impresión por cada dato de la imagen
		if ( $n%2 == 0 ) $xy["x"] = $nw / 2; else $xy["x"] = $px;
		
		if ( $n == 1 || $n == 2 ) $xy["y"] = $py;				// Línea 1
		if ( $n == 3 || $n == 4 ) $xy["y"] = $py + $al;			// Línea 2
		if ( $n == 5 || $n == 6 ) $xy["y"] = $py + ($al * 2);	// Línea 3
		
		return $xy;
	}
	/* ----------------------------------------------------------------------------------- */
	//function GI( $img, $nombre_img, $nombre, $id_p, $id, $precio, $peso, $tallas, $ubicacion, $zip ){
	function generarImagen( $img, $nombre_i, $id_p, $dataf, $zip ){	
		
		ini_set( "memory_limit", "200M" );
		ini_set('MAX_EXECUTION_TIME', '900');
		$alt_lin 			= 20;												// Altura de línea
		
		$ai 				= alturaInfoImagen( $dataf, $alt_lin );				//Altura de espacio para impresión
		$orig 				= imagecreatefromjpeg( $img );
		$ancho_o 			= imagesx( $orig ); 
		$alto_o 			= imagesy( $orig ); 
		$nw 				= 500;												// Ancho imagen nueva
		$nh 				= intval( ( $alto_o / $ancho_o ) * $nw ) + $ai;		// Alto: proporcional al ancho con respecto 
																				// a la original + espacio para texto 

		$nva 				= imagecreatetruecolor( $nw, $nh+10 ); 						// Creación de nueva imagen	
		$color_1 			= imagecolorallocate( $nva, 0, 0, 0 );						// Color negro
		$color_2 			= imagecolorallocatealpha( $nva, 167, 178, 57, 0 );		// Color blanco

		$x1 = 0; 	$x2 = $nw;
		$y1 = $nh; 	$y2 = $nh - $ai;
		
		// Copiar imagen de producto en la nueva
		imagecopyresampled( $nva, $orig, 0, 0, 0, 0, $nw, $nh-$ai, $ancho_o, $alto_o );		
		// Área de texto
		imagefilledrectangle ( $nva , $x1 , $y1+10 , $x2 , $y2 , $color_2 );				
		
		$tam = 12; $typ = '../fonts/futura medium bt.ttf';
		$lin = $y2 + $alt_lin;
		$p_x = 20; $p_y = $y2 + $alt_lin;

		$nelem = 1;
		foreach ( $dataf as $dato ) {
			if( $dato != NULL ){
				$xy = xyDato( $nelem, $p_x, $p_y, $nw, $alt_lin );
				if( $dato[0] == "T" ) $tam = $tam - 2;				// Tamaño de letra reducido para tallas
				imagettftext( $nva, $tam, 0, $xy["x"], $xy["y"], $color_1, $typ, $dato );
				$nelem++;
			}
		}

		$archivo = substr( $id_p, 1 );
		imagepng( $nva, "../salidas/$archivo.png", 9 ); 
		$zip->addFile( "../salidas/$archivo.png" );

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
			foreach ( $r["tallas"] as $talla ) {
				if( $talla["visible"] == 1 ){
					$peso = $talla["peso"]."g"; break;
				}
				if( isset( $f["p_ocultos"] ) ){
					$peso = $talla["peso"]."g"; break;
				}
			}
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
		$val_v = 1;
		if( isset( $f["p_tal"] ) ){
			$v_tallas = "T: ";
			$rt 	= $r["tallas"];
			foreach ( $rt as $t ) {
				if( isset( $f["p_ocultos"] ) ) $val_v = 0;
					
				if( $t["visible"] == $val_v )
						$v_tallas .= $t["talla"].$t["unidad"].", ";
			}
		}
		return substr( $v_tallas, 0, -2 ); 
	}
	/* ---------------------------------------- */
	function ubicacionP( $r, $f ){
		$ubicacion = NULL;
		if( isset( $f["p_ubc"] ) ){
			$det 		= $r["detalle"];
			$ubicacion 	= $det["ubicacion"];
		}
		
		return $ubicacion;
	}
	/* ---------------------------------------- */
	function linkImg( $n ){
		//download='$n.png'
		$lnk = "<a class='lnkig' href='salidas/$n.png'  target='_blank'>IMG</a>";
		return $lnk;
	}
	/* ----------------------------------------------------------------------------------- */
	function linkZip( $archivo ){
		// 
		$pre = "database/";
		$lnk = "<a class='lnkig btn btn-app' href='$pre$archivo' target='_blank'>
					Descargar imágenes <i class='fa fa-download'></a>";
		return $lnk;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarProgreso( $n, $img ){
		// Actualiza la variable de sesión que almacena el progreso de la generación de imágenes
		session_start();
		array_push ( $_SESSION["images"], $img );
		session_write_close();
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarZipsGenerados(){
		// Vacía el directorio donde se almacenan los archivos comprimidos
		$tmax_m = 30; 	// máx t en minutos que puede permanecer en el directorio

		date_default_timezone_set( 'America/Panama' );

		$t_actual = strtotime( date ("Y-m-d H:i:s") );
		
		$files = glob( 'prints/*' ); 
		foreach( $files as $file ){
			$t_archivo = strtotime( date ( "Y-m-d H:i:s", filemtime( $file ) ) );
			$t_dif = floor( ( $t_actual - $t_archivo ) / 60 );
			
		    if( is_file( $file ) && $t_dif >= $tmax_m ) 
		    	//El archivo tiene más de $tmax_m mins desde la fecha de creación hasta la ejecución de este script 
		    	unlink( $file );       
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarImagenesGeneradas(){
		// Vacía el directorio donde se almacenan las imágenes generadas
		
		$files = glob( '../salidas/*' ); 
		foreach( $files as $file ){
		    if( is_file( $file ) )
		    unlink( $file );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function escribirImagenes( $productos, $frm ){
		// Obtiene los datos a mostrar e invoca la generación de las imágenes con los datos
		
		date_default_timezone_set( 'America/Panama' );
		
		$filename 				= date("Ymd-his"); 
		$enl 					= "";
		$dir 					= "prints/";
		$archivo_zip 			= $dir.$filename.".zip";
		$nregs 					= count( $productos );
		$_SESSION["nimages"] 	= $nregs;
		$_SESSION["images"] 	= array();
		session_write_close();

		$zip = new ZipArchive();
		if ( $zip->open( $archivo_zip, ZipArchive::CREATE | ZipArchive::OVERWRITE ) ){

		}else echo "ERROR ZIP";
		
		foreach ( $productos as $p ) {
			
			$img 					= 	imgP( $p ); 
			$nombre_i				=	nombreP( $p, $frm, true );
			$id_p 					= 	idP( $p, $frm, true );
			
			$dataf["peso"] 			= 	pesoP( $p, $frm );	
			$dataf["id"] 			= 	idP( $p, $frm, false );
			$dataf["precio"] 		= 	precioP( $p, $frm );
			$dataf["tallas"] 		= 	tallasP( $p, $frm );
			$dataf["nombre"] 		= 	nombreP( $p, $frm, false ); 
			$dataf["ubicacion"] 	= 	ubicacionP( $p, $frm );

			if( $img != "" ){
				actualizarProgreso( $nregs, $nombre_i );
				generarImagen( $img, $nombre_i, $id_p, $dataf, $zip );
			}
		}

		$enl 						= 	linkZip( $archivo_zip );
		$zip->close();
		eliminarImagenesGeneradas();
		eliminarZipsGenerados();

		echo $enl;
	}
	/* ------------------------------------------------------------------------------ */
?>