<table id="datatable-clients" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>País</th>
      <th>Grupo</th>
      <th>Tipo</th>
      <th>Fecha registro</th>
      <th>Estado</th>
      <th>Editar</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      foreach ( $clientes as $c ) {
        $lnk_e = "client-edit.php?id=".$c["id"];
        $nombre_empresa = "";
        if( $c["esempresa"] == 1 ) $nombre_empresa = "(".trim($c["nempresa"]).")";
        if( $c["bloqueado"] == 1 ) {
          $data_bl = 0; $cll = "blocked_user";
          $blq_tx = "Desbloquear";
        }else{
          $data_bl = 1; $cll = "";
          $blq_tx = "Bloquear";
        } 
    ?>
      <tr>
        <td><?php echo $c["id"]; ?></td>
        <td><a href="client-data.php?id=<?php echo $c["id"]; ?>"><?php echo $c["nombre"]." ".$c["apellido"]; ?></a></td>
        <td><?php echo $c["email"]; ?></td>
        
        <td><?php echo $c["pais"]; ?></td>
        
        <td>
          <select class="form-control selec_grupo_perfil selectpicker" data-idc="<?php echo $c["id"]; ?>">
            <option disabled>Seleccione</option>
            <?php 
              foreach ( $grupos as $g ) { ?>
              <option <?php echo sop( $c["grupo"], $g["name"] ); ?> 
              class="cambio_perfil" data-trg="<?php echo $c["id"]; ?>" 
              value="<?php echo $g["id"]; ?>"><?php echo $g["name"] ?> </option>
            <?php } ?>
          </select>    
        </td>
        <td><?php echo $c["tipo"].$nombre_empresa; ?></td>
        <td><?php echo $c["fcreacion"]; ?></td>
        <td> <?php echo etiquetaEstadoCliente( $c["verificado"] ); ?> </td>
        <td><a href="<?php echo $lnk_e; ?>">Editar</a></td>
        <td>
          <?php if( $c["verificado"] != 1 ) { ?>
            <a href="#!" class="elim-cliente" data-toggle="modal" 
            data-idc="<?php echo $c["id"]; ?>" data-target="#confirmar-accion">Borrar</a>
          <?php } else { ?>
            <a href="#!" class="bloq-cliente <?php echo $cll; ?>" data-toggle="modal" 
              data-bl="<?php echo $data_bl; ?>" data-idc="<?php echo $c["id"]; ?>" 
              data-target="#confirmar-accion">
              <?php echo $blq_tx; ?>
            </a>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>