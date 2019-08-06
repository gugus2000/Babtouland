<?php

/**
 * Ajoute les différents élément au toast
 * 
 * @param array liens Liens à mettre dans le float
 * 
 * @param array icones Icônes à mettre dans le float
 * 
 * @param array descriptions Description des actions des liens du float
 * 
 * @return string
 * @author gugus2000
 **/
function insererLiens($liens, $icones, $descriptions)
{
	$affichage="";
	foreach ($liens as $index => $lien)
	{
		$affichage.='
			<div class="element">
				<a href="'.$lien.'" title="'.$descriptions[$index].'"><i class="material-icons">'.$icones[$index].'</i></a>
			</div>';
	}
	return $affichage;
}

/**
 * Ajoute le toast l'objet Page
 *
 * @param array css Css déjà utilisé dans la page
 * 
 * @param array js Js déjà utilisé dans la page
 * 
 * @param string contenu Contenu de la page a afficher (sera avant le toast)
 * 
 * @param array liens Liens à mettre dans le float
 * 
 * @param array icones Icônes à mettre dans le float
 * 
 * @param array descriptions Description des actions des liens du float
 * 
 * @return void
 * @author gugus2000
 **/
function ajouterToast(&$css, &$js, &$contenu, $liens, $icones, $descriptions)
{
	global $config, $lang, $Visiteur;
	foreach ($liens as $key => $lien)	// vérifie les permissions des liens
	{
		$array=recuperationApplicationActionLien($lien);
		if(!$Visiteur->getRole()->existPermission($array['application'], $array['action']))
		{
			unset($liens[$key]);
			unset($icones[$key]);
			unset($descriptions[$key]);
		}
	}
	if(!empty($liens))		// Aucune permission disponible
	{
		array_push($css, $config['toast_css']);
		array_push($js, $config['toast_js']);
		require $config['toast_contenu'];
		$contenu.=$Contenu;
	}
}

?>