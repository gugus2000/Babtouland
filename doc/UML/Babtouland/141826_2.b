class Commentaire
!!!206082.php!!!	getId()

		return $this->id;
!!!206210.php!!!	getId_auteur()

		return $this->id_auteur;
!!!206338.php!!!	getId_post()

		return $this->id_post;
!!!206466.php!!!	getContenu()

		return $this->contenu;
!!!206594.php!!!	getDate_publication()

		return $this->date_publication;
!!!206722.php!!!	getDate_mise_a_jour()

		return $this->date_mise_a_jour;
!!!206850.php!!!	setId(in id : )

		$this->id=(int)$id;
!!!206978.php!!!	setId_auteur(in id_auteur : )

		$this->id_auteur=(int)$id_auteur;
!!!207106.php!!!	setId_post(in id_post : )

		$this->id_post=(int)$id_post;
!!!207234.php!!!	setContenu(in contenu : )

		$this->contenu=$contenu;
!!!207362.php!!!	setDate_publication(in date_publication : )

		$this->date_publication=$date_publication;
!!!207490.php!!!	setDate_mise_a_jour(in date_mise_a_jour : )

		$this->date_mise_a_jour=$date_mise_a_jour;
!!!207618.php!!!	afficherId()

		return htmlspecialchars((string)$this->id);
!!!207746.php!!!	afficherId_auteur()

		return htmlspecialchars((string)$this->id_auteur);
!!!207874.php!!!	afficherid_post()

		return htmlspecialchars((string)$this->id_post);
!!!208002.php!!!	afficherContenu()

		return htmlspecialchars((string)$this->contenu);
!!!208130.php!!!	afficherDate_publication()

		return htmlspecialchars((string)$this->date_publication);
!!!208258.php!!!	afficherDate_mise_a_jour()

		return htmlspecialchars((string)$this->date_mise_a_jour);
!!!208386.php!!!	afficherDate_publicationFormat(in format : )

		return date($format, strtotime($this->date_publication));
!!!208514.php!!!	afficherDate_mise_a_jourFormat(in format : )

		return date($format, strtotime($this->date_mise_a_jour));
!!!208642.php!!!	afficher()

		return $this->afficherContenu();
!!!208770.php!!!	publier()

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
!!!208898.php!!!	mettre_a_jour()

		$Manager=$this->Manager();
		$Manager->update(array(
			'contenu'          => $this->getContenu(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		), $this->getId());
!!!209026.php!!!	supprimer()

		$Manager=$this->Manager();
		$Manager->delete($this->getId());
!!!209154.php!!!	recupererAuteur()

		$Utilisateur=new \user\Utilisateur(array());
		$Utilisateur->get($this->getId_auteur());
		return $Utilisateur;
!!!209282.php!!!	recupererPost()

		$Post=new \post\Post(array(
			'id' => $this->getId_post(),
		));
		$Post->recuperer();
		return $Post;
!!!209410.php!!!	recuperer()

		$this->get($this->getId());
