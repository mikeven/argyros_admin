<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Productos</th>
      <th>Editar</th>
      <th>Borrar</th>
    </tr>
  </thead>
  <tbody>
      <?php 
        foreach ( $trabajos as $t ) {
          $prods = obtenerProductosTrabajo( $dbh, $t["id"] );
      ?>
      <tr>
        <td><?php echo $t["name"]; ?></td>
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
        <td><a href="making-edit.php?id=<?php echo $t["id"]; ?>">Editar</a></td>
        <td>
            <a href="#!" class="elim-trabajo" data-toggle="modal" data-idt="<?php echo $t["id"]; ?>" 
            data-target="#confirmar-accion">Borrar</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>