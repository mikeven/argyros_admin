<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>País</th>
      <th>Productor</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ( $paises as $p ) { ?>
      <tr>
        <td><?php echo $p["name"]; ?></td>
        <td><?php echo $p["manufacture"]; ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>