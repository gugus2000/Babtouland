<?php ob_start(); ?>
	<div id="conteneur">
		<section class="ligne">
			<section class="ligne">
				<section class="carte">
					<section class="contenu">
						<div class="formulaire">
							<form action="<?= $config['post_publication_action'] ?>" method="POST" accept-charset="utf-8">
								<fieldset>
									<legend><?= $lang['post_publication_legend'] ?></legend>
									<label for="publication_titre"><?= $lang['post_publication_titreForm'] ?></label>
									<input type="text" name="publication_titre"><br />
									<label for="publication_contenu"><?= $lang['post_publication_contenu'] ?></label>
									<textarea name="publication_contenu"></textarea><br />
									<input type="submit" value="<?= $lang['post_publication_submit'] ?>">
								</fieldset>
							</form>
						</div>
					</section>
				</section>
			</section>
		</section>
	</div>
<?php $contenu=ob_get_clean(); ?>