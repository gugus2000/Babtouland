<?php

namespace user\page;

/**
 * Formulaire classique
 */
class Formulaire extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de Formulaire
	*
	* @param PageElement contenu Contenu dans le formulaire
	*
	* @param PageElement Tete Tête de la page
	* 
	* @return void
	*/
	public function __construct($contenu, $Tete=null)
	{
		global $config, $lang, $Visiteur;
		if (!$Tete)
		{
			$Tete=$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']);
		}
		$this->setTemplate($config['path_template'].$config['formulaire_path_template']);
		$this->setElements(array('contenu' => $contenu));
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['formulaire_path_css']);
	}
}

?>