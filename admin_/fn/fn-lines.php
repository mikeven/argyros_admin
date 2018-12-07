<?php 
	/* Argyros - Funciones de líneas */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	if( isset( $_GET["agregar_linea-exito"] ) ){ ?>
      <script>
        notificar( "Líneas", "Línea creada con éxito", "success" );
      </script>
<?php }	?>

<?php if( isset( $_GET["agregar_linea-nodisponible"] ) 
       || isset( $_GET["editar_linea-nodisponible"] ) ){ ?>
  <script>
    notificar( "Líneas", "Nombre de línea ya existente", "error" );
  </script>
<?php } ?>

<?php if( isset( $_GET["editar_linea-exito"] ) ){ ?>
  <script>
    notificar( "Líneas", "Los datos de la línea fueron modificados", 'success' );
  </script>
<?php } ?>


