<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Código</th>
      <th> </th>
    </tr>
  </thead>

  <tbody>
      <?php 
        foreach ( $productos as $p ) {
          $lnk = "product-data.php?p=$p[id]"; 
      ?>
      <tr>
        <td><a href="<?php echo $lnk; ?>" target="_blank"><?php echo $p["nombre"]; ?></a></td>
        <td><a href="<?php echo $lnk; ?>" target="_blank"><?php echo $p["descripcion"]; ?></a></td>
        <td><?php echo $p["code"]; ?></td>
        <td>
          <a href="#!" class="desv-prod" data-toggle="modal" data-idp="<?php echo $p["id"]; ?>" 
          data-target="#confirmar-accion">Desvincular</a>
        </td>
      </tr>
      <?php } ?>
  </tbody>
</table>