<?php

namespace core;

/**
* Connexion entre un objet et la base de donnée qui le caractérise
*/
class Manager
{
	/**
	* Construction du Manager
	*
	* @param PDO bdd Connexion avec la base de donnée
	*
	* @return void
	*/
	public function __construct($bdd)
	{
		$this->setBdd($bdd);
	}

	/* Attributs */
	
	/**
	* Connexion avec la base de donnée
	*
	* @var PDO
	*/
	protected $bdd;

	/* Constantes */

	/**
	* Nom de la table lié à l'objet
	*
	* @var string
	*/
	const TABLE='';
	/**
	* Liste de tous les attributs de la table
	*
	* @var array
	*/
	const ATTRIBUTES=array();
	/**
	* Index utilisé (clef primaire)
	*
	* @var string
	*/
	const INDEX='id';
	
	/* Accesseurs */

	/**
	* Accesseur de bdd
	*
	* @return PDO
	*/
	public function getBdd()
	{
		return $this->bdd;
	}
	
	/* Définisseurs */

	/**
	* Définisseur de bdd
	*
	* @param PDO bdd Connexion à la base de donnée
	*
	* @return void
	*/
	protected function setBdd($bdd)
	{
		$this->bdd=$bdd;
	}
	
	/* Autres méthodes */

	/**
	* Récupère le résulat d'une requête Mysql sur un élément
	*
	* @param mixed index Index de l'élément
	*
	* @return array
	*/
	public function get($index)
	{
		$requete=$this->getBdd()->prepare('SELECT '.implode(',', $this::ATTRIBUTES).' FROM '.$this::TABLE.' WHERE '.$this::INDEX.'=?');
		$requete->execute(array($index));
		return $requete->fetch(\PDO::FETCH_ASSOC);
	}
	/**
	* Ajoute un élément dans la base de donnée
	*
	* @param array attributs Tableau contenant le nom et la valeur de chaque attribut
	*
	* @return void
	*/
	public function add($attributs)
	{
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));	// Le tableau ne contient que les attributs valides
		$requete=$this->getBdd()->prepare('INSERT INTO '.$this::TABLE.'('.implode(',', array_keys($attributs)).') VALUES ('.implode(',', array_fill(0, count($attributs), '?')).')');
		$requete->execute(array_values($attributs));
	}
	/**
	* Met à jour un élément de la base de donnée
	*
	* @param array attributs Tableau contenant le nom et la valeur de chaque attribut a modifier
	* 
	* @param mixed index Index de l'élément à modifier
	*
	* @return void
	*/
	public function update($attributs, $index)
	{
		$attributsWithOperators=array();
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($attributs as $nom => $valeur)
		{
			$attributsWithOperators[]=$nom.'=?';
		}
		$requete=$this->getBdd()->prepare('UPDATE '.$this::TABLE.' SET '.implode(',', $attributsWithOperators).' WHERE '.$this::INDEX.'=?');
		array_push($attributs,$index);
		$requete->execute(array_values($attributs));
	}
	/**
	* Supprime un élément de la base de donnée
	*
	* @param mixed index Index de l'élément à supprimer
	*
	* @return void
	*/
	public function delete($index)
	{
		$requete=$this->getBdd()->prepare('DELETE FROM '.$this::TABLE.' WHERE '.$this::INDEX.'=?');
		$requete->execute(array($index));
	}
	/**
	* Obtient l'index de l'élément
	*
	* @param array attributs Tableau contenant le nom et la valeur de chaque attributs permettant de déterminer l'index de l'élément
	*
	* @return string
	*/
	public function getIdBy($attributs)
	{
		$attributsWithOperators=array();
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($attributs as $nom => $valeur)
		{
			$attributsWithOperators[]=$nom.'=?';
		}
		$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.' WHERE '.implode(' AND ', $attributsWithOperators));
		$requete->execute(array_values($attributs));
		return $requete->fetch(\PDO::FETCH_ASSOC)[$this::INDEX];
	}
	/**
	* Obtient l'index de l'élément à partir de sa position par rapport à un attribut
	*
	* @param int position Position de l'élément (0=premier)
	*
	* @param string attribut Attribut sur lequel se positionne l'élément
	* 
	* @return string
	*/
	public function getIdByPos($position, $attribut)
	{
		$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.' ORDER BY '.$attribut.' DESC LIMIT 1 OFFSET '.$position);
		$requete->execute();
		return $requete->fetch(\PDO::FETCH_ASSOC)[$this::INDEX];
	}
	/**
	* Récupère le résultat de la requête MYSQL crée à partir des paramètres
	*
	* @param array attributs Tableau contenant le nom et la valeur de chaque attribut
	* 
	* @param array operations Tableau contenant le nom et l'opération à exécuter sur chaque attributs
	*
	* @return array
	*/
	public function getBy($attributs, $operations)
	{
		$attributsWithOperators=array();
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($attributs as $nom => $valeur)
		{
			$attributsWithOperators[]=$nom.$operations[$nom].'?';
		}
		$requete=$this->getBdd()->prepare('SELECT '.implode(',', $this::ATTRIBUTES).' FROM '.$this::TABLE.' WHERE '.implode(' AND ', $attributsWithOperators).'');
		$requete->execute(array_values($attributs));
		$results=array();
		while ($result=$requete->fetch(\PDO::FETCH_ASSOC))
		{
			array_push($results, $result);
		}
		return $results;
	}
	/**
	* Vérifie l'existence d'un élément
	*
	* @param mixed index Index de l'élément à vérifier
	*
	* @return bool
	*/
	public function existId($index)
	{
		$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.' WHERE id=?');
		$requete->execute(array($index));
		return (bool)$requete->fetch(\PDO::FETCH_ASSOC);
	}
	/**
	* Vérifie l'existence d'un élément
	*
	* @param array attributs Tableau contenant le nom et la valeur de chaque attributs de l'élément
	*
	* @return bool
	*/
	public function exist($attributs)
	{
		$attributsWithOperators=array();
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($attributs as $nom => $valeur)
		{
			$attributsWithOperators[]=$nom.'=?';
		}
		$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.' WHERE '.implode(' AND ', $attributsWithOperators).'');
		$requete->execute(array_values($attributs));
		return (bool)$requete->fetch(\PDO::FETCH_ASSOC);
	}
	/**
	* Compte le nombre d'élément dans la base de donnée
	*
	* @return int
	*/
	public function count()
	{
		$requete=$this->getBdd()->prepare('SELECT count('.$this::INDEX.') AS nbr FROM '.$this::TABLE);
		$requete->execute();
		$donnees=$requete->fetch(\PDO::FETCH_ASSOC);
		return (int)$donnees['nbr'];
	}
}

?>