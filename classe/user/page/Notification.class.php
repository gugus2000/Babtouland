<?php

namespace user\page;

/**
 * Notification de page classique
 */
class Notification extends \user\PageElement
{
	/* Constantes */

	/**
	* Type de message: succès
	*
	* @var string
	*/
	const TYPE_SUCCES='succes';
	/**
	* Type de message: attention
	*
	* @var string
	*/
	const TYPE_ATTENTION='attention';
	/**
	* Type de message: erreur
	*
	* @var string
	*/
	const TYPE_ERREUR='erreur';

	/*Autres méthodes */

	/**
	* Constructeur de Notification
	*
	* @param array elements Éléments à insérer sous la forme d'une array
	*
	* @param \user\page\Page Page Page
	* 
	* @return void
	*/
	public function __construct($elements, $Page=null)
	{
		global $config, $lang, $Visiteur;
		if (!$Page)
		{
			if ($Visiteur->getPage()!=null)
			{
				$Page=$Visiteur->getPage()->getPageElement();
			}
			else 	// On crée la notification avant le chargement de la page
			{
				$this->setTemplate($config['path_template'].$config['notification_path_template']);
				$this->setElements($elements);
				return null;
			}
		}
		$this->setTemplate($config['path_template'].$config['notification_path_template']);
		$this->setElements($elements);
		$this->ajouterTete($Page->getElement($config['tete_nom']));
		$Page->ajouterValeurElement($config['notification_nom'], $this);
	}
	/**
	* Mets les css et les javascripts dans la tete
	*
	* @param \user\page\Tete Tete Tête de la page
	* 
	* @return void
	*/
	static public function ajouterTete($Tete)
	{
		global $config;
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['notification_path_css']);
		$Tete->ajouterValeurElement('javascripts', $config['path_assets'].$config['notification_path_js']);
	}
}

?>