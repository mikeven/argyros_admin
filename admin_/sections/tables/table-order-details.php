<form id="revision_pedido" data-parsley-validate class="form-horizontal form-label-left" method="post">
  <input id="idpedido" type="hidden" value="<?php echo $orden["id"]; ?>">
  <div id="leyenda" align="right">
      <i class="fa-circle fa iley_dsp"></i> Retirado por disponibilidad
      | <i class="fa-circle fa iley_cli"></i> Retirado por cliente
  </div>
  <table id="datatable_do" class="table table-bordered">
    <thead>
      <tr>
        <th> </th>
        <th>Producto</th>
        <th class="tx_al_c">Cant. Solic.</th>
        <th class="dcol" width="80">Disp</th>
        <?php if ( 
          $orden["estado"] == "revisado" 
          || $orden["estado"] == "confirmado" 
          || $orden["estado"] == "entregado" ) { 
        ?>
        <th>Cant. Disp</th>
        <?php } ?>
        <th class="tx_al_c">Precio unit</th>
        <th class="tx_al_c">Total</th>
        <th class="dcol"></th>
        <th class="dcol"></th>
        <th class="dcol"></th>
        <?php if ( $orden["procesada"] ) { ?>
          <th></th>
          <th></th>
          <th></th>
        <?php } ?>
      </tr>
    </thead>

    <tbody>
      <?php
        
        foreach ( $dorden as $r ) {
          $clase_item = "item_orden";
          $total_item = $r["quantity"] * $r["price"];
          if ( ( $orden["estado"] != "pendiente" ) && ( $orden["estado"] != "cancelado" ) )
             $total_item = $r["disponible"] * $r["price"];

          if( $r["istatus"] == "retirado" ) 
            $clase_item = "item_retirado";          // Retirado por estar no disponible
          if( $r["istatus"] == "retirado" && $r["revision"] != "nodisp" ) 
            $clase_item = "item_retirado_cliente";  // Retirado por por cliente

          $lnk_p = "product-data.php?p=".$r["product_id"]."#".$r["product_detail_id"];
      ?>
      <tr class="<?php echo $clase_item; ?>">
        
        <td align="center">

          <a href='#!' class="pop-img-p" data-toggle="modal" 
            data-src="<?php echo $r["imagen"]; ?>" data-target="#img-product-pop">
            <img src="<?php echo $r["imagen"]; ?>" width="30">
          </a>
          
        </td>

        <td>
          <a target="_blank" href="<?php echo $lnk_p; ?>">
            <?php echo "P:".$r["product_id"]." - ".$r["producto"]." (#".$r["product_detail_id"].")"." | "."Talla: ".$r["talla"]; ?>
          </a>
          <div align="left" title="Ubicación"><i class="fa fa-archive"></i> <?php echo $r["ubicacion"]; ?></div>
        </td>
        
        <td id="qcd<?php echo $r["id"]; ?>" align="center">
          <?php echo $r["quantity"]; ?>
        </td>
        
        <td class="dcol">

          <input id="cd<?php echo $r["id"]; ?>" name="cant" class="qdisp_orden" type="text" disabled 
          onKeyPress="return isIntegerKey(event);">

          <!--<input id="do<?php echo $r["id"]; ?>" name="iddo" type="hidden" value="<?php echo $r["id"]; ?>">-->
          <input class="qini" id="qocd<?php echo $r["id"]; ?>" type="hidden" 
          data-ti="ti<?php echo $r["id"]; ?>" value="<?php echo $r["quantity"]; ?>">
          
          <input id="vacd<?php echo $r["id"]; ?>" type="hidden" value="0">

          <input id="rrcd<?php echo $r["id"]; ?>" name="regrev[]" type="hidden" value="0">

        </td>
        <?php if ( $orden["estado"] == "revisado" || $orden["estado"] == "confirmado" || $orden["estado"] == "entregado" ) { ?>
          <td align="center"> <b> <?php echo $r["disponible"]; ?> </b> </span>
          </td>
        <?php } ?>
        <td align="right">
          $<span id="mntqocd<?php echo $r["id"]; ?>"> <?php echo $r["price"]; ?> </span>
        </td>
        <td align="right">
          $<span id="ti<?php echo $r["id"]; ?>"> <?php echo $total_item; ?> </span>
        </td>
        
        <td align="center" class="dcol">
          <i data-c="!0" data-t="cd<?php echo $r["id"]; ?>" data-sr="disp" 
          class="fa fa-check i-rev cd<?php echo $r["id"]; ?>" title="Disponible"></i>
        </td>
        <td align="center" class="dcol">
          <i data-c="0" data-t="cd<?php echo $r["id"]; ?>" data-sr="nodisp" 
          class="fa fa-times i-rev cd<?php echo $r["id"]; ?>" title="No disponible"></i>
        </td>
        <td align="center" class="dcol">
          <i id="icd<?php echo $r["id"]; ?>" data-c="*" data-t="cd<?php echo $r["id"]; ?>" data-sr="modif"
          class="fa fa-exclamation i-rev cd<?php echo $r["id"]; ?>" title="Cambiar cantidad"></i>
        </td>
        
        <?php if ( $orden["procesada"] ) { ?>
          <td align="center">
            <i class="fa fa-check <?php echo activarIconoRevision( $r["revision"], "disp" ); ?>" title="Disponible"></i>
          </td>
          <td align="center">
            <i class="fa fa-times <?php echo activarIconoRevision( $r["revision"], "nodisp" ); ?>" title="No disponible"></i>
          </td>
          <td align="center">
            <i class="fa fa-exclamation <?php echo activarIconoRevision( $r["revision"], "modif" ); ?>" title="Cantidad modificada"></i>
          </td>
        <?php } ?>

      </tr>
      <?php } ?>
    </tbody>
  </table>

  <div id="panel_revision_pedido" class="dcol">
    <hr>
    <div class="accion_observaciones">
      <textarea id="revision_obs" class="form-control" rows="3" placeholder="Nota" name="nota_revision"></textarea>
    </div>
    <div id="area_rsp_pedido" class="form-group">
        <a href="#!">
            <button id="resp_pedido" type="button" class="btn btn-info btn-xs">Enviar respuesta</button>
        </a> 
    </div>
  </div>
</form>