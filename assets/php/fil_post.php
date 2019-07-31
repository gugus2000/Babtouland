<?php ob_start(); ?>
						<h1><?= $Post->afficherTitre() ?></h1>
						<li class="date_publication"><?= $Post->afficherDate_publication() ?></li>
						<br />
						<i class="auteur">Par <a href="<?= $config['post_filPost_lien_auteur'] ?>?id=<?= $Post->recupererAuteur()->afficherId() ?>" title="title_auteur"><?= $Post->recupererAuteur()->afficherPseudo() ?></a></i>
						<br />
						<br />
						<br />
						<p class="contenu"><?= $Post->afficherContenu() ?></p>
						<br />
						<br />
						<a href="<?= $config['post_filPost_lien_detail'] ?>?id=<?= $Post->afficherId() ?>" title="title_plus"><?= $lang['post_filPost_detail'] ?></a>
<?php $Contenu=ob_get_clean(); // $Contenu et pas $contenu ?>