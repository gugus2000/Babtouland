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

$titre=$lang['post_fil_post_titre'].$page;

$Visiteur->getPage()->set(array(
	'template'    => file_get_contents($config['default_template']),
	'contenu'     => $contenu,
	'titre'       => $titre,
	'metas'       => $metas,
	'css'         => $css,
	'javascripts' => $js,
));

$Visiteur->getPage()->ajouterMenuUp($Visiteur);

$liens=array($config['post_fil_post_lien_publication']);
$icones=array('add');
$descriptions=array($lang['post_fil_post_publication']);
$Visiteur->getPage()->ajouterToast($Visiteur, $liens, $icones, $descriptions);

?>