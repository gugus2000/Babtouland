				<section class="carte">
					<section class="contenu">
						<h1><?= $Post->afficherTitre() ?></h1>
						<i class="date_publication"><?= $Post->afficherDate_publication() ?></i>
						<br />
						<i class="auteur">Par <a href="<?= $config['post_filPost_lien_auteur'] ?>&id=<?= $Post->recupererAuteur()->afficherId() ?>" title="title_auteur"><?= $Post->recupererAuteur()->afficherPseudo() ?></a></i>
						<br />
						<br />
						<br />
						<p class="contenu"><?= nl2br($Post->afficherContenu()) ?></p>
						<br />
						<br />
						<a href="<?= $config['post_filPost_lien_detail'] ?>&id=<?= $Post->afficherId() ?>" title="title_plus"><?= $lang['post_filPost_detail'] ?></a>
					</section>
				</section>
				<section class="espace_colonne">
					
				</section>