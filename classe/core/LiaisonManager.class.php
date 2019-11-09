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
	* Vérifie l'existence d'un element lié à la base de données respectant certaines conditions (cf. chat/envoyer_mp)
	*
	* @param array conditions Conditions à respecter
	*
	* @param string groupe Lien avec l'élément à vérifier
	* 
	* @return bool
	*/
	public function exist($conditions, $groupe)
	{
		if (!in_array($groupe, $this::ATTRIBUTES))	// L'élément n'est pas lié à la base de donnée
		{
			return False;
		}
		$donnees=array();
		$attributs_egalite=array();
		$valeurs_tous=array();
		foreach ($conditions as $index => $condition)
		{
			array_intersect_key($condition, array_flip($this::ATTRIBUTES));
			$attributs_egalite[$index]=array();
			foreach ($condition as $attribut => $valeur)
			{
				$attributs_egalite[$index][]=$attribut.'=?';
				if (!isset($donnees[$attribut]))
				{
					$donnees[$attribut]=array();
				}
				$donnees[$attribut][]=$valeur;
				$valeurs_tous[]=$valeur;
			}
		}

		$attributs_count=array();
		foreach ($donnees as $attribut => $valeurs)
		{
			$attributs_count[]='COUNT('.$attribut.')='.(string)count($valeurs);
		}
		$select_count='(SELECT '.$groupe.' FROM '.$this::TABLE.' GROUP BY '.$groupe.' HAVING '.implode(' AND ', $attributs_count).')';
		$selects_avec_nom_table=array();
		$egalites_join_avec_nom_table=array();
		$nbr_conditions=count($conditions);
		for ($index=0; $index < $nbr_conditions; $index++)
		{
			$selects_avec_nom_table[]='(SELECT '.$groupe.' FROM '.$this::TABLE.' WHERE '.implode(' AND ', $attributs_egalite[$index]).' AND '.$groupe.' IN '.$select_count.') AS table_'.$index;
			if ($index+1<$nbr_conditions)
			{
				$egalites_join_avec_nom_table[]='table_'.$index.'.'.$groupe.'=table_'.(string)($index+1).'.'.$groupe;
			}
		}
		$groupe_avec_nom_table='table_0.'.$groupe;
		$select='SELECT '.$groupe_avec_nom_table.' FROM '.implode(' JOIN ', $selects_avec_nom_table).' WHERE '.implode(' AND ', $egalites_join_avec_nom_table).' GROUP BY '.$groupe_avec_nom_table;
		$requete=$this->getBdd()->prepare($select);
		$requete->execute($valeurs_tous);
		return (bool)$requete->fetch(\PDO::FETCH_ASSOC);
	}
	/**
	* Selectionne les éléments respectant certaines conditions (cf. chat/envoyer_mp)
	*
	* @param array conditions Conditions à respecter
	*
	* @param string groupe Attribut de l'élément à vérifier
	* 
	* @return array
	*/
	public function getBy($conditions, $groupe)
	{
		if (!in_array($groupe, $this::ATTRIBUTES))	// L'élément n'est pas lié à la base de donnée
		{
			return False;
		}
		$donnees=array();
		$attributs_egalite=array();
		$valeurs_tous=array();
		foreach ($conditions as $index => $condition)
		{
			array_intersect_key($condition, array_flip($this::ATTRIBUTES));
			$attributs_egalite[$index]=array();
			foreach ($condition as $attribut => $valeur)
			{
				$attributs_egalite[$index][]=$attribut.'=?';
				if (!isset($donnees[$attribut]))
				{
					$donnees[$attribut]=array();
				}
				$donnees[$attribut][]=$valeur;
				$valeurs_tous[]=$valeur;
			}
		}

		$attributs_count=array();
		foreach ($donnees as $attribut => $valeurs)
		{
			$attributs_count[]='COUNT('.$attribut.')='.(string)count($valeurs);
		}
		$select_count='(SELECT '.$groupe.' FROM '.$this::TABLE.' GROUP BY '.$groupe.' HAVING '.implode(' AND ', $attributs_count).')';
		$selects_avec_nom_table=array();
		$egalites_join_avec_nom_table=array();
		$nbr_conditions=count($conditions);
		for ($index=0; $index < $nbr_conditions; $index++)
		{
			$selects_avec_nom_table[]='(SELECT '.$groupe.' FROM '.$this::TABLE.' WHERE '.implode(' AND ', $attributs_egalite[$index]).' AND '.$groupe.' IN '.$select_count.') AS table_'.$index;
			if ($index+1<$nbr_conditions)
			{
				$egalites_join_avec_nom_table[]='table_'.$index.'.'.$groupe.'=table_'.(string)($index+1).'.'.$groupe;
			}
		}
		$groupe_avec_nom_table='table_0.'.$groupe;
		$select='SELECT '.$groupe_avec_nom_table.' FROM '.implode(' JOIN ', $selects_avec_nom_table).' WHERE '.implode(' AND ', $egalites_join_avec_nom_table).' GROUP BY '.$groupe_avec_nom_table;
		$requete=$this->getBdd()->prepare($select);
		$requete->execute($valeurs_tous);
		$resultats=array();
		while ($result=$requete->fetch(\PDO::FETCH_ASSOC))
		{
			$resultats[]=$result;
		}
		return $resultats;
	}
}

?>