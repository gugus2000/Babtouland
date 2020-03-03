<?php

namespace user\page;

/**
 * Toast classique
 */
class Toast extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de Toast
	*
	* @param array elements Éléments contenu dans le toast
	*
	* @param PageElement Tete Tête de la page
	* 
	* @return void
	*/
	public function __construct($elements, $Tete=null)
	{
		global $config, $lang, $Visiteur, $Routeur;
		if (!$Tete)
		{
			$Tete=$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']);
		}
		$this->setTemplate($config['path_template'].$config['toast_path_template']);
		$liens=array();
		foreach ($elements['lien'] as $index => $lien)
		{
			if ($Visiteur->getRole()->existPermission($lien))
			{
				$liens[]=new \user\PageElement(array(
					'template' => $config['path_template'].$config['toast_lien_path_template'],
					'elements' => array(
						'href' => $Routeur->creerLien($lien),
						'title' => $elements['description'][$index],
						'icone' => $elements['icone'][$index],
					),
				));
			}
		}
		$this->setElements(array(
			'toast_liens' => $liens,
		));
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['toast_path_css']);
		$Tete->ajouterValeurElement('javascripts', $config['path_assets'].$config['toast_path_javascript']);
	}
}

?>