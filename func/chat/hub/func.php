<?php

/**
 * Permet l'affichage des cartes dans le hub du chat
 *
 * @param array cartes Tableaux de PageElements à insérer
 *
 * @return string
 * @author gugus2000
 **/
function cartesAfficher($cartes)
{
	global $config, $Visiteur;
	$affichage='';
	foreach ($cartes as $carte)
	{
		$affichage.=$carte->afficher();
		$affichage.=file_get_contents($config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/espace_carte.html');
	}
	return $affichage;
}

?>