<?php

$admin=False;
$Utilisateur=$Visiteur;
if(isset($_GET['id']) & $Visiteur->getRole()->existPermission($config['user_edition_admin_application'], $config['user_edition_admin_action']))
{
	$admin=True;
	$Utilisateur=new \user\Utilisateur(array(
		'id' => $_GET['id'],
	));
	$Utilisateur->recuperer();
	$config['user_edition_action']=$config['user_edition_action'].'&id='.$_GET['id'];
}

$contenu=$config['default_contenu'];
require 'contenu.php';

$metas=$config['default_metas'];
array_push($metas, array(
	'name'    => 'description',
	'content' => $lang['user_edition_description'],
));

$css=$config['default_css'];
array_push($css, 'assets/css/formulaire.css');

$js=$config['default_javascripts'];

ajouterMenuUp($css, $js, $contenu);

$Visiteur->getPage()->set(array(
	'template'    => file_get_contents($config['default_template']),
	'contenu'     => $contenu,
	'titre'       => $lang['user_edition_titre'],
	'metas'       => $metas,
	'css'         => $css,
	'javascripts' => $js,
));

?>