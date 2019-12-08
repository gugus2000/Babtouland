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
	* Paraamètres supplémentaires de la page
	* 
	* @var array
	*/
	protected $parametres;
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
	* Accesseur de parametres
	* 
	* @return array
	*/
	public function getParametres()
	{
		return $this->parametres;
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
	* Définisseur de parametres
	*
	* @param array parametres Paramètres supplémentaires de la page
	* 
	* @return void
	*/
	protected function setParametres($parametres)
	{
		$this->parametres=$parametres;
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
	* Afficheur de parametres
	* 
	* @return string
	*/
	public function afficherParametres()
	{
		return htmlspecialchars((string)$this->parametres);
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
		global $config, $Visiteur;
		if($this->getPageElement()->getElement($config['tete_nom']))
		{
			if ($this->getPageElement()->getElement($config['tete_nom'])->getElement('metas'))
			{
				$this->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
					'charset' => 'utf-8',
					'lang'    => $Visiteur->getConfiguration('lang'),
				));
			}
			if($this->getPageElement()->getElement($config['tete_nom'])->getElement('titre'))
			{
				$this->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('titre', $config['prefixe_titre']);
			}
			else
			{
				$this->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', '');
			}
		}
		if (!$this->getPageElement()->getElement($config['temps_nom']))
		{
			$this->getPageElement()->ajouterElement($config['temps_nom'], '');
		}
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
		$Notifications=$Visiteur->recupererNotifications();
		if ($Notifications)		// Gestion des notifications de la base de données
		{
			foreach ($Notifications as $Notification)
			{
				$Notification->envoyerNotification($PageElement);
			}
			\user\page\Notification::ajouterTete($PageElement->getElement($config['tete_nom']));
		}
		if (isset($_SESSION['notifications']))		// Gestion des notifications de sessions
		{
			foreach ($_SESSION['notifications'] as $notification_serialize)
			{
				$PageElement->ajouterValeurElement($config['notification_nom'], unserialize($notification_serialize));
			}
			\user\page\Notification::ajouterTete($PageElement->getElement($config['tete_nom']));
			unset($_SESSION['notifications']);
		}
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