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
            <tr>
              <th width="20%"></th>
              <th width="20%">Talla</th>
              <th width="60%">Peso</th>
            </tr>
          </thead>
          <tbody>
            <tr style="background:#ccc;">
              <td>

                <input type="checkbox" id="ajustable" name="talla-ajustable" value="ajustable">
                Ajustable
              </td>
              <td>
                <?php echo $t0["name"] ?>
                <input id="nt0" type="hidden" value="<?php echo $t0["name"] ?>" data-idt="<?php echo $t0["id"] ?>"></td>
              <td>
                <input type="text" class="form-control valtallas_sel" 
                placeholder="gr: 0.00" value="" data-t="nt0">
              </td>
            </tr>
            <?php
              $n = 1; 
              foreach ( $tallas as $t ) { 
            ?>
              <tr>
                <td></td>
                <td><?php echo $t["name"]." "."($t[unidad])"; ?>
                  <input id="nt<?php echo $n; ?>" type="hidden" value="<?php echo $t["name"] ?>" data-idt="<?php echo $t["id"] ?>">
                </td>
                <td>
                  <input type="text" class="form-control valtallas_sel" 
                  placeholder="gr: 0.00" value="" data-t="nt<?php echo $n; ?>">
                </td>
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