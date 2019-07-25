<?php

require 'contenu.php';

$metas=$config['default_metas'];
array_push($metas, array(
	'name'    => 'description',
	'content' => 'Page d\'inscription',
));

$css=$config['default_css'];
array_push($css, 'assets/css/formulaire.css');

$Visiteur->getPage()->set(array(
	'template'    => file_get_contents($config['default_template']),
	'contenu'     => $contenu,
	'titre'       => $lang['user_inscription_titre'],
	'metas'       => $metas,
	'css'         => $css,
	'javascripts' => $config['default_javascripts'],
));

?>