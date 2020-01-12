<?php

/**
 * Affichage des boutons dans boutons-liste
 *
 * @return string
 * @author gugus2000
 **/
function boutonsAfficher($boutons)
{
	$affichage='';
	foreach ($boutons as $Bouton)
	{
		if (is_object($Bouton))
		{
			$affichage.=$Bouton->afficher();
		}
	}
	return $affichage;
}

?>