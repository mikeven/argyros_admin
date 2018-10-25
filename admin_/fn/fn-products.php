<?php 
	/* Argyros - Funciones sobre productos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function mostrarLineasProducto( $datos ){
		//
		$bloque = "";
		foreach ( $datos as $d ) {
			$bloque .= "<div class=''>".$d["nombre"]."</div>";
		}

		return $bloque;
	}
	/* ----------------------------------------------------------------------------------- */
	function mostrarTrabajosProducto( $datos ){
		//
		$bloque = "";
		foreach ( $datos as $d ) {
			$bloque .= "<div class=''>".$d["nombre"]."</div>";
		}

		return $bloque;
	}
	/* ----------------------------------------------------------------------------------- */
	function txEstado( $estado ){
		//Devuelve la etiqueta asociada al estado de disponibilidad de un registro de talla de detalle de producto
		$tx = array( 
			1 	=> "Disponible",
			0 	=> "No disponible"
		);

		return $tx[$estado];
	}
	/* ----------------------------------------------------------------------------------- */
	function txTipoPeso( $tipo ){
		//Devuelve la etiqueta asociada al tipo de precio dependiendo del valor del tipo precio
		$tx = array( 
			"" 		=> "No definido",
			"p" 	=> "Por pieza",
			"g" 	=> "Por peso",
			"mo"	=> "Por mano de obra"
		);

		return $tx[$tipo];
	}
	/* ----------------------------------------------------------------------------------- */

	function Subir_Imagen($Input, $Ruta, $Foto, $Miniatura, $AnchoMax, $AltoMax){
	    $Respuesta = array();
	    $NombreOriginal  = basename($_FILES[$Input]['name']);
	    $Extension = pathinfo($NombreOriginal, PATHINFO_EXTENSION);

	    if ($Foto != '') { //Si el nombre esta vacio uso el orginal
	        $Nombre = $Foto.'.'.$Extension;
	    } else {
	        $Nombre = $_FILES[$Input]['name'];
	    }

		//Ruta de los archivos
	    $ImagenOriginal = $Ruta.basename($Nombre);
	    $ImagenMini = $Ruta."Mini_".basename($Nombre);

		//Subo la imagen
	    if (move_uploaded_file($_FILES[$Input]['tmp_name'],$ImagenOriginal)) {
	        //redimensiono la imagen si es demasiado grande.
	        if ($Extension == "jpg" || $Extension == "jpeg") { $ImagenGrande = imagecreatefromjpeg($ImagenOriginal);
	            } elseif ($Extension == "png") { $ImagenGrande = imagecreatefrompng($ImagenOriginal);
	            } elseif ($Extension == "gif") { $ImagenGrande = imagecreatefromgif($ImagenOriginal);
	            }

	        $x = imagesx($ImagenGrande);
	        $y = imagesy($ImagenGrande);

	        if($x <= $AnchoMax && $y <= $AltoMax){
	            $Respuesta['Script'] .= "Alerta('La imagen ya estaba optimizada.','success',3000);";
	            return json_encode($Respuesta);
	        }

	        if ($x >= $y) {
	            $nuevax = $AnchoMax;
	            $nuevay = $nuevax * $y / $x;
	            $Mininuevax = 400;
	            $Mininuevay = $Mininuevax * $y / $x;
	        } else {
	            $nuevay = $AltoMax;
	            $nuevax = $x / $y * $nuevay;
	            $Mininuevay = 400;
	            $Mininuevax = $x / $y * $Mininuevay;
	        }

	        $ImagenNueva = imagecreatetruecolor($nuevax, $nuevay);
	        imagecopyresized($ImagenNueva, $ImagenGrande, 0, 0, 0, 0, floor($nuevax), floor($nuevay), $x, $y);

	        if ($Extension == "jpg" || $Extension == "jpeg") { imagejpeg($ImagenNueva,$ImagenOriginal,100);
	            } elseif ($Extension == "png") { imagepng($ImagenNueva,$ImagenOriginal,100);
	            } elseif ($Extension == "gif") { imagegif($ImagenNueva,$ImagenOriginal,100); }

	    if($Miniatura == "SI") { //creo la miniatura
	            $Miniatura = imagecreatetruecolor($Mininuevax, $Mininuevay);
	            imagecopyresized($Miniatura, $ImagenGrande, 0, 0, 0, 0, floor($Mininuevax), floor($Mininuevay), $x, $y);

	        if ($Extension == "jpg" || $Extension == "jpeg") { imagejpeg($Miniatura,$ImagenMini,100);
	            } elseif ($Extension == "png") { imagepng($Miniatura,$ImagenMini,100);
	            } elseif ($Extension == "gif") { imagegif($Miniatura,$ImagenMini,100); }
	            imagedestroy($Miniatura);
	    }

	    } else {
	        $Respuesta['Script'] .= "Alerta(Ocurrió un error al subir la imagen.','error',3000);";
	    }
		//imagedestroy($ImagenRedimensionada);
		$Respuesta['Script'] .= "Alerta('La imagen se ha optimizado correctamente.','success',3000);";
	    return json_encode($Respuesta);
	}

	function uploadI( $file ){
		$FondoPantalla = Subir_Imagen( $file, 'uploads/rsz/', 'Nombrefoto', 'SI', 300, 300 );
		$img = json_decode( $FondoPantalla );
		print_r($img);
	}

	function make_thumb($src, $dest, $desired_width) {

		/* read the source image */
		echo $src."<br>";
		$source_image = imagecreatefromjpeg($src);
		
		$width = imagesx($source_image);
		$height = imagesy($source_image);

		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height * ($desired_width / $width));

		echo $desired_width." ".$desired_height."<br>";
		
		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);

		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

		
		/* create the physical thumbnail image to its destination */
		echo "dest: ".$dest."<br>";
		$img = imagejpeg($virtual_image, $dest);

		echo "IMG: ".var_dump($img);

	}

	if( isset( $_POST["submitf"] ) ){
		//print_r($_FILES["files"]);
		//uploadI( $_FILES["files"] );
		make_thumb( "../catalog/ac11333cc5ee80d0afe95c618b0e2b6901ed.jpg", "../uploads/rsz/dst.jpg", 300 );
	}else{
		
	}
?>