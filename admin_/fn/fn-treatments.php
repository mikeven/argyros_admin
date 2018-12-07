<?php 
	/* Argyros - Funciones de baños */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	if( isset( $_GET["agregar_bano-exito"] ) ){ ?>
      <script>
        notificar( "Baños", "Baño creado con éxito", "success" );
      </script>
<?php }	?>

<?php if( isset( $_GET["editar_bano-exito"] ) ){ ?>
  <script>
    notificar( "Baños", "Datos de baño modificados", "success" );
  </script>
<?php } ?>

<?php if( isset( $_GET["agregar_bano-nodisponible"] ) 
      || isset( $_GET["editar_bano-nodisponible"] ) ){ ?>
  <script>
    notificar( "Baños", "Nombre de baño ya existente con ese material", "error" );
  </script>
<?php } ?>

<?php if( isset( $_GET["edit_bano-exito"] ) ) { ?>
  <script>
    notificar( "Baños", "Los datos de baño fueron modificados", 'success' );
  </script>
<?php } ?>


