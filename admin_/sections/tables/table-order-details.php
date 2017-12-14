<table id="datatable_do" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th> </th>
      <th>Producto</th>
      <th>Cantidad</th>
      <th class="dcol" width="80">Disp</th>
      <th>Precio unit</th>
      <th>Total</th>
      <?php if ( $orden["estado"] == "pendiente" ) { ?>
        <th class="dcol"></th>
        <th class="dcol"></th>
        <th class="dcol"></th>
      <?php } ?>
    </tr>
  </thead>

  <tbody>
    <?php 
      foreach ( $dorden as $r ) {
        $total_item = $r["quantity"] * $r["price"];
    ?>
    <tr>
      <td align="center"><img src="<?php echo $r["imagen"]; ?>" width="20"></td>
      <td><a href="#!"><?php echo $r["producto"]." (".$r["description"].")"." | "."Talla: ".$r["talla"]; ?></a></td>
      <td id="qcd<?php echo $r["id"]; ?>" align="center">
        <?php echo $r["quantity"]; ?>
      </td>
      <td class="dcol"><input id="cd<?php echo $r["id"]; ?>" class="qdisp_orden" type="text" disabled></td>
      <td>$<?php echo $r["price"]; ?></td>
      <td>$<?php echo $total_item; ?></td>
      <?php if ( $orden["estado"] == "pendiente" ) { ?>
        <td align="center" class="dcol">
          <i data-t="cd<?php echo $r["id"]; ?>" class="fa fa-check dfull"></i>
        </td>
        <td align="center" class="dcol">
          <i data-t="cd<?php echo $r["id"]; ?>" class="fa fa-times dnone"></i>
        </td>
        <td align="center" class="dcol">
          <i data-t="cd<?php echo $r["id"]; ?>" class="fa fa-exclamation dmod"></i>
        </td>
      <?php } ?>
    </tr>
    <?php } ?>
  </tbody>
</table>