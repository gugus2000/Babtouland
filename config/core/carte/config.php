<?php

$Carte=new \user\PageElement(array(
	'template'  => $config['path_template'].'core/carte/carte.html',
	'fonctions' => $config['path_func'].'core/carte/carte.func.php',
	'elements'  => array(
		'contenu' => $Contenu,
	),
));

?>