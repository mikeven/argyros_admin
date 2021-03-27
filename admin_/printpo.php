<?php
    /*
     * Argyros Admin - Lista pre orden
     * 
     */
    session_start();
    include( "fn/fn-purchase.php" );

    $preorden = isset( $_SESSION["preorden"] ) ? $_SESSION["preorden"] : array();
    $ids_preo = obtenerIdsDetallesEnPreorden( $preorden );
    echo "\n";
    print_r( $ids_preo );

    echo "\n";
?>