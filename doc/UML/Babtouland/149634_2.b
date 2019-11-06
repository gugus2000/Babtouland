class Visiteur
!!!280322.php!!!	getPage()

		return $this->page;
!!!280450.php!!!	setPage(in page : )

		$this->page=$page;
!!!280578.php!!!	afficherPage()

		return htmlspecialchars((string)$this->page->afficher());
!!!280706.php!!!	verifPermission()

		return $this->getRole()->existPermission($this->getPage()->getApplication(), $this->getPage()->getAction());
!!!280834.php!!!	connexion(in motdepasse : )

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
!!!280962.php!!!	deconnexion()

		if ($this->getMotdepasse()->verif($motdepasse))
		{
			$utilisateurManager=$this->Manager();
			$date=date('Y-m-d H:i:s');
			$utilisateurManager->update(array(
				'date_connexion' => $date,
			), $this->getId());
			$_SESSION=array();
		}
!!!281090.php!!!	inscription(in motdepasse : , in nom_role : )

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
!!!281218.php!!!	mettre_a_jour()

		$Manager=$this->Manager();
		$Manager->update(array(
			'avatar' => $this->getAvatar(),
			'banni'  => (int)$this->getBanni(),
			'mail'   => $this->getMail(),
		), $this->getId());
!!!281346.php!!!	supprimer()

		$Manager=$this->Manager();
		$Manager->delete($this->getId());
!!!281474.php!!!	chargePage(in application : , in action : )

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
