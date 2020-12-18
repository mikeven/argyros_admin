<?php 
	/* Argyros - Funciones de proveedores */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	if( isset( $_GET["agregar_proveedor-exito"] ) ){ ?>
      <script>
        notificar( "Proveedores", "Proveedor creado con éxito", "success" );
      </script>
<?php }	?>

<?php if( isset( $_GET["agregar_proveedor-nodisponible"] ) 
       || isset( $_GET["editar_proveedor-nodisponible"] ) ){ ?>
  <script>
    notificar( "Proveedores", "Número de proveedor ya existente", "error" );
  </script>
<?php } ?>

<?php if( isset( $_GET["editar_proveedor-exito"] ) ){ ?>
  <script>
    notificar( "Proveedores", "Los datos del proveedor fueron modificados", 'success' );
  </script>
<?php } ?>


