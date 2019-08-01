<?php ob_start(); ?>
	<nav class="toast">
		<div class="open">
			<?= insererLiens($liens, $icones, $descriptions) ?>
		</div>
		<div class="closed">
			<div class="element">
				<a href="#open-tools" title="Outils"><i class="material-icons">more_vert</i></a>
			</div>
		</div>
	</nav>
<?php $Contenu=ob_get_clean(); // $Contenu et pas $contenu ?>