<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Editar</th>
      <th></th>
    </tr>
  </thead>

  <tbody>
      <?php 
        foreach ( $subcategories as $sc ) { 
      ?>
      <tr>
        <td><?php echo $sc["name"]; ?></td>
        <td><a href="subcategory-edit.php?id=<?php echo $sc["id"]; ?>">Editar</a></td>
        <td><a href="#!">Desvincular de esta categoría</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>