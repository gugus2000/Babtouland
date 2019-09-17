<?php

$titre=$lang['user_view_titre'];
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang['user_view_description'],
);

$id=$Visiteur->getId();
if(isset($_GET['id']))
{
	$id=$_GET['id'];
}
$Utilisateur=new \user\Utilisateur(array(
	'id' => $id,
));
$Utilisateur->recuperer();

ob_start();?>
<?= $lang['user_view_pseudo'] ?><?= $Utilisateur->afficherPseudo() ?><br />
<?= $lang['user_view_avatar'] ?><img src="<?= $config['chemin_avatar'] ?><?= $Utilisateur->afficherAvatar() ?>" alt="<?= $lang['user_view_avatar_alt'] ?><?= $Utilisateur->afficherPseudo() ?>"><br />
<?= $lang['user_view_derndateco'] ?><?= $Utilisateur->afficherDate_connexion() ?><br />
<?= $lang['user_view_premdatein'] ?><?= $Utilisateur->afficherDate_inscription() ?><br />
<?php
$contenu=ob_get_clean();

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'contenu' => $contenu,
	),
));

require $config['pageElement_carte_req'];

require $config['pageElement_menuUp_req'];

$Corps=new \user\PageElement(array(
	'template'  => $config['pageElement_corps_template'],
	'fonctions' => $config['pageElement_corps_fonctions'],
	'elements'  => array(
		'haut'   => $MenuUp,
		'centre' => $Carte,
		'bas'    => '',
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

$config['pageElement_elements']=array(
	'tete'  => $Tete,
	'corps' => $Corps,
);

?>