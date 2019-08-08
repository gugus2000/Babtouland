<?php

$Post=new \post\Post(array(
	'id' => $id,
));
$Post->recuperer();

?>
<?php ob_start(); ?>
	<div id="conteneur">
		<section class="ligne">
			<section class="colonne">
				<section class="carte">
					<section class="contenu">
						<h1><?= $Post->afficherTitre() ?></h1>
						<i class="date_publication"><?= $Post->afficherDate_publication() ?></i>
						<br />
						<i class="auteur"><?= $lang['post_lecture_auteur_presentation'] ?><a href="<?= $config['post_lecture_lien_auteur'] ?>&id=<?= $Post->recupererAuteur()->afficherId() ?>" title="<?= $lang['post_lecture_lien_auteur_titre'] ?>"><?= $Post->recupererAuteur()->afficherPseudo() ?></a></i>
						<br />
						<br />
						<br />
						<p class="contenu"><?= nl2br($Post->afficherContenu()) ?></p>
						<br />
					</section>
				</section>
				<?php

				$Commentaires=$Post->recupererCommentaires();
				foreach ($Commentaires as $index => $Commentaire)
				{
					require 'commentaire.php';
				}

				?>
				<?php
				$array=recuperationApplicationActionLien($config['post_lecture_publication_commentaire']);
				if($Visiteur->getRole()->existPermission($array['application'], $array['action']))		// L'utilisateur a la permission de publier un commentaire
				{
					?>
				<section class="espace_colonne">
					
				</section>
				<section class=carte>
					<section class="contenu">
						<section class="formulaire">
							<form action="<?= $config['post_lecture_publication_commentaire'] ?>&id=<?= $Post->afficherId() ?>" method="POST" accept-charset="utf-8">
								<fieldset>
									<legend><?= $lang['post_lecture_legend'] ?></legend>
									<label for="commentaire_contenu"><?= $lang['post_lecture_commentaire_contenu'] ?></label>
									<textarea name="commentaire_contenu"></textarea><br />
									<input type="submit" value="<?= $lang['post_lecture_commentaire_submit'] ?>">
								</fieldset>
							</form>
						</section>
					</section>
				</section>
				<?php
				}
				?>
			</section>
		</section>
	</div>
<?php $contenu.=ob_get_clean(); ?>