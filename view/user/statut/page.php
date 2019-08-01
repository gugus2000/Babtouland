<?php

$contenu=$config['default_contenu'];
if($Visiteur->getPseudo()==$config['nom_guest'])
{
	require 'contenu_guest.php';
}
else
{
	require 'contenu.php';
}

$metas=$config['default_metas'];
array_push($metas, array(
	'name'    => 'description',
	'content' => $lang['user_connexion_description'],
));

$css=$config['default_css'];

$js=$config['default_javascripts'];

ajouterMenuUp($css, $js, $contenu);

$Visiteur->getPage()->set(array(
	'template'    => file_get_contents($config['default_template']),
	'contenu'     => $contenu,
	'titre'       => $lang['user_statut_titre'],
	'metas'       => $metas,
	'css'         => $css,
	'javascripts' => $js,
));

?>