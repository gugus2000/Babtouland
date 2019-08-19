<?php

namespace core;

/**
* Manager d'une table de liaison entre deux autres tables de données
*/
class LiaisonManager
{
	/**
	* Construction du Manager
	*
	* @param PDO bdd Connexion avec la base de donnée
	* 
	* @param array attributs Liste des attributs de la table déjà connus
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
	* Récupère certains attributs de la table
	*
	* @param array attributs Tableau contenant le nom et la valeur de chaque attribut
	* 
	* @param array operations Tableau contenant le nom et l'opération à exécuter sur chaque attributs
	*
	* @return array
	*/
	public function get($attributs, $operations)
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
	* Ajoute les éléments dans l'array avec des paramètres variants et invariants
	*
	* @param array variants Valeurs variantes à chaque élément
	*
	* @param array invariants Valeurs invariantes communes à tous les éléments à ajouter
	* 
	* @return void
	*/
	public function addBy($variants, $invariants)
	{
		$attributs=array();
		foreach ($variants as $attribut => $valeurs)
		{
			$attributs[]=$attribut;
		}
		foreach ($invariants as $attribut => $valeur)
		{
			$attributs[]=$attribut;
		}
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($valeurs as $key => $valeur)
		{
			$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));	// Le tableau ne contient que les attributs valides
			$requete=$this->getBdd()->prepare('INSERT INTO '.$this::TABLE.'('.implode(',', array_keys($attributs)).') VALUES ('.implode(',', array_fill(0, count($attributs), '?')).')');
			$requete->execute(array_values($attributs));
		}
	}
}

?>