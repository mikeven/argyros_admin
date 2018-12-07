<?php 
	/* Argyros - Funciones de líneas */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	if( isset( $_GET["agregar_material-exito"] ) ){ ?>
      <script>
        notificar( "Materiales", "Material creado con éxito", "success" );
      </script>
<?php }	?>

<?php if( isset( $_GET["agregar_material-nodisponible"] ) 
      || isset( $_GET["editar_material-nodisponible"] ) ){ ?>
  <script>
    notificar( "Materiales", "Nombre de material ya existente", "error" );
  </script>
<?php } ?>

<?php if( isset( $_GET["edit_material-exito"] ) ) { ?>
  <script>
    notificar( "Materiales", "Los datos de material fueron modificados", 'success' );
  </script>
<?php } ?>


