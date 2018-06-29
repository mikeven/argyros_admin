<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Productos</th>
      <th>Editar</th>
      <th>Borrar</th>
    </tr>
  </thead>

  <tbody>
    <?php 
      foreach ( $lineas as $l ) {
        $prods = obtenerProductosLinea( $dbh, $l["id"] );
    ?>
    <tr>
      <td><?php echo $l["name"]; ?></td>
      <td><?php echo $l["description"]; ?></td>
      <td>
        <div class="list-prod-reg">
          <?php foreach ( $prods as $p ) { ?>
            <div>
              <a href="product-data.php?p=<?php echo $p["id"] ?>" target="_blank">
                <?php echo $p["nombre"] ?>
              </a>
            </div>
        <?php } ?>
        </div>
      </td>
      <td><a href="line-edit.php?id=<?php echo $l["id"]; ?>">Editar</a></td>
      <td>
          <a href="#!" class="elim-linea" data-toggle="modal" data-idl="<?php echo $l["id"]; ?>" 
            data-target="#confirmar-accion">Borrar</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>