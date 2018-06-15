<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Email</th>
      <th>Rol</th>
      <th>Fecha creación</th>
      <th>Editar</th>    </tr>
  </thead>
  <tbody>
      <?php 
        foreach ( $usuarios as $u ) { 
      ?>
      <tr>
        <td><a href="user-data.php?id=<?php echo $u["id"]; ?>"><?php echo $u["nombre"]." ".$u["apellido"]; ?></a></td>
        <td><?php echo $u["email"]; ?></td>
        <td>
          <select id="<?php echo $u["id"]; ?>" class="form-control ctr_rol_usuario">
            <option disabled>Seleccione</option>
            <?php foreach ( $roles as $r ) { ?>
              <option value="<?php echo $r["id"]; ?>" <?php echo sop( $r["id"], $u["idrol"] ); ?> >
                <?php echo $r["nombre"] ?>
              </option>
            <?php } ?>
          </select>    
        </td>
        <td><?php echo $u["fcreacion"]; ?></td>
        <td><a href="user-edit.php?id=<?php echo $u["id"]; ?>">Editar</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>