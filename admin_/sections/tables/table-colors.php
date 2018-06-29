<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Productos</th>
      <th> </th>
      <th> </th>
    </tr>
  </thead>

  <tbody>
      <?php 
        foreach ( $colores as $c ) {
          $prods =  obtenerProductosColor( $dbh, $c["id"] );
      ?>
      <tr>
        <td><?php echo $c["name"]; ?></td>
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
        <td><a href="color-edit.php?id=<?php echo $c["id"]; ?>">Editar</a></td>
        <td>
          <a href="#!" class="elim-color" data-toggle="modal" data-idc="<?php echo $c["id"]; ?>" 
          data-target="#confirmar-accion">Borrar</a>
      </td>
      </tr>
    <?php } ?>
  </tbody>
</table>