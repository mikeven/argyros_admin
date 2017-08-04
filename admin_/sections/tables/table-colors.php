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
        foreach ( $lineas as $l ) { 
      ?>
      <tr>
        <td><?php echo $l["name"]; ?></td>
        <td><a href="#!">Editar</a></td>
        <td><a href="#!">Borrar</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>