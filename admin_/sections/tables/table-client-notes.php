<table id="datatable-client-notes" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Fecha</th>
      <th>Usuario</th>
      <th>Nota</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ( $notas_cliente as $nota ) { ?>
      <tr>
        <td><?php echo $nota["fecha"]; ?></td>
        <td><?php echo $nota["nombre"]." ".$nota["apellido"]; ?></td>
        <td><?php echo $nota["nota"];?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>