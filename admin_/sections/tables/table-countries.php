<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>País</th>
      <th>Productor</th>
      <!--<th>Editar</th>-->
      <th>Borrar</th>
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
      <!-- <td><a id href="country-edit.php?id=<?php //echo $p["id"]; ?>"> Editar</a></td> -->
      <td>
        <a id href="#!" class="elim-pais" data-idp="<?php echo $p["id"]; ?>" 
          data-code="<?php echo $p["code"]; ?>" data-toggle="modal" 
          data-target="#confirmar-accion"> Borrar</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>