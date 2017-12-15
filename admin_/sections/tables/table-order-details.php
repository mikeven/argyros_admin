<form id="revision_pedido" data-parsley-validate class="form-horizontal form-label-left" method="post">
  <input id="idpedido" type="hidden" value="<?php echo $orden["id"]; ?>">
  <table id="datatable_do" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th> </th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th class="dcol" width="80">Disp</th>
        <th>Precio unit</th>
        <th>Total</th>
        <th class="dcol"></th>
        <th class="dcol"></th>
        <th class="dcol"></th>
        <?php if ( $orden["estado"] == "revisado" ) { ?>
          <th></th>
          <th></th>
          <th></th>
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
        
        <td class="dcol">
          <input id="cd<?php echo $r["id"]; ?>" name="cant" class="qdisp_orden" type="text" disabled>
          <!--<input id="do<?php echo $r["id"]; ?>" name="iddo" type="hidden" value="<?php echo $r["id"]; ?>">-->
          <input id="vacd<?php echo $r["id"]; ?>" type="hidden" value="0">
          <input id="rrcd<?php echo $r["id"]; ?>" name="regrev[]" type="hidden" value="0">
        </td>
        
        <td>$<?php echo $r["price"]; ?></td>
        <td>$<?php echo $total_item; ?></td>
        
        <td align="center" class="dcol">
          <i data-c="!0" data-t="cd<?php echo $r["id"]; ?>" 
          class="fa fa-check i-rev cd<?php echo $r["id"]; ?>"></i>
        </td>
        <td align="center" class="dcol">
          <i data-c="0" data-t="cd<?php echo $r["id"]; ?>" 
          class="fa fa-times i-rev cd<?php echo $r["id"]; ?>"></i>
        </td>
        <td align="center" class="dcol">
          <i data-c="*" data-t="cd<?php echo $r["id"]; ?>" 
          class="fa fa-exclamation i-rev cd<?php echo $r["id"]; ?>"></i>
        </td>
        
        <?php if ( $orden["estado"] == "revisado" ) { ?>
          <td align="center">
            <i data-c="!0" data-t="cd<?php echo $r["id"]; ?>" 
            class="fa fa-check cd<?php echo $r["id"]; ?>"></i>
          </td>
          <td align="center">
            <i data-c="0" data-t="cd<?php echo $r["id"]; ?>" 
            class="fa fa-times cd<?php echo $r["id"]; ?>"></i>
          </td>
          <td align="center">
            <i data-c="*" data-t="cd<?php echo $r["id"]; ?>" 
            class="fa fa-exclamation cd<?php echo $r["id"]; ?>"></i>
          </td>
        <?php } ?>

      </tr>
      <?php } ?>
    </tbody>
  </table>

  <div id="panel_revision_pedido" class="dcol">
    <hr>
    <div class="form-group">
        <a href="#!">
            <button id="resp_pedido" type="button" class="btn btn-info btn-xs">Enviar respuesta</button>
        </a> 
    </div>
  </div>
</form>