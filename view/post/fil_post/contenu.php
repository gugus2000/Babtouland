<?php ob_start(); ?>
	<div id=conteneur>
		<section class="ligne">
			<section class="colonne">
				<?php
					$BDDFactory=new \core\BDDFactory;
					$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
					$nbr_post=$PostManager->count();
					for ($position_post=$config['default_post_filPost_position_debut']; $position_post < $config['default_post_filPost_nombre_posts']; $position_post++)
					{
						$position_vraie=$page*$config['default_post_filPost_nombre_posts']-($config['default_post_filPost_nombre_posts']-$position_post);	// Calcul de la position du Post
						$Post=new \post\Post(array(
							'id' => $PostManager->getIdByPos($position_vraie, 'date_mise_a_jour'),
						));
						if($PostManager->existId($Post->getId()))
						{
							$Post->recuperer();
							require 'post.php';
						}
					}
				?>
			</section>
		</section>
	</div>
	<nav class="navigation_nombre">
		<ul>
			<?php
				for ($numero_page=1; $numero_page <= $nbr_post/$config['default_post_filPost_nombre_posts']; $numero_page++)
				{ 
					if ($numero_page==$page)
					{
						?>
							<span class="active"><li><?= $page ?></li></span>
						<?php
					}
					else
					{
					?>
						<a href="?application=<?= $Visiteur->getPage()->afficherApplication() ?>&action=<?= $Visiteur->getPage()->afficherAction() ?>&page=<?= $numero_page ?>" title="<?= $lang['post_filPost_nav_description'] ?><?= $numero_page ?>"><li><?= $numero_page ?></li></a>
					<?php
					}
				}
			?>
		</ul>
	</nav>
<?php $contenu.=ob_get_clean(); ?>