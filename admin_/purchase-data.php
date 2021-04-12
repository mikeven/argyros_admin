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
    $idusuario = $_SESSION["user-adm"]["id"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Orden de compra :: Argyros Admin</title>

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

        <style type="text/css">  
            #datatable_do .dcol .fa:hover{ cursor: pointer; }
            .marked{ color: #5bc0de; }
            .icono_ista{ font-size: 14px; }
            .qdisp_orden{ width: 100%; text-align: center; }
            .btn_accion_orden{ float: left; }
            .accion_observaciones{ margin-bottom: 20px; }
            .cnt_preord {
                text-align: center;
            }
            .btn-opc-editcants{ display: none; }
        </style>
    </head>

    <?php $ids_detalles_oc = obtenerIdsDetallesEnOrdenCompra( $detalle_oc ); ?>

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
                        <h3>Orden de compra</h3>
                      </div>
                      <div class="input-group" style="float:right;">
                        <a href="purchase-orders.php" class="btn btn-app">
                          <i class="fa fa-arrow-left"></i> Volver a órdenes de compra
                        </a>
                      </div>
                    
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                      
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            
                            <div class="x_panel">
                                <?php if( isset( $orden ) ) { ?>
                                    <div class="x_title">
                                        <h2>Datos de la orden de compra</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <?php echo $iconoe; ?> 
                                        </ul>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <label class="control-label">Estado: </label> <?php echo $orden["estado"]; ?>
                                            <input type="hidden" id="status_oc" value="<?php echo $orden["estado"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Creada por: </label> 
                                            <?php echo $orden["nombre_u"]." ".$orden["apellido_u"]; ?>
                                        </div>
                                    </div>
                                  
                                    <div class="x_content">
                                        
                                        <div class="form-group">
                                            <label class="control-label">Orden: </label> <?php echo "#".$orden["id"]; ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Fecha: </label> <?php echo $orden["fecha"]; ?>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Ítems: </label> <?php echo count( $ids_detalles_oc ); ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Cantidades: </label> 
                                            <?php echo $totales["cant"]." ( $peso_aprox gr apróx. )"; ?>
                                        </div>
                                        
                                        <hr>

                                        <div class="form-group">
                                            <label class="control-label">Proveedor: </label> 
                                            <a href="provider.php?id=<?php echo $orden[idpvd] ?>" target="_blank">
                                                <?php echo "#".$orden["idpvd"]; ?>
                                                <?php echo $orden["nombre"]." ".$orden["numero"]; ?>
                                            </a>
                                        </div>

                                        <hr>

                                        <?php include( "sections/purchase-options.php" ); ?>

                                        <div class="form-group">
                                            <a href="purchase-print.php?purchase-id=<?php echo $orden[id] ?>" 
                                                class="btn btn-app" target="_blank">
                                              <i class="fa fa-file-text-o"></i> Imprimir
                                            </a>
                                        </div>

                                        <div id="res_serv"></div>

                                        <hr>

                                        <?php include("sections/tables/table-purchase-notes.php"); 
                                        // Tabla con registro de notas ?>

                                        <hr>

                                        <form id="frm_nvanota_oc" data-parsley-validate class="form-horizontal form-label-left" action="database/data-purchase.php?nvanota" method="post">
                                            <input type="hidden" id="idordenc" name="idorden" value="<?php echo $ido ?>">
                                            <input type="hidden" name="idusuario" value="<?php echo $idusuario ?>">
                                            <div class="nota_orden_compra">
                                              <textarea class="form-control" placeholder="Nota" name="nota" required></textarea>
                                            </div>
                                            <div id="area_rsp_pedido" class="form-group">
                                                <div align="center">
                                                    <button type="submit" class="btn btn-info btn-xs">Guardar</button>
                                                </div> 
                                            </div>
                                        </form>

                                        <?php include( "sections/modals/confirm_action.php" ); ?>
                                      
                                    </div>
                                <?php } else { ?>
                                    <div class="x_title">Registro no encontrado</div>
                                <?php } ?>   
                            </div>
                        
                        </div>

                        <div class="col-md-8 col-sm-5 col-xs-12">
                            
                            <?php if( isset( $orden ) ) { ?>
                                
                                <div class="x_panel">

                                  <div class="x_title">

                                    <h2>Detalle de orden de compra</h2>

                                    <?php if( $orden["estado"] == "creada" || $orden["estado"] == "enviada" ) { ?>
                                        <div style="float: right;">
                                            <button id="btn_edit_cants" type="button" class="btn btn-info btn-xs">
                                                <i class="fa fa-edit" title="Editar cantidades"></i> Editar cantidades
                                            </button>
                                            <!-- opciones edición de cantidades -->
                                            <button id="btn_guardar_cants" type="button" 
                                                class="btn btn-primary btn-xs btn-opc-editcants">
                                                <i class="fa fa-save" title="Editar cantidades"></i> Guardar
                                            </button>
                                            <button id="btn_cancelar_edit_cants" type="button" 
                                                class="btn btn-xs btn-opc-editcants">
                                                <i class="fa fa-times" title="Cancelar"></i> Cancelar
                                            </button>
                                        </div>
                                    <?php } ?>

                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                    <?php include( "sections/tables/table-purchase-details.php" );?> 
                                    <?php include( "sections/modals/product-image.php" ); ?>
                                  </div>                                  
                                
                                </div>

                            <?php } ?>
                          
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

    <!-- PNotify -->
    <script src="vendors/pnotify/dist/pnotify.js"></script>
    <script src="vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="js/custom.js"></script>
    <script src="js/fn-ui.js"></script>
    <script src="js/fn-purchase.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.12/sorting/datetime-moment.js"></script>
    
    <script>
        $.fn.dataTable.moment( 'DD/MM/YY' );
        $(document).ready(function() {
            $('#datatable-purchase-notes').dataTable({
                "processing": true,
                "paging": true,
                "iDisplayLength": 10,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "deferRender": true,
                "autoWidth": false,
                "columnDefs" : [{"targets":0, "type":"date-eu"}],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ regs por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando pág _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros",
                    "infoFiltered": "(filtrados de _MAX_ regs)",
                    "search": "Buscar:",
                    "processing": "<img src='https://www.argyros.com.pa/admin/images/ajax-loader.gif' width='20'>",
                    "paginate": {
                        "first":      "Primero",
                        "last":       "Último",
                        "next":       "Próximo",
                        "previous":   "Anterior"
                    }
                }
            });
            var table = $('#datatable-purchase-notes').DataTable();
            // Ordenar por columna cero, dibujar
            table.order( [ 0, 'desc' ] ).draw();
        });   
    </script>

    <?php if( isset( $_GET["nueva_nota-exito"] ) ){ ?>
        <script>
          notificar( "Orden de Compra", "Nueva nota agregada con éxito", "success" );
        </script>
    <?php } ?>

  </body>
</html>
