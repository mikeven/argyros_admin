<?php 
	/* Argyros - Funciones de categorías y subcategorías */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	if( isset( $_GET["subcategories_edit_success"] ) ){ // Éxito al modificar subcategoría ?>
      <script>
        notificar( "Subcategorías de productos", "Registro modificado con éxito", "success" );
      </script>
<?php }	?>

<?php if( isset( $_GET["agregar_subcategoria-exito"] ) ) { // Éxito al guardar subcategoría?>
  <script>notificar( "Nueva subcategoría", "Registro guardado con éxito", "success" );</script>
<?php } ?>

<?php if( isset( $_GET["agregar_subcategoria-nodisponible"] ) 
      || isset( $_GET["editar_subcategoria-nodisponible"] )) { // Nombre de subcategoría duplicado ?>
      <script>
        notificar( "Nueva subcategoría", "Nombre de subcategoría ya registrado en esa categoría", "error" );
      </script>
<?php } ?>



<?php if( isset( $_GET["categoriasdestacadas"] ) ) { // Éxito al guardar categorías destacadas ?>
  <script>notificar( "Categorías de productos", "Los cambios se hicieron con éxito", "success" );</script>
<?php } ?>

<?php if( isset( $_GET["agregar_categoria-exito"] ) ) { // Éxito al guardar categoría?>
  <script>notificar( "Nueva categoría", "Registro guardado con éxito", "success" );</script>
<?php } ?>

<?php if( isset( $_GET["categories_edit_success"] ) ){ // Éxito al modificar categoría ?>
  <script>
    notificar( "Categorías de productos", "Registro modificado con éxito", "success" );
  </script>
<?php } ?>

<?php if( isset( $_GET["agregar_categoria-nodisponible"] ) 
      || isset( $_GET["editar_categoria-nodisponible"] )) { // Nombre de categoría duplicado ?>
  <script>notificar( "Nueva categoría", "Nombre de categoría ya registrado", "error" );</script>
<?php } ?>