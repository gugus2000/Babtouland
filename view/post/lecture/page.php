<?php

$BDDFactory=new \core\BDDFactory;
$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
$id=$PostManager->getIdByPos(0, 'date_mise_a_jour');
if(isset($_GET['id']))
{
	$id=(int)$_GET['id'];
}

$bbcode=CreateBBcode();

$contenu=$config['default_contenu'];
require 'contenu.php';

$metas=$config['default_metas'];
array_push($metas, array(
	'name'    => 'description',
	'content' => $lang['post_lecture_description'],
));

$css=$config['default_css'];
array_push($css, 'assets/css/formulaire.css');
array_push($css, 'assets/css/post.css');
if(isset($Commentaire))
{
	array_push($css, 'assets/css/commentaire.css');
}

$js=$config['default_javascripts'];

ajouterMenuUp($css, $js, $contenu);

$liens=array($config['post_lecture_lien_mise_a_jour'].'&id='.$id, $config['post_lecture_lien_suppression'].'&id='.$id);
$icones=array('edit', 'delete');
$descriptions=array($lang['post_lecture_lien_mise_a_jour'], $lang['post_lecture_lien_suppression']);
ajouterToast($css, $js, $contenu, $liens, $icones, $descriptions);

$Visiteur->getPage()->set(array(
	'template'    => file_get_contents($config['default_template']),
	'contenu'     => $contenu,
	'titre'       => $lang['post_lecture_titre'].$Post->afficherTitre(),
	'metas'       => $metas,
	'css'         => $css,
	'javascripts' => $js,
));

?>