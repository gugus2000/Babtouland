class Post
!!!154754.php!!!	getId() : int

		return $this->id;
!!!154882.php!!!	getId_auteur() : int

		return $this->id_auteur;
!!!155010.php!!!	getTitre() : string

		return $this->titre;
!!!155138.php!!!	getContenu() : string

		return $this->contenu;
!!!155266.php!!!	getDate_publication() : string

		return $this->date_publication;
!!!155394.php!!!	getDate_mise_a_jour() : string

		return $this->date_mise_a_jour;
!!!155522.php!!!	setId(in id : int) : void

		$this->id=(int)$id;
!!!155650.php!!!	setId_auteur(in id_auteur : int) : void

		$this->id_auteur=(int)$id_auteur;
!!!155778.php!!!	setTitre(in titre : string) : void

		$this->titre=$titre;
!!!155906.php!!!	setContenu(in contenu : string) : void

		$this->contenu=$contenu;
!!!156034.php!!!	setDate_publication(in date_publication : string) : void

		$this->date_publication=$date_publication;
!!!156162.php!!!	setDate_mise_a_jour(in date_mise_a_jour : string) : void

		$this->date_mise_a_jour=$date_mise_a_jour;
!!!156290.php!!!	afficherId() : string

		return htmlspecialchars((string)$this->id);
!!!156418.php!!!	afficherId_auteur() : string

		return htmlspecialchars((string)$this->id_auteur);
!!!156546.php!!!	afficherTitre() : string

		return htmlspecialchars((string)$this->titre);
!!!156674.php!!!	afficherContenu() : string

		return htmlspecialchars((string)$this->contenu);
!!!156802.php!!!	afficherDate_publication() : string

		return htmlspecialchars((string)$this->date_publication);
!!!156930.php!!!	afficherDate_mise_a_jour() : string

		return htmlspecialchars((string)$this->date_mise_a_jour);
!!!157058.php!!!	afficherDate_publicationFormat(in format : string) : string

		return date($format, strtotime($this->date_publication));
!!!157186.php!!!	afficherDate_mise_a_jourFormat(in format : string) : string

		return date($format, strtotime($this->date_mise_a_jour));
!!!157314.php!!!	afficher() : string

		return $this->afficherContenu();
!!!157442.php!!!	publier() : void

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
!!!157570.php!!!	mettre_a_jour() : void

		$Manager=$this->Manager();
		$Manager->update(array(
			'titre'            => $this->getTitre(),
			'contenu'          => $this->getContenu(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		), $this->getId());
!!!157698.php!!!	supprimer() : void

		$Manager=$this->Manager();
		$Manager->delete($this->getId());
!!!157826.php!!!	recupererAuteur() : Utilisateur

		$Utilisateur=new \user\Utilisateur(array());
		$Utilisateur->get($this->getId_auteur());
		return $Utilisateur;
!!!157954.php!!!	recupererCommentaires() : array

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
!!!158082.php!!!	recuperer() : void

		$this->get($this->getId());
