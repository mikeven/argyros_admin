<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Valor</th>
      <th>Unidad</th>
      <th>Categoría</th>
      <th> </th>
      <th> </th>
    </tr>
  </thead>

  <tbody>
      <?php 
        foreach ( $sizes as $s ) { 
          if( $s["cid"] != 0 ){   //Se filtra la talla N/A: categoría 0
      ?>
        <tr>
          <td><?php echo $s["name"]; ?></td>
          <td><?php echo $s["unidad"]; ?></td>
          <td><?php echo $s["cname"]; ?></td>
          <td><a href="size-edit.php?id=<?php echo $s["id"]; ?>">Editar</a></td>
          <td>
            <a href="#!" class="elim-rtalla" data-toggle="modal" data-idt="<?php echo $s["id"]; ?>" 
            data-target="#confirmar-accion">Borrar</a>
          </td>
        </tr>
    <?php } } ?>
  </tbody>
</table>