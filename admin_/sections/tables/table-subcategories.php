<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Subcategoría</th>
      <th>Categorías</th>
      <th>Editar</th>
      <th>Borrar</th>
    </tr>
  </thead>

  <tbody>
      <?php 
        foreach ( $subcategorias as $sc ) { 
      ?>
      <tr>
        <td><?php echo $sc["name"]." "."( $sc[uname] )";; ?></td>
        <td><?php echo $sc["cname"]; ?></td>
        <td><a href="subcategory-edit.php?id=<?php echo $sc["id"]; ?>">Editar</a></td>
        <td><a href="#!">Borrar</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>