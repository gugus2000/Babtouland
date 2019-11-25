<?php

namespace user;

class Configuration extends \core\Managed
{
	/**
	* Id de la configuration
	* 
	* @var int
	*/
	protected $id;
	/**
	* Id de l'utilisateur de la configuration
	* 
	* @var int
	*/
	protected $id_utilisateur;
	/**
	* Nom de la configuration
	* 
	* @var string
	*/
	protected $nom;
	/**
	* Valeur de la configuration
	* 
	* @var mixed
	*/
	protected $valeur;

	/* Accesseur */

	/**
	* Accesseur de id
	* 
	* @return int
	*/
	public function getId()
	{
		return $this->id;
	}
	/**
	* Accesseur de id_utilisateur
	* 
	* @return int
	*/
	public function getId_utilisateur()
	{
		return $this->id_utilisateur;
	}
	/**
	* Accesseur de nom
	* 
	* @return string
	*/
	public function getNom()
	{
		return $this->nom;
	}
	/**
	* Accesseur de valeur
	* 
	* @return mixed
	*/
	public function getValeur()
	{
		return $this->valeur;
	}

	/* Définisseur */

	/**
	* Définisseur de id
	*
	* @param int id Id de la configuration
	* 
	* @return void
	*/
	protected function setId($id)
	{
		$this->id=(int)$id;
	}
	/**
	* Définisseur de id_utilisateur
	*
	* @param int id_utilisateur Id de l'utilisateur de la configuration
	* 
	* @return void
	*/
	protected function setId_utilisateur($id_utilisateur)
	{
		$this->id_utilisateur=(int)$id_utilisateur;
	}
	/**
	* Définisseur de nom
	*
	* @param string nom Nom de la configuration
	* 
	* @return void
	*/
	protected function setNom($nom)
	{
		$this->nom=$nom;
	}
	/**
	* Définisseur de valeur
	*
	* @param mixed valeur Valeur de la configuration
	* 
	* @return void
	*/
	protected function setValeur($valeur)
	{
		$this->valeur=$valeur;
	}

	/* Afficheur */

	/**
	* Afficheur de id
	* 
	* @return string
	*/
	public function afficherId()
	{
		return htmlspecialchars((string)$this->id);
	}
	/**
	* Afficheur de id_utilisateur
	* 
	* @return string
	*/
	public function afficherId_utilisateur()
	{
		return htmlspecialchars((string)$this->id_utilisateur);
	}
	/**
	* Afficheur de nom
	* 
	* @return string
	*/
	public function afficherNom()
	{
		return htmlspecialchars((string)$this->nom);
	}
	/**
	* Afficheur de valeur
	* 
	* @return string
	*/
	public function afficherValeur()
	{
		return htmlspecialchars((string)$this->valeur);
	}
	/**
	* Afficheur de configuration
	* 
	* @return string
	*/
	public function afficher()
	{
		return $this->afficherNom().':'.$this->afficherValeur();
	}

	/* Autre méthode */

	/**
	* Récupère une conversation
	* 
	* @return void
	*/
	public function recuperer()
	{
		$this->get($this->getId());
	}
	/**
	* Créer une configuration
	* 
	* @return void
	*/
	public function creer()
	{
		$Manager=$this->Manager();
		$Manager->add(array(
			'id_utilisateur' => $this->getId_utilisateur(),
			'nom'            => $this->getNom(),
			'valeur'         => $this->getValeur(),
		));
		$this->setId($Manager->getIdBy(array(
			'id_utilisateur' => $this->getId_utilisateur(),
			'nom'            => $this->getNom(),
			'valeur'         => $this->getValeur(),
		)));
	}
	/**
	* Change la configuration
	* 
	* @return void
	*/
	public function changer()
	{
		$Manager=$this->Manager();
		$Manager->update(array(
			'valeur' => $this->getValeur(),
		), $this->getId());
	}
	/**
	* Supprimer la configuration
	* 
	* @return void
	*/
	public function supprimer()
	{
		$Manager=$this->Manager();
		$Manager->delete($this->getId());
	}
}

?>