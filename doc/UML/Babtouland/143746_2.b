class Utilisateur
!!!225666.php!!!	getId()

		return $this->id;
!!!225794.php!!!	getPseudo()

		return $this->pseudo;
!!!225922.php!!!	getMotdepasse()

		return $this->motdepasse;
!!!226050.php!!!	getAvatar()

		return $this->avatar;
!!!226178.php!!!	getDate_inscription()

		return $this->date_inscription;
!!!226306.php!!!	getDate_connexion()

		return $this->date_connexion;
!!!226434.php!!!	getBanni()

		return $this->banni;
!!!226562.php!!!	getRole()

		return $this->role;
!!!226690.php!!!	getMail()

		return $this->mail;
!!!226818.php!!!	setId(in id : )

		$this->id=(int)$id;
!!!226946.php!!!	setPseudo(in pseudo : )

		$this->pseudo=$pseudo;
!!!227074.php!!!	setMotdepasse(in motdepasse : )

		$this->motdepasse=$motdepasse;
!!!227202.php!!!	setAvatar(in avatar : )

		$this->avatar=$avatar;
!!!227330.php!!!	setDate_inscription(in date_inscription : )

		$this->date_inscription=(string)$date_inscription;
!!!227458.php!!!	setDate_connexion(in date_connexion : )

		$this->date_connexion=(string)$date_connexion;
!!!227586.php!!!	setBanni(in banni : )

		$this->banni=(bool)$banni;
!!!227714.php!!!	setRole(in role : )

		$this->role=$role;
!!!227842.php!!!	setMail(in mail : )

		$this->mail=$mail;
!!!227970.php!!!	afficherId()

		return htmlspecialchars((string)$this->id);
!!!228098.php!!!	afficherPseudo()

		return htmlspecialchars((string)$this->pseudo);
!!!228226.php!!!	afficherMotdepasse()

		return htmlspecialchars((string)$this->motdepasse->afficher());
!!!228354.php!!!	afficherAvatar()

		return htmlspecialchars((string)$this->avatar);
!!!228482.php!!!	afficherDate_inscription()

		return htmlspecialchars((string)$this->date_inscription);
!!!228610.php!!!	afficherDate_connexion()

		return htmlspecialchars((string)$this->date_connexion);
!!!228738.php!!!	afficherBanni()

		return htmlspecialchars((string)$this->banni);
!!!228866.php!!!	afficherRole()

		return htmlspecialchars((string)$this->role->afficher());
!!!228994.php!!!	afficherMail()

		return htmlspecialchars((string)$this->mail);
!!!229122.php!!!	afficherDate_inscriptionFormat(in format : )

		return date($format, strtotime($this->date_inscription));
!!!229250.php!!!	afficherDate_connexionFormat(in format : )

		return date($format, strtotime($this->date_connexion));
!!!229378.php!!!	afficher()

		return $this->afficherPseudo();
!!!229506.php!!!	estConnecte(in intervalle :  = 'PT5M')

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
!!!229634.php!!!	recuperer_motdepasse()

		if ($this->getId())
		{
			$BDDFactory=new \core\BDDFactory;
			$MotdepasseManager=new \user\MotdepasseManager($BDDFactory->MysqlConnexion());
			$motdepasse=$MotdepasseManager->get($this->getId());
			$Motdepasse=new \user\Motdepasse($motdepasse);
			$this->setMotdepasse($Motdepasse);
		}
!!!229762.php!!!	recuperer_role()

		if ($this->getId())
		{
			$Role=new \user\Role(array(
				'id' => $this->getId(),
			));
			$Role->recuperer();
			$this->setRole($Role);
		}
!!!229890.php!!!	recuperer()

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
!!!230018.php!!!	recupererConversations()

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
!!!230146.php!!!	recupererNotifications()

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
