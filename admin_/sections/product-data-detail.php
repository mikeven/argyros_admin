<div class="col-md-8 col-sm-8 col-xs-12">
    <h4>Detalle de producto</h4>      
    <?php 
        foreach ( $dproducto as $dp ) {
            $disponible         = false;
            $imagenes_detalle   = obtenerImagenesDetalleProducto( $dbh, $dp["id"], NULL );
            $tallas_detalle     = obtenerTallasDetalleProducto( $dbh, $dp["id"] ); 
            $lnk_mvm            = "product-movements.php?p=$producto[id]&dp=$dp[id]";
    ?>
    <div class="row">
        <div id="<?php echo $dp["id"]; ?>" class="col-md-4 col-sm-4 col-xs-12">
            
            <div class="">
                <label class="control-label">#Reg: </label> <?php echo $dp["id"]; ?>
            </div>
            <div class="">
                <label class="control-label">Color: </label> <?php echo $dp["color"]; ?>
            </div> 
            <div class="">
                <label class="control-label">Baño: </label> <?php echo $dp["bano"]; ?>
            </div>
            <div class="">
                <label class="control-label">Tipo de precio: </label> <?php echo txTipoPeso( $dp["tipo_precio"] ); ?>
            </div>

            <?php if( $dp["tipo_precio"] == "p" ) { ?>
            <div class="">
                <label class="control-label">Precio por pieza: </label> <?php echo $dp["precio_pieza"]; ?>
            </div>
            <?php } ?>

            <?php if( $dp["tipo_precio"] == "mo" ) { ?>
            <div class="">
                <label class="control-label">Precio mano de obra: </label> <?php echo $dp["precio_mo"]; ?>
            </div>
            <?php } ?>
            
            <?php if( $dp["tipo_precio"] == "g" ) { ?>
            <div class="">
                <label class="control-label">Precio por peso: </label> <?php echo $dp["precio_peso"]; ?>
            </div>
            <?php } ?>
            <div class="">
                <label class="control-label">Fecha última reposición: </label> 
                <span id="data-freposicion<?php echo $dp[id] ?>">
                    <?php echo $dp["freposicion"]; ?></span> |
                <button type="button" class="btn btn-info btn-xs act_frepos" 
                data-id="<?php echo $dp[id] ?>">
                    <i class="fa fa-arrow-circle-up"></i> Actualizar
                </button>
            </div>
            <div class="">
                <label class="control-label" title="Ubicación">
                    <i class="fa fa-archive"></i> Ubicación: 
                </label> 
                <input id="ub<?php echo $dp["id"]; ?>" class="txubc" type="text" 
                value="<?php echo $dp["ubicacion"]; ?>" maxlength="20">
                <button type="button" class="btn btn-info btn-xs act_ubicacion" 
                    data-id="<?php echo $dp[id] ?>" title="Cambiar"> <i class="fa fa-save"></i>
                </button>
            </div>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-12">
            <?php 
                foreach ( $imagenes_detalle as $img ) { 
            ?>
                <div class="thumb_detailproduct">
                    <a href="#!" class="pop-img-p" data-toggle="modal" data-src="<?php echo $img["path"];?>" 
                    data-target="#img-product-pop">
                        <img src="<?php echo $img["path"]; ?>" width="60px">
                    </a>
                </div> 
            <?php 
                }
            ?>
            <div class="right" style="float:right;">
                <a href="product-detail-edit.php?id=<?php echo $dp[id]; ?>">
                    <button type="button" class="btn btn-info btn-xs">Editar</button>
                </a>

                <div> 
                    <a href="<?php echo $lnk_mvm ?>">
                        <i class="fa fa-exchange"></i> Registro de Movimientos
                    </a>
                </div>
                
            </div>
        </div>
        <?php include( "sections/modals/product-image.php" ); ?>

    </div> <!-- Row -->
    
    <div class="row"><!-- Tallas de detalle de producto -->
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="data-talla-detalle">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr><th>Talla</th><th>Peso</th><th>Acción</th></tr>
                  </thead>
                  <tbody>
                    <?php 
                        foreach ( $tallas_detalle as $talla ) {
                            if( $talla["visible"] == 1 ) { 
                                $ctble = ""; $disponible = true; 
                            }
                            else $ctble = "poculto";
                            
                            $n_talla = $talla["talla"];  
                            if ( $talla["talla"] == "ajust" )  $n_talla  = "Ajustable";
                            if ( $talla["talla"] == "unica" )  $n_talla  = "Única";
                    ?>
                        <tr class="<?php echo $ctble; ?>">
                            <td align="center">
                                <?php echo $n_talla; ?>
                                <?php if ($talla["unidad"]) 
                                    echo "(".$talla["unidad"].")"; 
                                ?>
                            </td>
                            <td><?php echo $talla["peso"]; ?> gr</td>
                            <td>
                                <?php if( $talla["visible"] == 1 ) { ?>
                                    <i class="fa fa-eye-slash"></i> 
                                    <a id="id-dtp<?php echo $talla["idtalla"]; ?>" href="#!" 
                                    class="o-tdetp" data-idtalla="<?php echo $talla["idtalla"]; ?>" 
                                    data-idpdet="<?php echo $talla["iddetprod"]; ?>" data-st="0">Ocultar</a>
                                <?php } else { ?>
                                    <i class="fa fa-eye"></i> 
                                    <a id="id-dtp<?php echo $talla["idtalla"]; ?>" href="#!" 
                                    class="o-tdetp" data-idtalla="<?php echo $talla["idtalla"]; ?>" 
                                    data-idpdet="<?php echo $talla["iddetprod"]; ?>" data-st="1">Mostrar</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                  </tbody>
                </table>
            </div>
            <div>
                <?php if( !$disponible ) { ?>
                
                    <?php 
                        if( $dp["en_desuso"] ) { 
                            $dref = obtenerDatosVistaPrevia( $dbh, $dp["idref"] );
                    ?>
                        <label class="control-label disuse-label" title="Producto en desuso">
                            <i class="fa fa-history"></i>  Producto en desuso: </label> 
                        <?php 
                            if( $dp["idref"] != "" ) { 
                                $ref_pid = $dref[0]["idp"];  $ref_idet = $dref[0]["id"];
                                $lnk_ref = "product-data.php?p=$ref_pid#$ref_idet";
                        ?>
                            Ref: <a href="<?php echo $lnk_ref ?>" target="_blank">
                                    (#<?php echo $ref_pid." - ".$ref_idet ?>)
                                </a>
                                <?php if( $dp["sustituto"] ) { ?>
                                    <span class="badge badge-secondary lab_sust">Sustituto</span>
                                <?php } ?>
                        <?php } ?>
                        
                        <div id="ref_du">Fecha desuso: <?php echo $dp["fdesuso"] ?> </div>
                        <div class="opciones_producto_desuso">
                            <a href="#!" class="pdisuse" data-id="<?php echo $dp[id] ?>">
                                <button type="button" class="btn btn-info btn-xs"> Cambiar </button>
                            </a>
                            <a href="#!">
                                <button type="button" class="btn btn-warning btn-xs btn_not_disuse" 
                                data-id="<?php echo $dp[id] ?>" title="Quitar estatus desuso"> 
                                    <i class="fa fa-share-square"></i>
                                </button>
                            </a>
                        </div>

                    <?php } else { ?> 

                        <div class="lnk_btnpdu"> 
                            <a href="#!" class="pdisuse" data-id="<?php echo $dp[id] ?>">
                                <button type="button" class="btn btn-warning btn-xs"> 
                                    <i class="fa fa-history"></i> Producto en desuso
                                </button>
                            </a>
                        </div>
                        
                    <?php } ?>
                    <div id="pdu<?php echo $dp[id] ?>" class="bloq_refpdu">
                        <form class="frm_pdu">
                            <label class="control-label" title="Referencia">
                                <i class="fa fa-angle-double-right"></i> Referencia: 
                            </label> 
                            <input id="refdu-<?php echo $dp[id]; ?>" class="ref_desuso" type="text" 
                            value="" maxlength="20" data-ctg="<?php echo $producto[scid] ?>" 
                            data-idd="<?php echo $dp[id] ?>">
                            <input id="chk_sust<?php echo $dp[id]; ?>" type="checkbox" class="flat" name="ch_sust"> 
                                    Sustitución
                            <div class="form-group">
                                
                                <button type="button" class="btn btn-info btn-xs btn-ref-du" 
                                    data-id="<?php echo $dp[id] ?>" title="Guardar">
                                    <i class="fa fa-save"></i> Guardar
                                </button>
                            </div>
                            <div id="suggesstion-box"></div>
                                     
                        </form>
                        <div id="refpv-<?php echo $dp[id] ?>">
                            
                        </div>    
                    </div>
                <?php } ?>  
            </div>
        </div>
    </div>
    
    <div class="ln_solid"></div>
    
    <?php 
        } 
    ?> 
    <input id="selected_ref" type="hidden" value="">                     
</div>