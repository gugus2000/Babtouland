class Commentaire
!!!151298.php!!!	getId() : int

		return $this->id;
!!!151426.php!!!	getId_auteur() : int

		return $this->id_auteur;
!!!151554.php!!!	getId_post() : int

		return $this->id_post;
!!!151682.php!!!	getContenu() : string

		return $this->contenu;
!!!151810.php!!!	getDate_publication() : string

		return $this->date_publication;
!!!151938.php!!!	getDate_mise_a_jour() : string

		return $this->date_mise_a_jour;
!!!152066.php!!!	setId(in id : int) : void

		$this->id=(int)$id;
!!!152194.php!!!	setId_auteur(in id_auteur : int) : void

		$this->id_auteur=(int)$id_auteur;
!!!152322.php!!!	setId_post(in id_post : int) : void

		$this->id_post=(int)$id_post;
!!!152450.php!!!	setContenu(in contenu : string) : void

		$this->contenu=$contenu;
!!!152578.php!!!	setDate_publication(in date_publication : string) : void

		$this->date_publication=$date_publication;
!!!152706.php!!!	setDate_mise_a_jour(in date_mise_a_jour : string) : void

		$this->date_mise_a_jour=$date_mise_a_jour;
!!!152834.php!!!	afficherId() : string

		return htmlspecialchars((string)$this->id);
!!!152962.php!!!	afficherId_auteur() : string

		return htmlspecialchars((string)$this->id_auteur);
!!!153090.php!!!	afficherid_post() : string

		return htmlspecialchars((string)$this->id_post);
!!!153218.php!!!	afficherContenu() : string

		return htmlspecialchars((string)$this->contenu);
!!!153346.php!!!	afficherDate_publication() : string

		return htmlspecialchars((string)$this->date_publication);
!!!153474.php!!!	afficherDate_mise_a_jour() : string

		return htmlspecialchars((string)$this->date_mise_a_jour);
!!!153602.php!!!	afficherDate_publicationFormat(in format : string) : string

		return date($format, strtotime($this->date_publication));
!!!153730.php!!!	afficherDate_mise_a_jourFormat(in format : string) : string

		return date($format, strtotime($this->date_mise_a_jour));
!!!153858.php!!!	afficher() : string

		return $this->afficherContenu();
!!!153986.php!!!	publier() : void

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
!!!154114.php!!!	mettre_a_jour() : void

		$Manager=$this->Manager();
		$Manager->update(array(
			'contenu'          => $this->getContenu(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		), $this->getId());
!!!154242.php!!!	supprimer() : void

		$Manager=$this->Manager();
		$Manager->delete($this->getId());
!!!154370.php!!!	recupererAuteur() : Utilisateur

		$Utilisateur=new \user\Utilisateur(array());
		$Utilisateur->get($this->getId_auteur());
		return $Utilisateur;
!!!154498.php!!!	recupererPost() : Post

		$Post=new \post\Post(array(
			'id' => $this->getId_post(),
		));
		$Post->recuperer();
		return $Post;
!!!154626.php!!!	recuperer() : void

		$this->get($this->getId());
