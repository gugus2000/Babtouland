class Permission
!!!221826.php!!!	getId()

		return $this->id;
!!!221954.php!!!	getNom_role()

		return $this->nom_role;
!!!222082.php!!!	getApplication()

		return $this->application;
!!!222210.php!!!	getAction()

		return $this->action;
!!!222338.php!!!	setId(in id : )

		$this->id=(int)$id;
!!!222466.php!!!	setNom_role(in nom_role : )

		$this->nom_role=$nom_role;
!!!222594.php!!!	setApplication(in application : )

		$this->application=$application;
!!!222722.php!!!	setAction(in action : )

		$this->action=$action;
!!!222850.php!!!	afficherId()

		return htmlspecialchars((string)$this->id);
!!!222978.php!!!	afficherNom_role()

		return htmlspecialchars((string)$this->nom_role);
!!!223106.php!!!	afficherApplication()

		return htmlspecialchars((string)$this->application);
!!!223234.php!!!	afficherAction()

		return htmlspecialchars((string)$this->action);
!!!223362.php!!!	afficher()

		htmlspecialchars($this->afficherApplication.'-'.$this->afficherAction);
!!!223490.php!!!	recuperer()

		if ($this->getId())
		{
			$PermissionManager=$this->Manager();
			$this->hydrater($PermissionManager->get($this->getId()));
		}
