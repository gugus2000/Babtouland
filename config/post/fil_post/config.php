<?php

require $config['bbcode_config'];

$config['css'][]=$config['path_assets'].'css/navigation_nombre.css';

$page=$config['post_fil_post_default_page'];
if(isset($_GET['page']))
{
	$page=(int)$_GET['page'];
}

$titre=$lang[$application.'_'.$action.'_titre'].$page;
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang[$application.'_'.$action.'_description'],
);

$bbcode=CreateBBcode();

$BDDFactory=new \core\BDDFactory;
$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
$nbr_post=$PostManager->count();

ob_start();?>
<nav class="navigation_nombre">
	<ul>
		<?php
			for ($numero_page=1; $numero_page <= $nbr_post/$config['post_fil_post_nombre_posts']; $numero_page++)
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
<?php
$Pagination=ob_get_clean();

ob_start();?>
<?php
	for ($position_post=$config['post_fil_post_position_debut']; $position_post < $config['post_fil_post_nombre_posts']; $position_post++)
	{
		$position_vraie=$page*$config['post_fil_post_nombre_posts']-($config['post_fil_post_nombre_posts']-$position_post);	// Calcul de la position du Post
		$Post=new \post\Post(array(
			'id' => $PostManager->getIdByPos($position_vraie, $config['post_fil_post_tri']),
		));
		if($PostManager->existId($Post->getId()))
		{
			$Post->recuperer();
			?>
			<section class="carte">
				<section class="contenu">
					<h1><?= $Post->afficherTitre() ?></h1>
					<i class="date_publication"><?= $Post->afficherDate_publication() ?></i>
					<br />
					<i class="auteur"><?= $lang['post_fil_post_auteur_presentation'] ?><a href="<?= $config['post_fil_post_lien_auteur'] ?>&id=<?= $Post->recupererAuteur()->afficherId() ?>" title="<?= $lang['post_fil_post_lien_auteur_titre'] ?>"><?= $Post->recupererAuteur()->afficherPseudo() ?></a></i>
					<br />
					<br />
					<br />
					<div class="contenu"><?= $bbcode->parse($Post->afficherContenu()) ?></div>
					<br />
					<br />
					<a href="<?= $config['post_fil_post_lien_detail'] ?>&id=<?= $Post->afficherId() ?>" title="<?= $lang['post_fil_post_lien_detail_titre'] ?>"><?= $lang['post_fil_post_detail'] ?></a>
				</section>
			</section>
			<section class="espace_colonne">
				
			</section>
			<?php
		}
	}
?>
<?php
$contenu=ob_get_clean();

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'liste_post' => $contenu,
		'pagination' => $Pagination,
	),
));

$toast_liens=array(
	'lien'        => array($config['post_fil_post_lien_publication']),
	'description' => array($lang['post_fil_post_publication']),
	'icone'       => array('add'),
);

require $config['pageElement_toast_req'];

require $config['pageElement_menuUp_req'];

$Corps=new \user\PageElement(array(
	'template'  => $config['pageElement_corps_template'],
	'fonctions' => $config['pageElement_corps_fonctions'],
	'elements'  => array(
		'haut'   => $MenuUp,
		'centre' => $Contenu,
		'bas'    => $Toast,
	),
));

$Tete=new \user\PageElement(array(
	'template'  => $config['pageElement_tete_template'],
	'fonctions' => $config['pageElement_tete_fonctions'],
	'elements'  => array(
		'metas'       => $config['metas'],
		'titre'       => $titre,
		'css'         => $config['css'],
		'javascripts' => $config['javascripts'],
	),
));

$config['pageElement_elements']['tete']=$Tete;
$config['pageElement_elements']['corps']=$Corps;

?>