class Post
!!!259586.php!!!	getId()

		return $this->id;
!!!259714.php!!!	getId_auteur()

		return $this->id_auteur;
!!!259842.php!!!	getTitre()

		return $this->titre;
!!!259970.php!!!	getContenu()

		return $this->contenu;
!!!260098.php!!!	getDate_publication()

		return $this->date_publication;
!!!260226.php!!!	getDate_mise_a_jour()

		return $this->date_mise_a_jour;
!!!260354.php!!!	setId(in id : )

		$this->id=(int)$id;
!!!260482.php!!!	setId_auteur(in id_auteur : )

		$this->id_auteur=(int)$id_auteur;
!!!260610.php!!!	setTitre(in titre : )

		$this->titre=$titre;
!!!260738.php!!!	setContenu(in contenu : )

		$this->contenu=$contenu;
!!!260866.php!!!	setDate_publication(in date_publication : )

		$this->date_publication=$date_publication;
!!!260994.php!!!	setDate_mise_a_jour(in date_mise_a_jour : )

		$this->date_mise_a_jour=$date_mise_a_jour;
!!!261122.php!!!	afficherId()

		return htmlspecialchars((string)$this->id);
!!!261250.php!!!	afficherId_auteur()

		return htmlspecialchars((string)$this->id_auteur);
!!!261378.php!!!	afficherTitre()

		return htmlspecialchars((string)$this->titre);
!!!261506.php!!!	afficherContenu()

		return htmlspecialchars((string)$this->contenu);
!!!261634.php!!!	afficherDate_publication()

		return htmlspecialchars((string)$this->date_publication);
!!!261762.php!!!	afficherDate_mise_a_jour()

		return htmlspecialchars((string)$this->date_mise_a_jour);
!!!261890.php!!!	afficherDate_publicationFormat(in format : )

		return date($format, strtotime($this->date_publication));
!!!262018.php!!!	afficherDate_mise_a_jourFormat(in format : )

		return date($format, strtotime($this->date_mise_a_jour));
!!!262146.php!!!	afficher()

		return $this->afficherContenu();
!!!262274.php!!!	publier()

		$Manager=$this->Manager();
		$Manager->add(array(
			'id_auteur'        => $this->getId_auteur(),
			'titre'            => $this->getTitre(),
			'contenu'          => $this->getContenu(),
			'date_publication' => $this->getDate_publication(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		));
		$this->setId($Manager->getIdBy(array(
			'id_auteur'        => $this->getId_auteur(),
			'titre'            => $this->getTitre(),
			'contenu'          => $this->getContenu(),
			'date_publication' => $this->getDate_publication(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		)));
!!!262402.php!!!	mettre_a_jour()

		$Manager=$this->Manager();
		$Manager->update(array(
			'titre'            => $this->getTitre(),
			'contenu'          => $this->getContenu(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		), $this->getId());
!!!262530.php!!!	supprimer()

		$Manager=$this->Manager();
		$Manager->delete($this->getId());
!!!262658.php!!!	recupererAuteur()

		$Utilisateur=new \user\Utilisateur(array());
		$Utilisateur->get($this->getId_auteur());
		return $Utilisateur;
!!!262786.php!!!	recupererCommentaires()

		$BDDFactory=new \core\BDDFactory;
		$CommentaireManager=new \post\CommentaireManager($BDDFactory->MysqlConnexion());
		$commentaires=array();
		$donnees=$CommentaireManager->getBy(array(
			'id_post' => $this->getId(),
		), array(
			'id_post' => '=',
		));
		foreach ($donnees as $key => $donnee)
		{
			$Commentaire=new \post\Commentaire($donnee);
			$commentaires[]=$Commentaire;
		}
		return $commentaires;
!!!262914.php!!!	recuperer()

		$this->get($this->getId());
