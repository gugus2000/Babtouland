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
	* Ajoute les éléments dans la table avec des paramètres variants et invariants
	*
	* @param array variants Valeurs variantes à chaque élément
	*
	* @param array invariants Valeurs invariantes communes à tous les éléments à ajouter
	* 
	* @return void
	*/
	public function addBy($variants, $invariants)
	{
		$variants=array_intersect_key($variants, array_flip($this::ATTRIBUTES));
		$variant=array_intersect_key($invariants, array_flip($this::ATTRIBUTES));
		$attributs=array_merge(array_keys($variants),array_keys($invariants));
		$donnees=array();
		$nombre_elements=count($variants[array_keys($variants)[0]]);	// Le nombre d'éléments à insérer est le nombre de valeur dans les premières valeurs variantes
		for ($i=0; $i < $nombre_elements; $i++)
		{ 
			$donnee=array();
			foreach ($variants as $attribut => $valeurs)
			{
				$donnee[$attribut]=$valeurs[$i];
			}
			foreach ($invariants as $attribut => $valeur)
			{
				$donnee[$attribut]=$valeur;
			}
			$donnees[]=$donnee;	// donnees est un tableau contenant les attributs et leur valeur pour chaque élément
		}
		foreach ($donnees as $donnee)
		{
			$requete=$this->getBdd()->prepare('INSERT INTO '.$this::TABLE.'('.implode(',', $attributs).') VALUES ('.implode(',', array_fill(0, count($attributs), '?')).')');
			$requete->execute(array_values($donnee));
		}
	}
	/**
	* Supprime des éléments de la base de données en fonction de paramètres définis
	*
	* @param array attributs Paramètre permettant de déterminer l'élément à supprimer
	* 
	* @return void
	*/
	public function deleteBy($attributs)
	{
		$attributsWithOperators=array();
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($attributs as $nom => $valeur)
		{
			$attributsWithOperators[]=$nom.'=?';
		}
		$requete=$this->getBdd()->prepare('DELETE FROM '.$this::TABLE.' WHERE '.implode(' AND ', $attributsWithOperators));
		$requete->execute(array_values($attributs));
	}
}

?>