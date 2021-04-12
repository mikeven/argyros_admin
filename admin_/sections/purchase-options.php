<h2>Cambio de estado</h2>

<?php if ( $orden["estado"] == "creada" ) { ?>
    <div class="form-group btn_accion_orden" style="margin-left:20px;">
        <a href="#!" class="estat_oc" data-estado="enviada" data-idoc="<?php echo $orden['id']; ?>">
            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" 
            data-target="#confirmar-accion"><i class='fa fa-send-o' title='Enviada'></i> Enviada</button>
        </a> 
    </div>                    
    <div class="form-group btn_accion_orden" style="margin-left:20px;">
        <a href="#!" class="estat_oc" data-estado="cancelada" data-idoc="<?php echo $orden['id']; ?>">
            <button id="can_pedido" type="button" 
            class="btn btn-danger btn-xs" data-toggle="modal" 
            data-target="#confirmar-accion"><i class='fa fa-ban' title='Cancelada'></i> Cancelar</button>
        </a> 
    </div>
<?php } ?>

<?php if ( $orden["estado"] == "enviada" ) { ?>
                      
    <div class="form-group btn_accion_orden" style="margin-left:20px;">
        <a href="#!" class="estat_oc" data-estado="confirmada" data-idoc="<?php echo $orden['id']; ?>">
            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" 
            data-target="#confirmar-accion"><i class='fa fa-check' title='Confirmada'></i> Confirmada</button>
        </a> 
    </div>
    <div class="form-group btn_accion_orden" style="margin-left:20px;">
        <a href="#!" class="estat_oc" data-estado="cancelada" data-idoc="<?php echo $orden['id']; ?>">
            <button id="can_pedido" type="button" 
            class="btn btn-danger btn-xs" data-toggle="modal" 
            data-target="#confirmar-accion"><i class='fa fa-ban' title='Cancelada'></i> Cancelar</button>
        </a> 
    </div>
<?php } ?>

<?php if ( $orden["estado"] == "confirmada" ) { ?>                
    <div class="form-group btn_accion_orden" style="margin-left:20px;">
        <a href="#!" class="estat_oc" data-estado="recibida" data-idoc="<?php echo $orden['id']; ?>">
            <button id="btn_oc_recibida" type="button" class="btn btn-info btn-xs" data-toggle="modal" 
            data-target="#confirmar-accion"><i class='fa fa-download' title='Recibida'></i> Recibida</button>
        </a> 
    </div>
<?php } ?>