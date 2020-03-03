<?php

namespace user\page\MenuSide;

/**
 * Liste de boutons pour menu-side
 */
class BoutonsListe extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de BoutonsListe
	*
	* @param string titre Titre de la liste
	* 
	* @param array boutons Liste de boutons
	* 
	* @return void
	*/
	public function __construct($titre, $boutons)
	{
		global $config;
		$this->setTemplate($config['path_template'].$config['menuSide_boutonsListe_path_template']);
		$this->setElements(array(
			'titre'   => $titre,
			'boutons' => $boutons,
		));
	}
}

?>