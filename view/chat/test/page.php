<?php

$contenu='';
require 'contenu.php';

$metas=$config['default_metas'];

$css=array();

$js=array();

$titre='Chat test';

$Visiteur->getPage()->set(array(
	'template'    => file_get_contents($config['default_template']),
	'contenu'     => $contenu,
	'titre'       => $titre,
	'metas'       => $metas,
	'css'         => $css,
	'javascripts' => $js,
));

?>