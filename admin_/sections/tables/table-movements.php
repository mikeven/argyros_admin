<table id="dt_movements" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th class="datesort">Fecha</th>
      <th>Movimiento</th>
      <th>Cliente/Fabricante</th>
      <th>Cantidad</th>
    </tr>
  </thead>

  <tbody>
    <?php 
      foreach ( $movimientos as $m ) {
        if( $m["tipo_movimiento"] == "oc" )
          $lnk = "purchase-data.php?purchase-id=$m[id]";
        if( $m["tipo_movimiento"] == "pedido" )
          $lnk = "order-data.php?order-id=$m[id]"; 
    ?>
    <tr>
      <td class="datesort"><?php echo $m["fcreacion"]; ?></td>
      <td><a href="<?php echo $lnk ?>" target="_blank"><?php echo $m["movimiento"]; ?></a></td>
      <td><?php echo $m["cliente_proveedor"]; ?></td>
      <td><?php echo $m["cant"]; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
