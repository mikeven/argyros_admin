<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Valor</th>
      <th>Unidad</th>
      <th>Categoría</th>
      <th> </th>
      <th> </th>
    </tr>
  </thead>

  <tbody>
      <?php 
        foreach ( $sizes as $s ) { 
      ?>
        <tr>
          <td><?php echo $s["name"]; ?></td>
          <td><?php echo $s["unidad"]; ?></td>
          <td><?php echo $s["cname"]; ?></td>
          <td><a href="size-edit.php?id=<?php echo $s["id"]; ?>">Editar</a></td>
          <td><a href="#!">Borrar</a></td>
        </tr>
    <?php } ?>
  </tbody>
</table>