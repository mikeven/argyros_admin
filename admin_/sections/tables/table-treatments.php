<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Material</th>
      <th> </th>
      <th> </th>
    </tr>
  </thead>

  <tbody>
    <?php 
      foreach ( $banos as $b ) { 
    ?>
    <tr>
      <td><?php echo $b["name"]; ?></td>
      <td><?php echo $b["material"]; ?></td>
      <td><a href="treatment-edit.php?id=<?php echo $b["id"]; ?>">Editar</a></td>
      <td>
          <a href="#!" class="elim-bano" data-toggle="modal" data-idb="<?php echo $b["id"]; ?>" 
          data-target="#confirmar-accion">Borrar</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>