<?php

namespace user;

class PageElement
{
	/* Constante */

	/**
	* Séparateur utilisé pour l'insertion d'élément dans la template
	*
	* @var string
	*/
	const SEPARATEUR='\|';

	/* Attribut */

	/**
	* Chemin vers la template
	* 
	* @var string
	*/
	protected $template;
	/**
	* Chemin vers les fonctions nécessaires
	* 
	* @var string
	*/
	protected $fonctions;
	/**
	* Liste des éléments du PagElement
	* 
	* @var array
	*/
	protected $elements;

	/* Afficheur */

	/**
	* Accesseur de template
	* 
	* @return string
	*/
	public function getTemplate()
	{
		return $this->template;
	}
	/**
	* Accesseur de fonctions
	* 
	* @return string
	*/
	public function getFonctions()
	{
		return $this->fonctions;
	}
	/**
	* Accesseur de elements
	* 
	* @return array
	*/
	public function getElements()
	{
		return $this->elements;
	}

	/* Définisseur */

	/**
	* Définisseur de template
	*
	* @param string template Chemin vers la template
	* 
	* @return void
	*/
	protected function setTemplate($template)
	{
		$this->template=$template;
	}
	/**
	* Définisseur de fonctions
	*
	* @param string fonctions Chemin vers les fonctions nécessaires
	* 
	* @return void
	*/
	protected function setFonctions($fonctions)
	{
		$this->fonctions=$fonctions;
	}
	/**
	* Définisseur de elements
	*
	* @param array elements Liste des éléments du PageElement
	* 
	* @return void
	*/
	protected function setElements($elements)
	{
		$this->elements=$elements;
	}

	/* Méthodes */

	/**
	* Afficheur de template
	* 
	* @return string
	*/
	public function afficherTemplate()
	{
		return htmlspecialchars($this->template);
	}
	/**
	* Afficheur de fonctions
	* 
	* @return string
	*/
	public function afficherFonctions()
	{
		return htmlspecialchars($this->fonctions);
	}
	/**
	* Afficheur de elements
	* 
	* @return string
	*/
	public function afficherElements()
	{
		return htmlspecialchars(print_r($this->elements));
	}
	/**
	* Afficher l'élément "déployé"
	* 
	* @return string
	*/
	public function afficher()
	{
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
	}
	/**
	* Construction de l'objet PageElement
	*
	* @param array attributs Attributs du PageElement
	*
	* @return void
	*/
	public function __construct($attributs)
	{
		foreach ($attributs as $key => $value)
		{
			$method='set'.ucfirst($key);
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}
}

?>