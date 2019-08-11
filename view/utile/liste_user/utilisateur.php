<?php
$classe='';
if ($index%2==1)
{
	$classe=' class="impair"';
}
?>
								<tr<?= $classe ?>>
									<td><?= $Utilisateur->afficherPseudo() ?></td>
									<td><img src="<?= $config['chemin_avatar'] ?><?= $Utilisateur->afficherAvatar() ?>" alt="<?= $lang['utile_liste_user_table_td_avatar_alt'] ?><?= $Utilisateur->afficherPseudo() ?>"></td>
									<td><?= $Utilisateur->afficherDate_connexion() ?></td>
									<td><?= $Utilisateur->afficherDate_inscription() ?></td>
									<td><?= $Utilisateur->afficherRole() ?></td>
								</tr>