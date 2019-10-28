<?php

namespace user\page;

/**
 * Carte classique
 */
class Carte extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de Carte
	*
	* @param PageElement contenu Contenu dans le formulaire
	* 
	* @return void
	*/
	public function __construct($contenu)
	{
		global $config, $lang, $Visiteur;
		$this->setTemplate($config['path_template'].$config['carte_path_template']);
		$this->setFonctions($config['path_func'].$config['carte_path_fonctions']);
		$this->setElements(array('contenu' => $contenu));
	}
}

?>