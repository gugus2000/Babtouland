<?php

namespace user\page\rss;

/**
 * Page Channel
 *
 * @author gugus2000
 */
class Channel extends \user\PageElement
{
	
	/* méthode particulière */

	/**
	* Constructeur de Channel
	*
	* @param array elements Éléments contenu dans le flux
	* 
	* @return void
	*/
	public function __construct($elements)
	{
		global $config;
		$this->setTemplate($config['path_template'].$config['rss_channel_path_template']);
		$this->setElements($elements);
	}
	/**
	* Affichage d'une array
	*
	* @param array liste Liste d'éléments
	* 
	* @return string
	*/
	public function afficherArray($liste)
	{
		$affichage='';
		foreach ($liste as $tag => $element)
		{
			if (is_object($element))
			{
				$affichage.=$element->afficher();
			}
			else if (is_array($element))
			{
				foreach ($element as $tag => $valeur)
				{
					if (is_array($valeur))
					{
						$valeur=$this->afficherArray($valeur);
					}
					$affichage.='<'.$tag.'>'.$valeur.'</'.$tag.'>';
				}
			}
			else
			{
				$affichage.='<'.$tag.'>'.$element.'</'.$tag.'>';
			}
		}
		return $affichage;
	}

}

?>