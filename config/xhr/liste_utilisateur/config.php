<?php

$UtilisateurManager=new \user\UtilisateurManager(\core\BDDFactory::MysqlConnexion());
$resultats=$UtilisateurManager->getBy(array(
	'pseudo' => $config['nom_guest'],
), array(
	'pseudo' => '!=',
));
$ids=array();
foreach ($resultats as $resultat)
{
	$ids[]=$resultat['pseudo'];
}

$ids=implode('|', $ids);
$Contenu=new \user\PageElement(array(
	'elements' => array(
		'contenu' => $ids,
	),
));
$Visiteur->getPage()->creerPage($Contenu);

?>