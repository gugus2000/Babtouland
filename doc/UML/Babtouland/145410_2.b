class Conversation
!!!232834.php!!!	getId()

		return $this->id;
!!!232962.php!!!	getNom()

		return $this->nom;
!!!233090.php!!!	getDescription()

		return $this->description;
!!!233218.php!!!	getId_messages()

		return $this->messages;
!!!233346.php!!!	getId_utilisateurs()

		return $this->utilisateurs;
!!!233474.php!!!	setId(in id : )

		$this->id=(int)$id;
!!!233602.php!!!	setNom(in nom : )

		$this->nom=$nom;
!!!233730.php!!!	setDescription(in description : )

		$this->description=$description;
!!!233858.php!!!	setId_messages(in messages : )

		$this->messages=$messages;
!!!233986.php!!!	setId_utilisateurs(in utilisateurs : )

		$this->utilisateurs=$utilisateurs;
!!!234114.php!!!	afficherId()

		return htmlspecialchars((string)$this->id);
!!!234242.php!!!	afficherNom()

		return htmlspecialchars((string)$this->nom);
!!!234370.php!!!	afficherDescription()

		return htmlspecialchars((string)$this->description);
!!!234498.php!!!	afficherId_messages()

		$affichage='';
		foreach ($this->id_messages as $id_message)
		{
			$affichage.=htmlspecialchars($id_message).'\n';
		}
		return $affichage;
!!!234626.php!!!	afficheId_utilisateurs()

		$affichage='';
		foreach ($this->id_utilisateurs as $id_utilisateur)
		{
			$affichage.=htmlspecialchars($id_utilisateur);
		}
		return $affichage;
!!!234754.php!!!	recuperer(in date_historique :  = null)

		$this->get($this->getId());
		$this->recupererId_messages($date_historique);
		$this->recupererId_utilisateurs();
!!!234882.php!!!	creer()

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
		$id_utilisateurs=array();
		foreach ($this->getId_utilisateurs() as $id_utilisateur)
		{
			$id_utilisateurs[]=array('id_utilisateur' => $id_utilisateur);
		}
		$LiaisonConversationUtilisateur->addBy($id_utilisateurs, array(
			'id_conversation' => $this->getId(),
		));
!!!235010.php!!!	modifier()

		$Manager=$this->Manager();
		$Manager->update(array(
			'nom'         => $this->getNom(),
			'description' => $this->getDescription(),
		), $this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$id_utilisateurs=$this->getId_utilisateurs();
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
			$LiaisonConversationUtilisateur->addBy(array(array(
				'id_utilisateur' => $id_utilisateurs,
			)), array(
				'id_conversation' => $this->getId(),
			));
		}
		else
		{
			$id_utilisateurs_a_ajouter=array_diff($id_utilisateurs, $id_utilisateurs_non_modifies);
			$LiaisonConversationUtilisateur->addBy(array(array(
				'id_utilisateur' => $id_utilisateurs_a_ajouter,
			)), array(
				'id_conversation' => $this->getId(),
			));
		}
!!!235138.php!!!	supprimer()

		$Manager=$this->Manager();
		$Manager->delete($this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$LiaisonConversationUtilisateur->deleteBy(array(
			'id_conversation' => $this->getId(),
		));
!!!235266.php!!!	recupererId_utilisateurs()

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
!!!235394.php!!!	recupererUtilisateurs()

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
!!!235522.php!!!	recupererId_messages(in date_historique :  = null)

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
!!!235650.php!!!	recupererMessages()

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
