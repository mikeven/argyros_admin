<?php
    /*
     * Argyros Admin - Nuevo producto
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-user.php" );
    include( "fn/common-functions.php" );
    include( "database/data-lines.php" );
    include( "database/data-makings.php" );
    include( "database/data-products.php" );
    include( "database/data-materials.php" );
    include( "database/data-countries.php" );
    include( "database/data-categories.php" );

    checkSession( '' );

    if( isset( $_POST["P"] ) ){
      echo $_POST["trabajo"];
      echo $_POST["linea"];
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

    <title>Nuevo producto :: Argyros Admin</title>

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
  </head>

  <?php
    $lineas = obtenerListaLineas( $dbh );
    $trabajos = obtenerListaTrabajos( $dbh );
    $materiales = obtenerListaMateriales( $dbh );
    $categorias = obtenerListaCategorias( $dbh );
    $paises = obtenerListaPaisesProductores( $dbh );
  ?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include("sections/main-nav.php"); ?>

        <?php include("sections/top-nav.php"); ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Nuevo producto</h3>
              </div>

              <!--<div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Datos de nuevo producto</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> -->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                        <p class="text-muted font-13 m-b-30"> </p>
                        
                        <div class="row">
                          
                          <form id="frm_nproduct" data-parsley-validate class="form-horizontal form-label-left" 
                            action="product-detail.php" method="post">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Código </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input type="text" class="form-control" name="codigo" id="pcodigo" 
                                  placeholder="Código de producto" required="" data-parsley-available="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input type="text" class="form-control" id="pnombre" name="nombre" 
                                  placeholder="Nombre de producto" required="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">País de origen </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <select name="pais" class="form-control selectpicker">
                                    <option disabled>Seleccione</option>
                                    <?php foreach ( $paises as $p ) { ?>
                                      <option value="<?php echo $p["code"] ?>"><?php echo $p["name"] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Línea </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <select name="linea[]" class="form-control selectpicker" multiple required="">
                                    <?php foreach ( $lineas as $l ) { ?>
                                      <option value="<?php echo $l["id"] ?>"><?php echo $l["name"] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <textarea class="form-control" rows="3" name="descripcion" 
                                  placeholder="Texto descriptivo de producto"></textarea>
                                </div>
                              </div>
                              
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                              
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoría </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <select id="selcateg" name="categoria" class="form-control selectpicker" required="">
                                    <option disabled>Seleccione</option>
                                    <?php foreach ( $categorias as $c ) { ?>
                                      <option value="<?php echo $c["id"] ?>"><?php echo $c["name"] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Subcategoría </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <select id="val_subc" name="subcategoria" class="form-control" required="">
                                    
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Material </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <select id="smaterial" name="material" class="form-control selectpicker" required="">
                                    <?php foreach ( $materiales as $m ) { ?>
                                      <option value="<?php echo $m["id"] ?>"><?php echo $m["name"] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Trabajo </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <select id="strabajo" name="trabajo[]" class="form-control selectpicker" multiple required="">
                                    <?php foreach ( $trabajos as $t ) { ?>
                                      <option value="<?php echo $t["id"] ?>"><?php echo $t["name"] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                                                      
                            </div>
                          
                          </form>
                        
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                          <div align="center">
                            <button id="bot_guardar_nuevo_producto" type="submit" class="btn btn-success">Guardar</button>
                          </div>
                          <div id="ghres"></div>
                          <button type="button" class="btn btn-primary hidden" data-toggle="modal" 
                          data-target=".bs-example-modal-sm">Respuesta</button>
                          <?php include( "sections/modals/response_message.php" );?>
                        </div>
                  
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

    <!-- Parsley -->
    <script src="vendors/parsleyjs/dist/parsley.min.js"></script>
    <script src="vendors/parsleyjs/dist/i18n/es.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="js/custom.js"></script>
    <script src="js/fn-ui.js"></script>
    <script src="js/fn-product.js"></script>
    <script src="js/fn-validators.js"></script>
    <script>
      
      $(document).ready(function() {
        $('#frm_nproduct').parsley().on('form:success', function() {
          agregarProducto(); 
        });
      });
      
    </script>

    <!-- PNotify -->
    <script src="vendors/pnotify/dist/pnotify.js"></script>
    <script src="vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="vendors/pnotify/dist/pnotify.nonblock.js"></script>
	
  </body>
</html>
