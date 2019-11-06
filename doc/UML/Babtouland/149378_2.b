class Utilisateur
!!!275714.php!!!	getId()

		return $this->id;
!!!275842.php!!!	getPseudo()

		return $this->pseudo;
!!!275970.php!!!	getMotdepasse()

		return $this->motdepasse;
!!!276098.php!!!	getAvatar()

		return $this->avatar;
!!!276226.php!!!	getDate_inscription()

		return $this->date_inscription;
!!!276354.php!!!	getDate_connexion()

		return $this->date_connexion;
!!!276482.php!!!	getBanni()

		return $this->banni;
!!!276610.php!!!	getRole()

		return $this->role;
!!!276738.php!!!	getMail()

		return $this->mail;
!!!276866.php!!!	setId(in id : )

		$this->id=(int)$id;
!!!276994.php!!!	setPseudo(in pseudo : )

		$this->pseudo=$pseudo;
!!!277122.php!!!	setMotdepasse(in motdepasse : )

		$this->motdepasse=$motdepasse;
!!!277250.php!!!	setAvatar(in avatar : )

		$this->avatar=$avatar;
!!!277378.php!!!	setDate_inscription(in date_inscription : )

		$this->date_inscription=(string)$date_inscription;
!!!277506.php!!!	setDate_connexion(in date_connexion : )

		$this->date_connexion=(string)$date_connexion;
!!!277634.php!!!	setBanni(in banni : )

		$this->banni=(bool)$banni;
!!!277762.php!!!	setRole(in role : )

		$this->role=$role;
!!!277890.php!!!	setMail(in mail : )

		$this->mail=$mail;
!!!278018.php!!!	afficherId()

		return htmlspecialchars((string)$this->id);
!!!278146.php!!!	afficherPseudo()

		return htmlspecialchars((string)$this->pseudo);
!!!278274.php!!!	afficherMotdepasse()

		return htmlspecialchars((string)$this->motdepasse->afficher());
!!!278402.php!!!	afficherAvatar()

		return htmlspecialchars((string)$this->avatar);
!!!278530.php!!!	afficherDate_inscription()

		return htmlspecialchars((string)$this->date_inscription);
!!!278658.php!!!	afficherDate_connexion()

		return htmlspecialchars((string)$this->date_connexion);
!!!278786.php!!!	afficherBanni()

		return htmlspecialchars((string)$this->banni);
!!!278914.php!!!	afficherRole()

		return htmlspecialchars((string)$this->role->afficher());
!!!279042.php!!!	afficherMail()

		return htmlspecialchars((string)$this->mail);
!!!279170.php!!!	afficherDate_inscriptionFormat(in format : )

		return date($format, strtotime($this->date_inscription));
!!!279298.php!!!	afficherDate_connexionFormat(in format : )

		return date($format, strtotime($this->date_connexion));
!!!279426.php!!!	afficher()

		return $this->afficherPseudo();
!!!279554.php!!!	estConnecte(in intervalle :  = 'PT5M')

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
!!!279682.php!!!	recuperer_motdepasse()

		if ($this->getId())
		{
			$BDDFactory=new \core\BDDFactory;
			$MotdepasseManager=new \user\MotdepasseManager($BDDFactory->MysqlConnexion());
			$motdepasse=$MotdepasseManager->get($this->getId());
			$Motdepasse=new \user\Motdepasse($motdepasse);
			$this->setMotdepasse($Motdepasse);
		}
!!!279810.php!!!	recuperer_role()

		if ($this->getId())
		{
			$Role=new \user\Role(array(
				'id' => $this->getId(),
			));
			$Role->recuperer();
			$this->setRole($Role);
		}
!!!279938.php!!!	recuperer()

		if ($this->getId())
		{
			$UtilisateurManager=$this->Manager();
			$this->get($this->getId());
			$this->recuperer_role();
			$this->recuperer_motdepasse();
		}
		else if ($this->getpseudo())
		{
			$UtilisateurManager=$this->Manager();
			$this->setId($UtilisateurManager->getIdBy(array(
				'pseudo' => $this->getPseudo(),
			)));
			$this->get($this->getId());
			$this->recuperer_role();
			$this->recuperer_motdepasse();
		}
!!!280066.php!!!	recupererConversations()

		$BDDFactory=new \core\BDDFactory;
		$Liaison=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$resultats=$Liaison->get(array(
			'id_utilisateur' => $this->getId(),
		), array(
			'id_utilisateur' => '=',
		));
		$conversations=array();
		foreach ($resultats as $key => $resultat)
		{
			$conversation=new \chat\Conversation(array(
				'id' => $resultat['id_conversation'],
			));
			$conversation->recuperer();
			$conversations[]=$conversation;
		}
		return $conversations;
!!!280194.php!!!	recupererNotifications()

		$BDDFactory=new \core\BDDFactory;
		$Liaison=new \user\LiaisonNotificationUtilisateur($BDDFactory->MysqlConnexion());
		$resultats=$Liaison->get(array(
			'id_utilisateur' => $this->getId(),
		), array(
			'id_utilisateur' => '=',
		));
		$notifications=array();
		foreach ($resultats as $key => $resultat)
		{
			$notification=new \user\Notification(array(
				'id' => $resultat['id_notification'],
			));
			$notification->recuperer();
			$notifications[]=$notification;
		}
		return $notifications;
