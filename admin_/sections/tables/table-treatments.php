<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Material</th>
      <th>Productos</th>
      <th> </th>
      <th> </th>
    </tr>
  </thead>

  <tbody>
    <?php 
      foreach ( $banos as $b ) {
        $prods = obtenerProductosBanos( $dbh, $b["id"] );
    ?>
    <tr>
      <td><?php echo $b["name"]; ?></td>
      <td><?php echo $b["material"]; ?></td>
      <td>
          <div class="list-prod-reg">
            <?php 
              foreach ( $prods as $p ) { 
                echo "<a href='product-data.php?p=$p[id]' target='_blank'>
                  <div>$p[nombre]</div>
                </a>";  
              }
            ?>
          </div>
        </td>
      <td><a href="treatment-edit.php?id=<?php echo $b["id"]; ?>">Editar</a></td>
      <td>
          <a href="#!" class="elim-bano" data-toggle="modal" data-idb="<?php echo $b["id"]; ?>" 
          data-target="#confirmar-accion">Borrar</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>