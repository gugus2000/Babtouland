<?php

$Utilisateur=new \user\Utilisateur(array(
	'id' => $id,
));
$Utilisateur->recuperer();

?>
<?php ob_start(); ?>
	<div id="conteneur">
		<section class="ligne">
			<section class="colonne">
				<section class="carte">
					<section class="contenu">
						<?= $lang['user_view_pseudo'] ?><?= $Utilisateur->afficherPseudo() ?><br />
						<?= $lang['user_view_avatar'] ?><img src="<?= $config['chemin_avatar'] ?><?= $Utilisateur->afficherAvatar() ?>" alt="<?= $lang['user_view_avatar_alt'] ?><?= $Utilisateur->afficherPseudo() ?>"><br />
						<?= $lang['user_view_derndateco'] ?><?= $Utilisateur->afficherDate_connexion() ?><br />
						<?= $lang['user_view_premdatein'] ?><?= $Utilisateur->afficherDate_inscription() ?><br />
					</section>
				</section>
			</section>
		</section>
	</div>
<?php $contenu.=ob_get_clean(); ?>