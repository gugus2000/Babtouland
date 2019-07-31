<?php

$page=$config['post_filPost_default_page'];
if(isset($_GET['page']))
{
	$page=(int)$_GET['page'];
}

$contenu=$config['default_contenu'];
require 'contenu.php';

$metas=$config['default_metas'];
array_push($metas, array(
	'name'    => 'description',
	'content' => 'Page d\'affichage des posts',
));

$css=$config['default_css'];
array_push($css, 'assets/css/navigation_nombre.css');

$js=$config['default_javascripts'];

ajouterMenuUp($css, $js, $contenu);

$Visiteur->getPage()->set(array(
	'template'    => file_get_contents($config['default_template']),
	'contenu'     => $contenu,
	'titre'       => $lang['post_filPost_titre'],
	'metas'       => $metas,
	'css'         => $css,
	'javascripts' => $js,
));

?>