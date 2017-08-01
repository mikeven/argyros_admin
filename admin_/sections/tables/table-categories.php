<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Categoría</th>
      <th> </th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ( $categorias as $c ) { ?>
      <tr>
        <td><?php echo $c["name"]; ?></td>
        <td><?php ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>