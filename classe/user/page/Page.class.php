<?php

namespace user\page;

/**
 * Page classique
 */
class Page extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de Page
	* 
	* @return void
	*/
	public function __construct()
	{
		global $config, $lang, $Visiteur;
		$this->setTemplate($config['pageElement_page_template']);
		$this->setFonctions($config['pageElement_page_fonctions']);
		$this->setElements($config['pageElement_page_elements']);
	}
}

?>