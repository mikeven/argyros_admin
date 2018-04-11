<table id="datatable_o" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Pedido</th>
      <th>Cliente</th>
      <th class="datesort">Fecha</th>
      <th>Status</th>
      <th>Total</th>
      <th class="hidden"></th>
    </tr>
  </thead>

  <tbody>
    <?php 
      foreach ( $pedidos as $p ) {
         $iconoe = obtenerIconoEstado( $p["estado"], "" );
    ?>
    <tr>
      <td><a href="order-data.php?order-id=<?php echo $p["id"]; ?>">#Pedido <?php echo $p["id"]; ?></a></td>
      <td><?php echo $p["nombre"]." ".$p["apellido"]; ?></td>
      <td class="datesort"><?php echo $p["fecha"]; ?></td>
      <td><?php echo $iconoe." ".$p["estado"]; ?></td>
      <td>$ <?php echo $p["total"]; ?></td>
      <td class="hidden"><?php echo $p["creada"]; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
