class LiaisonManager
!!!134402.php!!!	__construct(in bdd : PDO) : void

		$this->setBdd($bdd);
!!!134530.php!!!	getBdd() : PDO

		return $this->bdd;
!!!134658.php!!!	setBdd(in bdd : PDO) : void

		$this->bdd=$bdd;
!!!134786.php!!!	get(in attributs : array, in operations : array) : array

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
!!!134914.php!!!	addBy(in variants : array, in invariants : array) : void

		foreach ($variants as $variant)
		{
			$variant=array_intersect_key($variant, array_flip($this::ATTRIBUTES));
		}
		$invariants=array_intersect_key($invariants, array_flip($this::ATTRIBUTES));
		$attributs=array_merge(array_keys($variants[\array_key_first($variants)]),array_keys($invariants));
		$donnees=array();
		$nombre_elements=count($variants[\array_key_first($variants)]);	// Le nombre d'éléments à insérer est le nombre de valeur dans les premières valeurs variantes
		for ($i=0; $i < $nombre_elements; $i++)
		{ 
			$donnee=array();
			foreach ($variants[$i] as $attribut => $valeurs)
			{
				$donnee[$attribut]=$valeurs;
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
!!!135042.php!!!	deleteBy(in attributs : array) : void

		$attributsWithOperators=array();
		$attributs=array_intersect_key($attributs, array_flip($this::ATTRIBUTES));
		foreach ($attributs as $nom => $valeur)
		{
			$attributsWithOperators[]=$nom.'=?';
		}
		$requete=$this->getBdd()->prepare('DELETE FROM '.$this::TABLE.' WHERE '.implode(' AND ', $attributsWithOperators));
		$requete->execute(array_values($attributs));
