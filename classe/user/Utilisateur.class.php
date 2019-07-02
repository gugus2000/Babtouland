<?php

namespace user;

/**
* Utilisateur du site web
*/
class Utilisateur extends \core\Managed
{
	/* Attributs */
	/**
	* Id de l'utilisateur
	*
	* @var int
	*/
	protected $id;
	/**
	* Pseudo de l'utilisateur
	*
	* @var string
	*/
	protected $pseudo;
	/**
	* Mot de passe de l'utilisateur
	*
	* @var Mot_de_passe
	*/
	protected $mot_de_passe;
	/**
	* Nom du fichier de l'avatar de l'utilisateur
	*
	* @var string
	*/
	protected $avatar;
	/**
	* Date de l'inscription de l'utilisateur
	*
	* @var string
	*/
	protected $date_inscription;
	/**
	* Date de la dernière connexion de l'utilisateur
	*
	* @var string
	*/
	protected $date_connexion;
	/**
	* Statut de l'utilisateur
	*
	* @var bool
	*/
	protected $banni;
	/**
	* Role de l'utilisateur
	*
	* @var Role
	*/
	protected $role;

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
	* Accesseur de pseudo
	*
	* @return string
	*/
	public function getPseudo()
	{
		return $this->pseudo;
	}
	/**
	* Accesseur de mot_de_passe
	*
	* @return Mot_de_passe
	*/
	public function getMot_de_passe()
	{
		return $this->mot_de_passe;
	}
	/**
	* Accesseur de avatar
	*
	* @return string
	*/
	public function getAvatar()
	{
		return $this->avatar;
	}
	/**
	* Accesseur de date_inscription
	*
	* @return string
	*/
	public function getDate_inscription()
	{
		return $this->date_inscription;
	}
	/**
	* Accesseur de date_connexion
	*
	* @return string
	*/
	public function getDate_connexion()
	{
		return $this->date_connexion;
	}
	/**
	* Accesseur de banni
	*
	* @return bool
	*/
	public function getBanni()
	{
		return $this->banni;
	}
	/**
	* Accesseur de role
	*
	* @return Role
	*/
	public function getRole()
	{
		return $this->role;
	}

	/* Définisseurs */

