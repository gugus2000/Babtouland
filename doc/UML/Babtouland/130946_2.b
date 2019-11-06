class Page
!!!161922.php!!!	getApplication() : string

		return $this->application;
!!!162050.php!!!	getAction() : string

		return $this->action;
!!!162178.php!!!	getPageElement() : PageElement

		return $this->pageElement;
!!!162306.php!!!	setApplication(in application : string) : void

		$this->application=$application;
!!!162434.php!!!	setAction(in action : string) : void

		$this->action=$action;
!!!162562.php!!!	setPageElement(in pageElement : PageElement) : void

		$this->pageElement=$pageElement;
!!!162690.php!!!	afficherApplication() : string

		return htmlspecialchars((string)$this->application);
!!!162818.php!!!	afficherAction() : string

		return htmlspecialchars((string)$this->action);
!!!162946.php!!!	afficherPageElement() : string

		return $this->pageElement->afficher();
!!!163074.php!!!	afficher() : string

		return $this->afficherPageElement();
!!!163202.php!!!	__construct(in attributs : array) : void

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
!!!163330.php!!!	envoyerNotificationsSession() : void

		global $config;
		$notifications_serialise=array();
		foreach ($this->getPageElement()->getElement($config['notification_nom']) as $notification)
		{
			$notifications_serialise[]=serialize($notification);
		}
		$_SESSION['notifications']=$notifications_serialise;
!!!163458.php!!!	ajouterNotificationSession(in Notification : \user\page\Notification) : void

		if (isset($_SESSION['notifications']))
		{
			$_SESSION['notifications'][]=serialize($Notification);
		}
		else
		{
			$_SESSION['notifications']=array(serialize($Notification));
		}
!!!163586.php!!!	getPath() : string

		global $config;
		return $config['path_pageDef_root'].$this->getApplication().'/'.$this->getAction().'/'.$config['path_pageDef_filename'];
