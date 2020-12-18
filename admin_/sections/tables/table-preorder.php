<table id="datatable-preorder" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th width="15%">Agotado</th>
      <th width="10%">Códigos</th>
      <th width="10%">Producto</th>
      <th width="25%">Tallas | Cantidades</th>
      <th width="15%">Nota</th>
      <th width="10%">Proveedor</th>
    </tr>
  </thead>
  <tbody>
      <?php 
        foreach ( $ids_preo as $iddet ) {
          $items        = obtenerItemsPorDetalle( $iddet );
          $i            = $items[0];
          $lnk_dp       = "product-data.php?p=$i[idp]#$i[idd]";
          $producto     = obtenerProductoPorId( $dbh, $i["idp"] ); 
          $nprov2       = "";
          $nprov3       = "";
           
          $proveedor    = obtenerProveedorPorId( $dbh, $producto["idpvd1"] );
          
          if( $producto["idpvd2"] ){
            $proveedor2 = obtenerProveedorPorId( $dbh, $producto["idpvd2"] );
            $nprov2     = $proveedor2["number"];
          }
          if( $producto["idpvd3"] ){
            $proveedor3 = obtenerProveedorPorId( $dbh, $producto["idpvd3"] );
            $nprov3     = $proveedor3["number"];
          }

          $proveedores  = obtenerListaProveedores( $dbh );
          $lproveedores = obtenerListaProveedoresPreorden( $dbh, $proveedores, $i["idpvd"], $i["idd"], $i["idt"] );
      ?>
      <tr id="itemid<?php echo $i[idd] ?>">
        <td><?php echo $i["agotado"]; ?></td>
        <td align="center"> 
          <div><?php echo $proveedor["number"]."-".$producto["codigof1"]; ?></div> 
          <?php if( $nprov2 != "" || $producto["codigof2"] ) {?>
            <div><?php echo $nprov2."-".$producto["codigof2"]; ?></div> 
          <?php } ?>
          <?php if( $nprov3 != "" || $producto["codigof3"] ) {?>
            <div><?php echo $nprov3."-".$producto["codigof3"]; ?></div> 
          <?php } ?>
        </td>
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
          <table id="tallas<?php echo $i[idd] ?>" class="table table-striped table-bordered">
            <tbody>
              <?php 
                foreach ( $items as $it ) {
                  $talla = obtenerColorDisponibilidadTalla( $dbh, $it );          // fn-purchase.php 
              ?>
                <tr id="<?php echo $it[idd].$it[idt] ?>" class="itemt<?php echo $it[idd] ?>">
                  <td><?php echo $talla; ?></td>
                  <td align="center">
                    <input class="form-control cnt_preord act_preo" type="text" onkeypress="return isIntegerKey(event)" 
                      name="cantidad" value="<?php echo $it[cant] ?>" maxlength="5" 
                      data-idt="<?php echo $it[idt]; ?>" data-idd="<?php echo $it[idd]; ?>" data-prm="cant">
                  </td>
                  <td align="center">
                    <a href="#!" class="quitar_item" data-idt="<?php echo $it[idt]; ?>" 
                      data-idd="<?php echo $it[idd]; ?>" data-prm="eliminar" title="Quitar de la lista pre-orden">
                      <i class="fa fa-2x fa-times"></i>
                    </a>
                  </td> 
                </tr> 
              <?php } ?>
          </tbody> 
          </table>
        </td>
        
        <td>
          <div align="center" class="form-group" style="width: 100%">
            <textarea class="form-control not_preord act_preo_d" rows="3" placeholder="Nota" 
            name="nota" data-idt="<?php echo $i[idt]; ?>" 
            data-idd="<?php echo $i[idd]; ?>" data-prm="nota"><?php echo $i[nota] ?></textarea>
          </div>
        </td>
        <td>
          <?php echo $lproveedores; ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<?php include( "sections/modals/product-image.php" ); ?>