<?php
	/* Argyros - Funciones de sistema */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerUname( $name ){
		//Devuelve el uname de nombre de registro
		$name = str_replace( "á", "a", $name );
		$name = str_replace( "é", "e", $name );
		$name = str_replace( "í", "i", $name );
		$name = str_replace( "ó", "o", $name );
		$name = str_replace( "ú", "u", $name );
		$name = str_replace( "ñ", "n", $name );

		return strtolower( str_replace( " ", "", $name) );
	}
	/* ----------------------------------------------------------------------------------- */
	function registroAsociadoTabla( $dbh, $tabla, $campo, $valor ){
		//Determina si existe un registro asociado a una tabla
		$asociado = false;
		$q = "select * from $tabla where $campo = $valor";
		$nrows = mysqli_num_rows( mysqli_query ( $dbh, $q ) );
		
		if( $nrows > 0 ) $asociado = true;

		return $asociado;
	}
	/* ----------------------------------------------------------------------------------- */
	function registroAsociadoTabla2P( $dbh, $tabla, $campo, $valor, $campo2, $valor2 ){
		//Determina si existe un registro asociado a una tabla dado por dos parámetros
		$asociado = false;
		$q = "select * from $tabla where $campo = $valor and $campo2 = $valor2";

		$nrows = mysqli_num_rows( mysqli_query ( $dbh, $q ) );
		
		if( $nrows > 0 ) $asociado = true;

		return $asociado;
	}
	/* ----------------------------------------------------------------------------------- */
	function chequeoExclusionIndirecta( $dbh, $resultado, $table, $k2 ){
		//Evalúa condición para determinar si un nombre está disponible para registrarse
		//de acuerdo a un parámetro auxiliar consultado 
		$disp = true;
		if( $table == "subcategories" ){
			//Si se está guardando una nueva subcategoría, se evalúa que la categoría
			//a la que pertenece no sea una que ya exista.
			while( $r = mysqli_fetch_array( $resultado ) ){
				if( $r["category_id"] == $k2 ) { $disp = false; break; }
			}
		}

		return $disp;
	}
	/* ----------------------------------------------------------------------------------- */
	function nombreDisponible( $dbh, $table, $campo, $valor, $k1, $k2 ){
		//Devuelve si un nombre está disponible especificando tabla y campo a consultar
		//k1: indica id excluyente directo, usado para excluir resultado de búsqueda en la misma tabla
		//k2: indica id excluyente indirecto, usado para excluir resultado de búsqueda en tabla auxiliar
		
		$disp = true;
		$param = "";

		if( $k1 != "" ) $param = "and id <> $k1";

		$q = "select * from $table where $campo = '$valor' $param";
		
		$resultado = mysqli_query( $dbh, $q );
		$nrows = mysqli_num_rows( $resultado );
		
		if( $nrows > 0 ) $disp = false;

		if( $k2 != "" )
			$disp = chequeoExclusionIndirecta( $dbh, $resultado, $table, $k2 );

		return $disp;
	}
	
?>