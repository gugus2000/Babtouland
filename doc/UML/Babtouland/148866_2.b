class Permission
!!!271874.php!!!	getId()

		return $this->id;
!!!272002.php!!!	getNom_role()

		return $this->nom_role;
!!!272130.php!!!	getApplication()

		return $this->application;
!!!272258.php!!!	getAction()

		return $this->action;
!!!272386.php!!!	setId(in id : )

		$this->id=(int)$id;
!!!272514.php!!!	setNom_role(in nom_role : )

		$this->nom_role=$nom_role;
!!!272642.php!!!	setApplication(in application : )

		$this->application=$application;
!!!272770.php!!!	setAction(in action : )

		$this->action=$action;
!!!272898.php!!!	afficherId()

		return htmlspecialchars((string)$this->id);
!!!273026.php!!!	afficherNom_role()

		return htmlspecialchars((string)$this->nom_role);
!!!273154.php!!!	afficherApplication()

		return htmlspecialchars((string)$this->application);
!!!273282.php!!!	afficherAction()

		return htmlspecialchars((string)$this->action);
!!!273410.php!!!	afficher()

		htmlspecialchars($this->afficherApplication.'-'.$this->afficherAction);
!!!273538.php!!!	recuperer()

		if ($this->getId())
		{
			$PermissionManager=$this->Manager();
			$this->hydrater($PermissionManager->get($this->getId()));
		}
