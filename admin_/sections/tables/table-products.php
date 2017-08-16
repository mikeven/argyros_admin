<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th><i class="fa fa-eye"> </i></th>
      <th>Id</th>
      <th>Código</th>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Categoría</th>
      <th>Subcategoría</th>
      <th>Detalle</th>
      <th>Editar</th>
      <th>Borrar</th>
    </tr>
  </thead>
  <tbody>
      <?php 
        foreach ( $productos as $p ) { 
      ?>
      <tr>
        <td><a href="#!">Ocultar</a></td>
        <td><?php echo $p["id"]; ?></td>
        <td><?php echo $p["codigo"]; ?></td>
        <td><?php echo $p["nombre"]; ?></td>
        <td><?php echo $p["descripcion"]; ?></td>
        <td><?php echo $p["categoria"]; ?></td>
        <td><?php echo $p["subcategoria"]; ?></td>
        <td><a href="#!">Detalle</a></td>
        <td><a href="#!">Editar</a></td>
        <td><a href="#!">Borrar</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>