<?php
$Post=new \post\Post(array(
	'id' => $id,
));
$Post->recuperer();
?>
<?php ob_start(); ?>
	<div id="conteneur">
		<section class="ligne">
			<section class="ligne">
				<section class="carte">
					<section class="contenu">
						<div class="formulaire">
							<form action="<?= $config['post_edition_formulaire_action'] ?>&id=<?= $Post->afficherId() ?>" method="POST" accept-charset="utf-8">
								<fieldset>
									<legend><?= $lang['post_edition_formulaire_legend'] ?></legend>
									<label for="edition_titre"><?= $lang['post_edition_formulaire_titre'] ?></label>
									<input type="text" name="edition_titre" value="<?= $Post->afficherTitre() ?>"><br />
									<label for="edition_contenu"><?= $lang['post_edition_formulaire_contenu'] ?></label>
									<textarea name="edition_contenu"><?= $Post->afficherContenu() ?></textarea><br />
									<input type="submit" value="<?= $lang['post_edition_formulaire_submit'] ?>">
								</fieldset>
							</form>
						</div>
					</section>
				</section>
			</section>
		</section>
	</div>
<?php $contenu=ob_get_clean(); ?>