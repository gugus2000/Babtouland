class Manager
!!!135810.php!!!	__construct(in bdd : PDO) : void

		$this->setBdd($bdd);
!!!135938.php!!!	getBdd() : PDO

		return $this->bdd;
!!!136066.php!!!	setBdd(in bdd : PDO) : void

		$this->bdd=$bdd;
!!!136194.php!!!	get(in index : mixed) : array

		$requete=$this->getBdd()->prepare('SELECT '.implode(',', $this::ATTRIBUTES).' FROM '.$this::TABLE.' WHERE '.$this::INDEX.'=?');
		$requete->execute(array($index));
		return $requete->fetch(\PDO::FETCH_ASSOC);
!!!136322.php!!!	add(in attributs : array) : void

		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));	// Le tableau ne contient que les attributs valides
		$requete=$this->getBdd()->prepare('INSERT INTO '.$this::TABLE.'('.implode(',', array_keys($attributs)).') VALUES ('.implode(',', array_fill(0, count($attributs), '?')).')');
		$requete->execute(array_values($attributs));
!!!136450.php!!!	update(in attributs : array, in index : mixed) : void

		$attributsWithOperators=array();
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($attributs as $nom => $valeur)
		{
			$attributsWithOperators[]=$nom.'=?';
		}
		$requete=$this->getBdd()->prepare('UPDATE '.$this::TABLE.' SET '.implode(',', $attributsWithOperators).' WHERE '.$this::INDEX.'=?');
		array_push($attributs,$index);
		$requete->execute(array_values($attributs));
!!!136578.php!!!	delete(in index : mixed) : void

		$requete=$this->getBdd()->prepare('DELETE FROM '.$this::TABLE.' WHERE '.$this::INDEX.'=?');
		$requete->execute(array($index));
!!!136706.php!!!	getIdBy(in attributs : array) : string

		$attributsWithOperators=array();
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($attributs as $nom => $valeur)
		{
			$attributsWithOperators[]=$nom.'=?';
		}
		$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.' WHERE '.implode(' AND ', $attributsWithOperators));
		$requete->execute(array_values($attributs));
		return $requete->fetch(\PDO::FETCH_ASSOC)[$this::INDEX];
!!!136834.php!!!	getIdByPos(in position : int, in attribut : string) : string

		$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.' ORDER BY '.$attribut.' DESC LIMIT 1 OFFSET '.$position);
		$requete->execute();
		return $requete->fetch(\PDO::FETCH_ASSOC)[$this::INDEX];
!!!136962.php!!!	getBy(in attributs : array, in operations : array) : array

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
!!!137090.php!!!	existId(in index : mixed) : bool

		$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.' WHERE id=?');
		$requete->execute(array($index));
		return (bool)$requete->fetch(\PDO::FETCH_ASSOC);
!!!137218.php!!!	exist(in attributs : array) : bool

		$attributsWithOperators=array();
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($attributs as $nom => $valeur)
		{
			$attributsWithOperators[]=$nom.'=?';
		}
		$requete=$this->getBdd()->prepare('SELECT '.$this::INDEX.' FROM '.$this::TABLE.' WHERE '.implode(' AND ', $attributsWithOperators).'');
		$requete->execute(array_values($attributs));
		return (bool)$requete->fetch(\PDO::FETCH_ASSOC);
!!!137346.php!!!	count() : int

		$requete=$this->getBdd()->prepare('SELECT count('.$this::INDEX.') AS nbr FROM '.$this::TABLE);
		$requete->execute();
		$donnees=$requete->fetch(\PDO::FETCH_ASSOC);
		return (int)$donnees['nbr'];