	/**
	* Définisseur de id
	*
	* @param int id index de l'utilisateur dans la base de donnée
	*
	* @return void
	*/
	protected function setId($id)
	{
		$this->id=(int)$id;
	}
	/**
	* Définisseur de pseudo
	*
	* @param string pseudo Pseudo de l'utilisateur
	*
	* @return void
	*/
	protected function setPseudo($pseudo)
	{
		$this->pseudo=$pseudo;
	}
	/**
	* Définisseur de mot_de_passe
	*
	* @param Mot_de_passe mot_de_passe Mot de passe de l'utilisateur
	*
	* @return void
	*/
	protected function setMot_de_passe($mot_de_passe)
	{
		$this->mot_de_passe=$mot_de_passe;
	}
	/**
	* Définisseur de avatar
	*
	* @param string avatar Avatar de l'utilisateur
	*
	* @return void
	*/
	protected function setAvatar($avatar)
	{
		$this->avatar=$avatar;
	}
	/**
	* Définisseur de date_inscription
	*
	* @param string date_inscription Date d'inscription de l'utilisateur
	*
	* @return void
	*/
	protected function setDate_inscription($date_inscription)
	{
		$this->date_inscription=(string)$date_inscription;
	}
	/**
	* Définisseur de date_connexion
	*
	* @param string date_connexion Date de la dernière connexion de l'utilisateur
	*
	* @return void
	*/
	protected function setDate_connexion($date_connexion)
	{
		$this->date_connexion=(string)$date_connexion;
	}
	/**
	* Définisseur de banni
	*
	* @param bool banni Statut de l'utilisateur
	*
	* @return void
	*/
	protected function setBanni($banni)
	{
		$this->banni=(bool)$banni;
	}
	/**
	* Définisseur de role
	*
	* @param Role role Role de l'utilisateur
	*
	* @return void
	*/
	protected function setRole($role)
	{
		$this->role=$role;
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
	* Afficheur de pseudo
	*
	* @return string
	*/
	public function afficherPseudo()
	{
		return htmlspecialchars((string)$this->pseudo);
	}
	/**
	* Afficheur de mot_de_passe
	*
	* @return string
	*/
	public function afficherMot_de_passe()
	{
		return htmlspecialchars((string)$this->mot_de_passe->afficher());
	}
	/**
	* Afficheur de avatar
	*
	* @return string
	*/
	public function afficherAvatar()
	{
		return htmlspecialchars((string)$this->avatar);
	}
	/**
	* Afficheur de date_inscription
	*
	* @return string
	*/
	public function afficherDate_inscription()
	{
		return htmlspecialchars((string)$this->date_inscription);
	}
	/**
	* Afficheur de date_connexion
	*
	* @return string
	*/
	public function afficherDate_connexion()
	{
		return htmlspecialchars((string)$this->date_connexion);
	}
	/**
	* Afficheur de banni
	*
	* @return string
	*/
	public function afficherBanni()
	{
		return htmlspecialchars((string)$this->banni);
	}
	/**
	* Afficheur de role
	*
	* @return string
	*/
	public function afficherRole()
	{
		return htmlspecialchars((string)$this->role->afficher());
	}
	/**
	* Affiche date_inscription avec le bon format
	*
	* @param string format Format de l'affichage de la date
	*
	* @return string
	*/
	public function afficherDate_inscriptionFormat($format)
	{
		return date($format, strtotime($this->date_inscription));
	}
	/**
	* Affiche date_connexion avec le bon format
	*
	* @param string format Format de l'affichage de la date
	*
	* @return string
	*/
	public function afficherDate_connexionFormat($format)
	{
		return date($format, strtotime($this->date_connexion));
	}
	/**
	* Converti l'objet utilisateur en string, pour l'instant, on représente l'utilisateur par son pseudo
	*
	* @return string
	*/
	public function afficher()
	{
		return $this->afficherPseudo();
	}
	/**
	* Vérifie si l'utilisateur est connecté
	*
	* @param string intervalle Intervalle de temps définissant si un utilisateur est connecté (sous le format de \DateInterval)
	* 
	* @return bool
	*/
	public function estConnecte($intervalle)
	{
		$Manager=$this->Manager();
		$date=new \DateTime(date('Y-m-d H:i:s'));
		$date->sub(new \DateInterval($intervalle));
		$donnees=$Manager->getBy(array(
			'date_connexion' => $date->format('Y-m-d H:i:s'),
			'id'             => $this->getId(),
		), array(
			'date_connexion' => '>=',
			'id'             => '=',
		));
		return (bool)$donnees;
	}
	/**
	* Récupère le mot de passe d'un utilisateur
	*
	* @return void
	*/
	public function recuperer_mot_de_passe()
	{
		if ($this->getId())
		{
			$BDDFactory=new \core\BDDFactory;
			$Mot_de_passeManager=new \user\MotdepasseManager($BDDFactory->MysqlConnexion());
			$mot_de_passe=$Mot_de_passeManager->get($this->getId());
			$Mot_de_passe=new \user\Motdepasse($mot_de_passe);
			$this->setMot_de_passe($Mot_de_passe);
		}
	}
	/**
	* Récupère le rôle d'un utilisateur
	*
	* @return void
	*/
	public function recuperer_role()
	{
		if ($this->getId())
		{
			$Role=new \user\Role(array(
				'id' => $this->getId(),
			));
			$Role->recuperer();
			$this->setRole($Role);
		}
	}
	/**
	* Récupère un utilisateur à partir de son id ou de son pseudo
	*
	* @return void
	*/
	public function recuperer()
	{
		if ($this->getId())
		{
			$UtilisateurManager=$this->Manager();
			$this->hydrater($UtilisateurManager->get($this->getId()));
			$this->recuperer_role();
			$this->recuperer_mot_de_passe();
		}
		else if ($this->getpseudo())
		{
			$UtilisateurManager=$this->Manager();
			$this->hydrater($UtilisateurManager->getBy(array(
				'pseudo' => $this->getPseudo(),
			), array(
				'pseudo' => '=',
			))[0]);
			$this->recuperer_role();
			$this->recuperer_mot_de_passe();
		}
	}
}

?>