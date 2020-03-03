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
		global $config, $lang, $Visiteur, $Routeur;
		$this->setTemplate($config['path_template'].$config['dropdown_path_template']);
		$Dropdown_others=array();
		foreach ($dropdown_others as $language)
		{
			$Parametres=$Visiteur->getPage()->getParametres();
			if (isset($Parametres['config_perso']))
			{
				unset($Parametres['config_perso']);
			}
			$link=array('application' => $Visiteur->getPage()->getApplication(), 'action' => $Visiteur->getPage()->getAction(), 'parametres' => array_merge($Parametres, array('lang' => $language['abbr'])));
			$Dropdown_others[]=new \user\PageElement(array(
				'template' => $config['path_template'].$config['dropdown_others_path_template'],
				'elements' => array(
					'href'     => $Routeur->creerLien($link),
					'language' => $language['full'],
				),
			));
		}
		$this->setElements(array(
			'dropdown_select' => $dropdown_select,
			'dropdown_others' => $Dropdown_others,
		));
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['dropdown_path_css']);
	}
}

?>