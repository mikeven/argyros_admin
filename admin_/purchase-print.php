<?php
    /*
     * Argyros Admin - Datos de orden de compra
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-user.php" );
    include( "fn/common-functions.php" );
    include( "database/data-purchase.php" );
    include( "database/data-products.php" );
    include( "database/data-providers.php" );
    include( "fn/fn-purchase.php" );
   
    checkSession( '' );
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Orden de compra <?php echo "#".$orden["id"]; ?></title>

        <style type="text/css">  
            body{ font-size: 14px; font-family: 'Helvetica' }
            .container{ width: 968px; margin: 0 auto; }
            .table_head_container{ padding: 4px 2px; border-bottom: 2px solid #f3f3f3; }
            .table_items_oc{ 
                margin: 20px 0 50px 0;  /*20px 0 50px 0*/
            }
            .table_items_oc thead{
                background: #f9f9f9; border: 1px solid #f3f3f3; 
                -webkit-print-color-adjust:exact; 
            }

            .table_items_oc thead th{ padding: 5px 2px; }
            .numeracion{ 
                text-align: center;
                width: 24px;
                height: 20px;
                font-size: 12px;
                border-radius: 50px;
                border: 1px double #999;
                background-color: #f9f9f9;
                vertical-align: text-bottom;
                padding: 5px 0 0 0;
                -webkit-print-color-adjust:exact;
            }
            #pie_documento{
              width: 100%;
              position: fixed;
              bottom: 0;
              margin-bottom: 8%;
              font-size: 12px !important;
            }

            @media print{
               thead {display: table-header-group;}
            }

            .table_head{ width: 100%; background: #f3f3f3; padding: 2px 20px; -webkit-print-color-adjust:exact; }
            .table_head td{ padding: 5px 0;  }

            .tabla_tallas_oc>tbody>tr>td, .tabla_tallas_oc>tbody>tr>th, .tabla_tallas_oc>tfoot>tr>td, .tabla_tallas_oc>tfoot>tr>th, .tabla_tallas_oc>thead>tr>td, .tabla_tallas_oc>thead>tr>th {
                    padding: 4px;
                    line-height: 1.1;
                    vertical-align: middle;
                    border-top: 1px solid #f2f2f2;
            }


            
        </style>
    </head>

    <?php $ids_detalles_oc = obtenerIdsDetallesEnOrdenCompra( $detalle_oc ); ?>

  <body class="nav-md_" onload="window.print();">
    
    <div class="container body" align="center">
        
        <?php if( isset( $orden ) ) { ?>
                        
            <div class="x_panel">

              <div class="x_content">
                <?php include( "sections/tables/table-purchase-print.php" );?> 
              </div>                                  
            
            </div>

        <?php } ?>

        <div id="pie_documento__" class="row pie_documento"></div>

    </div>

  </body>
</html>
