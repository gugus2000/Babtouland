<?php

namespace user\page;

/**
 * Tête de page classique
 */
class Tete extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de Tete
	* 
	* @return void
	*/
	public function __construct()
	{
		global $config, $lang, $Visiteur;
		$this->setTemplate($config['path_template'].$config['tete_path_template']);
		$this->setFonctions($config['path_func'].$config['tete_path_fonctions']);
		$this->setElements(array(
			'metas'       => $config['tete_metas'],
			'css'         => $config['tete_css'],
			'javascripts' => $config['tete_javascripts'],
		));
	}
}

?>