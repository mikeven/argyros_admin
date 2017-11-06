<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th><i class="fa fa-file-image-o"></i></th>
      <th>Id</th>
      <th>Código</th>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Categoría</th>
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
          $url_img = "";
          if( isset( $imgs[0] ) ){
            $url_img = $imgs[0]["image"];
          }
          //$lnk_d = "product-detail.php?p=$p[id]"; 
      ?>
      <tr>
        <td><img src="<?php echo $url_img;?>" width="60px"></td>
        <td><?php echo $p["id"]; ?></td>
        <td><?php echo $p["codigo"]; ?></td>
        <th><a class="primary" href="<?php echo $lnk_p; ?>"><?php echo $p["nombre"]; ?></a></th>
        <td><?php echo $p["descripcion"]; ?></td>
        <td><?php echo $p["categoria"]; ?></td>
        <td><?php echo $p["subcategoria"]; ?></td>
        <td align="center"><a href="product-edit.php?id=<?php echo $p["id"]; ?>"><i class="fa fa-edit"></i></a></td>
        <td><a href="#!">Desactivar</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>