<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Editar</th>
      <th>Borrar</th>
    </tr>
  </thead>
  <tbody>
      <?php 
        foreach ( $trabajos as $t ) { 
      ?>
      <tr>
        <td><?php echo $t["name"]; ?></td>
        <td><a href="making-edit.php?id=<?php echo $t["id"]; ?>">Editar</a></td>
        <td><a href="#!">Borrar</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>