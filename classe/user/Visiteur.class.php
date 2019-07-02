<?php

namespace user;

/**
* Visiteur du site
*/
class Visiteur extends Utilisateur
{
	/* Attributs */

	/**
	* Page vu par l'utilisateur
	*
	* @var Page
	*/
	protected $page;

	/* Accesseurs */
	
	/**
	* Accesseur de page
	*
	* @return Page
	*/
	public function getPage()
	{
		return $this->page;
	}

	/* Définisseurs */

	/**
	* Définisseur de page
	*
	* @param Page page Page vu par l'utilisateur
	*
	* @return void
	*/
	protected function setPage($page)
	{
		$this->page=$page;
	}

	/* Autres méthodes */

	/**
	* Afficheur de page
	*
	* @return string
	*/
	public function afficherPage()
	{
		return htmlspecialchars((string)$this->page->afficher());
	}
	/**
	* vérifie que l'utilisateur a la permission de voir la page
	*
	* @return bool
	*/
	public function verifPermission()
	{
		return $this->getRole()->existPermission($this->getPage()->getApplication(), $this->getPage()->getAction());
	}
	/**
	* Connecte le visiteur
	* 
	* @param string mot_de_passe Mot de passe du visiteur
	*
	* @return void
	*/
	public function connexion($mot_de_passe)
	{
		if ($this->getMot_de_passe()->verif($mot_de_passe))
		{
			$utilisateurManager=$this->Manager();
			$date=date('Y-m-d H:i:s');
			$utilisateurManager->update(array(
				'date_connexion' => $date,
			), $this->getId());
			$this->setDate_connexion($date);
			$_SESSION['mdp']=$this->getMot_de_passe()->getMdp_clair();
			$_SESSION['pseudo']=$this->getPseudo();
			$_SESSION['id']=$this->getId();
		}
	}
	/**
	* Déconnecte le visiteur
	*
	* @return void
	*/
	public function deconnexion()
	{
		if ($this->getMot_de_passe()->verif($mot_de_passe))
		{
			$utilisateurManager=$this->Manager();
			$date=date('Y-m-d H:i:s');
			$utilisateurManager->update(array(
				'date_connexion' => $date,
			), $this->getId());
			$_SESSION=array();
		}
	}
	/**
	* Inscription du visiteur
	*
	* @param string mot_de_passe Mot de passe du visiteur
	* 
	* @param string nom_role Rôle du visiteur
	*
	* @return void
	*/
	public function inscription($mot_de_passe, $nom_role)
	{
		$VisiteurManager=$this->Manager();
		$VisiteurManager->add(array(
			'pseudo'           => $this->getPseudo(),
			'avatar'           => $this->getAvatar(),
			'date_inscription' => $this->getDate_inscription(),
			'date_connexion'   => $this->getDate_connexion(),
			'banni'            => $this->getBanni(),
		));
		$this->setId($VisiteurManager->getIdBy(array(
			'pseudo'           => $this->getPseudo(),
			'avatar'           => $this->getAvatar(),
			'date_inscription' => $this->getDate_inscription(),
			'date_connexion'   => $this->getDate_connexion(),
			'banni'            => $this->getBanni(),
		)));
		$this->setMot_de_passe(new \user\Mot_de_passe(array(
			'id' => $this->getId(),
			'mdp_clair' => $mot_de_passe,
		)));
		$this->setRole(new \user\Role(array(
			'id' => $this->getId(),
			'nom_role' => $nom_role,
		)));
		$this->getRole()->recuperer_permissions();
		$RoleManager=$this->getRole()->Manager();
		$RoleManager->update(array(
			'nom_role' => $this->getRole()->getNom_role(),
		), $this->getId());
		$Mot_de_passeManager=$this->getMot_de_passe()->Manager();
		$this->getMot_de_passe()->hash();
		$Mot_de_passeManager->update(array(
			'mot_de_passe' => $this->getMot_de_passe()->getMot_de_passe(),
		), $this->getId());
	}
}

?>