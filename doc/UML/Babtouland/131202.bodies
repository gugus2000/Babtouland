class Permission
!!!165506.php!!!	getId() : int

		return $this->id;
!!!165634.php!!!	getNom_role() : string

		return $this->nom_role;
!!!165762.php!!!	getApplication() : string

		return $this->application;
!!!165890.php!!!	getAction() : string

		return $this->action;
!!!166018.php!!!	setId(in id : int) : void

		$this->id=(int)$id;
!!!166146.php!!!	setNom_role(in nom_role : string) : void

		$this->nom_role=$nom_role;
!!!166274.php!!!	setApplication(in application : string) : void

		$this->application=$application;
!!!166402.php!!!	setAction(in action : string) : void

		$this->action=$action;
!!!166530.php!!!	afficherId() : string

		return htmlspecialchars((string)$this->id);
!!!166658.php!!!	afficherNom_role() : string

		return htmlspecialchars((string)$this->nom_role);
!!!166786.php!!!	afficherApplication() : string

		return htmlspecialchars((string)$this->application);
!!!166914.php!!!	afficherAction() : string

		return htmlspecialchars((string)$this->action);
!!!167042.php!!!	afficher() : string

		htmlspecialchars($this->afficherApplication.'-'.$this->afficherAction);
!!!167170.php!!!	recuperer() : void

		if ($this->getId())
		{
			$PermissionManager=$this->Manager();
			$this->hydrater($PermissionManager->get($this->getId()));
		}
