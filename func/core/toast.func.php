<?php

/**
 * Ajoute les différents élément au toast
 * 
 * @param array liens Liens à mettre dans le toast
 * 
 * @return string
 * @author gugus2000
 **/
function insererLiens($liens)
{
	$affichage="";
	foreach ($liens as $index => $lien)
	{
		$affichage.='
			<div class="element">
				<a href="'.$liens['lien'].'" title="'.$liens['description'][$index].'"><i class="material-icons">'.$liens['icone'][$index].'</i></a>
			</div>';
	}
	return $affichage;
}

?>