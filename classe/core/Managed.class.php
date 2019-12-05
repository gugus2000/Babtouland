<?php

namespace core;

/**
* Objet managé par un Manager
*/
class Managed
{
	/* Constantes */

	/**
	* Critères (attributs) permettant de vérifier une similarité
	*
	* @var array
	*/
	const CRITERES_SIMILAIRE=array('id');

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
		if (!$attributs)
		{
			throw new \Exception($attributs);
		}
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
	/**
	* Vérifie si deux objets managé sont identiques
	*
	* @param Managed objet L'objet qui vérifie la similarité
	* 
	* @return bool
	*/
	public function similaire($objet)
	{
		$resultat=0;
		foreach ($this::CRITERES_SIMILAIRE as $critere)
		{
			$accesseur='get'.ucfirst($critere);
			if ($this->$accesseur()==$objet->$accesseur())
			{
				$resultat+=1;
			}
		}
		return $resultat==count($this::CRITERES_SIMILAIRE);
	}

}

?>