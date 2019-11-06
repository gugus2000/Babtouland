class Message
!!!235778.php!!!	getId()

		return $this->id;
!!!235906.php!!!	getId_conversation()

		return $this->id_conversation;
!!!236034.php!!!	getId_auteur()

		return $this->id_auteur;
!!!236162.php!!!	getContenu()

		return $this->contenu;
!!!236290.php!!!	getDate_publication()

		return $this->date_publication;
!!!236418.php!!!	getDate_mise_a_jour()

		return $this->date_mise_a_jour;
!!!236546.php!!!	setId(in id : )

		$this->id=(int)$id;
!!!236674.php!!!	setId_conversation(in id_conversation : )

		$this->id_conversation=(int)$id_conversation;
!!!236802.php!!!	setId_auteur(in id_auteur : )

		$this->id_auteur=(int)$id_auteur;
!!!236930.php!!!	setContenu(in contenu : )

		$this->contenu=$contenu;
!!!237058.php!!!	setDate_publication(in date_publication : )

		$this->date_publication=$date_publication;
!!!237186.php!!!	setDate_mise_a_jour(in date_mise_a_jour : )

		$this->date_mise_a_jour=$date_mise_a_jour;
!!!237314.php!!!	afficherId()

		return htmlspecialchars((string)$this->id);
!!!237442.php!!!	afficherId_conversation()

		return htmlspecialchars((string)$this->id_conversation);
!!!237570.php!!!	afficherId_auteur()

		return htmlspecialchars((string)$this->id_auteur);
!!!237698.php!!!	afficherContenu()

		return htmlspecialchars((string)$this->contenu);
!!!237826.php!!!	afficherDate_publication()

		return htmlspecialchars((string)$this->date_publication);
!!!237954.php!!!	afficherDate_mise_a_jour()

		return htmlspecialchars((string)$this->date_mise_a_jour);
!!!238082.php!!!	afficherDate_publicationFormat(in format : )

		return date($format, strtotime($this->date_publication));
!!!238210.php!!!	afficherDate_mise_a_jourFormat(in format : )

		return date($format, strtotime($this->date_mise_a_jour));
!!!238338.php!!!	afficher()

		return $this->afficherContenu();
!!!238466.php!!!	recuperer()

		$this->get($this->getId());
!!!238594.php!!!	creer()

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
!!!238722.php!!!	modifier()

		$Manager=$this->Manager();
		$Manager->update(array(
			'contenu'          => $this->getContenu(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		), $this->getId());
!!!238850.php!!!	supprimer()

		$Manager=$this->Manager();
		$Manager->delete($this->getId());
!!!238978.php!!!	recupererAuteur()

		$Auteur=new \user\Utilisateur(array(
			'id' => $this->getId_auteur(),
		));
		$Auteur->recuperer();
		return $Auteur;
