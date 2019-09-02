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
	$affichage='';
	if($type_ecran=='grand-ecran')		// Menu grand écran
	{
		foreach ($liens as $index => $lien)
		{
			$affichage.='<div class="element ligne">
							<div class="colonne">
								<a href="'.$lien.'" title="'.$titres[$index].'">'.$items[$index].'</a>
							</div>
						</div>';
		}
	}
	else
	{
		foreach ($liens as $index => $lien)
		{
			$affichage.='<a href="'.$lien.'" title="'.$titres[$index].'" class="lien-item"><i class="material-icons">'.$items[$index].'</i></a>';
		}
	}
	return $affichage;
}

/**
 * Ajoute le menu-up dans l'objet Page
 *
 * @param array css Css déjà utilisé dans la page
 * 
 * @param array js Js déjà utilisé dans la page
 * 
 * @param string contenu Contenu de la page a afficher (sera après menu-up)
 * 
 * @return void
 * @author gugus2000
 **/
function ajouterMenuUp(&$css, &$js, &$contenu)
{
	global $config, $lang, $Visiteur;
	foreach ($config['menu-up_liens'] as $key => $lien)	// vérifie les permissions des liens
	{
		$array=recuperationApplicationActionLien($lien);
		if(!$Visiteur->getRole()->existPermission($array['application'], $array['action']))
		{
			unset($config['menu-up_liens'][$key]);
			unset($lang['menu-up_titres'][$key]);
			unset($lang['menu-up_affichages'][$key]);
		}
	}
	if(!empty($config['menu-up_liens']))		// Aucune permission disponible
	{
		array_push($css, $config['menu-up_css']);
		array_push($js, $config['menu-up_js']);
		require $config['menu-up_contenu'];
		$contenu=$Contenu.$contenu;
	}
}

?>