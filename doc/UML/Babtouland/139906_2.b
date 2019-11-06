class Managed
!!!189954.php!!!	__construct(in attributs :  = array())

		$this->hydrater($attributs);
!!!190082.php!!!	hydrater(in attributs : )

		foreach ($attributs as $key => $value)
		{
			$method='set'.ucfirst($key);
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
!!!190210.php!!!	Manager()

		$BDDFactory=new \core\BDDFactory;
		$object=get_class($this).'Manager';
		return new $object($BDDFactory->MysqlConnexion());
!!!190338.php!!!	get(in index : )

		$Manager=$this->Manager();
		$this->hydrater($Manager->get($index));
!!!190466.php!!!	similaire(in objet : )

		$resultat=0;
		foreach ($this::CRITERES_SIMILAIRE as $critere)
		{
			$accesseur='get'.ucfirst($critere);
			if ($this->$accesseur()==$objet->$accesseur())
			{
				$resultat+=1;
			}
		}
		return $resultat==count($this::CRITERES_SIMILAIRE);
