class Conversation
!!!128002.php!!!	getId() : int

		return $this->id;
!!!128130.php!!!	getNom() : string

		return $this->nom;
!!!128258.php!!!	getDescription() : string

		return $this->description;
!!!128386.php!!!	getId_messages() : array

		return $this->messages;
!!!128514.php!!!	getId_utilisateurs() : array

		return $this->utilisateurs;
!!!128642.php!!!	setId(in id : int) : void

		$this->id=(int)$id;
!!!128770.php!!!	setNom(in nom : string) : void

		$this->nom=$nom;
!!!128898.php!!!	setDescription(in description : string) : void

		$this->description=$description;
!!!129026.php!!!	setId_messages(in messages : array) : void

		$this->messages=$messages;
!!!129154.php!!!	setId_utilisateurs(in utilisateurs : array) : void

		$this->utilisateurs=$utilisateurs;
!!!129282.php!!!	afficherId() : string

		return htmlspecialchars((string)$this->id);
!!!129410.php!!!	afficherNom() : string

		return htmlspecialchars((string)$this->nom);
!!!129538.php!!!	afficherDescription() : string

		return htmlspecialchars((string)$this->description);
!!!129666.php!!!	afficherId_messages() : string

		$affichage='';
		foreach ($this->id_messages as $id_message)
		{
			$affichage.=htmlspecialchars($id_message).'\n';
		}
		return $affichage;
!!!129794.php!!!	afficheId_utilisateurs() : string

		$affichage='';
		foreach ($this->id_utilisateurs as $id_utilisateur)
		{
			$affichage.=htmlspecialchars($id_utilisateur);
		}
		return $affichage;
!!!129922.php!!!	recuperer(in date_historique : mixed = null) : void

		$this->get($this->getId());
		$this->recupererId_messages($date_historique);
		$this->recupererId_utilisateurs();
!!!130050.php!!!	creer() : void

		$Manager=$this->Manager();
		$Manager->add(array(
			'nom'         => $this->getNom(),
			'description' => $this->getDescription(),
		));
		$this->setId($Manager->getIdBy(array(
			'nom'         => $this->getNom(),
			'description' => $this->getDescription(),
		)));
		$BDDFactory=new \core\BDDFactory;
		$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$LiaisonConversationUtilisateur->addBy(array(
			'id_utilisateur' => $this->getId_utilisateurs,
		), array(
			'id_conversation' => $this->getId(),
		));
!!!130178.php!!!	modifier() : void

		$Manager=$this->Manager();
		$Manager->update(array(
			'nom'         => $this->getNom(),
			'description' => $this->getDescription(),
		), $this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$id_utilisateurs=$this->getId_utilisateurs;
		$donnees_already_in=$LiaisonConversationUtilisateur->get(array(
			'id_conversation' => $this->getId(),
		), array(
			'id_conversation' => '=',
		));
		$id_utilisateurs_already_in=array();
		foreach ($donnees_already_in as $donnee)
		{
			$id_utilisateurs_already_in[]=$donnee['id_utilisateur'];
		}
		$id_utilisateurs_non_modifies=array_intersect($id_utilisateurs_already_in, $id_utilisateurs);
		if(array_diff($id_utilisateurs_non_modifies, $id_utilisateurs_already_in))	// Il y a des utilisateurs qui ne sont plus dans la discussion
		{
			$LiaisonConversationUtilisateur->deleteBy(array(
				'id_conversation' => $this->getId(),
			));
			$LiaisonConversationUtilisateur->addBy(array(
				'id_utilisateur' => $id_utilisateurs,
			), array(
				'id_conversation' => $this->getId(),
			));
		}
		else
		{
			$id_utilisateurs_a_ajouter=array_diff($id_utilisateurs, $id_utilisateurs_non_modifies);
			$LiaisonConversationUtilisateur->addBy(array(
				'id_utilisateur' => $id_utilisateurs_a_ajouter,
			), array(
				'id_conversation' => $this->getId(),
			));
		}
!!!130306.php!!!	supprimer() : void

		$Manager=$this->Manager();
		$Manager->delete($this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$LiaisonConversationUtilisateur->deleteBy(array(
			'id_conversation' => $this->getId(),
		));
!!!130434.php!!!	recupererId_utilisateurs() : void

		$BDDFactory=new \core\BDDFactory;
		$Liaison=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$resultats=$Liaison->get(array(
			'id_conversation' => $this->getId(),
		), array(
			'id_conversation' => '=',
		));
		$id=array();
		foreach ($resultats as $resultat)
		{
			$id[]=$resultat['id_utilisateur'];
		}
		$this->setId_utilisateurs($id);
!!!130562.php!!!	recupererUtilisateurs() : array

		$utilisateurs=array();
		foreach ($this->getId_utilisateurs() as $id)
		{
			$utilisateur=new \user\Utilisateur(array(
				'id' => $id,
			));
			$utilisateur->recuperer();
			$utilisateurs[]=$utilisateur;
		}
		return $utilisateurs;
!!!130690.php!!!	recupererId_messages(in date_historique : mixed = null) : void

		$BDDFactory=new \core\BDDFactory;
		$MessageManager=new \chat\MessageManager($BDDFactory->MysqlConnexion());
		$getByArray=array(
			'id_conversation' => $this->getId(),
		);
		$getByOperateur=array(
			'id_conversation' => '=',
		);
		if ($date_historique)
		{
			$getByArray['date_publication']=$date_historique;
			$getByOperateur['date_publication']='>';
		}
		$resultats=$MessageManager->getBy($getByArray, $getByOperateur);
		$id=array();
		foreach ($resultats as $resultat)
		{
			$id[]=$resultat['id'];
		}
		$this->setId_messages($id);
!!!130818.php!!!	recupererMessages() : array

		$Messages=array();
		foreach ($this->getId_messages() as $id)
		{
			$Message=new \chat\Message(array(
				'id' => $id,
			));
			$Message->recuperer();
			$Messages[]=$Message;
		}
		return $Messages;
