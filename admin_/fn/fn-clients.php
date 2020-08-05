<?php 
	/* Argyros - Funciones de clientes */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

  function etiquetaEstadoCliente( $v ){
    //Devuelve la etiqueta correspondiente al estado de verificación de una cuenta de cliente
    $estados = array(
      1     => "Verificado",
      NULL  => "No verificado"
    );

    return $estados[$v];
  }

  /* ----------------------------------------------------------------------------------- */

	if( isset( $_GET["ngroupsuccess"] ) ){ ?>
      <script>
        notificar( "Grupo de cliente", "Perfil de cliente creado con éxito", "success" );
      </script>
  <?php }	?>

  <?php if( isset( $_GET["editgroupsuccess"] ) ){ ?>
    <script>
      notificar( "Grupo de cliente", "Datos de grupo modificados", "success" );
    </script>
  <?php } ?>

  <?php if( isset( $_GET["editar_usuario-exito"] ) ){ ?>
    <script>
      notificar( "Cliente", "Datos de cliente modificados", "success" );
    </script>
  <?php } ?>

  <?php if( isset( $_GET["editar_password-cliente-exito"] ) ){ ?>
    <script>
      notificar( "Cliente", "Contraseña de cliente actualizada", "success" );
    </script>
  <?php } ?>

  <?php if( isset( $_GET["nueva_nota-exito"] ) ){ ?>
    <script>
      notificar( "Cliente", "Nueva nota agregada con éxito", "success" );
    </script>
  <?php } ?>