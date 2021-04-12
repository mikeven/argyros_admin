<?php
	ini_set( 'display_errors', 1 );
	// Create image from existing file


	function GI( $im0, $n ){
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
		imagettftext( $generada, 24, 0, 70, 70, $color_1, 
			'fonts/futura medium bt.ttf', "NOMBRE PRODUCTO" );
		
		imagepng( $generada, "salidas/imgr$n.png", 9 ); 
		imagedestroy( $generada );
	}
 		
	$directorio = "catalog/";
	$gestor_dir = opendir( $directorio );
	while (false !== ($nombre_fichero = readdir($gestor_dir))) {
	    $ficheros[] = $nombre_fichero;
	}

	$n = 0;
	foreach ( $ficheros as $f ) {
		if( $f != "." && $f != ".." ){
			$n++;
			if( $n <= 2 ){
				echo "Generando imagen para: ".$f."..."."<br>";
				GI( "catalog/".$f, $n );
			}
		}
	}

	$directorio = "salidas/";
	$gestor_dir = opendir( $directorio );
	while ( false !== ( $nombre_fichero = readdir( $gestor_dir ) ) ) {
	    $pics[] = $nombre_fichero;
	}
	foreach ( $pics as $f ) {
		echo $f."<br>";
	}

	$zip = new ZipArchive();
	$filename = "catalog.zip";

	if  ( $zip->open( $filename, ZipArchive::CREATE ) !== TRUE ) {
	    exit( "cannot open <$filename>\n" );
	}
	foreach ( $pics as $f ) {
		if( $f != "." && $f != ".." )
			$zip->addFile( "salidas/" . $f );
	}

	
	echo "numficheros: " . $zip->numFiles . "\n";
	echo "estado:" . $zip->status . "\n";
	$zip->close();


?>