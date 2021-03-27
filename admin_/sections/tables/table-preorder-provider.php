<table id="datatable-preorder<?php echo $idpvd ?>" class="table table-striped table-bordered datatable-preorder-provider">
  <thead>
    <tr>
      <th width="5%">Ítem</th>
      <th width="10%">Códigos</th>
      <th width="10%">Producto</th>
      <th width="30%">Tallas | Cantidades</th>
      <th width="25%">Nota</th>
      <th width="20%">Totales</th>
    </tr>
  </thead>
  <tbody>
      <?php 
        $numeracion     = 1;
        foreach ( $ids_pro_preo as $idpro ) {

          $ids_detpro_preo = obtenerIdsDetallesPorProductoEnPreorden( $preorden, $idpro );
          
          foreach ( $ids_detpro_preo as $iddet ) {
            $items        = obtenerItemsPorDetalle( $iddet );
            $i            = $items[0];
            $npzas        = 0;
            $tpeso        = 0;
            $items_enoc   = tieneItemsEnOC( $items );
            $lnk_dp       = "product-data.php?p=$i[idp]#$i[idd]";
            $producto     = obtenerProductoPorId( $dbh, $i["idp"] ); 
            $proveedor    = obtenerProveedorPorId( $dbh, $producto["idpvd1"] );

            if( $i["idpvd"] == $idpvd && $items_enoc ){
        ?>
              <tr id="itemid<?php echo $i[idd] ?>">
                <td align="center"> <div class="numeracion" style="margin-bottom: 5px"><?php echo $numeracion ?></div> </td>
                <td align="center"> <?php echo $proveedor["number"]."-".$producto["codigof1"]; ?> </td>
                <td>
                  <div align='center'>
                    <a href='#!' class='pop-img-p' data-toggle='modal' 
                    data-src="<?php echo $i[imagen]; ?>" data-target='#img-product-pop'>
                    <img src="<?php echo $i[imagen]; ?>" width='60px'></a>
                  </div>
                  <div align='center'>
                    <a href="<?php echo $lnk_dp ?>" target='_blank'>#<?php echo $i["idp"]."-".$i["idd"] ?></a>
                  </div>
                </td>
                <td> 
                  <table id="tallas<?php echo $iddet ?>" class="table table-striped table-bordered">
                    <tbody>
                        <?php 
                          foreach ( $items as $it ) {
                            $talla = obtenerColorDisponibilidadTalla( $dbh, $it );          // fn-purchase.php 
                            if( $it["en_oc"] == true ){
                              $npzas += $it["cant"];
                              $tpeso += $it["cant"] * $it["peso"];
                        ?>    
                          <tr id="<?php echo $it[idd].$it[idt] ?>" class="itemt<?php echo $it[idd] ?> oc<?php echo $idpvd ?>">
                            <td><?php echo $talla; ?></td>
                            <td align="center">
                              <input class="form-control cnt_preord act_preo cant_oc<?php echo $idpvd ?>" type="text" 
                                onkeypress="return isIntegerKey(event)" name="cantidad" value="<?php echo $it[cant] ?>" 
                                maxlength="5" data-idt="<?php echo $it[idt]; ?>" data-idd="<?php echo $it[idd]; ?>" 
                                data-prm="cant" data-peso="<?php echo $it[peso] ?>" data-idpvd-oc="<?php echo $idpvd ?>">
                            </td>
                            <td align="center">
                              <a href="#!" class="quitar_item" data-idt="<?php echo $it[idt]; ?>" 
                                data-bot="oc<?php echo $idpvd ?>" data-idd="<?php echo $it[idd]; ?>" 
                                data-prm="eliminar_oc" data-idpvd-oc="<?php echo $idpvd ?>" title="Quitar de la orden">
                                <i class="fa fa-2x fa-times"></i>
                              </a>
                            </td> 
                          </tr> 
                        <?php } } ?>
                    </tbody> 
                  </table>
                </td>
                <td>
                  <div align="center" class="form-group" style="width: 100%">
                    <textarea class="form-control not_preord act_preo_d" rows="3" placeholder="Nota" 
                    name="nota" data-idt="<?php echo $i[idt]; ?>" data-idd="<?php echo $i[idd]; ?>" 
                    data-prm="nota" maxlength="300"><?php echo $i[nota] ?></textarea>
                  </div>
                </td>
                <td>
                  <div align="left" class="form-group" style="width: 100%">
                    <div>Piezas:  
                      <span id="npzas<?php echo $i[idp].$i[idd] ?>"><?php echo $npzas ?> und.</span>
                    </div>
                    <div>Peso: 
                      <span id="tpeso<?php echo $i[idp].$i[idd] ?>"><?php echo $tpeso ?> gr.</span>
                    </div>
                  </div>
                </td>
              </tr>
      <?php 
            $numeracion++; 
            } 
          }
        }
      ?>
  </tbody>
</table>