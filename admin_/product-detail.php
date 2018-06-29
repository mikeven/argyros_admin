<?php
  /*
   * Argyros Admin - Detalle del producto
   * 
   */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-user.php" );
    include( "fn/common-functions.php" );
    include( "database/data-lines.php" );
    include( "database/data-sizes.php" );
    include( "database/data-colors.php" );
    include( "database/data-makings.php" );
    include( "database/data-products.php" );
    include( "database/data-materials.php" );
    include( "database/data-countries.php" );
    include( "database/data-treatments.php" );
    include( "database/data-categories.php" );

    include( "fn/fn-prices.php" );
    include( "fn/fn-products.php" );
    checkSession( '' );
    
    if( isset( $_GET["p"] ) ){
        $idp = $_GET["p"];
        $lnk_back = "product-data.php?p=$idp";    
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

    <title>Detalle de producto :: Argyros Admin</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/bootstrap-select-1.12.4/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- dropzone -->
    <link href="vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <link href="css/fileinput.css" rel="stylesheet">
	
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
  <style>
    #img_uploader{
      width: 100%;
      min-height: 353px;
      border: 1px solid #2a3f54;
    }
    #talla_peso{
      padding: 8px 0;
      height: auto;
      border: 1px solid #ccc;
    }
    .oprecio{display: none;}
  </style>

  <?php
    $banos = obtenerListaBanos( $dbh );                               // database/data-treatments.php
    $lineas = obtenerListaLineas( $dbh );                             // database/data-lines.php
    $colores = obtenerListaColores( $dbh );                           // database/data-colors.php
    $trabajos = obtenerListaTrabajos( $dbh );                         // database/data-makings.php
    $tprecios = obtenerOpcionesPrecios();                             // fn/fn-prices.php
    
    $producto = obtenerProductoPorId( $dbh, $idp );
    $tallas = obtenerListaTallasCategoria( $dbh, $producto["cid"] );  // database/data-sizes.php
    $t0 = obtenerValoresTallaCero( $dbh );
    
  ?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include("sections/main-nav.php"); ?>

        <?php include("sections/top-nav.php"); ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            <!--<div class="page-title">
              
              <div class="title_left">
                <h3>Nuevo producto</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div> -->

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Detalle de producto</h2>
                    <ul class="nav navbar-right panel_toolbox">
                     <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> -->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      
                      <p class="text-muted font-13 m-b-30"> </p>
                      
                      <form id="frm_ndetproduct" data-parsley-validate 
                      class="form-horizontal form-label-left" action="product-data.php?p=<?php echo $idp; ?>" method="post">
                          
                          <div class="row">
                          
                            <div class="col-md-5 col-sm-5 col-xs-12">
                              
                                <div class="form-group">
                                  <input id="idproducto" type="hidden" name="idproducto" value="<?php echo $idp; ?>">
                                  <a href="<?php echo $lnk_back; ?>">
                                    <label class="control-label">Producto: </label> <?php echo $producto["nombre"]; ?>
                                  </a>
                                  <label class="control-label">( <?php echo $producto["codigo"]; ?> )</label>
                                </div>
                                
                                <div class="form-group">
                                  <label class="control-label">Categoría: </label> 
                                  <?php echo $producto["categoria"]." > ".$producto["subcategoria"]; ?>
                                </div>
                                
                                <div class="form-group">
                                  <label class="control-label">Material::</label> 
                                  <?php echo $producto["material"]; ?>
                                </div>
                                
                                <div class="ln_solid"></div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Baño </label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="bano" class="form-control" required="">
                                      <option value>Seleccione</option>
                                      <?php foreach ( $banos as $b ) { ?>
                                        <option value="<?php echo $b["id"] ?>"><?php echo $b["name"] ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Color </label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="color" class="form-control" required="">
                                      <option value>Seleccione</option>
                                      <?php foreach ( $colores as $c ) { ?>
                                        <option value="<?php echo $c["id"] ?>"><?php echo $c["name"] ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de precio </label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select id="seltprecio" name="tprecio" class="form-control" required="">
                                      <option value>Seleccione</option>
                                      <?php foreach ( $tprecios as $tp ) { ?>
                                        <option value="<?php echo $tp["tipo"] ?>">
                                          <?php echo $tp["etiqueta"]; ?>
                                        </option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>

                                <div id="valor_pieza" class="form-group oprecio">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor de la pieza </label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input id="vpieza" name="valor_pieza" type="text" class="form-control vtp" placeholder="Valor de pieza" 
                                    value="0.00">
                                  </div>
                                </div>

                                <div id="valor_mo" class="form-group oprecio">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor de mano de obra </label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input id="vmanoo" name="valor_mano_obra" type="text" class="form-control vtp" 
                                    placeholder="Valor Mano de obra" value="0.00">
                                  </div>
                                </div>

                                <div id="valor_gramo" class="form-group oprecio">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor del gramo </label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input id="vgramo" name="valor_gramo" type="text" class="form-control vtp" 
                                    placeholder="Valor del gramo" value="0.00">
                                  </div>
                                </div>
                              
                                <div class="ln_solid"></div>

                                <div class="form-group">
                                  
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Talla - Peso </label>
                                  <div class="col-md-4 col-sm-4 col-xs-12">
                                    <button type="button" class="btn btn-primary" 
                                    data-toggle="modal" data-target="#size-table">Seleccionar</button>
                                    <?php include( "sections/modals/sizes-weight.php" ); ?>
                                  </div>
                                  <div id="tallas_seleccion" class="col-md-5 col-sm-5 col-xs-12"> </div>
                                  <div id="valor_tseleccion" class="col-md-5 col-sm-5 col-xs-12"> </div>
                                  <div id="image-response"></div>

                                </div>

                            </div>

                            <!-- Columna derecha -->
                            <div class="col-md-7 col-sm-7 col-xs-12">
                              <div id="img_uploader" class="s">

                                <div id="panel_upload_photos">
                                  <input id="images" name="images[]" type="file" multiple class="file-loading">
                                  
                                </div>
                                
                              </div>
                            </div>
                        
                          </div>
                          
                          <div class="ln_solid"></div>
                          
                          <div class="form-group">
                            <div align="center">
                              <button id="bot_guardar_det_producto" type="button" class="btn btn-success">Guardar</button>
                            </div>
                            <div id="ghres"></div>
                          </div>

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

    <!-- Dropzone -->
    <script src="js/dropzone.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/locales/es.js"></script>

    <script>
        Dropzone.autoDiscover = false;

        $(document).ready(function() {
        
          $("#myId").dropzone({ 
            url: "http://127.0.0.1/argyros/trunk/admin_/uploads/upload.php",
            dictDefaultMessage:"Arrastre las imágenes del XXX correspondientes al color seleccionado..." 
          });
          
        });
    </script>
    <script>
        var server_url = "database/data-products.php";
        $("#images").fileinput({
            uploadUrl: server_url, // server upload action
            uploadAsync: true,
            maxFileCount: 6,
            language: "es",
            width: '50px',
            autoReplace: false,
            removeFromPreviewOnError: true,
            uploadExtraData: function() {
                return {
                    file_sending: "product_detail_pic",
                    id_producto:  <?php echo $idp; ?>
                };
            }
        }).on('filelock', function(event, filestack, extraData) {
          var fstack = filestack.filter(function(n){ return n != undefined });
          console.log( 'Files selected - ' + fstack.length );
        });

        $("#images").on('fileuploaded', function( event, data, previewId, index ) {
          var form = data.form, files = data.files, extra = data.extra, response = data.response, reader = data.reader;
          console.log( response );
          agregarCamposOcultosImagenes();
        });
        
        $("#images").on('filebatchuploadcomplete', function( event, data, previewId, index ) {
          agregarCamposOcultosImagenes();
        });

    </script>

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
    
    <!--<script src="https://gist.github.com/askehansen/6809825.js"></script>-->

    <!-- Parsley -->
    <script src="vendors/parsleyjs/dist/parsley.min.js"></script>
    <script src="vendors/parsleyjs/dist/i18n/es.js"></script>

    <script>
      
      $(document).ready(function() {
        $('#frm_ndetproduct').parsley().on('form:success', function() {
          alert("EXITO");
          if( checkDetalleProducto() == 0 ){
            agregarDetalleProducto();
          };
          
        });
      });
      
    </script>

    <!-- Custom Theme Scripts -->
    <script src="js/custom.js"></script>
    <script src="js/fn-ui.js"></script>
    <script src="js/fn-product.js"></script>
    <script src="js/fn-validators.js"></script>

    <!-- PNotify -->
    <script src="vendors/pnotify/dist/pnotify.js"></script>
    <script src="vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="vendors/pnotify/dist/pnotify.nonblock.js"></script>

  </body>
</html>
