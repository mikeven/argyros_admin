<?php
    /*
     * Argyros Admin - Productos no disponibles
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-user.php" );
    include( "database/data-providers.php" );
    include( "fn/common-functions.php" );
    include( "fn/fn-purchase.php" );
    include( "database/data-products.php" );
    checkSession( '' );

    print_r($_SESSION["preorden"]);
?>
