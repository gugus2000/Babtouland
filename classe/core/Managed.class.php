<?php

namespace core;

/**
* Objet managé par un Manager
*/
class Managed
{
	/* Constante */

	/**
	* Critères (attributs) permettant de vérifier une similarité
	*
	* @var array
	*/
	const CRITERES_SIMILAIRE=array('id');
	/**
	* Index
	*
	* @var mixed
	*/
	const INDEX='id';

	/* Autre méthode */

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
	* Donne le nom de la fonction accesseur d'un attribut
	*
	* @param string attribut Attribut dont on veut l'accesseur
	* 
	* @return string
	*/
	public function getGet($attribut)
	{
		return 'get'.ucfirst($attribut);
	}
	/**
	* Donne le nom de la fonction définisseur d'un attribut
	*
	* @param string attribut Attribut dont on veut le définisseur
	* 
	* @return string
	*/
	public function getSet($attribut)
	{
		return 'set'.ucfirst($attribut);
	}
	/**
	* Donne le nom de la fonction affichage d'un attribut
	*
	* @param string attribut Attribut dont on veut l'afficheur
	* 
	* @return string
	*/
	public function getAff($attribut)
	{
		return 'afficher'.ucfirst($attribut);
	}
	/**
	* Défini l'afficheur d'un attribut
	*
	* @param string attribut Nom de l'attribut
	* 
	* @return string
	*/
	public function setAffichage($attribut)
	{
		return htmlspecialchars((string)$this->$attribut);
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
			$method=$this->getSet($key);
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
		$this->hydrater($this->Manager()->get($index));
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
			$accesseur=$this->getGet($critere);
			if ($this->$accesseur()==$objet->$accesseur())
			{
				$resultat+=1;
			}
		}
		return $resultat==count($this::CRITERES_SIMILAIRE);
	}
	/**
	* Retourne un tableau représentant l'objet managé
	* 
	* @return array
	*/
	public function table()
	{
		$array=array();
		foreach ($this->Manager()::ATTRIBUTES as $attribut)
		{
			$accesseur=$this->getGet($attribut);
			if (method_exists($this, $accesseur))
			{
				if ($this->$accesseur()!=null)
				{
					$array[$attribut]=$this->$accesseur();
				}
			}
		}
		return $array;
	}
	/**
	* Récupère un objet dans la base de donnée
	* 
	* @return void
	*/
	public function recuperer()
	{
		$getter=$this->getGet($this::INDEX);
		$this->get($this->$getter());
	}
	/**
	* Insérer l'objet dans la base de donnée
	* 
	* @return void
	*/
	public function creer()
	{
		$this->Manager()->add($this->table());
		$this->setId($this->Manager()->getIdBy($this->table()));
	}
	/**
	* Modifie un objet dans la base de donnée
	* 
	* @return void
	*/
	public function modifier()
	{
		$getter=$this->getGet($this::INDEX);
		$this->Manager()->update($this->table(), $this->$getter());
	}
	/**
	* Supprime un objet dans la base de donnée
	* 
	* @return void
	*/
	public function supprimer()
	{
		$getter=$this->getGet($this::INDEX);
		$this->Manager()->delete($this->$getter());
	}

}

?>