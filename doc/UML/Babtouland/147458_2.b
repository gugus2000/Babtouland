class Commentaire
!!!256130.php!!!	getId()

		return $this->id;
!!!256258.php!!!	getId_auteur()

		return $this->id_auteur;
!!!256386.php!!!	getId_post()

		return $this->id_post;
!!!256514.php!!!	getContenu()

		return $this->contenu;
!!!256642.php!!!	getDate_publication()

		return $this->date_publication;
!!!256770.php!!!	getDate_mise_a_jour()

		return $this->date_mise_a_jour;
!!!256898.php!!!	setId(in id : )

		$this->id=(int)$id;
!!!257026.php!!!	setId_auteur(in id_auteur : )

		$this->id_auteur=(int)$id_auteur;
!!!257154.php!!!	setId_post(in id_post : )

		$this->id_post=(int)$id_post;
!!!257282.php!!!	setContenu(in contenu : )

		$this->contenu=$contenu;
!!!257410.php!!!	setDate_publication(in date_publication : )

		$this->date_publication=$date_publication;
!!!257538.php!!!	setDate_mise_a_jour(in date_mise_a_jour : )

		$this->date_mise_a_jour=$date_mise_a_jour;
!!!257666.php!!!	afficherId()

		return htmlspecialchars((string)$this->id);
!!!257794.php!!!	afficherId_auteur()

		return htmlspecialchars((string)$this->id_auteur);
!!!257922.php!!!	afficherid_post()

		return htmlspecialchars((string)$this->id_post);
!!!258050.php!!!	afficherContenu()

		return htmlspecialchars((string)$this->contenu);
!!!258178.php!!!	afficherDate_publication()

		return htmlspecialchars((string)$this->date_publication);
!!!258306.php!!!	afficherDate_mise_a_jour()

		return htmlspecialchars((string)$this->date_mise_a_jour);
!!!258434.php!!!	afficherDate_publicationFormat(in format : )

		return date($format, strtotime($this->date_publication));
!!!258562.php!!!	afficherDate_mise_a_jourFormat(in format : )

		return date($format, strtotime($this->date_mise_a_jour));
!!!258690.php!!!	afficher()

		return $this->afficherContenu();
!!!258818.php!!!	publier()

		$Manager=$this->Manager();
		$Manager->add(array(
			'id_auteur'        => $this->getId_auteur(),
			'id_post'          => $this->getId_post(),
			'contenu'          => $this->getContenu(),
			'date_publication' => $this->getDate_publication(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		));
		$this->setId($Manager->getIdBy(array(
			'id_auteur'        => $this->getId_auteur(),
			'id_post'          => $this->getId_post(),
			'contenu'          => $this->getContenu(),
			'date_publication' => $this->getDate_publication(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		)));
!!!258946.php!!!	mettre_a_jour()

		$Manager=$this->Manager();
		$Manager->update(array(
			'contenu'          => $this->getContenu(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		), $this->getId());
!!!259074.php!!!	supprimer()

		$Manager=$this->Manager();
		$Manager->delete($this->getId());
!!!259202.php!!!	recupererAuteur()

		$Utilisateur=new \user\Utilisateur(array());
		$Utilisateur->get($this->getId_auteur());
		return $Utilisateur;
!!!259330.php!!!	recupererPost()

		$Post=new \post\Post(array(
			'id' => $this->getId_post(),
		));
		$Post->recuperer();
		return $Post;
!!!259458.php!!!	recuperer()

		$this->get($this->getId());
