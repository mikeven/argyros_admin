<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>
          <?php if( isset( $_GET["imagenes"] ) ) { ?>
            <i class="fa fa-file-image-o"></i>
          <?php } ?>
      </th>
      <th>Id</th>
      <th>Código</th>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Categoría</th>
      <th>Detalles</th>
      <th>Subcategoría</th>
      <th>Editar</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
      <?php 
        foreach ( $productos as $p ) {
          $lnk_p = "product-data.php?p=$p[id]";
          $imgs = obtenerImagenesProducto( $dbh, $p["id"]);
          $drdet = obtenerDetalleProductoPorId( $dbh, $p["id"] );
          $url_img = "";
          if( isset( $imgs[0] ) ){
            $url_img = $imgs[0]["image"];
          }
          if( $p["visible"] == 1 ) {
            $clp = ""; $accion = "Ocultar"; $ccol = "pstat_";
          }else{ $clp = "-slash"; $accion = "Mostrar"; $ccol = "pstat_o"; }
          //$lnk_d = "product-detail.php?p=$p[id]"; 
      ?>
      <tr>
        <td>
          <?php if( isset( $_GET["imagenes"] ) ) { ?>
            <a href="#!" class="pop-img-p" data-toggle="modal" data-src="<?php echo $url_img;?>" 
            data-target="#img-product-pop"><img src="<?php echo $url_img;?>" width="60px">
            </a>
           <?php } ?>
        </td>
        <td>
          <a class="primary" href="<?php echo $lnk_p; ?>"><?php echo $p["id"]; ?></a>
        </td>
        <td>
          <?php echo $p["codigo"]; ?>
        </td>
        <th><a class="primary" href="<?php echo $lnk_p; ?>"><?php echo $p["nombre"]; ?></a></th>
        <td><?php echo $p["descripcion"]; ?></td>
        <td><?php echo $p["categoria"]; ?></td>
        <td>
          <?php
            foreach ( $drdet as $dp ) {
              $lnk_dp = "product-data.php?p=$p[id]#$dp[id]"; 
          ?>
            <div>
              <a href="<?php echo $lnk_dp;?>">#<?php echo $dp["id"];?></a>
            </div> 
          <?php } ?>
        </td>
        <td><?php echo $p["subcategoria"]; ?></td>
        <td align="center">
          <a href="product-edit.php?id=<?php echo $p["id"]; ?>"><i class="fa fa-edit"></i></a>
        </td>
        <td>
          <div align="center">
            <i id="im<?php echo $p['id']?>" class="fa fa-eye<?php echo $clp; ?> fa-2x <?php echo $ccol; ?>"></i>
          </div>
          <hr>
          <div align="center">
            <a href="#!" class="bt-prod-act" data-idp="<?php echo $p["id"]; ?>" 
              data-op="<?php echo $p["visible"]; ?>" data-toggle="modal" data-target="#confirmar-accion">
              <?php echo $accion; ?>
            </a>
          </div>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<?php include( "sections/modals/product-image.php" ); ?>