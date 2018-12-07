<?php 
	/* Argyros - Funciones de líneas */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	if( isset( $_GET["agregar_usuario-exito"] ) ){ ?>
      <script>
        notificar( "Usuarios", "Usuario creado con éxito", "success" );
      </script>
<?php }	?>

<?php if( isset( $_GET["agregar_usuario-error"] ) ){ ?>
  <script>
    notificar( "Usuarios", "Error al crear usuario", "success" );
  </script>
<?php } ?>

<?php if( isset( $_GET["edit_usuario-exito"] ) ){ ?>
  <script>
    notificar( "Usuarios", "Datos de usuario modificados", "success" );
  </script>
<?php } ?>

<?php if( isset( $_GET["agregar_usuario-emailnodisponible"] ) 
      || isset( $_GET["editar_usuario-emailnodisponible"] ) ){ ?>
  <script>
    notificar( "Usuarios", "Email ya asociado a otro usuario", "error" );
  </script>
<?php } ?>



