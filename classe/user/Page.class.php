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
		if (!$this->getParametres()['config_perso']['custom_pageElement'])
		{
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
		$configPerso=$this->chargementConfigPerso();
		$parametres=$this->getParametres();
		if (isset($parametres['config_perso']))
		{
			$configPerso=array_merge($parametres['config_perso'], $configPerso);
		}
		$parametres['config_perso']=$configPerso;
		$this->setParametres($parametres);
		if ($configPerso['notifications'])
		{
			$Notifications=$Visiteur->recupererNotifications();
		}
		if (!$configPerso['custom_pageElement'])
		{
			$PageElement=new \user\page\Page();
			$PageElement->ajouterElement($config['tete_nom'], new \user\page\Tete());
			if ($configPerso['notifications'])
			{
				$PageElement->ajouterElement($config['notification_nom'], $config['notification_elements']);
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
			}
			else
			{
				$PageElement->ajouterElement($config['notification_nom'], '');
			}
			$this->setPageElement($PageElement);
		}
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
	static public function ajouterNotificationSession($Notification)
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
	/**
	* Donne le path du fichier de la template de la page
	* 
	* @return string
	*/
	public function getTemplatePath()
	{
		global $config;
		return $config['path_template'].$this->getApplication().'/'.$this->getAction().'/'.$config['filename_contenu_template'];
	}
	/**
	* Donne le path du fichier des fonctions de la page
	* 
	* @return string
	*/
	public function getFonctionsPath()
	{
		global $config;
		return $config['path_func'].$this->getApplication().'/'.$this->getAction().'/'.$config['filename_contenu_fonctions'];
	}
	/**
	* Ajouter un paramètre dans la page
	*
	* @param string nom Nom du paramètre (clef)
	*
	* @param mixed valeur Valeur du paramètre
	* 
	* @return void
	*/
	public function ajouterParametre($nom, $valeur)
	{
		$this->setParametres(array_merge($this->getParametres(), array($nom => $valeur)));
	}
	/**
	* Raccourci pour ajouter rapidement le titre et la description de façon automatique
	* 
	* @return void
	*/
	public function ajouterEnteteClassique()
	{
		global $Visiteur, $config, $lang;
		$Visiteur->getPage()->getpageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
		$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
			'name'   => 'description',
			'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
		));
	}
	/**
	* Chargement de la config perso
	* 
	* @return array
	*/
	public function chargementConfigPerso()
	{
		global $config;
		$array=$config['defaut_config'];
		if (isset($config[$this->getApplication().'_config']))
		{
			$array=array_merge($array, $config[$this->getApplication().'_config']);
		}
		if (isset($config[$this->getApplication().'_'.$this->getAction().'_config']))
		{
			$array=array_merge($array, $config[$this->getApplication().'_'.$this->getAction().'_config']);
		}
		return $array;
	}
	/**
	* Changer de pageElement
	*
	* @param \user\PageElement pageElement Le nouveau PageElement
	* 
	* @return void
	*/
	public function creerPage($pageElement)
	{
		if ($this->getParametres()['config_perso']['custom_pageElement']!=null)
		{
			if ($this->getParametres()['config_perso']['custom_pageElement'])
			{
				$this->setPageElement($pageElement);
			}
		}
	}

}

?>