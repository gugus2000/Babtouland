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

ajouterMenuUp($css, $js, $contenu);

$Visiteur->getPage()->set(array(
	'template'    => file_get_contents($config['default_template']),
	'contenu'     => $contenu,
	'titre'       => $lang['user_view_titre'],
	'metas'       => $metas,
	'css'         => $css,
	'javascripts' => $js,
));

?>