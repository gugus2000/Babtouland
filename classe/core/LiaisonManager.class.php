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
	* Récupère les entrées avec un index donnée dans une colonne donnée
	* 
	* @param string attribut Attribut pour l'index donné
	*
	* @param mixed index Index de l'élément
	* 
	* @return mixed
	*/
	public function get($attribut, $index)
	{
		if (in_array($attribut, $this::ATTRIBUTES))
		{
			$requete=$this->getBdd()->prepare('SELECT '.implode(',', $this::ATTRIBUTES).' FROM '.$this::TABLE.' WHERE '.$attribut.'=?');
			$requete->execute(array($index));
			return $requete->fetchAll();
		}
		return False;
	}
	/**
	* Récupère les entrées avec des paramètres précis
	*
	* @param array attributs Tableau contenant le nom et la valeur de chaque attribut
	*
	* @param array operations Tableau contenant le nom et l'opération à exécuter sur chaque attributs
	* 
	* @return mixed
	*/
	public function getBy($attributs, $operations)
	{
		$attributsWithOperators=array();
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($attributs as $nom => $valeur)
		{
			$attributsWithOperators[]=$nom.$operations[$nom].'?';
		}
		$requete=$this->getBdd()->prepare('SELECT '.implode(',', $this::ATTRIBUTES).' FROM '.$this::TABLE.' WHERE '.implode(' AND ', $attributsWithOperators));
		$requete->execute(array_values($attributs));
		return $requete->fetchAll();
	}
	/**
	* Récupère les entrée ayant plusieurs autres mêmes attributs ayant des valeurs particulières
	*
	* @param array attributs Tableau de tableau d'attributs avec leurs valeurs
	*
	* @param array operations Tableau de tableau d'operations
	*
	* @param string groupe Attribut utilisé pour grouper
	*
	* @param bool strict Si le mode strict est activé ou non (si le nombre d'attributs dans ce groupe doit correspondre exactement )
	* 
	* @return mixed
	*/
	public function getByGroup($attributs, $operations, $groupe, $strict=False)
	{
		if (in_array($groupe, $this::ATTRIBUTES))
		{
			$donnees=array();
			$attributs_operateurs=array();
			$valeurs_tous=array();
			foreach ($attributs as $index => $condition)
			{
				array_intersect_key($condition, array_flip($this::ATTRIBUTES));
				$attributs_operateurs[$index]=array();
				foreach ($condition as $attribut => $valeur)
				{
					$attributs_operateurs[$index][]=$attribut.$operations[$index][$attribut].'?';
					if (!isset($donnees[$attribut]))
					{
						$donnees[$attribut]=array();
					}
					$donnees[$attribut][]=$valeur;
					$valeurs_tous[]=$valeur;
				}
			}
			if ($strict)
			{
				$attributs_count=array();
				foreach ($donnees as $attribut => $valeurs)
				{
					$attributs_count[]='COUNT('.$attribut.')='.(string)count($valeurs);
				}
				$condition_count=' AND '.$groupe.' IN (SELECT '.$groupe.' FROM '.$this::TABLE.' GROUP BY '.$groupe.' HAVING '.implode(' AND ', $attributs_count).')';
			}
			else
			{
				$condition_count='';
			}
			$selects_avec_nom_table=array();
			$egalites_join_avec_nom_table=array();
			$nbr_conditions=count($attributs);
			for ($index=0; $index < $nbr_conditions; $index++)
			{
				$selects_avec_nom_table[]='(SELECT '.$groupe.' FROM '.$this::TABLE.' WHERE '.implode(' AND ', $attributs_operateurs[$index]).$condition_count.') AS table_'.$index;
				if ($index+1<$nbr_conditions)
				{
					$egalites_join_avec_nom_table[]='table_'.$index.'.'.$groupe.'=table_'.(string)($index+1).'.'.$groupe;
				}
			}
			$groupe_avec_nom_table='table_0.'.$groupe;
			if (count($egalites_join_avec_nom_table)==0)
			{
				$where_egalites_join='';
			}
			else
			{
				$where_egalites_join=' WHERE '.implode(' AND ', $egalites_join_avec_nom_table);
			}
			$select='SELECT '.$groupe_avec_nom_table.' FROM '.implode(' JOIN ', $selects_avec_nom_table).$where_egalites_join.' GROUP BY '.$groupe_avec_nom_table;
			$requete=$this->getBdd()->prepare($select);
			$requete->execute($valeurs_tous);
			return $requete->fetchAll();
		}
		return False;
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
		foreach ($variants as $variant)
		{
			$variant=array_intersect_key($variant, array_flip($this::ATTRIBUTES));
		}
		$invariants=array_intersect_key($invariants, array_flip($this::ATTRIBUTES));
		$attributs=array_merge(array_keys($variants[\array_key_first($variants)]),array_keys($invariants));
		$donnees=array();
		for ($i=0; $i < count($variants); $i++)
		{ 
			$donnee=array();
			foreach ($variants[$i] as $attribut => $valeur)
			{
				$donnee[$attribut]=$valeur;
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
	/**
	* Vérifie l'existence d'au moins un élément ayant un attribut avec une valeur particulière
	*
	* @param string attribut Attribut donné
	*
	* @param mixed index Valeur de l'attribut
	* 
	* @return bool
	*/
	public function exist($attribut, $index)
	{
		return (bool)$this->get($attribut, $index);
	}
	/**
	* Vérifie l'existence d'au moins une entrée ayant plusieurs autres mêmes attributs ayant des valeurs particulières
	*
	* @param array attributs Tableau de tableau d'attributs avec leurs valeurs
	*
	* @param array operations Tableau de tableau d'operations
	*
	* @param string groupe Attribut utilisé pour grouper
	*
	* @param bool strict Si le mode strict est activé ou non (si le nombre d'attributs dans ce groupe doit correspondre exactement )
	* 
	* @return bool
	*/
	public function existByGroup($attributs, $operations, $groupe, $strict=False)
	{
		return (bool)$this->getByGroup($attributs, $operations, $groupe, $strict);
	}
}

?>