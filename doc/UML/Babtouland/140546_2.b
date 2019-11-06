class Message
!!!185730.php!!!	getId()

		return $this->id;
!!!185858.php!!!	getId_conversation()

		return $this->id_conversation;
!!!185986.php!!!	getId_auteur()

		return $this->id_auteur;
!!!186114.php!!!	getContenu()

		return $this->contenu;
!!!186242.php!!!	getDate_publication()

		return $this->date_publication;
!!!186370.php!!!	getDate_mise_a_jour()

		return $this->date_mise_a_jour;
!!!186498.php!!!	setId(in id : )

		$this->id=(int)$id;
!!!186626.php!!!	setId_conversation(in id_conversation : )

		$this->id_conversation=(int)$id_conversation;
!!!186754.php!!!	setId_auteur(in id_auteur : )

		$this->id_auteur=(int)$id_auteur;
!!!186882.php!!!	setContenu(in contenu : )

		$this->contenu=$contenu;
!!!187010.php!!!	setDate_publication(in date_publication : )

		$this->date_publication=$date_publication;
!!!187138.php!!!	setDate_mise_a_jour(in date_mise_a_jour : )

		$this->date_mise_a_jour=$date_mise_a_jour;
!!!187266.php!!!	afficherId()

		return htmlspecialchars((string)$this->id);
!!!187394.php!!!	afficherId_conversation()

		return htmlspecialchars((string)$this->id_conversation);
!!!187522.php!!!	afficherId_auteur()

		return htmlspecialchars((string)$this->id_auteur);
!!!187650.php!!!	afficherContenu()

		return htmlspecialchars((string)$this->contenu);
!!!187778.php!!!	afficherDate_publication()

		return htmlspecialchars((string)$this->date_publication);
!!!187906.php!!!	afficherDate_mise_a_jour()

		return htmlspecialchars((string)$this->date_mise_a_jour);
!!!188034.php!!!	afficherDate_publicationFormat(in format : )

		return date($format, strtotime($this->date_publication));
!!!188162.php!!!	afficherDate_mise_a_jourFormat(in format : )

		return date($format, strtotime($this->date_mise_a_jour));
!!!188290.php!!!	afficher()

		return $this->afficherContenu();
!!!188418.php!!!	recuperer()

		$this->get($this->getId());
!!!188546.php!!!	creer()

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
!!!188674.php!!!	modifier()

		$Manager=$this->Manager();
		$Manager->update(array(
			'contenu'          => $this->getContenu(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		), $this->getId());
!!!188802.php!!!	supprimer()

		$Manager=$this->Manager();
		$Manager->delete($this->getId());
!!!188930.php!!!	recupererAuteur()

		$Auteur=new \user\Utilisateur(array(
			'id' => $this->getId_auteur(),
		));
		$Auteur->recuperer();
		return $Auteur;
