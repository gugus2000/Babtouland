class LiaisonManager
!!!239234.php!!!	__construct(in bdd : )

		$this->setBdd($bdd);
!!!239362.php!!!	getBdd()

		return $this->bdd;
!!!239490.php!!!	setBdd(in bdd : )

		$this->bdd=$bdd;
!!!239618.php!!!	get(in attributs : , in operations : )

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
!!!239746.php!!!	addBy(in variants : , in invariants : )

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
!!!239874.php!!!	deleteBy(in attributs : )

		$attributsWithOperators=array();
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($attributs as $nom => $valeur)
		{
			$attributsWithOperators[]=$nom.'=?';
		}
		$requete=$this->getBdd()->prepare('DELETE FROM '.$this::TABLE.' WHERE '.implode(' AND ', $attributsWithOperators));
		$requete->execute(array_values($attributs));
