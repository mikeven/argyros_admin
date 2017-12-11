<table id="datatable_do" class="table table-striped table-bordered">
  <thead>
    <tr>
      
      <th>Producto</th>
      <th>Cantidad</th>
      <th>Precio unit</th>
      <th>Total</th>
    </tr>
  </thead>

  <tbody>
    <?php 
      foreach ( $dorden as $r ) {
        $total_item = $r["quantity"] * $r["price"];
    ?>
    <tr>
      <td><a href="#!"><?php echo $r["producto"]." (".$r["description"].")"." | "."Talla: ".$r["talla"]; ?></a></td>
      <td align="center"><?php echo $r["quantity"]; ?></td>
      <td>$<?php echo $r["price"]; ?></td>
      <td>$<?php echo $total_item; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>