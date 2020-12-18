<?php 
  $numeracion     = 1;
  $iddet = $ids_detalles_oc[0];
  for( $k=0; $k<13; $k++ ) {
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
                    Orden de compra: <?php echo "#".$orden["id"]." ( $orden[numero] ) "; ?> 
                </td>
                <td align="right"> Fecha: <?php echo $orden["fecha"]; ?></td>
            </tr>
        </table>
        <div class="clearfix"></div>
      </div>
      <table id="datatable-oc<?php echo $ido ?>" class="table_items_oc" border="0">
        <thead>
          <tr>
            <th width="5%">Ítem</th>
            <th width="15%">Producto</th>
            <th width="40%">Descripción</th>
            <th width="40%">Obs</th>
          </tr>
        </thead>
        <tbody>
    <?php } ?>

        <tr>
          <td><div class="numeracion"><?php echo $numeracion ?></div></td>
          <td>
            <div align='center'>
              <a href='#!' class='pop-img-p' data-toggle='modal' 
              data-src="<?php echo $imagen[0][path]; ?>" data-target='#img-product-pop'>
              <img src="<?php echo $imagen[0][path]; ?>" width='200px'></a>
            </div>
            <div align='center' style="font-size: 10px">
              <?php echo $proveedor["number"]."-".$producto["codigof1"]; ?>
            </div>
            <div align='center' style="font-size: 10px">
              <?php echo "#".$i["idp"]."-".$i["idd"]; ?>
            </div>
          </td>
          <td> 
            <table id="tallas<?php echo $iddet ?>" class="table tabla_tallas_oc">
              <tbody>
                  <?php $it = $items[0];
                  for ( $j=0; $j<2; $j++ ) { ?>
                    <tr id="<?php echo $it[idd].$it[idt] ?>">
                      <td align="left"><?php echo "Talla: ".$it["talla"]." ".$it["unidad"]; ?></td>
                      <td align="center"><?php echo "Peso: ".$it["peso"]; ?></td>
                      <td align="right"><?php echo "Cant: ".$it[cant] ?></td>
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