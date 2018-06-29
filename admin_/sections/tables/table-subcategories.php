<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Subcategoría</th>
      <th>Categorías</th>
      <th>Productos</th>
      <th>Editar</th>
      <th>Borrar</th>
    </tr>
  </thead>

  <tbody>
      <?php 
        foreach ( $subcategorias as $sc ) {
          $prods = obtenerProductosC_S( $dbh, $sc["idc"], $sc["idsc"] );
      ?>
      <tr>
        <td><?php echo $sc["name"]; ?></td>
        <td><?php echo $sc["cname"]; ?></td>
        <td>
          <div class="list-prod-reg">
            <?php foreach ( $prods as $p ) { ?>
              <div>
                <a href="product-data.php?p=<?php echo $p["id"] ?>" target="_blank">
                  <?php echo $p["name"] ?>
                </a>
              </div>
          <?php } ?>
          </div>
        </td>
        <td><a href="subcategory-edit.php?id=<?php echo $sc["scid"]; ?>">Editar</a></td>
        <td>
            <a href="#!" class="elim-subcategoria" data-toggle="modal" 
            data-idsc="<?php echo $sc["idsc"]; ?>" data-target="#confirmar-accion">Borrar</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>