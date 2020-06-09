<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Categoría</th>
      <th>Subcategoría</th>
      <th>Producto</th>
      <th>Detalles</th>
    </tr>
  </thead>
  <tbody>
      <?php 
        foreach ( $productos as $p ) {
          $lnk_p = "product-data.php?p=$p[id]";
          $drdet = obtenerDetalleProductoPorId( $dbh, $p["id"] );
      ?>
      <tr>
        <td><?php echo $p["categoria"]; ?></td>
        <td><?php echo $p["subcategoria"]; ?></td>
        <td><a class="primary" href="<?php echo $lnk_p; ?>"><?php echo $p["nombre"]; ?></a></td>
        <td>
          <?php
            foreach ( $drdet as $dp ) {
              $lnk_dp = "product-data.php?p=$p[id]#$dp[id]"; 
              $imgs = obtenerImagenesDetalleProducto( $dbh, $dp["id"], "" );
              $url_img = "";
              if( isset( $imgs[0] ) ){
                $url_img = $imgs[0]["path"];
              }
          ?>
            <div>
              <table class="seleccion-detalle-juego" width="100%" align="center">
                <tr>
                  <th width="33.3%"><a href="<?php echo $lnk_dp;?>" target="_blank">
                        #<?php echo $p["id"]."-".$dp["id"];?>
                      </a>
                  </th>
                  <th width="33.3%">
                    <img id="img<?php echo $dp["id"];?>" src="<?php echo $url_img;?>" width="60px">
                  </th>
                  <th width="33.3%">
                    <a href="#!" class="sel-pj" data-idd="<?php echo $dp["id"];?>">
                      <i class="fa fa-2x fa-plus-square"></i>
                    </a>
                  </th>
                </tr>
              </table>
            </div> 

          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<?php include( "sections/modals/product-image.php" ); ?>