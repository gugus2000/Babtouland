<?php

/**
 * Permet l'affichage des composants d'un select dans le formulaire de admin\publier_notification
 *
 * @param array options Options à afficher
 *
 * @return string
 * @author gugus2000
 **/
function options_groupeAfficher($options)
{
	$affichage='';
	foreach ($options as $option)
	{
		$affichage.=$option->afficher();
	}
	return $affichage;
}

?>