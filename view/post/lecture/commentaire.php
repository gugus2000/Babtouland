					<?php
					$Auteur=$Commentaire->recupererAuteur();
					?>
					<section class="espace_colonne">
						
					</section>
					<section class="carte">
						<?php
						if($Visiteur->getPseudo()==$Commentaire->recupererAuteur()->getPseudo() | $Visiteur->getRole()->existPermission($config['post_commentaireSuppression_admin_application'], $config['post_commentaireSuppression_admin_action']))
						{
							?>
							<a class='suppression' href="<?= $config['post_lecture_lien_commentaire_suppression'] ?>&id=<?= $Commentaire->afficherId() ?>" title="<?= $lang['post_lecture_lien_commentaire_suppression_titre'] ?>"><i class="material-icons petit-ecran-menu">close</i></a>
							<?php
						}
						?>
						<section class="contenu commentaire">
							<section class="ligne">
								<div class="colonne cote_gauche">
									<i class="date_publication"><?= $Commentaire->afficherDate_publication() ?></i>
									<a href="<?= $config['post_lecture_lien_auteur'] ?>&id=<?= $Auteur->afficherId() ?>" title="<?= $lang['post_lecture_commentaire_lien_avatar_titre'] ?><?= $Auteur->afficherPseudo() ?>"><img src="<?= $config['chemin_avatar'] ?><?= $Auteur->afficherAvatar() ?>" alt="<?= $lang['post_lecture_commentaire_avatar_description'] ?><?= $Auteur->afficherPseudo() ?>"></a>	
								</div>
								<div class="colonne cote_droit">
									<p><?= nl2br($Commentaire->afficherContenu()) ?></p>
								</div>
							</section>
						</section>
					</section>