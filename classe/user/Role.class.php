<?php

namespace user;

/**
* Role de d'utilisateur
*/
class Role extends \core\Managed
{
	/* Attributs */
	
	/**
	* Nom du rôle
	*
	* @var string
	*/
	protected $nom_role;
	/**
	* Id de l'utilisateur ayant le rôle
	*
	* @var int
	*/
	protected $id;
	/**
	* Permissions accordées au rôle
	*
	* @var array
	*/
	protected $permissions;

	/* Accesseurs */
	
	/**
	* Accesseur de nom_role
	*
	* @return string
	*/
	public function getNom_role()
	{
		return $this->nom_role;
	}
	/**
	* Accesseur de id
	*
	* @return int
	*/
	public function getId()
	{
		return $this->id;
	}
	/**
	* Accesseur de permissions
	*
	* @return array
	*/
	public function getPermissions()
	{
		return $this->permissions;
	}

	/* Définisseurs */

	/**
	* Définisseur de nom_role
	*
	* @param string nom_role Nom du rôle
	*
	* @return void
	*/
	protected function setNom_role($nom_role)
	{
		$this->nom_role=$nom_role;
	}
	/**
	* Définisseur de id
	*
	* @param int id Id de l'utilisateur
	*
	* @return void
	*/
	protected function setId_utilisateur($id)
	{
		$this->id=(int)$id;
	}
	/**
	* Définisseur de permissions
	*
	* @param array permissions Permissions accordées au rôle
	*
	* @return void
	*/
	protected function setPermissions($permissions)
	{
		$this->permissions=$permissions;
	}

	/* Autres méthodes */

	/**
	* Afficheur de nom_role
	*
	* @return string
	*/
	public function afficherNom_role()
	{
		return htmlspecialchars((string)$this->nom_role);
	}
	/**
	* Afficheur de id
	*
	* @return string
	*/
	public function afficherId()
	{
		return htmlspecialchars((string)$this->id);
	}
	/**
	* Afficheur de permissions
	*
	* @return string
	*/
	public function afficherPermissions()
	{
		$affichage=array();
		foreach ($this->permissions as $key => $permission)
		{
			array_push($affichage, $permission->afficher());
		}
		return htmlspecialchars((string)implode(', ', $affichage));
	}
	/**
	* Accesseur d'une permission
	*
	* @param int index Index de la permission dans permissions
	*
	* @return Permission
	*/
	public function getPermission($index)
	{
		return $this->permissions[$index];
	}
	/**
	* Définisseur d'une permission
	*
	* @param int index Index de la permission dans permissions
	*
	* @param Permission permission Permission à définir
	* 
	* @return void
	*/
	public function setPermission($index, $permission)
	{
		$this->permissions[$index]=$permission;
	}
	/**
	* Afficheur d'une permission
	*
	* @param int index Index de la permission dans permissions
	*
	* @return string
	*/
	public function afficherpermission($index)
	{
		return htmlspecialchars((string)$this->permissions[$index]->afficher());
	}
	/**
	* Afficheur de l'objet Role
	*
	* @return string
	*/
	public function afficher()
	{
		return $this->afficherNom_role();
	}
	/**
	* Récupère les permissions du rôle avec le nom_role déjà connu
	*
	* @return void
	*/
	public function recuperer_permissions()
	{
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
	}
	/**
	* Vérifie l'existence d'une permission pour le rôle
	*
	* @param string application Application de la permission
	* 
	* @param string action Action de la permission
	* 
	* @return bool
	*/
	public function existPermission($application, $action)
	{
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
	}
	/**
	* Récupère le rôle à partir de son id
	*
	* @return void
	*/
	public function recuperer()
	{
		if ($this->getId())
		{
			$RoleManager=$this->Manager();
			$this->setNom_role($RoleManager->get($this->getId())['nom_role']);
			$this->recuperer_permissions();
		}
	}
}

?>