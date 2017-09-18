<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>País</th>
      <th>Productor</th>
    </tr>
  </thead>

  <tbody>
    <?php 
      foreach ( $paises as $p ) { 
            
    ?>

      <tr>
        <td><?php echo $p["name"]; ?></td>
        <td><a id href="#!" class="epaisproductor" data-id="<?php echo $p["id"]; ?>">
          <div id="rco<?php echo $p["id"]; ?>"><?php echo $p["is_manufacture"]; ?></div></a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>