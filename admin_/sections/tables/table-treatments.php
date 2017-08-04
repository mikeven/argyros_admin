<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Material</th>
    </tr>
  </thead>

  <tbody>
    <?php 
      foreach ( $banos as $b ) { 
    ?>
    <tr>
      <td><?php echo $b["name"]; ?></td>
      <td><?php echo $b["material"]; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>