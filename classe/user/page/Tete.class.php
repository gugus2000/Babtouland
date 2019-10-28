<?php

namespace user\page;

/**
 * Tete de page classique
 */
class Tete extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de Tete
	*
	* @param array elements Éléments à insérer sous la forme d'une array
	* 
	* @return void
	*/
	public function __construct($elements)
	{
		global $config, $lang, $Visiteur;
		$this->setTemplate($config['path_template'].$config['tete_path_template']);
		$this->setFonctions($config['path_func'].$config['tete_path_fonctions']);
		$this->setElements($elements);
	}
}

?>