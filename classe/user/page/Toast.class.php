<?php

namespace user\page;

/**
 * Toast classique
 */
class Toast extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de Toast
	*
	* @param array elements Éléments contenu dans le toast
	*
	* @param PageElement Tete Tête de la page
	* 
	* @return void
	*/
	public function __construct($elements, $Tete=null)
	{
		global $config, $lang, $Visiteur;
		if (!$Tete)
		{
			$Tete=$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']);
		}
		$this->setTemplate($config['path_template'].$config['toast_path_template']);
		$this->setFonctions($config['path_func'].$config['toast_path_fonctions']);
		$this->setElements(array(
			'toast_liens' => $elements,
		));
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['toast_path_css']);
		$Tete->ajouterValeurElement('javascripts', $config['path_assets'].$config['toast_path_javascript']);
	}
}

?>