<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
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
        <td><a href="<?php echo $lnk; ?>"><?php echo $p["description"]; ?></a></td>
        <td><?php echo $p["code"]; ?></td>
        <td><a href="#!">Desvincular de esta línea</a></td>
      </tr>
      <?php } ?>
  </tbody>
</table>