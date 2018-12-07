<?php 
	/* Argyros - Funciones de colores */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	if( isset( $_GET["agregar_color-exito"] ) ){ ?>
      <script>
        notificar( "Colores", "Color creado con éxito", "success" );
      </script>
<?php }	?>

<?php if( isset( $_GET["agregar_color-nodisponible"] ) 
      || isset( $_GET["editar_color-nodisponible"] ) ){ ?>
  <script>
    notificar( "Colores", "Nombre de color ya existente", "error" );
  </script>
<?php } ?>

<?php if( isset( $_GET["editar_color-exito"] ) ) { ?>
  <script>
    notificar( "Colores", "Los datos de color fueron modificados", 'success' );
  </script>
<?php } ?>


