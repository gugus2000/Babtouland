<?php

namespace user\page;

/**
 * Menu-side
 */
class MenuSide extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de Menu-side
	*
	* @param mixed contenu Contenu du menu-side
	* 
	* @param PageElement Tete Tête de la page
	* 
	* @return void
	*/
	public function __construct($contenu, $Tete=null)
	{
		global $config, $Visiteur;
		if (!$Tete)
		{
			$Tete=$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']);
		}
		$this->setTemplate($config['path_template'].$config['menuSide_path_template']);
		$this->setElements(array(
			'contenu' => $contenu,
		));
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['menuSide_path_css']);
	}
}

?>