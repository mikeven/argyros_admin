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
        foreach ( $colores as $c ) { 
      ?>
      <tr>
        <td><?php echo $c["name"]; ?></td>
        <td><a href="color-edit.php?id=<?php echo $c["id"]; ?>">Editar</a></td>
        <td>
          <a href="#!" class="elim-color" data-toggle="modal" data-idc="<?php echo $c["id"]; ?>" 
          data-target="#confirmar-accion">Borrar</a>
      </td>
      </tr>
    <?php } ?>
  </tbody>
</table>