<?php

namespace user;

/**
* Mot de passe d'un utilisateur
*/
class Motdepasse extends \core\Managed
{
	/* Attributs */

	/**
	* Id de l'utilisateur
	*
	* @var int
	*/
	protected $id;
	/**
	* Mot de passe en clair
	*
	* @var string
	*/
	protected $mdp_clair;
	/**
	* Mot de passe hashé
	*
	* @var string
	*/
	protected $mot_de_passe;

	/* Accesseurs */

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
	* Accesseur de mdp_clair
	*
	* @return string
	*/
	public function getMdp_clair()
	{
		return $this->mdp_clair;
	}
	/**
	* Accesseur de mot_de_passe
	*
	* @return string
	*/
	public function getMot_de_passe()
	{
		return $this->mot_de_passe;
	}

	/* Constantes */

	/**
	* Coût du hash (voir doc)
	*
	* @var int
	*/
	const HASH_COST=6;

	/* Définisseurs */

	/**
	* Définisseur de id
	*
	* @param int id Id de l'utilisateur
	*
	* @return void
	*/
	protected function setId($id)
	{
		$this->id=$id;
	}
	/**
	* Définisseur de mdp_clair
	*
	* @param string mdp_clair Mot de passe en claire
	*
	* @return void
	*/
	protected function setMdp_clair($mdp_clair)
	{
		$this->mdp_clair=$mdp_clair;
	}
	/**
	* Définisseur de mot_de_passe
	*
	* @param string mot_de_passe Mot de passe hashé
	*
	* @return void
	*/
	protected function setMot_de_passe($mot_de_passe)
	{
		$this->mot_de_passe=$mot_de_passe;
	}

	/* Autres méthodes */

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
	* Afficheur de mdp_clair
	*
	* @return string
	*/
	public function afficherMdp_clair()
	{
		return htmlspecialchars((string)$this->mdp_clair);
	}
	/**
	* Afficheur de mdp_hash
	*
	* @return string
	*/
	public function afficherMdp_hash()
	{
		return htmlspecialchars((string)$this->mdp_hash);
	}
	/**
	* Hash le mot de passe en clair
	*
	* @return void
	*/
	public function hash()
	{
		if ($this->getMdp_clair())
		{
			$mdp_hash=password_hash($this->getMdp_clair(), PASSWORD_DEFAULT);
			$this->setMot_de_passe($mdp_hash);
		}
	}
	/**
	* Vérifie si le mot de passe en clair correspond au mot de passe hashé
	* 
	* @param string mot_de_passe Mot de passe en clair à vérifier
	*
	* @return bool
	*/
	public function verif($mot_de_passe)
	{
		if ($this->getMot_de_passe())
		{
			$password=$mot_de_passe;
			$hash=$this->getMot_de_passe();
			$options=array(
				'cost' => $this::HASH_COST,
			);
			if (password_verify($password, $hash))
			{
			    if (password_needs_rehash($hash, PASSWORD_DEFAULT, $options))
			    {
			        $this->setMot_de_passe(password_hash($password, PASSWORD_DEFAULT, $options));
			        $Mot_de_passeManager=$this->Manager();
			        $Mot_de_passeManager->update(array(
			        	'mot_de_passe' => $this->getMot_de_passe(),
			        ), $this->getId());
			    }
			    $this->setMdp_clair($mot_de_passe);
			    return True;
			}
			return False;
		}
		return False;
	}
}

?>