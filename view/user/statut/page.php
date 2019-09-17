<?php

if($Visiteur->getPseudo()==$config['nom_guest'])
{
	require 'contenu_guest.php';
}
else
{
	require 'contenu.php';
}

$PageElement=new \user\PageElement(array(
	'template' => $config['defaut_template'],
	'config'   => $config['defaut_config_path'].$Page->getApplication().'/'.$Page->getAction().'/config.php',
));

$metas=$config['default_metas'];
array_push($metas, array(
	'name'    => 'description',
	'content' => $lang['user_connexion_description'],
));

$css=$config['default_css'];

$js=$config['default_javascripts'];

$titre=$lang['user_statut_titre'];

$Visiteur->getPage()->set(array(
	'template'    => file_get_contents($config['default_template']),
	'contenu'     => $contenu,
	'titre'       => $titre,
	'metas'       => $metas,
	'css'         => $css,
	'javascripts' => $js,
));

$Visiteur->getPage()->ajouterMenuUp($Visiteur);

?>