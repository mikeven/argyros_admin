<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>A</th>
      <th>B</th>
      <th>C</th>
      <th>D</th>
      <th>Material</th>
      <th>Editar</th>
      <th>Borrar</th>
    </tr>
  </thead>
  <tbody>
      <?php 
        foreach ( $grupos as $g ) { 
      ?>
      <tr>
        <td><?php echo $g["name"]; ?></td>
        <td><?php echo $g["variable_a"]; ?></td>
        <td><?php echo $g["variable_b"]; ?></td>
        <td><?php echo $g["variable_c"]; ?></td>
        <td><?php echo $g["variable_d"]; ?></td>
        <td><?php echo $g["material"]; ?></td>
        <td><a href="#!">Editar</a></td>
        <td><a href="#!">Borrar</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>