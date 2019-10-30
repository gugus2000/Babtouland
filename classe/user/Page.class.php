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
	* Afficheur de Page
	* 
	* @return string
	*/
	public function afficher()
	{
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
		}
		$PageElement=new \user\page\Page();
		$PageElement->ajouterElement($config['tete_nom'], new \user\page\Tete());
		$PageElement->ajouterElement($config['notification_nom'], $config['notification_elements']);
		if (isset($_SESSION['notifications']))		// Gestion des notifications
		{
			foreach ($_SESSION['notifications'] as $notification_serialize)
			{
				$PageElement->ajouterValeurElement($config['notification_nom'], unserialize($notification_serialize));
			}
			\user\page\Notification::ajouterTete($PageElement->getElement($config['tete_nom']));
		}
		unset($_SESSION['notifications']);
		$this->setPageElement($PageElement);
	}
	/**
	* Envoie les notifications dans la session
	* 
	* @return void
	*/
	public function envoyerNotificationsSession()
	{
		global $config;
		$notifications_serialise=array();
		foreach ($this->getPageElement()->getElement($config['notification_nom']) as $notification)
		{
			$notifications_serialise[]=serialize($notification);
		}
		$_SESSION['notifications']=$notifications_serialise;
	}
	/**
	* Ajouter une notification à envoyer dans la session
	*
	* @param \user\page\Notification Notification Notification à envoyer dans la session
	* 
	* @return void
	*/
	public function ajouterNotificationSession($Notification)
	{
		if (isset($_SESSION['notifications']))
		{
			$_SESSION['notifications'][]=serialize($Notification);
		}
		else
		{
			$_SESSION['notifications']=array(serialize($Notification));
		}
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