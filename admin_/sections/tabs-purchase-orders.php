<ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
    <?php 
      $active = " active"; $a_sel = "true";
      foreach ( $proveedores as $idpvd ) { 
        $p = obtenerProveedorPorId( $dbh, $idpvd );
    ?>
      <li class="nav-item">
        <a class="nav-link<?php echo $active ?>" id="prov<?php echo $idpvd ?>" data-toggle="tab" 
          href="#dp<?php echo $idpvd ?>" role="tab" aria-controls="<?php echo $p[number] ?>" aria-selected="<?php echo $a_sel ?>">
          <?php echo $p[number]." ".$p[name] ?>
        </a>
      </li>
    <?php $active = ""; $a_sel = "false"; } ?>
</ul>
<div class="tab-content" id="ordenes_p_proveedor">
    <?php 
      $active = " active";
      foreach ( $proveedores as $idpvd ) { 
        $p = obtenerProveedorPorId( $dbh, $idpvd );
    ?>
        <div class="tab-pane fade<?php echo $active ?>" id="dp<?php echo $idpvd ?>" role="tabpanel"
         aria-labelledby="prov<?php echo $idpvd ?>">
            <div align="center"><h3><?php echo $p[number]." ".$p[name] ?></h3></div>
            <input type="hidden" class="tabpvd" value="<?php echo $idpvd ?>">
            <?php include( "tables/table-preorder-provider.php" ); ?>
            
            <hr>

            <div class="resumen_oc">
              <div align="right">Total piezas: 
                <span id="tpzas<?php echo $idpvd ?>"></span>
              </div>
              <div align="right">Total peso: 
                <span id="tpesos<?php echo $idpvd ?>"></span>
              </div>
            </div>

            <div class="form-group" id="bot_no<?php echo $idpvd ?>">
                <div align="center" class="boton_guardar_orden">
                    <a href="#!" >
                        <button id="oc<?php echo $idpvd ?>" type="button" class="btn btn-success guardar_oc" 
                          data-idpvd="<?php echo $idpvd ?>">Guardar Orden</button>
                    </a>
                </div>
                <div id="alerta_exito_oc<?php echo $idpvd ?>" class="alert alert-success alert-oc-exito" role="alert">
                  <strong>Orden guardada con éxito.</strong>
                </div>
            </div>
        </div>
        
    <?php $active = ""; } ?>
</div>
<?php include( "sections/modals/product-image.php" ); ?>