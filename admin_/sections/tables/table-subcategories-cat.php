<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Editar</th>
    </tr>
  </thead>

  <tbody>
      <?php 
        foreach ( $subcategories as $sc ) { 
      ?>
      <tr>
        <td><?php echo $sc["name"]; ?></td>
        <td><a href="subcategory-edit.php?id=<?php echo $sc["id"]; ?>">Editar</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>