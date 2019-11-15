<?php

namespace user\page;

/**
 * Temps de génération de page
 */
class Temps extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de Temps
	*
	* @param string temps Temps de génération à indiquer
	* 
	* @return void
	*/
	public function __construct($temps, $Tete=null)
	{
		global $config, $lang, $Visiteur;
		if (!$Tete)
		{
			$Tete=$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']);
		}
		$this->setTemplate($config['path_template'].$config['temps_path_template']);
		$this->setElements(array(
			'temps'       => $lang['temps_debut'].$temps.$lang['temps_fin'],
		));
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['temps_path_css']);
	}
}

?>