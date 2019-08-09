<?php ob_start(); ?>
	<div id="conteneur">
		<section class="ligne">
			<section class="colonne">
				<section class="carte">
					<section class="contenu">
						<?= $lang['user_statut_pseudo'] ?><?= $Visiteur->afficherPseudo() ?><br />
						<?= $lang['user_statut_avatar'] ?><img src="<?= $config['chemin_avatar'] ?><?= $Visiteur->afficherAvatar() ?>" alt="<?= $lang['user_view_avatar_alt'] ?><?= $Visiteur->afficherPseudo() ?>"><br />
						<?= $lang['user_statut_derndateco'] ?><?= $Visiteur->afficherDate_connexion() ?><br />
						<?= $lang['user_statut_premdatein'] ?><?= $Visiteur->afficherDate_inscription() ?><br />
						<?= $lang['user_statut_mail'] ?><?= $Visiteur->afficherMail() ?><br />
						<a href="<?= $config['user_statut_lien_edition'] ?>" title="<?= $lang['user_statut_titre_lien_edition'] ?>"><?= $lang['user_statut_affichage_lien_edition'] ?></a><br />
						<a href="<?= $config['user_statut_lien_deconnexion'] ?>" title="<?= $lang['user_statut_titre_lien_deconnexion'] ?>"><?= $lang['user_statut_affichage_lien_deconnexion'] ?></a><br />
						<a href="<?= $_SERVER['REQUEST_URI'].'&lang='.$lang['inv_lang'] ?>" title="<?= $lang['user_statut_titre_lien_langage'] ?>"><?= $lang['user_statut_affichage_lien_langage'] ?></a>
					</section>
				</section>
			</section>
		</section>
	</div>
<?php $contenu.=ob_get_clean(); ?>