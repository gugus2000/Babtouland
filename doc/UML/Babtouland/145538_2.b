class Managed
!!!240002.php!!!	__construct(in attributs :  = array())

		$this->hydrater($attributs);
!!!240130.php!!!	hydrater(in attributs : )

		foreach ($attributs as $key => $value)
		{
			$method='set'.ucfirst($key);
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
!!!240258.php!!!	Manager()

		$BDDFactory=new \core\BDDFactory;
		$object=get_class($this).'Manager';
		return new $object($BDDFactory->MysqlConnexion());
!!!240386.php!!!	get(in index : )

		$Manager=$this->Manager();
		$this->hydrater($Manager->get($index));
!!!240514.php!!!	similaire(in objet : )

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
