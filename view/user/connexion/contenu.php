<?php ob_start(); ?>
	<div id="conteneur">
		<section class="ligne">
			<section class="colonne">
				<section class="carte">
					<section class="contenu">
						<div class="formulaire">
							<form action="?application=user&action=validation_connexion" method="POST" accept-charset="utf-8">
								<fieldset>
									<legend><?= $lang['user_connexion_fieldset'] ?></legend>
									<label for="connexion_pseudo"><?= $lang['user_formulairepseudo'] ?></label>
									<input type="text" name="connexion_pseudo"><br />
									<label for="connexion_mdp"><?= $lang['user_formulairemdp'] ?></label>
									<input type="password" name="connexion_mdp"><br />
									<input type="submit" value="<?= $lang['user_connexion_submit'] ?>">
								</fieldset>
							</form>
						</div>
					</section>
				</section>
			</section>
		</section>
	</div>
<?php $contenu=ob_get_clean(); ?>