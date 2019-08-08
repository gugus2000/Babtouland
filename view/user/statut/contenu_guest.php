<?php ob_start(); ?>
	<div id="conteneur">
		<section class="ligne">
			<section class="colonne">
				<section class="carte">
					<section class="contenu">
						<?= $lang['user_statut_nologin'] ?><br />
						<a href="<?= $config['user_statut_lien_connexion'] ?>" title="<?= $lang['user_statut_titre_lien_connexion'] ?>"><?= $lang['user_statut_affichage_lien_connexion'] ?></a><br />
						<a href="<?= $config['user_statut_lien_inscription'] ?>" title="<?= $lang['user_statut_titre_lien_inscription'] ?>"><?= $lang['user_statut_affichage_lien_inscription'] ?></a>
					</section>
				</section>
			</section>
		</section>
	</div>
<?php $contenu.=ob_get_clean(); ?>