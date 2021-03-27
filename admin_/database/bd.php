<?php
	/* Argyros - Conexión a base de datos */
	/* ----------------------------------------------------------------------------------- */
	$servidor = "127.0.0.1";
	$usuariobd = "argyrosa_bd";
	$passbd = "argyros@bd";
	$basedatos = "argyrosa_20";

	ini_set( "memory_limit", "128M" );
	//require_once($_SERVER['DOCUMENT_ROOT'].'/lib/FirePHPCore/fb.php');
	
	$dbh = mysqli_connect ( $servidor, $usuariobd, $passbd ) 
	or die('No se puede conectar a '.$servidor.": ". mysql_error());
	mysqli_select_db ( $dbh, $basedatos );
	mysqli_query( $dbh, "SET NAMES 'utf8'" );
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function redireccionar( $url ){
		//Redirecciona hacia la url indicada
		echo "<script>window.location.href='$url'</script>";
	}
	/* ----------------------------------------------------------------------------------- */
	function cambiaf_a_mysql( $fecha ){
		//Obtiene una fecha del formato dd/mm/YYYY al formato YYYY-mm-dd
		list( $dia, $mes, $ano ) = explode( "/", $fecha );
    	$lafecha = "$ano-$mes-$dia";
		return $lafecha; 
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaRegistros( $data ){
		//Devuelve un arreglo con los resultados de un resultset de BD
		$lista_c = array();
		if( $data ){
			while( $c = mysqli_fetch_array( $data ) ){
				$lista_c[] = $c;	
			}
		}
		return $lista_c;
	}
	/* ----------------------------------------------------------------------------------- */
	function escaparTexto( $dbh, $texto ){
		// Devuelve un texto escapado
		
		return mysqli_real_escape_string( $dbh, $texto );
	}
	/* ----------------------------------------------------------------------------------- */
	function escaparCampos( $dbh, $registro ){
		// Devuelve un arreglo con los valores escapados de sus  
		// campos de tipo string
		foreach ( $registro as $campo => $valor ) {
			$registro[$campo] = $valor;
			if( is_string( $valor ) )
				$registro[$campo] = mysqli_real_escape_string( $dbh, $valor );
		}
		return $registro;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerFechaConFormato($lnk, $fecha, $formato){
		$q = "Select DATE_FORMAT('$fecha','$formato') as fecha";
		echo $q;
		$fdata = mysql_fetch_array( mysql_query ( $q, $lnk ) );
		return $fdata["fecha"];		
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerFechaActual(){
		//Obtiene la fecha actual de acuerdo a la zona horaria especificada, retornándola en varios formatos
		date_default_timezone_set( "America/Caracas" ); 
		
		$hora_actual_f1 = date("g:i a");		// Formato mm:ss am/pm
		$fecha_actual_f1 = date("d/m/Y");		// formato d.m.a
		$hora_actual_f2 = date("G:i:s");		// Formato mm:ss ( 24 horas )
		$fecha_actual_f2 = date("Y-m-d");		// Formato aaaa-mm-dd
		
		$fecha_f1['fecha'] = $fecha_actual_f1;
		$fecha_f1['hora'] = $hora_actual_f1;
		$fecha_f2['fecha'] = $fecha_actual_f2;
		$fecha_f2['hora'] = $hora_actual_f2;
		$fecha["f1"] = $fecha_f1;
		$fecha["f2"] = $fecha_f2;
		
		return $fecha;
	}
	/* ----------------------------------------------------------------------------------- */
?>