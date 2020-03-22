<?php

namespace core;

/**
* Manager d'une table de liaison entre deux autres tables de données
*/
class LiaisonManager extends \core\Manager
{
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
	public function get($attribut, $index=null)
	{
		if ($index!=null)
		{
			if (in_array($attribut, $this::ATTRIBUTES))
			{
				$requete=$this->getBdd()->prepare('SELECT '.implode(',', $this::ATTRIBUTES).' FROM '.$this::TABLE.' WHERE '.$attribut.'=?');
				$requete->execute(array($index));
				return $requete->fetchAll();
			}
		}
		return False;
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
			$true_attributes=array();
			if ($strict)
			{
				$attributs_count=array();
			}
			foreach ($attributs as $index => $condition)
			{
				$conditionCreator=$this->conditionCreator($condition, $operations[$index]);
				$attributs_operateurs[$index]=$conditionCreator[0];
				$condition=$conditionCreator[1];
				$true_attributes=array_merge($true_attributes, array_values($condition));
			}
			if ($strict)
			{
				$keys=array_keys_multi($attributs);
				foreach ($keys as $key)
				{
					$attributs_count[]='COUNT('.$key.')='.(string)count(array_column($attributs, $key));
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
			$requete->execute(array_values_recursive($true_attributes));
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
	/**
	* Récupère les objets de façon rapide
	*
	* @param array attributs Tableau contenant le nom et la valeur de chaque attribut
	*
	* @param array operations Tableau contenant le nom et l'opération à exécuter sur chaque attributs
	*
	* @param string name_class Nom de la classe des objets à récupérer
	*
	* @param array name_id Tableau contenant 'bdd' le nom de l'index utilisé pour la récupération de l'objet et 'obj' le nom de l'attribut utilisé comme index
	*
	* @param int recuperate 0 pas de récupération, 1 récupération groupé, 2 récupération une à une
	* 
	* @return array
	*/
	public function recuperateBy($attributs=null, $operations=null, $name_class=null, $name_id=null, $recuperate=1)
	{
		if ($name_class===null)
		{
			preg_match('/[A-Z]+[a-z]+$/', get_class($this), $matches);	// Denier Objet précisé dans le nom
			$name_class=$matches[0];
			preg_match('/^((\w+\\\)+)/', get_class($this), $matches);
			$name_class='\\'.$matches[0].$name_class;
		}
		if ($name_id===null)
		{
			$name_id=array(
				'bdd' => 'id_'.strtolower(get_class_name($name_class)),
				'obj' => 'id',
			);
		}
		$results=$this->getBy($attributs, $operations);
		switch ($recuperate)
		{
			case 0:
				$Objects=array();
				foreach ($results as $result)
				{
					$Objects[]=new $name_class(array($name_id['obj'] => $result[$name_id['bdd']]));
				}
				return $Objects;
				break;
			case 1:
				$name_manager=$name_class.'Manager';
				$Manager=new $name_manager(\core\BDDFactory::MysqlConnexion());
				return $Manager->recuperateBy(array(
					$name_id['obj'] => array_column($results, $name_id['bdd']),
				), array(
					$name_id['obj'] => 'IN',
				));
				break;
			case 2:
				$Objects=array();
				foreach ($results as $result)
				{
					$Object=new $name_class(array($name_id['obj'] => $name_id['bdd']));
					$Object->recuperer();
					$Objects[]=$Object;
				}
				return $Objects;
				break;
			defaut:			// Ne devrait jamais arriver
				$Objects=array();
				foreach ($results as $result)
				{
					$Objects[]=new $name_class(array($name_id['obj'] => $result[$name_id['bdd']]));
				}
				return $Objects;
				break;
		}
	}
}

?>