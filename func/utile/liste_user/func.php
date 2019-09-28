<?php

/**
 * Permet l'affichage des différentes lignes ud tableau affichant les memebres du site
 *
 * @param array lignes Liste des lignes du tableau
 *
 * @return string
 * @author gugus2000
 **/
function contenuAfficher($lignes)
{
	$affichage='';
	foreach ($lignes as $ligne)
	{
		$affichage.=$ligne->afficher();
	}
	return $affichage;
}

?>