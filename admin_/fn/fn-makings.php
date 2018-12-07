<?php 
	/* Argyros - Funciones de trabajos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	if( isset( $_GET["agregar_trabajo-exito"] ) ){ ?>
      <script>
        notificar( "Trabajos", "Trabajo creado con éxito", "success" );
      </script>
<?php }	?>

<?php if( isset( $_GET["agregar_trabajo-nodisponible"] ) 
      || isset( $_GET["editar_trabajo-nodisponible"] ) ){ ?>
  <script>
    notificar( "Trabajos", "Nombre de trabajo ya existente", "error" );
  </script>
<?php } ?>

<?php if( isset( $_GET["editar_trabajo-exito"] ) ) { ?>
  <script>
    notificar( "Trabajos", "Los datos de trabajo fueron modificados", 'success' );
  </script>
<?php } ?>


