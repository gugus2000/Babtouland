<?php

/**
 * Affichage de la liste des langues pour le dropdown
 * 
 * @param array options_lang Liste des langues
 *
 * @return string
 * @author gugus2000
 **/
function options_langAfficher($options_lang)
{
	$affichage='';
	foreach ($options_lang as $option_lang)
	{
		$affichage.=$option_lang->afficher();
	}
	return $affichage;
}

?>