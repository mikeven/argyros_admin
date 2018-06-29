<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Baños</th>
      <th>Productos</th>
      <th> </th>
      <th> </th>
    </tr>
  </thead>
  <tbody>
      <?php 
        foreach ( $materiales as $m ) { 
          $banos = obtenerListaBanosMaterial( $dbh, $m["id"] );
          $prods = obtenerProductosMateriales( $dbh, $m["id"] );
      ?>
      <tr>
        <td><?php echo $m["name"]; ?></td>
        <td>
          <?php 
            foreach ( $banos as $b ) { 
              echo "<a href='#!'><div>$b[name]</div></a>";  
            }
          ?>
        </td>
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
        <td><a href="material-edit.php?id=<?php echo $m["id"]; ?>">Editar</a></td>
        <td>
            <a href="#!" class="elim-material" data-toggle="modal" data-idm="<?php echo $m["id"]; ?>" 
            data-target="#confirmar-accion">Borrar</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>