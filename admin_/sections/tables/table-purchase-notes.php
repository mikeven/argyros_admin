<table id="" class="table table-striped table-bordered" style="margin-top: 85px;">
  <thead>
    <tr>
      <th>Fecha</th>
      <th>Usuario</th>
      <th>Nota</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ( $notas_oc as $nota ) { ?>
      <tr>
        <td><?php echo $nota["fecha"]; ?></td>
        <td><?php echo $nota["nombre"]." ".$nota["apellido"]; ?></td>
        <td><?php echo $nota["nota"];?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>