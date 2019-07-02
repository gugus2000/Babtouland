<?php

namespace core;

/**
* Objet managé par un Manager
*/
class Managed
{
	/* Autres méthodes */

	/**
	* Construction de l'objet
	*
	* @param array attributs Attributs de l'objet
	*
	* @return void
	*/
	public function __construct($attributs=array())
	{
		$this->hydrater($attributs);
	}
	/**
	* Hydrate l'objet
	*
	* @param array attributs Tableau contenant le nom et la valeur de chaque attribut de l'objet
	*
	* @return void
	*/
	public function hydrater($attributs)
	{
		foreach ($attributs as $key => $value)
		{
			$method='set'.ucfirst($key);
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}
	/**
	* Crée une instance de la clase du manager de l'objet managé
	*
	* @return Manager
	*/
	public function Manager()
	{
		$BDDFactory=new \core\BDDFactory;
		$object=get_class($this).'Manager';
		return new $object($BDDFactory->MysqlConnexion());
	}
	/**
	* Remplir l'objet managé
	*
	* @param mixed index Index de l'objet managé
	*
	* @return void
	*/
	public function get($index)
	{
		$Manager=$this->Manager();
		$this->hydrater($Manager->get($index));
	}

}

?>