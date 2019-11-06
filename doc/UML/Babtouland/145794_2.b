class Manager
!!!240642.php!!!	__construct(in bdd : )

		$this->setBdd($bdd);
!!!240770.php!!!	getBdd()

		return $this->bdd;
!!!240898.php!!!	setBdd(in bdd : )

		$this->bdd=$bdd;
!!!241026.php!!!	get(in index : )

		$requete=$this->getBdd()->prepare('SELECT '.implode(',', $this::ATTRIBUTES).' FROM '.$this::TABLE.' WHERE '.$this::INDEX.'=?');
		$requete->execute(array($index));
		return $requete->fetch(\PDO::FETCH_ASSOC);
!!!241154.php!!!	add(in attributs : )

		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));	// Le tableau ne contient que les attributs valides
		$requete=$this->getBdd()->prepare('INSERT INTO '.$this::TABLE.'('.implode(',', array_keys($attributs)).') VALUES ('.implode(',', array_fill(0, count($attributs), '?')).')');
		$requete->execute(array_values($attributs));
!!!241282.php!!!	update(in attributs : , in index : )

		$attributsWithOperators=array();
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($attributs as $nom => $valeur)
		{
			$attributsWithOperators[]=$nom.'=?';
		}
		$requete=$this->getBdd()->prepare('UPDATE '.$this::TABLE.' SET '.implode(',', $attributsWithOperators).' WHERE '.$this::INDEX.'=?');
		array_push($attributs,$index);
		$requete->execute(array_values($attributs));
!!!241410.php!!!	delete(in index : )

		$requete=$this->getBdd()->prepare('DELETE FROM '.$this::TABLE.' WHERE '.$this::INDEX.'=?');
		$requete->execute(array($index));
!!!241538.php!!!	getIdBy(in attributs : )

		$attributsWithOperators=array();
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($attributs as $nom => $valeur)
		{
			$attributsWithOperators[]=$nom.'=?';
		}
		$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.' WHERE '.implode(' AND ', $attributsWithOperators));
		$requete->execute(array_values($attributs));
		return $requete->fetch(\PDO::FETCH_ASSOC)[$this::INDEX];
!!!241666.php!!!	getIdByPos(in position : , in attribut : )

		$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.' ORDER BY '.$attribut.' DESC LIMIT 1 OFFSET '.$position);
		$requete->execute();
		return $requete->fetch(\PDO::FETCH_ASSOC)[$this::INDEX];
!!!241794.php!!!	getBy(in attributs : , in operations : )

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
!!!241922.php!!!	existId(in index : )

		$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.' WHERE id=?');
		$requete->execute(array($index));
		return (bool)$requete->fetch(\PDO::FETCH_ASSOC);
!!!242050.php!!!	exist(in attributs : )

		$attributsWithOperators=array();
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($attributs as $nom => $valeur)
		{
			$attributsWithOperators[]=$nom.'=?';
		}
		$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.' WHERE '.implode(' AND ', $attributsWithOperators).'');
		$requete->execute(array_values($attributs));
		return (bool)$requete->fetch(\PDO::FETCH_ASSOC);
!!!242178.php!!!	count()

		$requete=$this->getBdd()->prepare('SELECT count('.$this::INDEX.') AS nbr FROM '.$this::TABLE);
		$requete->execute();
		$donnees=$requete->fetch(\PDO::FETCH_ASSOC);
		return (int)$donnees['nbr'];
