				<section class="carte">
					<section class="contenu">
						<h1><?= $Post->afficherTitre() ?></h1>
						<i class="date_publication"><?= $Post->afficherDate_publication() ?></i>
						<br />
						<i class="auteur"><?= $lang['post_fil_post_auteur_presentation'] ?><a href="<?= $config['post_fil_post_lien_auteur'] ?>&id=<?= $Post->recupererAuteur()->afficherId() ?>" title="<?= $lang['post_fil_post_lien_auteur_titre'] ?>"><?= $Post->recupererAuteur()->afficherPseudo() ?></a></i>
						<br />
						<br />
						<br />
						<p class="contenu"><?= nl2br($Post->afficherContenu()) ?></p>
						<br />
						<br />
						<a href="<?= $config['post_fil_post_lien_detail'] ?>&id=<?= $Post->afficherId() ?>" title="<?= $lang['post_fil_post_lien_detail_titre'] ?>"><?= $lang['post_fil_post_detail'] ?></a>
					</section>
				</section>
				<section class="espace_colonne">
					
				</section>