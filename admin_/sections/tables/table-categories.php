<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Categoría</th>
      <th>Subcategorías</th>
      <th>Editar</th>
      <th>Borrar</th>
    </tr>
  </thead>

  <tbody>
      <?php 
        foreach ( $categorias as $c ) { 
          $subcategories = obtenerListaSubCategoriasCategoria( $dbh, $c["id"] )
      ?>
      <tr>
        <td><?php echo $c["name"]; ?></td>
        <td>
          <?php 
            foreach ( $subcategories as $sc ) { 
              echo "<div>$sc[name]</div>";  
            }
          ?>
        </td>
        <td><a href="category-edit.php?id=<?php echo $c["id"]; ?>">Editar</a></td>
        <td><a href="#!">Borrar</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>