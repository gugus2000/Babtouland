class Post
!!!209538.php!!!	getId()

		return $this->id;
!!!209666.php!!!	getId_auteur()

		return $this->id_auteur;
!!!209794.php!!!	getTitre()

		return $this->titre;
!!!209922.php!!!	getContenu()

		return $this->contenu;
!!!210050.php!!!	getDate_publication()

		return $this->date_publication;
!!!210178.php!!!	getDate_mise_a_jour()

		return $this->date_mise_a_jour;
!!!210306.php!!!	setId(in id : )

		$this->id=(int)$id;
!!!210434.php!!!	setId_auteur(in id_auteur : )

		$this->id_auteur=(int)$id_auteur;
!!!210562.php!!!	setTitre(in titre : )

		$this->titre=$titre;
!!!210690.php!!!	setContenu(in contenu : )

		$this->contenu=$contenu;
!!!210818.php!!!	setDate_publication(in date_publication : )

		$this->date_publication=$date_publication;
!!!210946.php!!!	setDate_mise_a_jour(in date_mise_a_jour : )

		$this->date_mise_a_jour=$date_mise_a_jour;
!!!211074.php!!!	afficherId()

		return htmlspecialchars((string)$this->id);
!!!211202.php!!!	afficherId_auteur()

		return htmlspecialchars((string)$this->id_auteur);
!!!211330.php!!!	afficherTitre()

		return htmlspecialchars((string)$this->titre);
!!!211458.php!!!	afficherContenu()

		return htmlspecialchars((string)$this->contenu);
!!!211586.php!!!	afficherDate_publication()

		return htmlspecialchars((string)$this->date_publication);
!!!211714.php!!!	afficherDate_mise_a_jour()

		return htmlspecialchars((string)$this->date_mise_a_jour);
!!!211842.php!!!	afficherDate_publicationFormat(in format : )

		return date($format, strtotime($this->date_publication));
!!!211970.php!!!	afficherDate_mise_a_jourFormat(in format : )

		return date($format, strtotime($this->date_mise_a_jour));
!!!212098.php!!!	afficher()

		return $this->afficherContenu();
!!!212226.php!!!	publier()

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
!!!212354.php!!!	mettre_a_jour()

		$Manager=$this->Manager();
		$Manager->update(array(
			'titre'            => $this->getTitre(),
			'contenu'          => $this->getContenu(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		), $this->getId());
!!!212482.php!!!	supprimer()

		$Manager=$this->Manager();
		$Manager->delete($this->getId());
!!!212610.php!!!	recupererAuteur()

		$Utilisateur=new \user\Utilisateur(array());
		$Utilisateur->get($this->getId_auteur());
		return $Utilisateur;
!!!212738.php!!!	recupererCommentaires()

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
!!!212866.php!!!	recuperer()

		$this->get($this->getId());
