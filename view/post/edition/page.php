<?php

if(!isset($_GET['id']))
{
	$_SESSION['message']=$lang['post_edition_message_erreur_id'];
	header('location: index.php'.$config['post_edition_lien_erreur_id']);
	exit();
}
$BDDFactory=new \core\BDDFactory;
$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
if(!$PostManager->existId((int)$_GET['id']))
{
	$_SESSION['message']=$lang['post_edition_message_erreur_existe'];
	header('location: index.php'.$config['post_edition_lien_erreur_existe']);
	exit();
}
$id=$_GET['id'];

$contenu=$config['default_contenu'];
require 'contenu.php';

if(!autorisationModification($Post, $Visiteur->getPage()->getApplication(), $Visiteur->getPage()->getAction()))
{
	$_SESSION['message']=$lang['post_edition_message_erreur_autorisation'];
	header('location: index.php'.$config['post_edition_lien_erreur_autorisation'].'&id='.$id);
	exit();
}

$metas=$config['default_metas'];
array_push($metas, array(
	'name'    => 'description',
	'content' => $lang['post_edition_description'],
));

$css=$config['default_css'];
array_push($css, 'assets/css/formulaire.css');

$js=$config['default_javascripts'];

ajouterMenuUp($css, $js, $contenu);

$Visiteur->getPage()->set(array(
	'template'    => file_get_contents($config['default_template']),
	'contenu'     => $contenu,
	'titre'       => $lang['post_edition_titre'],
	'metas'       => $metas,
	'css'         => $css,
	'javascripts' => $js,
));

?>