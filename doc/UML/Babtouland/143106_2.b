class PageElement
!!!220034.php!!!	getTemplate()

		return $this->template;
!!!220162.php!!!	getFonctions()

		return $this->fonctions;
!!!220290.php!!!	getElements()

		return $this->elements;
!!!220418.php!!!	setTemplate(in template : )

		$this->template=$template;
!!!220546.php!!!	setFonctions(in fonctions : )

		$this->fonctions=$fonctions;
!!!220674.php!!!	setElements(in elements : )

		$this->elements=$elements;
!!!220802.php!!!	afficherTemplate()

		return htmlspecialchars($this->template);
!!!220930.php!!!	afficherFonctions()

		return htmlspecialchars($this->fonctions);
!!!221058.php!!!	afficherElements()

		return htmlspecialchars(print_r($this->elements));
!!!221186.php!!!	afficher()

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
!!!221314.php!!!	getElement(in index : )

		return $this->elements[$index];
!!!221442.php!!!	__construct(in attributs : )

		foreach ($attributs as $key => $value)
		{
			$method='set'.ucfirst($key);
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
!!!221570.php!!!	ajouterElement(in nom : , in element : )

		$this->elements[$nom]=$element;
!!!221698.php!!!	ajouterValeurElement(in index : , in valeur : )

		if (is_array($this->getElement($index)))
		{
			if (!in_array($valeur, $this->elements[$index]))		// La valeur n'existe pas déjà (évite de mettre plusieurs fois le même css par exemple)
			{
				$this->elements[$index][]=$valeur;
			}
		}
		else if (is_string($this->getElement($index)))
		{
			$this->elements[$index].=(string)$valeur;
		}
		else
		{
			throw new Exception("On ne peut pas ajouter la valeur à l'élément s'il n'est pas un array ou une string");
		}
