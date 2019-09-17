<?php

$template=file_get_contents($config['default_template']);

$contenu=$config['default_contenu'];
require 'contenu.php';

$metas=$config['default_metas'];
$metas[]=array(
	'name'    => 'description',
	'content' => $lang['chat_hub_description'],
);

$css=$config['default_css'];

$js=$config['default_javascripts'];

$titre=$lang['chat_hub_titre'];

$Visiteur->getPage()->set(array(
	'titre'       => $titre,
	'metas'       => $metas,
	'css'         => $css,
	'javascripts' => $js,
	'contenu'     => $contenu,
	'template'    => $template,
));

$Visiteur->getPage()->ajouterMenuUp($Visiteur);

$Visiteur->getPage()->ajouterMenuSide($Visiteur);

?>