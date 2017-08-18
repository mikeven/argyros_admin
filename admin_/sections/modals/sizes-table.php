<div id="size-table" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
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
              <th>Talla</th>
              <th>Peso</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $tallas as $t ) { ?>
              <tr>
                <td><?php echo $t["name"] ?></td>
                <td><input type="text" class="form-control" placeholder="Peso (gr: 00.00)"></td>
              </tr>
            <?php } ?>  
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
      </div>

    </div>
  </div>
</div>