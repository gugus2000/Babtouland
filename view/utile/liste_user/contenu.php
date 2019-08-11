<?php ob_start(); ?>
	<div id="conteneur">
		<section class="ligne">
			<section class="colonne">
				<section class="carte">
					<section class="contenu">
						<table>
							<caption><?= $lang['utile_liste_user_table_caption'] ?></caption>
							<thead>
								<tr>
									<th><?= $lang['utile_liste_user_table_th_nom'] ?></th>
									<th><?= $lang['utile_liste_user_table_th_avatar'] ?></th>
									<th><?= $lang['utile_liste_user_table_th_date_derniere_connexion'] ?></th>
									<th><?= $lang['utile_liste_user_table_th_date_inscription'] ?></th>
									<th><?= $lang['utile_liste_user_table_th_role'] ?></th>
								</tr>
							</thead>
							<tbody>
						<?php
						$BDDFactory=new \core\BDDFactory;
						$UtilisateurManager=new \user\UtilisateurManager($BDDFactory->MysqlConnexion());
						$attributs=array('pseudo' => 'guest');
						$operations=array('pseudo' => '!=');
						$resultats=$UtilisateurManager->getBy($attributs, $operations);
						foreach ($resultats as $index => $resultat)
						{
							$Utilisateur=new \user\Utilisateur(array(
								'id' => $resultat['id'],
							));
							$Utilisateur->recuperer();
							require 'utilisateur.php';
						}
						?>

							</tbody>
						</table>
					</section>
				</section>
			</section>
		</section>
	</div>
<?php $contenu.=ob_get_clean(); ?>