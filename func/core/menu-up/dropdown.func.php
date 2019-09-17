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
	global $lang, $config;
	$affichage='';
	foreach ($lang_others as $language)
	{
		$link='&lang=';
		if(!$_GET & !$_SERVER['REQUEST_URI'][strlen($_SERVER['REQUEST_URI'])-1]=='?')
		{
			$link='?lang=';
		}
		$affichage.='<a href="'.$_SERVER['REQUEST_URI'].$link. $language['abbr'].'">'.$language['full'].'</a>';
	}
	return $affichage;
}

?>