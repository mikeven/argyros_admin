<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Archivo en servidor</th>
      <th>Asignada</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      
      while ( ( $archivo = $dirint->read() ) !== false ) {
    ?>
      <tr>
        <td><a href="catalog/<?php echo $archivo; ?>" target="_blank"><?php echo $archivo; ?></a></td>
        <td><?php echo imagenAsignada( $dbh, "catalog/".$archivo ); ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>