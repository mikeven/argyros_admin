<?php 
	/* Argyros - Funciones comúnes */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
?>
	<div id="gallery">

		<?php 
			$conti = 0;
			foreach ( $imgs_det as $img ) { 
				$datatg = "confdel".$conti;
				$dataog = "cancdel".$conti;
				$idimgc = "galprod".$conti;
		?>
			
			<div id="<?php echo $idimgc; ?>" class="col-md-5 col-sm-3 col-xs-4 galdetexist">

				<img class="responsive" src="<?php echo $img["path"]; ?>" width="100%" height="100%">
				<div class="imgdetprod_delopt">
					<a id="<?php echo $dataog; ?>" href="#!" class="lnk_elimimg_detprod" data-target="<?php echo $datatg; ?>">
						<i class="fa fa-trash"></i> Eliminar
					</a>
					<div id="<?php echo $datatg; ?>" class="opt_confelimimg_detprod">
						<a href="#!" class="lnk_confelim_idet optcanconf" data-idimg="<?php echo $img["id"]; ?>" 
						data-gal="<?php echo $idimgc; ?>">
							<i class="fa fa-check-square-o"></i> Confimar
						</a>
						<span>   |   </span>
						<a href="#!" class="lnk_cancelim_idetp optcanconf" data-target="<?php echo $dataog; ?>" data-bloc="<?php echo $datatg; ?>">
							<i class="fa fa-times"></i> Cancelar
						</a>
					</div>
				</div>

			</div>

		<?php $conti++; } ?>

	</div>
