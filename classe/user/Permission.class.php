<?php

namespace user;

/**
* Permission du site
*/
class Permission extends \core\Managed
{
	/* Attributs */

	/**
	* Index de la permission
	*
	* @var int
	*/
	protected $id;
	/**
	* Nom du rôle ayant la permission
	*
	* @var string
	*/
	protected $nom_role;
	/**
	* Application dans laquelle agit la permission
	*
	* @var string
	*/
	protected $application;
	/**
	* Action pour laquelle la permission est demandée
	*
	* @var string
	*/
	protected $action;

	/* Accesseurs */

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
	* Accesseur de nom_role
	*
	* @return string
	*/
	public function getNom_role()
	{
		return $this->nom_role;
	}
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

	/* Définisseurs */

	/**
	* Définisseur de id
	*
	* @param int id Index de la permission
	*
	* @return void
	*/
	protected function setId($id)
	{
		$this->id=(int)$id;
	}
	/**
	* Définisseur de nom_role
	*
	* @param string nom_role Nom du rôle ayant la permission
	*
	* @return void
	*/
	protected function setNom_role($nom_role)
	{
		$this->nom_role=$nom_role;
	}
	/**
	* Définisseur de application
	*
	* @param string application Application dans laquelle agit la permission
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
	* @param string action Action pour laquelle la permission est demandée
	*
	* @return void
	*/
	protected function setAction($action)
	{
		$this->action=$action;
	}

	/* Autres méthodes */

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
	* Afficheur de nom_role
	*
	* @return string
	*/
	public function afficherNom_role()
	{
		return htmlspecialchars((string)$this->nom_role);
	}
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
	* Afficher la permission
	*
	* @return string
	*/
	public function afficher()
	{
		htmlspecialchars($this->afficherApplication.'-'.$this->afficherAction);
	}
	/**
	* Récupère une permission à partir de son id
	*
	* @return void
	*/
	public function recuperer()
	{
		if ($this->getId())
		{
			$PermissionManager=$this->Manager();
			$this->hydrater($PermissionManager->get($this->getId()));
		}
	}
}

?>