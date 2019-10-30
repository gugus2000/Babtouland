class Role
!!!167298.php!!!	getNom_role() : string

		return $this->nom_role;
!!!167426.php!!!	getId() : int

		return $this->id;
!!!167554.php!!!	getPermissions() : array

		return $this->permissions;
!!!167682.php!!!	setNom_role(in nom_role : string) : void

		$this->nom_role=$nom_role;
!!!167810.php!!!	setId(in id : int) : void

		$this->id=(int)$id;
!!!167938.php!!!	setPermissions(in permissions : array) : void

		$this->permissions=$permissions;
!!!168066.php!!!	afficherNom_role() : string

		return htmlspecialchars((string)$this->nom_role);
!!!168194.php!!!	afficherId() : string

		return htmlspecialchars((string)$this->id);
!!!168322.php!!!	afficherPermissions() : string

		$affichage=array();
		foreach ($this->permissions as $key => $permission)
		{
			array_push($affichage, $permission->afficher());
		}
		return htmlspecialchars((string)implode(', ', $affichage));
!!!168450.php!!!	getPermission(in index : int) : Permission

		return $this->permissions[$index];
!!!168578.php!!!	setPermission(in index : int, in permission : Permission) : void

		$this->permissions[$index]=$permission;
!!!168706.php!!!	afficherpermission(in index : int) : string

		return htmlspecialchars((string)$this->permissions[$index]->afficher());
!!!168834.php!!!	afficher() : string

		return $this->afficherNom_role();
!!!168962.php!!!	recuperer_permissions() : void

		if ($this->getNom_role())
		{
			$BDDFactory=new \core\BDDFactory;
			$PermissionManager=new \user\PermissionManager($BDDFactory->MysqlConnexion());
			$permissions=$PermissionManager->getBy(array(
				'nom_role' => $this->getNom_role(),
			), array(
				'nom_role' => '=',
			));
			$Permissions=array();
			foreach ($permissions as $key => $permission)
			{
				$Permission=new \user\Permission($permission);
				$Permissions[]=$Permission;
			}
			$this->setPermissions($Permissions);
		}
!!!169090.php!!!	existPermission(in application : string, in action : string) : bool

		$BDDFactory=new \core\BDDFactory;
		$PermissionManager=new \user\PermissionManager($BDDFactory->MysqlConnexion());
		return $PermissionManager->getBy(array(
			'nom_role'    => $this->getNom_role(),
			'application' => $application,
			'action'      => $action,
		), array(
			'nom_role'    => '=',
			'application' => '=',
			'action'      => '=',
		));
!!!169218.php!!!	recuperer() : void

		if ($this->getId())
		{
			$RoleManager=$this->Manager();
			$this->setNom_role($RoleManager->get($this->getId())['nom_role']);
			$this->recuperer_permissions();
		}
