<div id="size-table" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="">Tallas de categoría</h4>
      </div>
      <div id="sizestable" class="modal-body">
        <table class="table">
          <thead>
            <tr><th>Talla</th><th>Peso</th><th>Disponibilidad</th><th>Acción</th></tr>
          </thead>
          <tbody>
            <tr style="background:#ccc;">
              <td>
                <?php echo $t0["name"] ?>
                <input id="nt0" type="hidden" value="<?php echo $t0["name"] ?>" data-idt="<?php echo $t0["id"] ?>">
              </td>
              <td>
                <input type="text" class="form-control valtallas_sel" placeholder="Peso (gr: 0.00)" value="" data-t="nt0">
              </td>
            </tr>
            <?php
              $n = 1;
              
              //$tallas: registro general de tallas registradas en la categoría
              foreach ( $tallas as $t ) {
                $data = obtenerDatosTallaRegistrada( $t["id"], $tallas_det );
                //$tallas_det: tallas registradas en detalle prod
                
                $vpeso = $data["peso"]; 
                $disponibilidad = $data["disp"];
                $lnk = $data["ldsp"];  
            ?>
            <tr>
              <td><?php echo $t["name"] ?>
                <input id="nt<?php echo $n; ?>" type="hidden" value="<?php echo $t["name"] ?>" data-idt="<?php echo $t["id"] ?>">
              </td>
              <td>
                <input type="text" class="form-control valtallas_sel" placeholder="Peso (gr: 0.00)" 
                value="<?php echo $vpeso ?>" data-t="nt<?php echo $n; ?>">
              </td>
              <td><?php echo $disponibilidad; ?></td>
              <td><?php echo $lnk; ?></td>
            </tr>

            <?php $n++; } ?>  
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button id="bot_seltallas" type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
      </div>

    </div>
  </div>
</div>