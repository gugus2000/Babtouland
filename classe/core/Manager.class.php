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
	* Vérifie l'existence de chaque attribut dans la liste comme étant un attribut de la table sélectionnée
	*
	* @param array attributs Liste à vérifier
	* 
	* @return array
	*/
	public function testAttributes($attributs)
	{
		return array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
	}
	/**
	* Associations entre valeurs et opérations
	*
	* @param array attributs Tableau contenant le nom et la valeur de chaque attribut
	*
	* @param mixed operations Tableau contenant le nom et l'opération à effectuer sur chaque attribut ou opération à effctuer sur chaque attribut
	* 
	* @return array
	*/
	public function conditionCreator($attributs, $operations)
	{
		$attributs=$this->testAttributes($attributs);
		$attributsWithOperators=array();
		if (!empty($attributs) & $attributs!=null)
		{
			if (is_array($operations))
			{
				foreach ($attributs as $nom => $valeur)
				{
					if (isset($operations[$nom]))
					{
						switch (trim($operations[$nom]))
						{
							case 'IN':
								if (!isset($array_keys_attributes))
								{
									$array_keys_attributes=array_keys($attributs);
								}
								$attributsWithOperators[]=$nom.' IN ('.str_repeat('?, ', count($valeur)-1).'?)';
								$array_search_result=array_search($nom, $array_keys_attributes);
								if (count($attributs)>1)
								{
									if ($array_search_result<=0)
									{
										$attributs=array_merge($valeur,array_slice($attributs, 1));
									}
									else if ($array_search_result>=count($attributs)-1)
									{
										$attributs=array_merge(array_slice($attributs, 0, count($attribut)-1), $valeur);
									}
									else
									{
										$attributs=array_merge(array_slice($attributs, 0, $array_search_result, true),$valeur,array_slice($attributs, $array_search_result+1, null, true));
									}
								}
								else
								{
									$attributs=$valeur;
								}
								break;
							case '=':
							case '!=':
							case '<>':
							case '>':
							case '<':
							case '>=':
							case '<=':
								$attributsWithOperators[]=$nom.$operations[$nom].'?';
								break;
							default:
								throw new \Exception('Error unknown operation');
								break;
						}
					}
					else
					{
						$attributsWithOperators[]=$nom.'=?';
					}
				}
			}
			else if (is_string($operations))
			{
				switch (trim($operations))
				{
					case 'IN':
						foreach ($attributs as $nom => $valeur)
						{
							if (!isset($array_keys_attributes))
							{
								$array_keys_attributes=array_keys($attributs);
							}
							$attributsWithOperators[]=$nom.' IN ('.str_repeat('?, ', count($valeur)-1).'?)';
							$array_search_result=array_search($nom, $array_keys_attributes);
							if (count($attributs)>1)
							{
								if ($array_search_result<=0)
								{
									$attributs=array_merge($valeur,array_slice($attributs, 1));
								}
								else if ($array_search_result>=count($attributs)-1)
								{
									$attributs=array_merge(array_slice($attributs, 0, count($attribut)-1), $valeur);
								}
								else
								{
									$attributs=array_merge(array_slice($attributs, 0, $array_search_result, true),$valeur,array_slice($attributs, $array_search_result+1, null, true));
								}
							}
							else
							{
								$attributs=array($valeur);
							}
						}
						break;
					case '=':
					case '!=':
					case '<>':
					case '>':
					case '<':
					case '>=':
					case '<=':
						foreach ($attributs as $nom => $valeur)
						{
							$attributsWithOperators[]=$nom.$operations.'?';
						}
						break;
					default:
						throw new \Exception('Error unknown operation');
						break;
				}
			}
			else
			{
				foreach ($attributs as $nom => $valeur)
				{
					$attributsWithOperators[]=$nom.'=?';
				}
			}
		}
		return [$attributsWithOperators, $attributs];
	}
	/**
	* Permet de générer la clause sur la limite à partir d'un tableau complexe pour une requête mysql
	*
	* @param array bornes Bornes
	* 
	* @return string
	*/
	public function interpreterBornes($bornes)
	{
		if (isset($bornes['order_by']))
		{
			if (!in_array($bornes['order_by'], $this::ATTRIBUTES))
			{
				throw new \UnexpectedValueException((string)$bornes['ordre'].' not exist');
			}
			$order_by=$bornes['order_by'];
		}
		else if (isset($bornes['ordre']))
		{
			if (!in_array($bornes['ordre'], $this::ATTRIBUTES))
			{
				throw new \UnexpectedValueException((string)$bornes['ordre'].' not exist');
			}
			$order_by=$bornes['ordre'];
		}
		else
		{
			$order_by=$this::INDEX;
		}
		if (isset($bornes['fin']))
		{
			if (!is_numeric($bornes['fin']))
			{
				throw new \UnexpectedValueException((string)$bornes['fin'].' not numeric');
			}
			$ordre='DESC';
			$bornes['offset']=$bornes['fin'];
		}
		else
		{
			if (isset($bornes['sens']))
			{
				switch ($bornes['sens'])
				{
					case 'ASC':
					case 'DESC':
						$ordre=$bornes['sens'];
						break;
					default:
						$ordre='ASC';
						break;
				}
			}
			else
			{
				$ordre='ASC';
			}
		}
		if (isset($bornes['offset']))
		{
			if(!is_numeric($bornes['offset']))
			{
				throw new \UnexpectedValueException((string)$bornes['offset'].' not numeric');
			}
			$offset=$bornes['offset'];
		}
		else if (isset($bornes['position']))
		{
			if(!is_numeric($bornes['position']))
			{
				throw new \UnexpectedValueException((string)$bornes['position'].' not numeric');
			}
			$offset=$bornes['position'];
		}
		else if (isset($bornes['debut']))
		{
			if (!is_numeric($bornes['debut']))
			{
				throw new \UnexpectedValueException((string)$bornes['debut'].' not numeric');
			}
			$offset=$bornes['debut'];
		}
		else
		{
			$offset=0;
		}
		if (isset($bornes['limit']))
		{
			if(!is_numeric($bornes['limit']))
			{
				throw new \UnexpectedValueException((string)$bornes['limit'].' not numeric');
			}
			$limit=$bornes['limit'];
		}
		else if (isset($bornes['nombre']))
		{
			if(!is_numeric($bornes['nombre']))
			{
				throw new \UnexpectedValueException((string)$bornes['nombre'].' not numeric');
			}
			$limit=$bornes['nombre'];
		}
		else
		{
			$limit=1;
		}
		return 'ORDER BY '.$order_by.' '.$ordre.' LIMIT '.(string)$limit.' OFFSET '.(string)$offset;
	}
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
		$attributs=$this->testAttributes($attributs);
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
		$attributs=$this->testAttributes($attributs);
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
	* Supprime un élément de la base de donnée selon plusieurs paramètres
	*
	* @param array attributs Valeurs des attributs
	*
	* @param array operations Opérations sur les attributs
	* 
	* @return void
	*/
	public function deleteBy($attributs, $operations)
	{
		if (!empty($attributs) & $attributs!=null)
		{	
			$conditionCreator=$this->conditionCreator($attributs, $operations);
			$attributsWithOperators=$conditionCreator[0];
			$attributs=$conditionCreator[1];
			$where=' WHERE '.implode(' AND ', $attributsWithOperators).' ';
		}
		else
		{
			$where='';
		}
		$requete=$this->getBdd()->prepare('DELETE FROM '.$this::TABLE.$where);
		$requete->execute(array_values($attributs));
	}
	/**
	* Obtient l'index de l'élément
	*
	* @param array attributs Tableau contenant le nom et la valeur de chaque attributs permettant de déterminer l'index de l'élément
	*
	* @return string
	*/
	public function getIdBy($attributs, $operations='=')
	{
		if (!empty($attributs) & $attributs!=null)
		{	
			$conditionCreator=$this->conditionCreator($attributs, $operations);
			$attributsWithOperators=$conditionCreator[0];
			$attributs=$conditionCreator[1];
			$where=' WHERE '.implode(' AND ', $attributsWithOperators).' ';
		}
		else
		{
			$where='';
		}
		$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.$where);
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
		if (is_int($position) & in_array($attribut, $this::ATTRIBUTES))
		{
			$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.' ORDER BY '.$attribut.' DESC LIMIT 1 OFFSET '.$position);
			$requete->execute();
			return $requete->fetch(\PDO::FETCH_ASSOC)[$this::INDEX];
		}
		return False;
	}
	/**
	* Récupère le résultat de la requête MYSQL crée à partir des paramètres
	*
	* @param array attributs Tableau contenant le nom et la valeur de chaque attribut
	* 
	* @param array operations Tableau contenant le nom et l'opération à exécuter sur chaque attributs
	*
	* @param array bornes Tableau contenant les bornes dans lesquels chercher
	*
	* @return array
	*/
	public function getBy($attributs=null, $operations=null, $bornes=null)
	{
		if (!empty($attributs) & $attributs!=null)
		{	
			$conditionCreator=$this->conditionCreator($attributs, $operations);
			$attributsWithOperators=$conditionCreator[0];
			$attributs=$conditionCreator[1];
			$where=' WHERE '.implode(' AND ', $attributsWithOperators).' ';
		}
		else
		{
			$where='';
		}
		if ($bornes!=null)
		{
			$limite=$this->interpreterBornes($bornes);
		}
		else
		{
			$limite='';
		}
		$requete=$this->getBdd()->prepare('SELECT '.implode(',', $this::ATTRIBUTES).' FROM '.$this::TABLE.$where.$limite);
		$requete->execute(array_values($attributs));
		return $requete->fetchAll();
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
	public function existBy($attributs, $operations=null)
	{
		if (!empty($attributs) & $attributs!=null)
		{
			$conditionCreator=$this->conditionCreator($attributs, $operations);
			$attributsWithOperators=$conditionCreator[0];
			$attributs=$conditionCreator[1];
			$where=' WHERE '.implode(' AND ', $attributsWithOperators).' ';
		}
		else
		{
			$where='';
		}
		$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.$where);
		$requete->execute(array_values($attributs));
		return (bool)$requete->fetch(\PDO::FETCH_ASSOC);
	}
	/**
	* Compte le nombre d'élément dans la base de donnée qui respectent une clause précise
	*
	* @param array attributs Tableau contenant le nom et la valeur de chaque attribut
	* 
	* @param array operations Tableau contenant le nom et l'opération à exécuter sur chaque attributs
	* 
	* @return int
	*/
	public function countBy($attributs, $operations=null)
	{
		$attributsWithOperators=array();
		$attributs=$this->testAttributes($attributs);
		foreach ($attributs as $nom => $valeur)
		{
			if (isset($operations[$nom]))
			{
				$attributsWithOperators[]=$nom.$operations[$nom].'?';
			}
			else
			{
				$attributsWithOperators[]=$nom.'=?';
			}
		}
		if ($attributs & !empty($attributsWithOperators))
		{
			$where='WHERE '.implode(' AND ', $attributsWithOperators);
		}
		else
		{
			$where='';
		}
		$requete=$this->getBdd()->prepare('SELECT count('.$this::INDEX.') AS nbr FROM '.$this::TABLE.' '.$where);
		$requete->execute(array_values($attributs));
		$donnees=$requete->fetch(\PDO::FETCH_ASSOC);
		return (int)$donnees['nbr'];
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
	/**
	* Crée une instance de la classe du managed de l'objet sélectionné
	*
	* @param array table Tableau des attributs de l'objet à hydrater
	* 
	* @return \core\Managed
	*/
	public function Managed($table)
	{
		$object=$object=substr(get_class($this),0,-7);
		return new $object($table);
	}
	/**
	* Permet la récupération d'objet de façon plus rapide
	*
	* @param array attributs Tableau contenant le nom et la valeur de chaque attribut
	* 
	* @param array operations Tableau contenant le nom et l'opération à exécuter sur chaque attributs
	*
	* @param array bornes Tableau contenant les bornes dans lesquels chercher
	*
	* @return array
	*/
	public function recuperateBy($attributs=null, $operations=null, $bornes=null)
	{
		$results=$this->getBy($attributs, $operations, $bornes);
		$Objects=array();
		foreach ($results as $result)
		{
			$Objects[]=$this->Managed($result);
		}
		return $Objects;
	}
}

?>