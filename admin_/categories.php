<?php
    /*
     * Argyros Admin - Categorías
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-user.php" );
    include( "database/data-categories.php" );

    include( "fn/common-functions.php" );
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

    <title>Categorías :: Argyros Admin</title>

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
  </head>

  <?php
    $categorias = obtenerListaCategorias( $dbh );
    $cdestacadas[0] = obtenerCategoriasDestacadaPorOrden( $dbh, 1 );
    $cdestacadas[1] = obtenerCategoriasDestacadaPorOrden( $dbh, 2 );
    $cdestacadas[2] = obtenerCategoriasDestacadaPorOrden( $dbh, 3 );
    $cdestacadas[3] = obtenerCategoriasDestacadaPorOrden( $dbh, 4 );
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
                <h3>Categorías</h3>
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
              </div>-->
            
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Crear categoría</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form id="frm_ncategoria" data-parsley-validate class="form-horizontal form-label-left" 
                      action="database/data-categories.php?ncategoria" method="post">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="nombre" type="text" class="form-control" placeholder="Nombre categoría" required="">
                        </div>
                      </div>
                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div align="center">
                          <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                      </div>
                    </form>  
                  </div>
                </div>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Categorías destacadas</h2>
                    <ul class="nav navbar-right panel_toolbox"></ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form id="frm_cestacadas" data-parsley-validate class="form-horizontal form-label-left" 
                      action="database/data-categories.php?categorias_destacadas" method="post">
                       
                       <!-- *** -->

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">#1 </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select name="c_orden1" class="form-control">
                            <option disabled>Seleccione</option>
                            <?php foreach ( $categorias as $c ) { ?>
                              <option value="<?php echo $c["id"] ?>" <?php echo sop( $c["id"], $cdestacadas[0]["id"] )?>><?php echo $c["name"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <!-- *** -->

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">#2 </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select name="c_orden2" class="form-control">
                            <option disabled>Seleccione</option>
                            <?php foreach ( $categorias as $c ) { ?>
                              <option value="<?php echo $c["id"] ?>" <?php echo sop( $c["id"], $cdestacadas[1]["id"] )?>><?php echo $c["name"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                       <!-- *** -->

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">#3 </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select name="c_orden3" class="form-control">
                            <option disabled>Seleccione</option>
                            <?php foreach ( $categorias as $c ) { ?>
                              <option value="<?php echo $c["id"] ?>" <?php echo sop( $c["id"], $cdestacadas[2]["id"] )?>>
                                <?php echo $c["name"] ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                       <!-- *** -->

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">#4 </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select name="c_orden4" class="form-control">
                            <option disabled>Seleccione</option>
                            <?php foreach ( $categorias as $c ) { ?>
                              <option value="<?php echo $c["id"] ?>" <?php echo sop( $c["id"], $cdestacadas[3]["id"] )?>><?php echo $c["name"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                       <!-- *** -->

                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div align="center">
                          <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                      </div>
                    </form>  
                  </div>
                </div>


              </div>
              <div class="col-md-8 col-sm-5 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Lista de categorías</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30"> </p>
                    <div id="tabla_datos-categorias">
                      <?php include( "sections/tables/table-categories.php" );?>
                    </div>
                    <?php include( "sections/modals/confirm_action.php" ); ?>
                    <input id="id-categ-e" type="hidden">
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

        <button type="button" class="btn btn-default source hidden" onclick="new PNotify({
            title: '',
            text: 'That thing that you were trying to do worked!',
            type: 'success',
            styling: 'bootstrap3'
        });">Success</button>

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

    <!-- PNotify -->
    <script src="vendors/pnotify/dist/pnotify.js"></script>
    <script src="vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- Parsley -->
    <script src="vendors/parsleyjs/dist/parsley.min.js"></script>
    <script src="vendors/parsleyjs/dist/i18n/es.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="js/custom.js"></script>
    <script src="js/fn-category.js"></script>
    <script src="js/fn-ui.js"></script>

    <?php include( "fn/fn-categories.php" ); ?>
	  
  </body>
</html>
