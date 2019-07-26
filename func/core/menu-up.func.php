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
			$affichage.='<a href="'.$lien.'" title="'.$titres[$index].'"><div class="saut-ligne"><br />'.$items[$index].'</div></a>';
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
	array_push($css, $config['menu-up_css']);
	array_push($js, $config['menu-up_js']);
	require $config['menu-up_contenu'];
	$contenu=$Contenu.$contenu;
}

?>