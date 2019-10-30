class Utilisateur
!!!169346.php!!!	getId() : int

		return $this->id;
!!!169474.php!!!	getPseudo() : string

		return $this->pseudo;
!!!169602.php!!!	getMotdepasse() : Motdepasse

		return $this->motdepasse;
!!!169730.php!!!	getAvatar() : string

		return $this->avatar;
!!!169858.php!!!	getDate_inscription() : string

		return $this->date_inscription;
!!!169986.php!!!	getDate_connexion() : string

		return $this->date_connexion;
!!!170114.php!!!	getBanni() : bool

		return $this->banni;
!!!170242.php!!!	getRole() : Role

		return $this->role;
!!!170370.php!!!	getMail() : string

		return $this->mail;
!!!170498.php!!!	setId(in id : int) : void

		$this->id=(int)$id;
!!!170626.php!!!	setPseudo(in pseudo : string) : void

		$this->pseudo=$pseudo;
!!!170754.php!!!	setMotdepasse(in motdepasse : Motdepasse) : void

		$this->motdepasse=$motdepasse;
!!!170882.php!!!	setAvatar(in avatar : string) : void

		$this->avatar=$avatar;
!!!171010.php!!!	setDate_inscription(in date_inscription : string) : void

		$this->date_inscription=(string)$date_inscription;
!!!171138.php!!!	setDate_connexion(in date_connexion : string) : void

		$this->date_connexion=(string)$date_connexion;
!!!171266.php!!!	setBanni(in banni : bool) : void

		$this->banni=(bool)$banni;
!!!171394.php!!!	setRole(in role : Role) : void

		$this->role=$role;
!!!171522.php!!!	setMail(in mail : string) : void

		$this->mail=$mail;
!!!171650.php!!!	afficherId() : string

		return htmlspecialchars((string)$this->id);
!!!171778.php!!!	afficherPseudo() : string

		return htmlspecialchars((string)$this->pseudo);
!!!171906.php!!!	afficherMotdepasse() : string

		return htmlspecialchars((string)$this->motdepasse->afficher());
!!!172034.php!!!	afficherAvatar() : string

		return htmlspecialchars((string)$this->avatar);
!!!172162.php!!!	afficherDate_inscription() : string

		return htmlspecialchars((string)$this->date_inscription);
!!!172290.php!!!	afficherDate_connexion() : string

		return htmlspecialchars((string)$this->date_connexion);
!!!172418.php!!!	afficherBanni() : string

		return htmlspecialchars((string)$this->banni);
!!!172546.php!!!	afficherRole() : string

		return htmlspecialchars((string)$this->role->afficher());
!!!172674.php!!!	afficherMail() : string

		return htmlspecialchars((string)$this->mail);
!!!172802.php!!!	afficherDate_inscriptionFormat(in format : string) : string

		return date($format, strtotime($this->date_inscription));
!!!172930.php!!!	afficherDate_connexionFormat(in format : string) : string

		return date($format, strtotime($this->date_connexion));
!!!173058.php!!!	afficher() : string

		return $this->afficherPseudo();
!!!173186.php!!!	estConnecte(in intervalle : string = 'PT5M') : bool

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
!!!173314.php!!!	recuperer_motdepasse() : void

		if ($this->getId())
		{
			$BDDFactory=new \core\BDDFactory;
			$MotdepasseManager=new \user\MotdepasseManager($BDDFactory->MysqlConnexion());
			$motdepasse=$MotdepasseManager->get($this->getId());
			$Motdepasse=new \user\Motdepasse($motdepasse);
			$this->setMotdepasse($Motdepasse);
		}
!!!173442.php!!!	recuperer_role() : void

		if ($this->getId())
		{
			$Role=new \user\Role(array(
				'id' => $this->getId(),
			));
			$Role->recuperer();
			$this->setRole($Role);
		}
!!!173570.php!!!	recuperer() : void

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
!!!173698.php!!!	recupererConversations() : array

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
