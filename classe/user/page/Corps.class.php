<?php

namespace user\page;

/**
 * Corps classique
 */
class Corps extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de Corps
	*
	* @param mixed haut Haut du contenu dans le corps
	*
	* @param mixed centre Centre du contenu dans le corps
	*
	* @param mixed bas Bas du contenu dans le corps
	* 
	* @return void
	*/
	public function __construct($haut, $centre, $bas)
	{
		global $config, $lang, $Visiteur;
		$this->setTemplate($config['path_template'].$config['corps_path_template']);
		$this->setFonctions($config['path_func'].$config['corps_path_fonctions']);
		$this->setElements(array(
			'haut'   => $haut,
			'centre' => $centre,
			'bas'    => $bas,
		));
	}
}

?>