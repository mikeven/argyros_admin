<?php 
function seef_(){
		// Vacía el directorio donde se almacenan las imágenes generadas
	date_default_timezone_set( 'America/Panama' );
	$cd = date ("Y-m-d H:i:s");
	$currdat = strtotime(date ("Y-m-d H:i:s"));
	$files = glob( 'database/prints/*' ); 
	foreach( $files as $file ){
		
		$ult_mod = date ("Y-m-d H:i:s", filemtime($file));
		$um = strtotime($ult_mod);
	    echo $file.": ".$ult_mod." <> ".$cd." <>";
	    //if( is_file( $file ) )
	    //unlink( $file );
	    echo ($currdat-$um);
	}
}

function seef(){

	$tmax_m = 30; 	// máx t en minutos que puede permanecer en el directorio
	
	date_default_timezone_set( 'America/Panama' );

	$t_actual = strtotime( date ("Y-m-d H:i:s") );
	
	$files = glob( 'database/prints/*' ); 
	foreach( $files as $file ){
		$t_archivo = strtotime( date ( "Y-m-d H:i:s", filemtime( $file ) ) );
		$t_dif = floor( ( $t_actual - $t_archivo ) / 60 );
	    echo $file." f: ".date ("Y-m-d H:i:s")." um: ".date ( "Y-m-d H:i:s", filemtime( $file ) )." df: ".$t_dif." >>"."<br>";
	    if( is_file( $file ) && $t_dif >= $tmax_m )
	    	echo "ELIM: ".$file;//unlink( $file );
	}
}


 seef();
?>