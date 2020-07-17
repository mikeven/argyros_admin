<table id="datatable-products" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>
          <?php if( isset( $_GET["imagenes"] ) ) { ?>
            <i class="fa fa-file-image-o"></i>
          <?php } ?>
      </th>
      <th>Id</th>
      <th>Código</th>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Categoría</th>
      <th>Detalles</th>
      <th>Editar</th>
      <th>Acción</th>
    </tr>
  </thead>
</table>

<?php include( "sections/modals/product-image.php" ); ?>