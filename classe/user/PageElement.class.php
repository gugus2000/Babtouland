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
	const SEPARATEUR='|';

	/* Attribut */

	/**
	* Chemin vers la template
	* 
	* @var string
	*/
	protected $template;
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
	* Afficheur de elements
	* 
	* @return string
	*/
	public function afficherElements()
	{
		return print_r($this->elements);
	}
	/**
	* Affichage d'une array sans fonctions
	*
	* @param array liste Liste d'éléments
	* 
	* @return string
	*/
	public function afficherArray($liste)
	{
		$affichage='';
		foreach ($liste as $nom => $element)
		{
			if (is_object($element))
			{
				$affichage.=$element->afficher();
			}
			else if (is_array($element))
			{
				$affichage.=$this->afficherArray($element);
			}
			else
			{
				$affichage.=$element;
			}
		}
		return $affichage;
	}
	/**
	* Afficher l'élément "déployé"
	* 
	* @return string
	*/
	public function afficher()
	{
		if ($this->getTemplate())
		{
			$contenuElement=file_get_contents($this->getTemplate());
		}
		else
		{
			$contenuElement='';
		}
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
				$valeur=$this->afficherArray($element);
			}
			else
			{
				$valeur=$element;
			}
			$contenuElement=str_replace($this::SEPARATEUR.$nom.$this::SEPARATEUR, $valeur, $contenuElement);
		}
		return $contenuElement;
	}
	/**
	* Accesseur d'un élément de elements
	*
	* @param mixed index Index de l'élément à récupérer
	* 
	* @return mixed
	*/
	public function getElement($index)
	{
		if (isset($this->elements[$index]))
		{
			return $this->elements[$index];
		}
		return False;
	}
	/**
	* Définisseur d'un élément de elments
	*
	* @param mixed index Index de l'élément à définir
	*
	* @param mixed valeur valeur de l'élément à définir
	* 
	* @return void
	*/
	protected function setElement($index, $valeur)
	{
		if (isset($this->elements[$index]))
		{
			$this->elements[$index]=$valeur;
		}
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
	/**
	* Ajoute un élément
	*
	* @param string nom Nom de l'élément à ajouter
	*
	* @param PageElement element PageElement à ajouter
	* 
	* @return void
	*/
	public function ajouterElement($nom, $element)
	{
		$this->elements[$nom]=$element;
	}
	/**
	* Ajoute un élément dans un élément array dans elements
	*
	* @param mixed index Index de l'élément à laquelle ajouter la valeur
	*
	* @param mixed valeur Valeur de l'élément de l'élément à ajouter
	* 
	* @return void
	*/
	public function ajouterValeurElement($index, $valeur)
	{
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
			throw new \Exception("On ne peut pas ajouter la valeur à l'élément s'il n'est pas un array ou une string");
		}
	}
}

?>