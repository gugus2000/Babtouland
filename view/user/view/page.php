<?php

$id=$Visiteur->getId();
if(isset($_GET['id']))
{
	$id=$_GET['id'];
}

$contenu=$config['default_contenu'];

require 'contenu.php';

$metas=$config['default_metas'];
array_push($metas, array(
	'name'    => 'description',
	'content' => $lang['user_view_description'],
));

$css=$config['default_css'];

$js=$config['default_javascripts'];

$titre=$lang['user_view_titre'];

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