<?php
    /*
     * Argyros Admin - Ficha de producto
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-user.php" );
    include( "fn/common-functions.php" );
    include( "database/data-products.php" );
    include( "database/data-providers.php" );

    include( "fn/fn-products.php" );

    checkSession( '' );    
    
    if( isset( $_GET["p"] ) ){
        $idp = $_GET["p"];    
    }else{

    }
?>
<!DOCTYPE html>
<html lang="en">
  
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Detalle de productos :: Argyros Admin</title>

        <!-- Bootstrap -->
        <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="vendors/bootstrap-select-1.12.4/dist/css/bootstrap-select.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Datatables -->
        <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

        <!-- PNotify -->
        <link href="vendors/pnotify/dist/pnotify.css" rel="stylesheet">
        <link href="vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
        <link href="vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="build/css/custom.min.css" rel="stylesheet">
        <link href="css/custom-styles.css" rel="stylesheet">

        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    </head>
    <style>
        .thumb_detailproduct{
            margin: 2px ;
            padding:1px;
            border: 1px solid #ccc;
            float: left;
        }

        .data-talla-detalle{
            padding-top: 15px;
        }
        .bloq_refpdu{ display: none; }
        .lnk_btnpdu{ margin-top: 20px }
        .poculto{ background-color: #f9c7c6 !important; }
        .txubc{ border: 1px solid #f1f1f1; }

        .ref_desuso {
            padding: 3px;
            border: 1px solid #ccc;
            border-radius: 2px;
        }

        .ids-auto-c {
            float: left;
            left: 90px;
            width: 160px;
            list-style: none;
            margin-top: 0px;
            padding: 0;
            position: absolute;
            z-index: 1;
        }

        .ids-auto-c li {
            padding: 8px 8px 8px 12px;
            background: #f0f0f0;
            border-bottom: #bbb9b9 1px solid;
        }

        .ui-autocomplete-row {
            padding:8px;
            background-color: #f4f4f4;
            border-bottom:1px solid #ccc;
            font-weight:bold;
        }
        .ui-autocomplete-row:hover{
            background-color: #ddd;
        }

        .disuse-label{ color: #d58512; }
    </style>

  <?php
    if( isset( $idp ) ) {
        $producto       = obtenerProductoPorId( $dbh, $idp );
        $dproducto      = obtenerDetalleProductoPorId( $dbh, $idp );
        $trabajosp      = obtenerTrabajosDeProductoPorId( $dbh, $idp );
        $lineasp        = obtenerLineasDeProductoPorId( $dbh, $idp );
        
        $proveedores    = obtenerDatosProveedores( $dbh, $producto );
    }
  ?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include("sections/main-nav.php"); ?>

        <?php include("sections/top-nav.php"); ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Datos de producto</h2>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">

                          <div class="input-group" style="float:right;">
                            <a href="product-detail.php?p=<?php echo $idp;?>" class="btn btn-app">
                              <i class="fa fa-plus"></i> Agregar detalle
                            </a>
                          </div>

                          <div class="input-group" style="float:right;">
                            <a href="products.php" class="btn btn-app">
                              <i class="fa fa-arrow-left"></i> Volver a productos
                            </a>
                          </div>
                          
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form id="frm_nproduct" data-parsley-validate class="form-horizontal form-label-left" 
                      action="new-product.php?p=1" method="post">
                        <p class="text-muted font-13 m-b-30"> </p>
                        <?php if( isset( $idp ) ) { ?>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                
                                <div class="data-product-label">
                                    <label class="control-label">
                                        ID: </label> <?php echo $producto["id"]; ?>
                                </div>
                                <div class="data-product-label">
                                    <label class="control-label">
                                        Código: </label> <?php echo $producto["codigo"]; ?>
                                </div>
                                <div class="data-product-label">
                                    <label class="control-label">
                                        Producto: </label> <?php echo $producto["nombre"]; ?>
                                </div>
                                <div class="data-product-label">
                                    <label class="control-label">Descripción: </label> <?php echo $producto["descripcion"]; ?>
                                </div>
                                <div class="data-product-label">
                                    <label class="control-label">Categoría: 
                                    </label> <?php echo $producto["categoria"]." > ".$producto["subcategoria"]; ?>
                                    <input type="hidden" name="idsubctg" id="id_subcat" value="<?php echo $producto[scid]; ?>">
                                </div>
                                <div class="data-product-label">
                                    <label class="control-label">Material: </label> <?php echo $producto["material"]; ?>
                                </div>
                                <div class="data-product-label">
                                    <label class="control-label">País: </label> <?php echo $producto["pais"]; ?>
                                </div>
                                <div class="data-product-label">
                                    <label class="control-label">Fecha de creación: </label> 
                                    <?php echo $producto["fcreacion"]; ?>
                                </div>

                                <div class="ln_solid"></div>
                                
                                <div class="data-product-label">
                                    <label class="control-label">Código de fabricante 1: </label> 
                                    <?php echo $producto["codigof1"]; ?> 
                                    <?php if( $proveedores[1] ) { ?>
                                        | <label class="control-label">Proveedor 1: </label> 
                                        <?php echo $proveedores[1]["number"]." ".$proveedores[1]["name"]; ?>  
                                    <?php } ?>
                                </div>
                                
                                <div class="data-product-label">
                                    <label class="control-label">Código de fabricante 2: </label> 
                                    <?php echo $producto["codigof2"]; ?> 
                                    <?php if( $proveedores[2] ) { ?>
                                        | <label class="control-label">Proveedor 2: </label> 
                                        <?php echo $proveedores[2]["number"]." ".$proveedores[2]["name"]; ?>  
                                    <?php } ?>
                                </div>

                                <div class="data-product-label">
                                    <label class="control-label">Código de fabricante 3: </label> 
                                    <?php echo $producto["codigof3"]; ?> 
                                    <?php if( $proveedores[3] ) { ?>
                                        | <label class="control-label">Proveedor 3: </label> 
                                        <?php echo $proveedores[3]["number"]." ".$proveedores[3]["name"]; ?>  
                                    <?php } ?>
                                </div>
                                
                                <div class="ln_solid"></div>
                                
                                <div id="datos_línea">
                                    <label class="control-label">Líneas: </label>
                                    <?php echo mostrarLineasProducto( $lineasp ); ?>    
                                </div>
                                <div id="datos_trabajo">
                                    <label class="control-label">Trabajos: </label>
                                    <?php echo mostrarTrabajosProducto( $trabajosp ); ?>    
                                </div>
                                
                                <div class="ln_solid"></div>
                                
                                <div>
                                    <a href="product-edit.php?id=<?php echo $idp; ?>">
                                        <button type="button" class="btn btn-info btn-xs">Editar</button>
                                    </a>
                                </div>
                                <div>
                                    <a href="product-copy.php?id=<?php echo $idp; ?>">
                                        <button type="button" class="btn btn-info btn-xs">
                                            Copiar producto
                                        </button>
                                    </a>
                                </div>
                              
                            </div>

                            <?php include( "sections/product-data-detail.php" ); ?>

                        </div>
                        <?php } ?>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include( "sections/footer.php" ); ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendors/bootstrap-select-1.12.4/dist/js/bootstrap-select.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- PNotify -->
    <script src="vendors/pnotify/dist/pnotify.js"></script>
    <script src="vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="js/custom.js"></script>
    <script src="js/fn-ui.js"></script>
	<script src="js/fn-product.js"></script>
  </body>
</html>
