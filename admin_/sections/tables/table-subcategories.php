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
        <td><?php echo $sc["name"]; ?></td>
        <td><?php echo $sc["cname"]; ?></td>
        <td><a href="#!">Editar</a></td>
        <td><a href="#!">Borrar</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>