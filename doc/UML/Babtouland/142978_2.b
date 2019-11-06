class Page
!!!218242.php!!!	getApplication()

		return $this->application;
!!!218370.php!!!	getAction()

		return $this->action;
!!!218498.php!!!	getPageElement()

		return $this->pageElement;
!!!218626.php!!!	setApplication(in application : )

		$this->application=$application;
!!!218754.php!!!	setAction(in action : )

		$this->action=$action;
!!!218882.php!!!	setPageElement(in pageElement : )

		$this->pageElement=$pageElement;
!!!219010.php!!!	afficherApplication()

		return htmlspecialchars((string)$this->application);
!!!219138.php!!!	afficherAction()

		return htmlspecialchars((string)$this->action);
!!!219266.php!!!	afficherPageElement()

		return $this->pageElement->afficher();
!!!219394.php!!!	afficher()

		global $config;
		if(null!=$this->getPageElement()->getElement($config['tete_nom'])->getElement('titre'))
		{
			$this->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('titre', $config['prefixe_titre']);
		}
		return $this->afficherPageElement();
!!!219522.php!!!	__construct(in attributs : )

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
		}
		unset($_SESSION['notifications']);
		$this->setPageElement($PageElement);
!!!219650.php!!!	envoyerNotificationsSession()

		global $config;
		$notifications_serialise=array();
		foreach ($this->getPageElement()->getElement($config['notification_nom']) as $notification)
		{
			$notifications_serialise[]=serialize($notification);
		}
		$_SESSION['notifications']=$notifications_serialise;
!!!219778.php!!!	ajouterNotificationSession(in Notification : )

		if (isset($_SESSION['notifications']))
		{
			$_SESSION['notifications'][]=serialize($Notification);
		}
		else
		{
			$_SESSION['notifications']=array(serialize($Notification));
		}
!!!219906.php!!!	getPath()

		global $config;
		return $config['path_pageDef_root'].$this->getApplication().'/'.$this->getAction().'/'.$config['path_pageDef_filename'];
