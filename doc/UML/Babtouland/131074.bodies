class PageElement
!!!163714.php!!!	getTemplate() : string

		return $this->template;
!!!163842.php!!!	getFonctions() : string

		return $this->fonctions;
!!!163970.php!!!	getElements() : array

		return $this->elements;
!!!164098.php!!!	setTemplate(in template : string) : void

		$this->template=$template;
!!!164226.php!!!	setFonctions(in fonctions : string) : void

		$this->fonctions=$fonctions;
!!!164354.php!!!	setElements(in elements : array) : void

		$this->elements=$elements;
!!!164482.php!!!	afficherTemplate() : string

		return htmlspecialchars($this->template);
!!!164610.php!!!	afficherFonctions() : string

		return htmlspecialchars($this->fonctions);
!!!164738.php!!!	afficherElements() : string

		return htmlspecialchars(print_r($this->elements));
!!!164866.php!!!	afficher() : string

		$contenuElement=file_get_contents($this->getTemplate());
		if ($this->getFonctions())
		{
			require $this->getFonctions();
		}
		foreach ($this->getElements() as $nom => $element)
		{
			if (is_object($element))
			{
				$valeur=$element->afficher();
			}
			else if (is_array($element))
			{
				$valeur=($nom.'Afficher')($element);
			}
			else
			{
				$valeur=$element;
			}
			$contenuElement=preg_replace('#'.$this::SEPARATEUR.$nom.$this::SEPARATEUR.'#', $valeur, $contenuElement);
		}
		return $contenuElement;
!!!164994.php!!!	getElement(in index : mixed) : mixed

		return $this->elements[$index];
!!!165122.php!!!	__construct(in attributs : array) : void

		foreach ($attributs as $key => $value)
		{
			$method='set'.ucfirst($key);
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
!!!165250.php!!!	ajouterElement(in nom : string, in element : PageElement) : void

		$this->elements[$nom]=$element;
!!!165378.php!!!	ajouterValeurElement(in index : mixed, in valeur : mixed) : void

		if (!in_array($valeur, $this->elements[$index]))		// La valeur n'existe pas déjà (évite de mettre plusieurs fois le même css par exemple)
		{
			$this->elements[$index][]=$valeur;
		}
