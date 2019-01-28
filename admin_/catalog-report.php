<?php
    /*
     * Argyros Admin - Imágenes de catálogo
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-user.php" );
    include( "database/data-lines.php" );
    include( "database/data-colors.php" );
    include( "database/data-makings.php" );
    include( "database/data-clients.php" );
    include( "database/data-products.php" );
    include( "database/data-materials.php" );
    include( "database/data-treatments.php" );
    include( "database/data-categories.php" );

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

    <title>Imágenes de catálogo :: Argyros Admin</title>

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

    <!-- select-picker-multiple -->
    <link href="vendors/select-picker/picker.css" rel="stylesheet">

    <!-- PNotify -->
    <link href="vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <link href="css/custom-styles.css" rel="stylesheet">
  </head>

  <style>
    .pc-trigger, .pc-element{
      padding-top: 6px !important;
      padding-bottom: 6px !important;
    }

    #response_img{ margin-top: 10px; }

    .lnkig{ margin-right: 5px; }

    .view-first p{ max-height: 45px; }
  </style>

  <?php

    $banos = obtenerListaBanos( $dbh );
    $lineas = obtenerListaLineas( $dbh );
    $colores = obtenerListaColores( $dbh );
    $trabajos = obtenerListaTrabajos( $dbh );
    $materiales = obtenerListaMateriales( $dbh );
    $categorias = obtenerListaCategorias( $dbh );
    $grupos = obtenerListaGruposClientes( $dbh );
    
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
                <h3>Imágenes de catálogo</h3>
              </div>
            
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <!-- -------------------------- Primera columna ------------------------------- -->
              <div class="col-md-5 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Selección de parámetros</h2>
                    <!--<ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>-->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form id="frm_rcatalogo" data-parsley-validate 
                    class="form-horizontal form-label-left" 
                      action="" method="post">

                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <input id="busq_id" type="checkbox" class="flat" name="ch_busq_id"> 
                          Buscar por identificador
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      
                      <div id="panel_opciones_1">

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoría </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select id="selcateg_fr" name="categoria" class="form-control selectpicker" 
                              required title="Seleccione">
                                <?php foreach ( $categorias as $c ) { ?>
                                  <option value="<?php echo $c["id"] ?>"><?php echo $c["name"] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Subcategoría </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select id="val_subc" name="subcategoria" class="form-control" 
                              title="Seleccione" required>
                              <option value="">Seleccione</option>
                                
                              </select>
                            </div>
                          </div>
                          
                          <div class="ln_solid"></div>

                          <div class="form-group"><!-- Tallas -->
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Tallas </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <select id="tallas_fc" name="tallas[]" class="form-control" 
                              title="Seleccione" multiple>                            
                                
                              </select>    
                            </div>
                          </div>

                          <div class="form-group"><!-- Peso -->
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Peso </label>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                              <input type="text" id="flt_pre_pes_min" class="form-control input_flt" placeholder="Mín gr." name="peso_min" value="" 
                              onkeypress="return isNumberKey(event)">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                              <input type="text" id="flt_pre_pes_max" class="form-control input_flt" placeholder="Máx gr." name="peso_max" value="" 
                              onkeypress="return isNumberKey(event)">
                            </div>
                          </div>

                          <div class="form-group"><!-- Precio por pieza -->
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Precio por pieza </label>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                              <input type="text" id="flt_pre_pro_min" class="form-control input_flt" placeholder="Mín $" name="prepza_min" value="" 
                              onkeypress="return isNumberKey(event)">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                              <input type="text" id="flt_pre_pro_max" class="form-control input_flt" placeholder="Máx $" name="prepza_max" value="" 
                              onkeypress="return isNumberKey(event)">  
                            </div>
                          </div>

                          <div class="form-group"><!-- Precio por peso -->
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Precio por gr</label>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                              <input type="text" id="flt_pre_pes_min" class="form-control input_flt" placeholder="Mín $" name="prepes_min" value="" 
                              onkeypress="return isNumberKey(event)">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                              <input type="text" id="flt_pre_pes_max" class="form-control input_flt" placeholder="Máx $" name="prepes_max" value="" 
                              onkeypress="return isNumberKey(event)">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Perfil cliente </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select id="gcliente" name="cgcliente" class="form-control selectpicker" 
                              title="Seleccione">
                                <?php foreach ( $grupos as $g ) { ?>
                                  <option value="<?php echo $g["id"] ?>"><?php echo $g["name"] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group"><!-- Líneas -->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Líneas </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select id="rlinea" name="linea[]" class="form-control selectpicker" 
                              title="Seleccione" multiple>
                                <?php foreach ( $lineas as $l ) { ?>
                                  <option value="<?php echo $l["id"] ?>"><?php echo $l["name"] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div><!-- Líneas -->

                          <div class="form-group"><!-- Materiales -->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Materiales </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select id="rmaterial" name="material" class="form-control selectpicker" 
                              title="Seleccione">
                              <option value="">Seleccione</option>
                                <?php foreach ( $materiales as $m ) { ?>
                                  <option value="<?php echo $m["id"] ?>"><?php echo $m["name"] ?></option>
                                <?php } ?>
                              </select>  
                            </div>
                          </div><!-- Materiales -->

                          <div class="form-group"><!-- Baños -->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Baños </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select id="banos_fc" name="bano[]" class="form-control" multiple 
                              title="Seleccione">
                                
                              </select>
                            </div>
                          </div><!-- Baños -->

                          <div class="form-group"><!-- Colores -->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Colores </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select id="rcolor" name="color[]" class="form-control selectpicker" 
                              title="Seleccione" multiple>
                                <?php foreach ( $colores as $c ) { ?>
                                  <option value="<?php echo $c["id"] ?>"><?php echo $c["name"] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div><!-- Colores -->

                          <div class="form-group"><!-- Trabajos -->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Trabajos </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select id="rtrabajo" name="trabajo[]" class="form-control selectpicker" 
                              title="Seleccione" multiple >
                                <?php foreach ( $trabajos as $t ) { ?>
                                  <option value="<?php echo $t["id"] ?>"><?php echo $t["name"] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div><!-- Trabajos -->

                          <div class="ln_solid"></div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"> </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <div>
                                <input type="checkbox" name="p_ocultos" class="flat"> 
                                Obtener sólo productos ocultos
                              </div>
                            </div>
                          </div>
                      </div>

                      <div id="panel_opciones_2" class="form-group" style="display: none;">
                        <!-- Identificador -->
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        Identificador</label>
                        <div class="col-md-9 col-sm-9 col-xs-6">
                          <input type="text" id="flt_pre_pes_min" class="form-control input_flt" placeholder="Id producto-Id detalle" name="identificador">
                        </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Perfil cliente</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select id="gcliente_id" name="cgcliente_id" 
                              class="form-control selectpicker" 
                              title="Seleccione">
                                <?php foreach ( $grupos as $g ) { ?>
                                  <option value="<?php echo $g["id"] ?>"><?php echo $g["name"] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                        </div>

                      </div>

                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mostrar </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div>
                            <input type="checkbox" name="p_pep" class="flat" checked> Peso
                          </div>
                          <div>
                            <input type="checkbox" name="p_idp" class="flat"> #ID del producto
                          </div>
                          <div>
                            <input type="checkbox" name="p_nop" class="flat"> Nombre del producto
                          </div>
                          <div>
                            <input type="checkbox" name="p_prp" class="flat"> Precio 
                          </div>
                          <div>
                            <input type="checkbox" name="p_tal" class="flat"> Tallas 
                          </div>
                        </div>
                      </div>

                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div align="center">
                          <button id="btn_rcatal" type="button" class="btn btn-success">Buscar</button>
                        </div>
                      </div>

                    </form>  
                  </div>
                </div>

                <div class="x_panel hidden">
                  <div class="x_title">
                    <h2>Búsqueda por identificador</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form id="frm_rcatalogo_id" data-parsley-validate 
                    class="form-horizontal form-label-left" 
                      action="" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary">Buscar</button>
                            </span>
                        </div>
                        <div class="form-group">
                        <div align="center">
                          <button id="btn_rcatal_id" type="button" 
                          class="btn btn-success">Buscar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- -------------------------- Segunda columna ------------------------------- -->
              <div class="col-md-7 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Resultado</h2>
                    <!--<ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>-->

                    <div class="clearfix"></div>
                  </div>
                  <div id="tabla_datos-consulta" class="x_content">
                     
                  </div>
                  
                  <div class="form-group">
                    <div align="center">
                      <button id="btn_oimgs" type="button" 
                      class="btn btn-success" style="display: none">Obtener imágenes</button>
                      <div id="response_img"></div>
                      <input type="hidden" id="status_r" value="0">
                      <div id="progreso_img" class="progress progress-striped" style="display: none;">
                        <div id="barra_progreso_img" data-transitiongoal="" aria-valuenow="" 
                        class="progress-bar progress-bar-success progress-bar-animated"></div>
                      </div>
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

    <!-- select picker -->
    <script src="vendors/select-picker/picker.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
          /*$('#tallas_fc').picker(
            texts : { trigger : "Selexione" }
          );
          $('#banos_fc').picker(
            texts : { trigger : "Seleccione" }
          );*/
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

    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

    <!-- PNotify -->
    <script src="vendors/pnotify/dist/pnotify.js"></script>
    <script src="vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- Parsley -->
    <script src="vendors/parsleyjs/dist/parsley.min.js"></script>
    <script src="vendors/parsleyjs/dist/i18n/es.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="js/custom.js"></script>
    <script src="js/fn-ui.js"></script>
    <script src="js/fn-product.js"></script>
	  <script src="js/fn-catalog.js"></script>
  </body>
</html>
