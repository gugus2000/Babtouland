class Role
!!!223618.php!!!	getNom_role()

		return $this->nom_role;
!!!223746.php!!!	getId()

		return $this->id;
!!!223874.php!!!	getPermissions()

		return $this->permissions;
!!!224002.php!!!	setNom_role(in nom_role : )

		$this->nom_role=$nom_role;
!!!224130.php!!!	setId(in id : )

		$this->id=(int)$id;
!!!224258.php!!!	setPermissions(in permissions : )

		$this->permissions=$permissions;
!!!224386.php!!!	afficherNom_role()

		return htmlspecialchars((string)$this->nom_role);
!!!224514.php!!!	afficherId()

		return htmlspecialchars((string)$this->id);
!!!224642.php!!!	afficherPermissions()

		$affichage=array();
		foreach ($this->permissions as $key => $permission)
		{
			array_push($affichage, $permission->afficher());
		}
		return htmlspecialchars((string)implode(', ', $affichage));
!!!224770.php!!!	getPermission(in index : )

		return $this->permissions[$index];
!!!224898.php!!!	setPermission(in index : , in permission : )

		$this->permissions[$index]=$permission;
!!!225026.php!!!	afficherpermission(in index : )

		return htmlspecialchars((string)$this->permissions[$index]->afficher());
!!!225154.php!!!	afficher()

		return $this->afficherNom_role();
!!!225282.php!!!	recuperer_permissions()

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
!!!225410.php!!!	existPermission(in application : , in action : )

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
!!!225538.php!!!	recuperer()

		if ($this->getId())
		{
			$RoleManager=$this->Manager();
			$this->setNom_role($RoleManager->get($this->getId())['nom_role']);
			$this->recuperer_permissions();
		}
