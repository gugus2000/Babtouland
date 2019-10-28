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
	public function __construct($contenu, $Tete)
	{
		global $config, $lang, $Visiteur;
		$this->setTemplate($config['path_template'].$config['formulaire_path_template']);
		$this->setFonctions($config['path_func'].$config['formulaire_path_fonctions']);
		$this->setElements(array('contenu' => $contenu));
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['formulaire_path_css']);
	}
}

?>