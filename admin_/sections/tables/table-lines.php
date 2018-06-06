<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Editar</th>
      <th>Borrar</th>
    </tr>
  </thead>

  <tbody>
    <?php 
      foreach ( $lineas as $l ) { 
    ?>
    <tr>
      <td><?php echo $l["name"]; ?></td>
      <td><?php echo $l["description"]; ?></td>
      <td><a href="line-edit.php?id=<?php echo $l["id"]; ?>">Editar</a></td>
      <td>
          <a href="#!" class="elim-linea" data-toggle="modal" data-idl="<?php echo $l["id"]; ?>" 
            data-target="#confirmar-accion">Borrar</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>