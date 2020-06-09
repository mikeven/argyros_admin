<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th class="hidden"></th>
      <th>ID</th>
      <th>Productos</th>
      <th>Acción</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
      <?php 
        foreach ( $juegos as $j ) {
      ?>
      <tr>
        <td class="hidden"></td>
        <td>#<?php echo $j["id"]; ?></td>
        <td>
          <div>
            <table class="detalles-juego" align="left">
              <tr>
          <?php 
            foreach ( $j["detalles"] as $dp ) {
              $lnk_dp = "product-data.php?p=$dp[idp]#$dp[idd]"; 
              $imgs = obtenerImagenesDetalleProducto( $dbh, $dp["idd"], "" );
              $url_img = "";
              if( isset( $imgs[0] ) ){
                $url_img = $imgs[0]["path"];
              }
          ?>
                <td class="img-j">
                  <img id="img<?php echo $dp["idd"];?>" src="<?php echo $url_img;?>" width="60px">
                  <a href="#!" class="elim_djp" data-iddpj="<?php echo $dp["idd"];?>" 
                    data-idj="<?php echo $j["id"]; ?>" data-toggle="modal" 
                    data-target="#confirmar-accion" title="Quitar del juego">
                    <i class="fa fa-2x fa-times-circle"></i>
                  </a>
                  <div>
                    <a href="<?php echo $lnk_dp;?>" target="_blank">
                      #<?php echo $dp["idp"]."-".$dp["idd"];?>
                    </a>
                  </div>
                </td>
            <?php } ?>
            </table>
          </div>
        </td>
        <td>
          <a href="#!" class="elim_j" data-idj="<?php echo $j["id"]; ?>" data-toggle="modal" 
            data-target="#confirmar-accion"> Eliminar
          </a>
        </td>
        <td>
          <a href="set-edit.php?ids=<?php echo $j["id"]; ?>">Editar</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<?php include( "sections/modals/product-image.php" ); ?>