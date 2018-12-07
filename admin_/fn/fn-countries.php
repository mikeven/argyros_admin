<?php 
	/* Argyros - Funciones de países */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	if( isset( $_GET["agregar_pais-exito"] ) ){ ?>
      <script>
        notificar( "Países", "País agreado con éxito", "success" );
      </script>
<?php }	?>

<?php if( isset( $_GET["agregar_pais-nodisponible"] ) 
      || isset( $_GET["editar_pais-nodisponible"] ) ){ ?>
  <script>
    notificar( "Países", "Nombre de país ya existente", "error" );
  </script>
<?php } ?>

<?php if( isset( $_GET["editar_pais-exito"] ) ) { ?>
  <script>
    notificar( "Países", "Los datos de país fueron modificados", 'success' );
  </script>
<?php } ?>


