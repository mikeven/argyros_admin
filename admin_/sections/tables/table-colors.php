<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th> </th>
      <th> </th>
    </tr>
  </thead>

  <tbody>
      <?php 
        foreach ( $lineas as $l ) { 
      ?>
      <tr>
        <td><?php echo $l["name"]; ?></td>
        <td><a href="color-edit.php?id=<?php echo $l["id"]; ?>">Editar</a></td>
        <td><a href="#!">Borrar</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>