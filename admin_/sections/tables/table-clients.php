<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Email</th>
      <th>Teléfono</th>
      <th>País</th>
      <th>Grupo</th>
      <th>Fecha registro</th>
      <th>Editar</th>
      <th>Borrar</th>
    </tr>
  </thead>
  <tbody>
      <?php 
        foreach ( $clientes as $c ) { 
      ?>
      <tr>
        <td><a href="client-data.php?id=<?php echo $c["id"]; ?>"><?php echo $c["nombre"]." ".$c["apellido"]; ?></a></td>
        <td><?php echo $c["email"]; ?></td>
        <td><?php echo $c["phone"]; ?></td>
        <td><?php echo $c["pais"]; ?></td>
        <td>
          <select class="form-control selec_grupo_perfil" data-idc="<?php echo $c["id"]; ?>">
            <option disabled>Seleccione</option>
            <?php foreach ( $grupos as $g ) { ?>
              <option <?php echo sop( $c["grupo"], $g["name"] ); ?> 
              class="cambio_perfil" data-trg="<?php echo $c["id"]; ?>"><?php echo $g["name"] ?> </option>
            <?php } ?>
          </select>    
        </td>
        <td><?php echo $c["fcreacion"]; ?></td>
        <td><a href="#!">Editar</a></td>
        <td><a href="#!">Borrar</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>