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

$Corps=new \user\page\Corps('', implode('|', $ids), '');
$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$this->getPage()->envoyerNotificationsSession();

?>