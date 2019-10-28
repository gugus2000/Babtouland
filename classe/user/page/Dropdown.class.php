<?php

namespace user\page;

/**
 * Dropdown classique
 */
class Dropdown extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de Dropdown
	*
	* @param string dropdown_select Texte affiché dès le départ dans le dropdown
	*
	* @param array dropdown_others Autres textes à afficher
	*
	* @param PageElement Tete Tête de la page
	* 
	* @return void
	*/
	public function __construct($dropdown_select, $dropdown_others, $Tete)
	{
		global $config, $lang, $Visiteur;
		$this->setTemplate($config['path_template'].$config['dropdown_path_template']);
		$this->setFonctions($config['path_func'].$config['dropdown_path_fonctions']);
		$this->setElements(array(
			'dropdown_select' => $dropdown_select,
			'dropdown_others' => $dropdown_others,
		));
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['dropdown_path_css']);
	}
}

?>