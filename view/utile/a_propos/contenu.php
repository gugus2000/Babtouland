<?php ob_start(); ?>
	<div id="conteneur">
		<section class="ligne">
			<section class="colonne">
				<section class="carte">
					<section class="contenu">
						<h1><?= $lang['utile_a_propos_contenu_titre'] ?></h1>
						<?php
						for ($i=0, $lenght=count($lang['utile_a_propos_contenu_questions']); $i < $lenght; $i++)
						{
							?>
						<h2><?= $lang['utile_a_propos_contenu_questions'][$i] ?></h2>
						<p class="left_align"><?= $lang['utile_a_propos_contenu_reponses'][$i] ?></p>
							<?php
						}
						?>
					</section>
					<section class="espace_carte_x2">
						
					</section>
					<section class="contenu">
						<section class="formulaire">
							<form action="<?= $config['utile_a_propos_formulaire_action'] ?>" method="POST" accept-charset="utf-8">
								<fieldset>
									<legend><?= $lang['utile_a_propos_formulaire_legend'] ?></legend>
									<label for="a_propos_contenu"><?= $lang['utile_a_propos_formulaire_label'] ?></label>
									<textarea name="a_propos_contenu"></textarea><br />
									<input type="submit" value="<?= $lang['utile_a_propos_formulaire_submit'] ?>">
								</fieldset>
							</form>
						</section>
					</section>
				</section>
			</section>
		</section>
	</div>
<?php $contenu.=ob_get_clean(); ?>