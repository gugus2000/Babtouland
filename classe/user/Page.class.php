<?php

namespace user;

/**
* Page vu par l'utilisateur
*/
class Page
{
	/* Attributs */

	/**
	* Application de la page
	*
	* @var string
	*/
	protected $application;
	/**
	* Action de la page
	*
	* @var string
	*/
	protected $action;
	/**
	* Élément représentant la page
	* 
	* @var PageElement
	*/
	protected $pageElement;
	/**
	* Notifications dans la page
	* 
	* @var array
	*/
	protected $notifications;

	/* Accesseurs */

	/**
	* Accesseur de application
	*
	* @return string
	*/
	public function getApplication()
	{
		return $this->application;
	}
	/**
	* Accesseur de action
	*
	* @return string
	*/
	public function getAction()
	{
		return $this->action;
	}
	/**
	* Accesseur de pageElement
	* 
	* @return PageElement
	*/
	public function getPageElement()
	{
		return $this->pageElement;
	}
	/**
	* Accesseur de notifications
	* 
	* @return array
	*/
	public function getNotifications()
	{
		return $this->notifications;
	}

	/* Définisseurs */

	/**
	* Définisseur de application
	*
	* @param string application Application de la page
	*
	* @return void
	*/
	protected function setApplication($application)
	{
		$this->application=$application;
	}
	/**
	* Définisseur de action
	*
	* @param string action Action de la page
	*
	* @return void
	*/
	protected function setAction($action)
	{
		$this->action=$action;
	}
	/**
	* Définisseur de pageElement
	*
	* @param PageElement pageElement Élément représentant la page
	* 
	* @return void
	*/
	protected function setPageElement($pageElement)
	{
		$this->pageElement=$pageElement;
	}
	/**
	* Définisseur de notifications
	*
	* @param array notifications Notifications à ajouter dans la page
	* 
	* @return void
	*/
	protected function setNotifications($notifications)
	{
		$this->notifications=$notifications;
	}

	/* Autres méthodes */

	/**
	* Afficheur de application
	*
	* @return string
	*/
	public function afficherApplication()
	{
		return htmlspecialchars((string)$this->application);
	}
	/**
	* Afficheur de action
	*
	* @return string
	*/
	public function afficherAction()
	{
		return htmlspecialchars((string)$this->action);
	}
	/**
	* Afficheur de pageElement
	* 
	* @return string
	*/
	public function afficherPageElement()
	{
		return $this->pageElement->afficher();
	}
	/**
	* Afficheur de notifications
	* 
	* @return string
	*/
	public function afficherNotifications()
	{
		$affichage='';
		foreach ($this->notifications as $notification)
		{
			$affichage.=$notification->afficher();
		}
		return $affichage;
	}
	/**
	* Afficheur de Page
	* 
	* @return string
	*/
	public function afficher()
	{
		global $config;
		$this->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].$config['message_css']);
		$this->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('javascripts', $config['path_assets'].$config['message_js']);
		$this->getPageElement()->ajouterElement('notifications', $this->afficherNotifications());
		return $this->afficherPageElement();
	}
	/**
	* Construction de l'objet Page
	*
	* @param array attributs Attributs de la page
	*
	* @return void
	*/
	public function __construct($attributs)
	{
		global $config, $lang, $Visiteur;
		foreach ($attributs as $key => $value)
		{
			$method='set'.ucfirst($key);
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
			$PageElement=new \user\PageElement(array(
				'template'  => $config['pageElement_page_template'],
				'fonctions' => $config['pageElement_page_fonctions'],
				'elements'  => $config['pageElement_elements'],
			));
			$Tete=new \user\page\Tete(array(
				'metas'       => $config['tete_metas'],
				'css'         => $config['tete_css'],
				'javascripts' => $config['tete_javascripts'],
			));
			$PageElement->ajouterElement($config['tete_nom'], $Tete);
			$this->setPageElement($PageElement);
		}
	}
	/**
	* Ajout d'une notification dans la page
	*
	* @param Notification Notification Notification à rajouter dans la page
	* 
	* @return void
	*/
	public function ajouter_Notification($Notification)
	{
		$this->notifications[]=$Notification;
	}
	/**
	* Obtient le path du fichier de définition de la page à afficher
	*
	* @return string
	*/
	public function getPath()
	{
		global $config;
		return $config['path_pageDef_root'].$this->getApplication().'/'.$this->getAction().'/'.$config['path_pageDef_filename'];
	}
}

?>