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
	* @param string motdepasse Mot de passe du visiteur
	*
	* @return bool
	*/
	public function connexion($motdepasse)
	{
		if ($this->getMotdepasse()->verif($motdepasse))
		{
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
		$VisiteurManager->add(array(
			'pseudo'           => $this->getPseudo(),
			'avatar'           => $this->getAvatar(),
			'date_inscription' => $this->getDate_inscription(),
			'date_connexion'   => $this->getDate_connexion(),
			'banni'            => (int)$this->getBanni(),
			'mail'             => $this->getMail(),
		));
		$this->setId($VisiteurManager->getIdBy(array(
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
			'nom_role' => $this->getRole()->getNom_role(),
		), $this->getId());
		$MotdepasseManager=$this->getMotdepasse()->Manager();
		$this->getMotdepasse()->hash();
		$MotdepasseManager->update(array(
			'mot_de_passe' => $this->getMotdepasse()->getMot_de_passe(),
		), $this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());	// On met l'utilisateur dans la conversation "général"
		global $config;
		$LiaisonConversationUtilisateur->addBy(array(
			'id_conversation' => $config['id_conversation_all'],
		), array(
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
	* @return bool
	*/
	public function chargePage($application, $action)
	{
		global $config, $lang, $Visiteur;
		if($this->getRole()->existPermission($application, $action))	// Permission accordée
		{
			if (isset($_SESSION['message']))
			{
				$Message=unserialize($_SESSION['message']);
				$config['pageElement_elements']['message']=$Message;
				$config['css'][]=$config['message_css'];
				$config['javascripts'][]=$config['message_js'];
				unset($_SESSION['message']);
			}
			if (include($this->getPagePath($application, $action)))
			{
				$PageElement=new \user\PageElement(array(
					'template'  => $config['pageElement_page_template'],
					'fonctions' => $config['pageElement_page_fonctions'],
					'elements'  => $config['pageElement_elements'],
				));
				$this->setPage(new \user\Page(array(
					'application' => $application,
					'action'      => $action,
					'pageElement' => $PageElement,
				)));
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
	/**
	* Trouve le fichier de définition de la page concerné
	*
	* @param string application Application de la page
	*
	* @param string action Action de la page
	* 
	* @return string
	*/
	public function getPagePath($application, $action)
	{
		$Page=new \user\Page(array(
			'application' => $application,
			'action'      => $action,
		));
		return $Page->getPath();
	}
}

?>