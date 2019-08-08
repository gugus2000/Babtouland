<?php
$Commentaire=new \post\Commentaire(array(
	'id' => $id,
));
$Commentaire->recuperer();
?>
<?php ob_start(); ?>
	<div id="conteneur">
		<section class="ligne">
			<section class="ligne">
				<section class="carte">
					<section class="contenu">
						<div class="formulaire">
							<form action="<?= $config['post_commentaire_edition_formulaire_action'] ?>&id=<?= $Commentaire->afficherId() ?>" method="POST" accept-charset="utf-8">
								<fieldset>
									<legend><?= $lang['post_commentaire_edition_formulaire_legend'] ?></legend>
									<label for="edition_commentaire_contenu"><?= $lang['post_commentaire_edition_formulaire_contenu'] ?></label>
									<textarea name="edition_commentaire_contenu"><?= $Commentaire->afficherContenu() ?></textarea><br />
									<input type="submit" value="<?= $lang['post_commentaire_edition_formulaire_submit'] ?>">
								</fieldset>
							</form>
						</div>
					</section>
				</section>
			</section>
		</section>
	</div>
<?php $contenu=ob_get_clean(); ?>