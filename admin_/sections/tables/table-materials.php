<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Baños</th>
      <th>Borrar</th>
    </tr>
  </thead>
  <tbody>
      <?php 
        foreach ( $materiales as $m ) { 
          $banos = obtenerListaBanosMaterial( $dbh, $m["id"] );
      ?>
      <tr>
        <td><?php echo $m["name"]; ?></td>
        <td>
          <?php 
            foreach ( $banos as $b ) { 
              echo "<a href='#!'><div>$b[name]</div></a>";  
            }
          ?>
        </td>
        <td><a href="#!">Borrar</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>