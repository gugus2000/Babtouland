class Message
!!!130946.php!!!	getId() : int

		return $this->id;
!!!131074.php!!!	getId_conversation() : int

		return $this->id_conversation;
!!!131202.php!!!	getId_auteur() : int

		return $this->id_auteur;
!!!131330.php!!!	getContenu() : string

		return $this->contenu;
!!!131458.php!!!	getDate_publication() : string

		return $this->date_publication;
!!!131586.php!!!	getDate_mise_a_jour() : string

		return $this->date_mise_a_jour;
!!!131714.php!!!	setId(in id : int) : void

		$this->id=(int)$id;
!!!131842.php!!!	setId_conversation(in id_conversation : int) : void

		$this->id_conversation=(int)$id_conversation;
!!!131970.php!!!	setId_auteur(in id_auteur : int) : void

		$this->id_auteur=(int)$id_auteur;
!!!132098.php!!!	setContenu(in contenu : string) : void

		$this->contenu=$contenu;
!!!132226.php!!!	setDate_publication(in date_publication : string) : void

		$this->date_publication=$date_publication;
!!!132354.php!!!	setDate_mise_a_jour(in date_mise_a_jour : string) : void

		$this->date_mise_a_jour=$date_mise_a_jour;
!!!132482.php!!!	afficherId() : string

		return htmlspecialchars((string)$this->id);
!!!132610.php!!!	afficherId_conversation() : string

		return htmlspecialchars((string)$this->id_conversation);
!!!132738.php!!!	afficherId_auteur() : string

		return htmlspecialchars((string)$this->id_auteur);
!!!132866.php!!!	afficherContenu() : string

		return htmlspecialchars((string)$this->contenu);
!!!132994.php!!!	afficherDate_publication() : string

		return htmlspecialchars((string)$this->date_publication);
!!!133122.php!!!	afficherDate_mise_a_jour() : string

		return htmlspecialchars((string)$this->date_mise_a_jour);
!!!133250.php!!!	afficherDate_publicationFormat(in format : string) : string

		return date($format, strtotime($this->date_publication));
!!!133378.php!!!	afficherDate_mise_a_jourFormat(in format : string) : string

		return date($format, strtotime($this->date_mise_a_jour));
!!!133506.php!!!	afficher() : string

		return $this->afficherContenu();
!!!133634.php!!!	recuperer() : void

		$this->get($this->getId());
!!!133762.php!!!	creer() : void

		$Manager=$this->Manager();
		$Manager->add(array(
			'id_conversation'  => $this->getId_conversation(),
			'id_auteur'        => $this->getId_auteur(),
			'contenu'          => $this->getContenu(),
			'date_publication' => $this->getDate_publication(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		));
		$this->setId($Manager->getIdBy(array(
			'id_conversation'  => $this->getId_conversation(),
			'id_auteur'        => $this->getId_auteur(),
			'contenu'          => $this->getContenu(),
			'date_publication' => $this->getDate_publication(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		)));
!!!133890.php!!!	modifier() : void

		$Manager=$this->Manager();
		$Manager->update(array(
			'contenu'          => $this->getContenu(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		), $this->getId());
!!!134018.php!!!	supprimer() : void

		$Manager=$this->Manager();
		$Manager->delete($this->getId());
!!!134146.php!!!	recupererAuteur() : Utilisateur

		$Auteur=new \user\Utilisateur(array(
			'id' => $this->getId_auteur(),
		));
		$Auteur->recuperer();
		return $Auteur;
