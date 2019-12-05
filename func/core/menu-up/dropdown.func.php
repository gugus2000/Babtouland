<?php

/**
 * Mets en forme les liens pour changer de langue dans la template
 *
 * @param array lang_others Liste des autres langues
 *
 * 
 * @return string
 * @author gugus2000
 **/
function dropdown_othersAfficher($lang_others)
{
	global $lang, $config, $Visiteur, $Routeur;
	$affichage='';
	foreach ($lang_others as $language)
	{
		$link=$Routeur->creerLien(array('application' => $Visiteur->getPage()->getApplication(), 'action' => $Visiteur->getPage()->getAction(), 'parametres' => array('lang' => $language['abbr'])));
		$affichage.='<a href="'.$link.'">'.$language['full'].'</a>';
	}
	return $affichage;
}

?>