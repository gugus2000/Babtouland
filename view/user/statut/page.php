<?php

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
	'content' => 'Statut du visiteur',
));

$Visiteur->getPage()->set(array(
	'template' => file_get_contents($config['default_template']),
	'contenu'  => $contenu,
	'titre'    => $lang['user_statut_titre'],
	'metas'    => $metas,
	'css'      => $config['default_css'],
));

?>