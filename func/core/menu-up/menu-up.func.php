<?php

/**
 * Permet de mettre en forme menu-up (version petit écran et garnd écran)
 *
 * @param array liens Liens à afficher
 * 
 * @param array titres Titre des liens à afficher
 * 
 * @pram array items Icones pour les liens sur petit écran et Affichage pour les liens sur grand écran
 * 
 * @param string type_ecran Type de l'écran
 * 
 * @return string
 * @author gugus2000
 **/
function afficherLiens($liens, $titres, $items, $type_ecran)
{
	global $Visiteur;
	$affichage='';
	if($type_ecran=='grand-ecran')		// Menu grand écran
	{
		foreach ($liens as $index => $lien)
		{
			$page=recuperationApplicationActionLien($lien);
			if ($Visiteur->getRole()->existPermission($page['application'], $page['action']))
			{
				$affichage.='<div class="element ligne">
								<div class="colonne">
									<a href="'.$lien.'" title="'.$titres[$index].'">'.$items[$index].'</a>
								</div>
							</div>';
			}
		}
	}
	else
	{
		foreach ($liens as $index => $lien)
		{
			$page=recuperationApplicationActionLien($lien);
			if ($Visiteur->getRole()->existPermission($page['application'], $page['action']))
			{
				$affichage.='<a href="'.$lien.'" title="'.$titres[$index].'" class="lien-item"><i class="material-icons">'.$items[$index].'</i></a>';
			}
		}
	}
	return $affichage;
}

/**
 * Fonction permettant d'afficher les liens sur grand écran dans la template de menu-up
 *
 * @param array liste Liste des paramètres à rentrer dans la fonction afficherLiens
 *
 * @return string
 * @author gugus2000
 **/
function liens_grand_ecranAfficher($liste)
{
	return afficherLiens($liste['liens'], $liste['titres'], $liste['items'], $liste['type_ecran']);
}

/**
 * Fonction permettant d'afficher les liens sur petit écran dans la template de menu-up
 *
 * @param array liste Liste des paramètres à rentrer dans la fonction afficherLiens
 *
 * @return string
 * @author gugus2000
 **/
function liens_petit_ecranAfficher($liste)
{
	return afficherLiens($liste['liens'], $liste['titres'], $liste['items'], $liste['type_ecran']);
}

?>