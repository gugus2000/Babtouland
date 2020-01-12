<?php

namespace user\page\MenuSide;

/**
 * Bouton pour le menu-side
 */
class Bouton extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de bouton
	* 
	* @param string href Lien du bouton
	*
	* @param string title Titre du lien
	*
	* @param string texte Texte dans le bouton
	* 
	* @return void
	*/
	public function __construct($href, $title, $texte, $classe='')
	{
		global $config;
		$this->setTemplate($config['path_template'].$config['menuSide_bouton_path_template']);
		$this->setElements(array(
			'classe' => $classe,
			'href'   => $href,
			'title'  => $title,
			'texte'  => $texte,
		));
	}
}

?>