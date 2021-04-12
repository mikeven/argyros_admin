<table id="datatable-oc" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th width="5%">Ítem</th>
      <th width="5%">Códigos</th>
      <th width="15%">Producto</th>
      <th width="50%">Tallas | Cantidades</th>
      <th width="25%">Nota</th>
    </tr>
  </thead>
  <tbody>
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
        <tr>
          <td align="center"> <div class="numeracion" style="margin-bottom: 5px"><?php echo $numeracion ?></div> </td>
          <td align="center"> <?php echo $proveedor["number"]."-".$producto["codigof1"]; ?> </td>
          <td>
            <div align='center'>
              <a href='#!' class='pop-img-p' data-toggle='modal' 
              data-src="<?php echo $imagen[0]['path']; ?>" data-target='#img-product-pop'>
              <img src="<?php echo $imagen[0]['path']; ?>" width='60px'></a>
            </div>
            <div align='center'>
              <a href="<?php echo $lnk_dp ?>" target='_blank'>#<?php echo $i["idp"]."-".$i["idd"] ?></a>
            </div>
            <?php if( $i["desuso"] ){ ?>
              <div align="center"><span class="badge badge-secondary" title="En desuso">
                <i class="fa fa-history"></i> En desuso</span>
              </div>
            <?php } ?>
          </td>
          <td> 
            <form id="frm_orden_compra">
              <table id="tallas<?php echo $iddet ?>" class="table table-striped table-bordered">
                <tbody>
                    <?php 
                      foreach ( $items as $it ) { 
                        $cl = obtenerIndicadorEstadoItemOC( $it["estado"] );
                    ?>
                      <tr id="<?php echo $it['idd'].$it['idt'] ?>">
                        <td align="center" width="25%"><?php echo $it["talla"]." ".$it["unidad"]; ?></td>
                        <td align="center" width="50%">
                          <input class="form-control cnt_preord" type="text" onkeypress="return isIntegerKey(event)" 
                            name="cantidad[]" value="<?php echo $it['cant'] ?>" maxlength="5" 
                            data-idt="<?php echo $it['idt']; ?>" data-idd="<?php echo $it['idd']; ?>" 
                            data-id-detoc="<?php echo $it['id']; ?>" readonly>
                        </td>
                        <td align="center" width="25%">

                          <table class="tabla_estatus_items">
                            <td align="center">
                              <a id="<?php echo $it['id'] ?>" href="#!" class="item_oc_estado" 
                                data-iddo="<?php echo $it['id'] ?>" title="Pendiente" data-valor="pendiente">
                                <button id="pendiente<?php echo $it['id'] ?>" type="button" 
                                  class="st_pdt btn btn-xs <?php echo $cl[0] ?> btn-est-<?php echo $it['id'] ?>">
                                  <i class="fa fa-exclamation-triangle icono_ista"></i>
                                </button>
                              </a>
                            </td>
                            <td align="center">
                              <a id="<?php echo $it['id'] ?>" href="#!" class="item_oc_estado" 
                                data-iddo="<?php echo $it['id'] ?>" title="Recibido" data-valor="recibido">
                                <button id="recibido<?php echo $it['id'] ?>" type="button" 
                                  class="btn btn-xs <?php echo $cl[1] ?> btn-est-<?php echo $it['id'] ?>">
                                  <i class="fa fa-check-circle icono_ista"></i>
                                </button>
                              </a>
                            </td>
                            <td align="center">
                              <a id="<?php echo $it['id'] ?>" href="#!" class="item_oc_estado" 
                                data-iddo="<?php echo $it['id'] ?>" title="No Recibido" data-valor="no-recibido">
                                <button id="no-recibido<?php echo $it['id'] ?>" type="button" 
                                  class="btn btn-xs <?php echo $cl[2] ?> btn-est-<?php echo $it['id'] ?>">
                                  <i class="fa fa-times-circle icono_ista"></i>
                                </button>
                              </a>
                            </td>
                          </table>

                        </td>
                      </tr> 
                    <?php } ?>
                </tbody> 
              </table>
            </form>
          </td>
          <td>
            <?php echo $i["nota"] ?>
          </td>
        </tr>
    <?php $numeracion++; } ?>
  </tbody>
</table>