<?php

/**
 * Affichage de la liste des strings composants la navigation pour le fil des posts
 *
 * @param array liste_navigation Liste des strings de la navigation
 *
 * @return string
 * @author gugus2000
 **/
function liste_navigationAfficher($liste_navigation)
{
	$affichage='';
	foreach ($liste_navigation as $element)
	{
		$affichage.=$element;
	}
	return $affichage;
}

/**
 * Affichage de la liste des pageElements représentant des posts
 *
 * @param array liste_post Liste des posts à insérer
 *
 * @return string
 * @author gugus2000
 **/
function liste_postAfficher($liste_post)
{
	$affichage='';
	foreach ($liste_post as $post)
	{
		$affichage.=$post->afficher();
	}
	return $affichage;
}

?>