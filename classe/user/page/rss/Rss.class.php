<?php

namespace user\page\rss;

/**
 * Page rss
 *
 * @author gugus2000
 */
class Rss extends \user\PageElement
{
	
	/* méthode particulière */

	/**
	* Constructeur de Rss
	*
	* @param array elements Éléments contenu dans le flux
	* 
	* @return void
	*/
	public function __construct($elements)
	{
		global $config;
		header('Content-type: text/xml');
		$this->setTemplate($config['path_template'].$config['rss_path_template']);
		$this->setElements($elements);
	}

}

?>