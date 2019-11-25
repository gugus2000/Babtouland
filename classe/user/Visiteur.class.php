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
	/**
	* Configurations de l'utilisateur
	* 
	* @var array
	*/
	protected $configurations;

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
	/**
	* Accesseur de configurations
	* 
	* @return array
	*/
	public function getConfigurations()
	{
		return $this->configurations;
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
	/**
	* Définisseur de configurations
	*
	* @param array configurations Configurations de l'utilisateur
	* 
	* @return void
	*/
	protected function setConfigurations($configurations)
	{
		$this->configurations=$configurations;
	}

	/* Afficheur */

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
	* Afficheur de configurations
	* 
	* @return string
	*/
	public function afficherConfigurations()
	{
		$affichage='';
		foreach ($this->configurations as $Configuration)
		{
			$affichage.=$Configuration->afficher().'<br />';
		}
		return $affichage;
	}

	/* Autres méthodes */

	/**
	* Ajout d'un élément dans l'array configurations
	*
	* @param string index Index à insérer
	*
	* @param mixed valeur Valeur à insérer
	* 
	* @return void
	*/
	public function setConfiguration($index, $valeur)
	{
		$this->configurations[$index]=$valeur;
	}
	/**
	* Accesseur d'une valeur de configurations associé à un index
	*
	* @param string index Index de la valeur
	* 
	* @return mixed
	*/
	public function getConfiguration($index)
	{
		return $this->configurations[$index];
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
	* @param string motdepasse Mot de passe du visiteur
	*
	* @return bool
	*/
	public function connexion($motdepasse)
	{
		if ($this->getMotdepasse()->verif($motdepasse))
		{
			global $config;
			$this->setConfigurations($config['config_utilisateur']);
			$ConfigurationManager=new \user\ConfigurationManager(\core\BDDFactory::MysqlConnexion());
			if (isset($_GET['lang']))
			{
				if ($this->getPseudo()==$config['nom_guest'])	// On définit le guest comme ayant un langage différent
				{
					$_SESSION['lang']=$_GET['lang'];
				}
				else
				{
					if ($ConfigurationManager->exist(array(	// La langue a déjà été définie une fois
						'id_utilisateur' => $this->getId(),
						'nom'            => 'lang',
					)))
					{
						$id=$ConfigurationManager->getIdBy(array(
							'id_utilisateur' => $this->getId(),
							'nom'            => 'lang',
						));
						$ConfigurationManager->update(array(
							'valeur' => $_GET['lang'],
						), $id);
					}
					else 	// Première fois que la langue a été définie
					{
						$ConfigurationManager->add(array(
							'id_utilisateur' => $this->getId(),
							'nom'            => 'lang',
							'valeur'         => $_GET['fr'],
						));
					}
				}
			}
			if (isset($_SESSION['lang']) & $this->getId()==$config['id_guest'])	// L'utilisateur est un guest avec un langage différent
			{
				$this->setConfiguration('lang', $_SESSION['lang']);
			}
			if (isset($_SESSION['post_fil_post_nombre_posts']) & $this->getId()==$config['id_guest'])
			{
				$this->setConfiguration('post_fil_post_nombre_posts', $_SESSION['post_fil_post_nombre_posts']);
			}
			$configurations=$ConfigurationManager->getBy(array(
				'id_utilisateur' => $this->getId(),
			), array(
				'id_utilisateur' => '=',
			));
			foreach ($configurations as $configuration)
			{
				$Configuration=new \user\Configuration($configuration);
				$this->setConfiguration($Configuration->getNom(), $Configuration->getValeur());
			}
			$utilisateurManager=$this->Manager();
			$date=date('Y-m-d H:i:s');
			$utilisateurManager->update(array(
				'date_connexion' => $date,
			), $this->getId());
			$this->setDate_connexion($date);
			$_SESSION['mdp']=$this->getMotdepasse()->getMdp_clair();
			$_SESSION['pseudo']=$this->getPseudo();
			$_SESSION['id']=$this->getId();
			return True;
		}
		else
		{
			return False;
		}
	}
	/**
	* Déconnecte le visiteur
	*
	* @return void
	*/
	public function deconnexion()
	{
		if ($this->getMotdepasse()->verif($motdepasse))
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
	* @param string motdepasse Mot de passe du visiteur
	* 
	* @param string nom_role Rôle du visiteur
	*
	* @return void
	*/
	public function inscription($motdepasse, $nom_role)
	{
		$VisiteurManager=$this->Manager();
		$VisiteurManager->add(array(				// Inscription dans la base de donnée
			'pseudo'           => $this->getPseudo(),
			'avatar'           => $this->getAvatar(),
			'date_inscription' => $this->getDate_inscription(),
			'date_connexion'   => $this->getDate_connexion(),
			'banni'            => (int)$this->getBanni(),
			'mail'             => $this->getMail(),
		));
		$this->setId($VisiteurManager->getIdBy(array(	// Récupération de l'id
			'pseudo'           => $this->getPseudo(),
			'avatar'           => $this->getAvatar(),
			'date_inscription' => $this->getDate_inscription(),
			'date_connexion'   => $this->getDate_connexion(),
			'banni'            => (int)$this->getBanni(),
			'mail'             => $this->getMail(),
		)));
		$this->setMotdepasse(new \user\Motdepasse(array(
			'id' => $this->getId(),
			'mdp_clair' => $motdepasse,
		)));
		$this->setRole(new \user\Role(array(
			'id' => $this->getId(),
			'nom_role' => $nom_role,
		)));
		$this->getRole()->recuperer_permissions();
		$RoleManager=$this->getRole()->Manager();
		$RoleManager->update(array(
			'nom_role' => $this->getRole()->getNom_role(),	// Inscription du role dans la table utilisateur
		), $this->getId());
		$MotdepasseManager=$this->getMotdepasse()->Manager();
		$this->getMotdepasse()->hash();
		$MotdepasseManager->update(array(					// Inscription du mot de passe
			'mot_de_passe' => $this->getMotdepasse()->getMot_de_passe(),
		), $this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		global $config;
		$LiaisonConversationUtilisateur->addBy(array(array(			// On met l'utilisateur dans la conversation "général"
			'id_conversation' => $config['id_conversation_all'],
		)), array(
			'id_utilisateur' => $this->getId(),
		));
	}
	/**
	* Met à jour l'utilisateur
	*
	* @return void
	*/
	public function mettre_a_jour()
	{
		$Manager=$this->Manager();
		$Manager->update(array(
			'avatar' => $this->getAvatar(),
			'banni'  => (int)$this->getBanni(),
			'mail'   => $this->getMail(),
		), $this->getId());
	}
	/**
	* Supprime l'utilisateur
	*
	* @return void
	*/
	public function supprimer()
	{
		$Manager=$this->Manager();
		$Manager->delete($this->getId());
	}
	/**
	* Charge la page
	*
	* @param string application Application de la page
	*
	* @param  string action Action de la page
	* 
	* @return string
	*/
	public function chargePage($application, $action)
	{
		global $config, $lang, $Visiteur;
		if($this->getRole()->existPermission($application, $action))	// Permission accordée
		{
			$this->setPage(new \user\Page(array(
				'application'   => $application,
				'action'        => $action,
			)));
			if (include($this->getPage()->getPath()))
			{
				return $this->getPage()->afficher();
			}
			else
			{
				throw new \Exception($lang['erreur_general_fichier_introuvable']);
			}
		}
		else
		{
			throw new \Exception($lang['erreur_general_autorisations_insuffisantes']);	// Pas l'autorisation
		}
	}
}

?>