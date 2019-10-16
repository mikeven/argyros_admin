<?php
    /*
     * Argyros Admin - Ajustes
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-categories.php" );
    //checkSession( 'index' );

    //// GENERACIÓN DE TALLAS ÚNICAS
    function generarTallasUnicasPorCategoria( $dbh, $idc ){
      $q1 = "insert into sizes ( name, unit, category_id, created_at ) values 
      ( 'unica', '', $idc, NOW() )";
      $q2 = "insert into sizes ( name, unit, category_id, created_at ) values 
      ( 'ajustable', '', $idc, NOW() )";
      echo $q1."<br>".$q2."<br>"."<br>";

    }

    /*$categorias = obtenerListaCategorias( $dbh );

    foreach ( $categorias as $c ) {
      
      generarTallasUnicasPorCategoria( $dbh, $c["id"] );

    }*/
    //// GENERACIÓN DE TALLAS ÚNICAS


    //// OBTENCIÓN DE REGISTROS DE DETALLES DE PRODUCTOS CON TALLAS 'N/A' JUNTO A CATEGORÍA DE PRODUCTO
    
    function regDetTallasUnicas( $dbh ){
      
      $q = "select spd.product_detail_id as iddet, spd.size_id idt, spd.adjustable, 
            c.id as idcat, c.name as categoria 
            from size_product_detail spd, product_details dp, categories c, products p, sizes s 
            where spd.size_id = s.id and spd.product_detail_id = dp.id and dp.product_id = p.id 
            and p.category_id = c.id and spd.size_id = 1";
      
      $data = mysqli_query( $dbh, $q );
      $lista = obtenerListaRegistros( $data );
      return $lista;
    }
    /*--------------------------------------------------------*/
    function obtenerIdNuevaTalla( $dbh, $idc, $adj ){
      
      if( $adj == 1 )
        $q = "select id from sizes where name = 'ajust' and category_id = $idc";
      if( $adj == 0 )
        $q = "select id from sizes where name = 'unica' and category_id = $idc";
      

      $data = mysqli_query( $dbh, $q );
      return mysqli_fetch_array( $data );
    }
    /*--------------------------------------------------------*/
    function actRefTallasUnicasCateg( $dbh, $idd, $idc, $adj ){
      
      $n_id = obtenerIdNuevaTalla( $dbh, $idc, $adj );
      $nid = $n_id[0];

      $q = "update size_product_detail set size_id = $nid where size_id = 1 
            and product_detail_id = $idd";

      //$data = mysqli_query( $dbh, $q );
    }
    /*--------------------------------------------------------*/
    $registros = regDetTallasUnicas( $dbh );
    foreach ( $registros as $r ) {
      
      //echo $r["iddet"]." ".$r["adjustable"]." ".$r["categoria"]." ".$r["idcat"]."<br>";
      actRefTallasUnicasCateg( $dbh, $r["iddet"], $r["idcat"], $r["adjustable"] );

    }
    /*--------------------------------------------------------*/
?>