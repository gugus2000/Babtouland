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

$titre=$lang[$application.'_'.$action.'_titre'];
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang[$application.'_'.$action.'_description'],
);

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

require $config['pageElement_formulaire_req'];

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'formulaire' => $Formulaire,
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

$config['pageElement_elements']['tete']=$Tete;
$config['pageElement_elements']['corps']=$Corps;

?>