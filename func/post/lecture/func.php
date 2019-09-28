<?php

/**
 * Affichage de la liste des PageElements représentant les commentaires
 *
 * @param array commentaires Liste des commentaires à insérer
 *
 * @return string
 * @author gugus2000
 **/
function commentairesAfficher($commentaires)
{
	$affichage='';
	foreach ($commentaires as $commentaire)
	{
		$affichage.=$commentaire->afficher();
	}
	return $affichage;
}

?>