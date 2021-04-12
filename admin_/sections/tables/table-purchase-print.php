<?php 
  $numeracion     = 1;
  foreach ( $ids_detalles_oc as $iddet ) {
    $items        = obtenerItemsPorDetalleOC( $iddet, $detalle_oc );
    $i            = $items[0];
    $lnk_dp       = "product-data.php?p=$i[idp]#$i[idd]";
    $producto     = obtenerProductoPorId( $dbh, $i["idp"] ); 
    $imagen       = obtenerImagenesDetalleProducto( $dbh, $i["idd"], 1 );
    $proveedor    = obtenerProveedorPorId( $dbh, $producto["idpvd1"] );
?>
        
    <?php if( ( $numeracion - 1 ) % 5 == 0 ) { ?>
      <div class="table_head_container">
        <table border="0" class="table_head">
            <tr>
                <td><img src="https://argyros.com.pa/admin/images/alogo.png" height="26"></td>
                <td align="left"> 
                    Order: <?php echo "#".$orden["id"]." ( $orden[numero] ) "; ?> - 
                    Total W.: <?php echo $totales["peso"]." gr"; ?> 
                </td>
                <td align="right"> Date: <?php echo $orden["fecha_en"]; ?></td>
            </tr>
        </table>
        <div class="clearfix"></div>
      </div>
      <table id="datatable-oc<?php echo $ido ?>" class="table_items_oc" border="0">
        <thead>
          <tr>
            <th width="15%">Item/Code</th>
            <th width="15%">Photo</th>
            <th width="30%" align="left">Size/Weight/Qty</th>
            <th width="40%" align="left">Remarks</th>
          </tr>
        </thead>
        <tbody>
    <?php } ?>

        <tr>
          <td align="center">
            <div class="numeracion" style="margin-bottom: 5px"><?php echo $numeracion ?></div>
            <div align='center' style="font-size: 13px">
              <?php echo $proveedor["number"]."-".$producto["codigof1"]; ?>
            </div>
            <div align='center' style="font-size: 13px">
              <?php echo "#".$i["idp"]."-".$i["idd"]; ?>
            </div>
          </td>
          <td>
            <div align='center'>
              <a href='#!' class='pop-img-p' data-toggle='modal' 
              data-src="<?php echo $imagen[0]['path']; ?>" data-target='#img-product-pop'>
              <img src="<?php echo $imagen[0]['path']; ?>" width='225px'></a>
            </div>
            
          </td>
          <td> 
            <table id="tallas<?php echo $iddet ?>" class="table tabla_tallas_oc" style="font-size: 12px">
              <tbody>
                  <?php 
                    foreach ( $items as $it ) { 
                      $wt   = number_format( $it["peso"], 1, '.', '' );
                      $twgt = number_format( $it["peso"]*$it["cant"], 1, '.', '' );
                  ?>
                    <tr id="<?php echo $it['idd'].$it['idt'] ?>">
                      <td align="left"><?php echo "Size: ".$it["talla"].$it["unidad"]; ?></td>
                      <td align="center"><?php echo "Wt: ".$wt; ?></td>
                      <td align="right"><?php echo "Qty: ".$it['cant'] ?></td>
                      <td align="right">
                        <div>T: <?php echo $twgt." gr"; ?></div>
                        <div></div>
                      </td>
                    </tr> 
                  <?php } ?>
              </tbody> 
            </table>
          </td>
          <td>
            <?php echo $i["nota"] ?>
          </td>
        </tr>
    <?php $numeracion++; } ?>
  <?php if( ( $numeracion - 1 ) % 5 == 0 ) { ?>
  </tbody>
</table>
<?php } ?>