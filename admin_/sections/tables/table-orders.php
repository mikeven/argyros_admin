<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Pedido</th>
      <th>Cliente</th>
      <th>Fecha</th>
      <th>Status</th>
      <th>Total</th>
    </tr>
  </thead>

  <tbody>
    <?php 
      foreach ( $pedidos as $p ) { 
    ?>
    <tr>
      <td><a href="#!">#Pedido <?php echo $p["id"]; ?></a></td>
      <td><a href="#!"><?php echo $p["nombre"]." ".$p["apellido"]; ?></a></td>
      <td><?php echo $p["fecha"]; ?></td>
      <td><?php echo $p["estado"]; ?></td>
      <td><?php echo $p["total"]; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>