<?php
    /*
     * Argyros Admin - Datos cliente
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-user.php" );
    include( "fn/common-functions.php" );
    include( "database/data-clients.php" );

    if( isset( $_GET["id"] ) ){
        $idc        = $_GET["id"];
        $cliente    = obtenerClientePorId( $dbh, $idc );
        $grupos     = obtenerListaGruposClientes( $dbh );
    }
    
    checkSession( '' );
    $idusuario          = $_SESSION["user-adm"]["id"];
    $notas_cliente      = obtenerListaNotasClientes( $dbh, $idc );
    $ingresos_cliente   = obtenerIngresosCliente( $dbh, $idc );
?>
<!DOCTYPE html>
<html lang="en">
  <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Datos cliente :: Argyros Admin</title>

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
            #login_list{ 
                display: none; 
                text-align: right; 
                max-height: 300px; 
                overflow-y: scroll; 
                padding-right: 20px 
            }
        </style>
  </head>

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
                <h3>Cliente</h3>
              </div>

              <div class="input-group" style="float:right;">
                <a href="clients.php" class="btn btn-app">
                  <i class="fa fa-arrow-left"></i> Volver a clientes
                </a>
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
                    <h2>Datos de cliente</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="x_content">
                    
                    <div class="form-group">
                        <label class="control-label">Cliente: </label> 
                        <?php echo $cliente["nombre"]." ".$cliente["apellido"]; ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email: </label> <?php echo $cliente["email"]; ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">phone: </label> <?php echo $cliente["telefono"]; ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Dirección: </label> <?php echo $cliente["direccion"]; ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">País: </label> <?php echo $cliente["pais"]; ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Grupo cliente: </label>
                        <select class="form-control selec_grupo_perfil" data-idc="<?php echo $idc ?>">
                            <option disabled>Seleccione</option>
                            <?php foreach ( $grupos as $g ) { ?>
                            <option <?php echo sop( $cliente["grupo"], $g["name"] ); ?> value="<?php echo $g['id'] ?>">
                                <?php echo $g["name"] ?> 
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <label class="control-label">Compañía: </label> <?php echo $cliente["ncompania"]; ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tipo compañía: </label> <?php echo $cliente["tcompania"]; ?>
                    </div>                
                    
                    <?php if( $cliente["verificado"] != 1 ) { ?>
                        <div id="activacion_cuenta">
                            <div class="ln_solid"></div>
                            <span>Cuenta no verificada </span>

                            <button id="act_cuenta" type="button" class="btn btn-success btn-xs" 
                            data-toggle="modal" data-target="#confirmar-accion" 
                            data-idc="<?php echo $idc ?>">Activar cuenta de usuario</button>
                        </div>

                    <?php } ?>

                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <label class="control-label">Fecha creación: </label> 
                        <?php echo $cliente["fcreacion"]; ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Fecha última modificación: </label> 
                        <?php echo $cliente["fmodificacion"]; ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Fecha último ingreso: </label> 
                        <a href="#!" id="login_hist">
                            <?php echo $ingresos_cliente[0]["flogin"]; ?> 
                            <i class="fa fa-toggle-down"></i>
                        </a>
                    </div>
                    <div id="login_list" class="form-group">
                        <label class="control-label">Historial de ingresos </label>
                        <?php foreach ( $ingresos_cliente as $reg ) { ?>
                            <div> <span><?php echo $reg["flogin"]; ?> </span> </div>
                        <?php } ?>
                    </div>  

                    <?php if( in_array( $uargyros["id"], array( 1, 7 ) ) ) { ?>
                        <div class="ln_solid"></div>
                        <form id="frm_nvapasswd_cliente" data-parsley-validate 
                        class="form-horizontal form-label-left" action="database/data-clients.php?mpassword" method="post">
                            <div class="form-group">
                                <label class="control-label">Asignar nueva constraseña a cliente: </label> 
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="idcliente" value="<?php echo $idc; ?>">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña: </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input type="password" class="form-control" placeholder="Password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                              <div align="center">
                                <button type="submit" class="btn btn-success">Guardar</button>
                              </div>
                            </div>
                        </form>
                    <?php } ?>
                  
                  </div>
                
                </div>
              </div>
              
              <div class="col-md-8 col-sm-5 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Notas</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        
                        <?php include("sections/tables/table-client-notes.php"); // Tabla con registro de notas ?>

                    </div>

                    
                    <div class="x_content">
                        <div class="ln_solid"></div>
                        
                        <form id="frm_nvanota_cliente" data-parsley-validate class="form-horizontal form-label-left" 
                            action="database/data-clients.php?nvanota" method="post">
                            <div class="form-group">
                                <label class="control-label">Agregar nueva nota: </label> 
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="idcliente" value="<?php echo $idc; ?>">
                                <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nota: </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <textarea class="form-control" placeholder="Nota" name="nota" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                              <div align="center">
                                <button type="submit" class="btn btn-success">Guardar</button>
                              </div>
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
    <script src="js/fn-client.js"></script>
	<script src="js/fn-ui.js"></script>

    <?php include( "fn/fn-clients.php" ); ?>

    
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.12/sorting/datetime-moment.js"></script>
    
    <script>
        $.fn.dataTable.moment( 'DD/MM/YY' );
        $(document).ready(function() {

            $('#login_hist').on('click', function() {
                $("#login_list").fadeToggle();
            });

            $('#datatable-client-notes').dataTable({
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
            var table = $('#datatable-client-notes').DataTable();
            // Ordenar por columna cero, dibujar
            table.order( [ 0, 'desc' ] ).draw();
        });   
    </script>

  </body>
</html>
