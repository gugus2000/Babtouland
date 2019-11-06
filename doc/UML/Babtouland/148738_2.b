class PageElement
!!!270082.php!!!	getTemplate()

		return $this->template;
!!!270210.php!!!	getFonctions()

		return $this->fonctions;
!!!270338.php!!!	getElements()

		return $this->elements;
!!!270466.php!!!	setTemplate(in template : )

		$this->template=$template;
!!!270594.php!!!	setFonctions(in fonctions : )

		$this->fonctions=$fonctions;
!!!270722.php!!!	setElements(in elements : )

		$this->elements=$elements;
!!!270850.php!!!	afficherTemplate()

		return htmlspecialchars($this->template);
!!!270978.php!!!	afficherFonctions()

		return htmlspecialchars($this->fonctions);
!!!271106.php!!!	afficherElements()

		return htmlspecialchars(print_r($this->elements));
!!!271234.php!!!	afficher()

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
!!!271362.php!!!	getElement(in index : )

		return $this->elements[$index];
!!!271490.php!!!	__construct(in attributs : )

		foreach ($attributs as $key => $value)
		{
			$method='set'.ucfirst($key);
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
!!!271618.php!!!	ajouterElement(in nom : , in element : )

		$this->elements[$nom]=$element;
!!!271746.php!!!	ajouterValeurElement(in index : , in valeur : )

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
