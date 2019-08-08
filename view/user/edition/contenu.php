<?php

$checked='';
if($Utilisateur->getBanni())
{
	$checked=' checked=""';
}

?>
<?php ob_start(); ?>
	<div id="conteneur">
		<section class="ligne">
			<section class="ligne">
				<section class="carte">
					<section class="contenu">
						<div class="formulaire">
							<form action="<?= $config['user_edition_action'] ?>" method="POST" accept-charset="utf-8">
								<fieldset>
									<legend><?= $lang['user_edition_legend'] ?><?= $Utilisateur->afficherPseudo() ?></legend>
									<label for="edition_avatar"><?= $lang['user_edition_label_avatar'] ?></label>
									<input type="file" name="edition_avatar" value="<?= $Utilisateur->afficherAvatar() ?>"><br />
									<?php
									if($admin)
									{
										?>
									<label for="edition_banni"><?= $lang['user_edition_label_banni'] ?></label>
									<input type="checkbox" name="edition_banni" value="oui"<?= $checked ?>><br />
										<?php
									}
									?>
									<input type="submit" value="<?= $lang['user_edition_submit'] ?>">
								</fieldset>
							</form>
						</div>
					</section>
				</section>
			</section>
		</section>
	</div>
<?php $contenu=ob_get_clean(); ?>