<?php

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));

$id=$Visiteur->getId();
if(isset($_GET['id']))
{
	$id=$_GET['id'];
}
$Utilisateur=new \user\Utilisateur(array(
	'id' => $id,
));
$Utilisateur->recuperer();

$contenu=new \user\PageElement(array(
	'template' => $config['path_template'].$application.'/'.$action.'/contenu.html',
	'elements' => array(
		'pseudo' => $lang['user_view_pseudo'].$Utilisateur->afficherPseudo(),
		'avatar_texte' => $lang['user_view_avatar'],
		'avatar_src' => $config['chemin_avatar'].$Utilisateur->afficherAvatar(),
		'avatar_alt' => $lang['user_view_avatar_alt'].$Utilisateur->afficherPseudo(),
		'date_connexion' => $lang['user_view_derndateco'].$Utilisateur->afficherDate_connexion(),
		'date_inscription' => $lang['user_view_premdatein'].$Utilisateur->afficherDate_inscription(),
	),
));

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'contenu' => $contenu,
	),
));

$Carte=new \user\page\Carte($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Carte, '');

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);

?>