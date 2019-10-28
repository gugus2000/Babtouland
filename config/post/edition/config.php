<?php

if(!isset($_GET['id']))
{
	$Message=new \user\Message(array(
		'contenu'  =>$lang['post_edition_message_erreur_id'],
		'type'     => \user\Message::TYPE_ERREUR,
		'css'      => $config['message_css'],
		'js'       => $config['message_js'],
		'template' => $config['message_template'],
	));
	$_SESSION['message']=serialize($Message);
	header('location: index.php'.$config['post_edition_lien_erreur_id']);
	exit();
}
$BDDFactory=new \core\BDDFactory;
$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
if(!$PostManager->existId((int)$_GET['id']))
{
	$Message=new \user\Message(array(
		'contenu'  =>$lang['post_edition_message_erreur_existe'],
		'type'     => \user\Message::TYPE_ERREUR,
		'css'      => $config['message_css'],
		'js'       => $config['message_js'],
		'template' => $config['message_template'],
	));
	$_SESSION['message']=serialize($Message);
	header('location: index.php'.$config['post_edition_lien_erreur_existe']);
	exit();
}
$id=$_GET['id'];

$Post=new \post\Post(array(
	'id' => $id,
));
$Post->recuperer();

if(!autorisationModification($Post, $application, $action))
{
	$Message=new \user\Message(array(
		'contenu'  =>$lang['post_edition_message_erreur_autorisation'],
		'type'     => \user\Message::TYPE_ERREUR,
		'css'      => $config['message_css'],
		'js'       => $config['message_js'],
		'template' => $config['message_template'],
	));
	$_SESSION['message']=serialize($Message);
	header('location: index.php'.$config['post_edition_lien_erreur_autorisation'].'&id='.$id);
	exit();
}

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));

$Contenu=new \user\PageElement(array(
	'template' => $config['path_template'].$application.'/'.$action.'/form.html',
	'elements' => array(
		'action'        => $config['post_edition_formulaire_action'].'&id='.$Post->afficherId(),
		'legend'        => $lang['post_edition_formulaire_legend'],
		'label_titre'   => $lang['post_edition_formulaire_titre'],
		'titre'         => $Post->afficherTitre(),
		'label_contenu' => $lang['post_edition_formulaire_contenu'],
		'contenu'       => $Post->afficherContenu(),
		'submit'        => $lang['post_edition_formulaire_submit'],
	),
));

$Formulaire=new \user\page\Formulaire($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'formulaire' => $Formulaire,
	),
));

$Carte=new \user\page\Carte($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getpageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Carte, '');

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);

?>