<?php ob_start(); ?>
	<div id="conteneur">
		<section class="ligne">
			<section class="colonne">
				<section class="carte">
					<section class="contenu">
						<?= $lang['user_statut_nologin'] ?><br />
						<a href="<?= $config['user_statut_lien-connexion'] ?>" title="<?= $lang['user_statut_titre-lien-connexion'] ?>"><?= $lang['user_statut_affichage-lien-connexion'] ?></a><br />
						<a href="<?= $config['user_statut_lien-inscription'] ?>" title="<?= $lang['user_statut_titre-lien-inscription'] ?>"><?= $lang['user_statut_affichage-lien-inscription'] ?></a>
					</section>
				</section>
			</section>
		</section>
	</div>
<?php $contenu.=ob_get_clean(); ?>