<?php

$config['css'][]=$config['path_assets'].'css/formulaire.css';

$Formulaire=new \user\PageElement(array(
	'template' => $config['path_template'].'core/formulaire/formulaire.html',
	'fonctions' => $config['path_func'].'core/formulaire/formulaire.func.php',
	'elements' => array(
		'contenu' => $Contenu,
	),
));

?>