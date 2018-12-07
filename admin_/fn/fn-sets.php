<?php 
	/* Argyros - Funciones de líneas */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	if( isset( $_GET["agregar_juego-exito"] ) ){ ?>
      <script>
        notificar( "Juegos", "Juego creado con éxito", "success" );
      </script>
<?php }	?>

<?php if( isset( $_GET["editar_juego-exito"] ) ){ ?>
  <script>
    notificar( "Juegos", "Juego de productos modificado", 'success' );
  </script>
<?php } ?>


