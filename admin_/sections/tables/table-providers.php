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
          $lnk_edit = "provider-edit.php?id=$p[id]";
    ?>
      <tr>
        <td><?php echo $p["nombre"]; ?></td>
        <td><?php echo $p["numero"]; ?></td>
        <td></td>
        <td></td>
        <!--<td><a href="#!" disabled>Editar</a></td>
        <td>
            <a href="#!" class="elim-proveedor__" data-toggle="modal" data-idp="<?php //echo $p["id"]; ?>" 
              data-target="#confirmar-accion" disabled>Borrar</a>
        </td>-->
      </tr>
    <?php } ?>
  </tbody>
</table>