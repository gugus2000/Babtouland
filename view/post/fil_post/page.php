<?php

$page=$config['post_fil_post_default_page'];
if(isset($_GET['page']))
{
	$page=(int)$_GET['page'];
}

$bbcode=CreateBBcode();

$contenu=$config['default_contenu'];
require 'contenu.php';

$metas=$config['default_metas'];
array_push($metas, array(
	'name'    => 'description',
	'content' => $lang['post_fil_post_description'],
));

$css=$config['default_css'];
array_push($css, 'assets/css/navigation_nombre.css');

$js=$config['default_javascripts'];

ajouterMenuUp($css, $js, $contenu);

$liens=array($config['post_fil_post_lien_publication']);
$icones=array('add');
$descriptions=array($lang['post_fil_post_publication']);
ajouterToast($css, $js, $contenu, $liens, $icones, $descriptions);

$Visiteur->getPage()->set(array(
	'template'    => file_get_contents($config['default_template']),
	'contenu'     => $contenu,
	'titre'       => $lang['post_fil_post_titre'].$page,
	'metas'       => $metas,
	'css'         => $css,
	'javascripts' => $js,
));

?>