<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Número</th>
      <th>Editar</th>
      <th>Borrar</th>
    </tr>
  </thead>

  <tbody>
    <?php 
      foreach ( $proveedores as $p ) {
          $lnk_edit   = "provider-edit.php?id=$p[id]";
          $prod_asoc  = tieneProductosAsociados( $dbh, $p["id"] );
    ?>
      <tr>
        <td><?php echo $p["nombre"]; ?></td>
        <td><?php echo $p["numero"]; ?></td>
        <td><a href="provider-edit.php?id=<?php echo $p[id] ?>">Editar</a></td>
        <td>
          <?php if( !$prod_asoc ){ ?>
            <a href="#!" class="elim-proveedor" data-toggle="modal" data-idp="<?php echo $p[id] ?>" 
              data-target="#confirmar-accion" disabled>Borrar
            </a>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>