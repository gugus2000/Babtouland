class Notification
!!!214402.php!!!	getId()

		return $this->id;
!!!214530.php!!!	getType()

		return $this->type;
!!!214658.php!!!	getDate_publication()

		return $this->date_publication;
!!!214786.php!!!	getContenu_defaut()

		return $this->contenu_defaut;
!!!214914.php!!!	getContenu_FR()

		return $this->contenu_FR;
!!!215042.php!!!	getContenu_EN()

		return $this->contenu_EN;
!!!215170.php!!!	getId_utilisateurs()

		return $this->id_utilisateurs;
!!!215298.php!!!	setId(in id : )

		$this->id=(int)$id;
!!!215426.php!!!	setType(in type : )

		$this->type=$type;
!!!215554.php!!!	setDate_publication(in date_publication : )

		$this->date_publication=$date_publication;
!!!215682.php!!!	setContenu_defaut(in contenu_defaut : )

		$this->contenu_defaut=$contenu_defaut;
!!!215810.php!!!	setContenu_FR(in contenu_FR : )

		$this->contenu_FR=$contenu_FR;
!!!215938.php!!!	setContenu_EN(in contenu_EN : )

		$this->contenu_EN=$contenu_EN;
!!!216066.php!!!	setId_utilisateurs(in id_utilisateurs : )

		$this->id_utilisateurs=$id_utilisateurs;
!!!216194.php!!!	afficherId()

		return htmlspecialchars((string)$this->id);
!!!216322.php!!!	afficherType()

		return htmlspecialchars((string)$this->type);
!!!216450.php!!!	afficherDate_publication()

		return htmlspecialchars((string)$this->date_publication);
!!!216578.php!!!	afficherContenu_defaut()

		return htmlspecialchars((string)$this->contenu_defaut);
!!!216706.php!!!	afficherContenu_FR()

		return htmlspecialchars((string)$this->contenu_FR);
!!!216834.php!!!	afficherContenu_EN()

		return htmlspecialchars((string)$this->contenu_EN);
!!!216962.php!!!	afficherDate_publicationFormat(in format : )

		return date($format, strtotime($this->date_publication));
!!!217090.php!!!	afficheId_utilisateurs()

		$affichage='';
		foreach ($this->id_utilisateurs as $id_utilisateur)
		{
			$affichage.=htmlspecialchars($id_utilisateur);
		}
		return $affichage;
!!!217218.php!!!	afficher()

		$this->afficherContenu_defaut();
!!!217346.php!!!	recuperer()

		$this->get($this->getId());
		$this->recupererId_utilisateurs();
!!!217474.php!!!	envoyerNotification(in Page :  = null, in langue :  = null)

		global $config, $lang, $Visiteur;
		if (!$langue)
		{
			$langue=$lang['lang_self']['abbr'];
		}
		else if(!\in_array($langue, $config['lang_available']))
		{
			$langue=$lang['lang_self']['abbr'];
		}
		$methode='afficherContenu_'.$langue;
		if (!$this->$methode())		// Pas de contenu pour la langue utilisée
		{
			$methode='afficherContenu_defaut';
		}
		$Notification=new \user\page\Notification(array(
			'type'    => $this->afficherType(),
			'contenu' => $this->$methode(),
		), $Page);
		$BDDFactory=new \core\BDDFactory;
		$LiaisonNotificationUtilisateur=new \user\LiaisonNotificationUtilisateur($BDDFactory->MysqlConnexion());
		$LiaisonNotificationUtilisateur->deleteBy(array(
			'id_notification' => $this->getId(),
			'id_utilisateur'  => $Visiteur->getId(),
		));
!!!217602.php!!!	creer()

		$Manager=$this->Manager();
		$Manager->add(array(
			'type'             => $this->getType(),
			'date_publication' => date('Y-m-d H:i:s'),
			'contenu_defaut'   => $this->getContenu_defaut(),
			'contenu_FR'       => $this->getContenu_FR(),
			'contenu_EN'       => $this->getContenu_EN(),
		));
		$this->setId($Manager->getIdBy(array(
			'type'           => $this->getType(),
			'contenu_defaut' => $this->getContenu_defaut(),
			'contenu_FR'     => $this->getContenu_FR(),
			'contenu_EN'     => $this->getContenu_EN(),
		)));
		$BDDFactory=new \core\BDDFactory;
		$LiaisonNotificationUtilisateur=new \user\LiaisonNotificationUtilisateur($BDDFactory->MysqlConnexion());
		$id_utilisateurs=array();
		foreach ($this->getId_utilisateurs() as $id_utilisateur)
		{
			$id_utilisateurs[]=array('id_utilisateur' => $id_utilisateur);
		}
		$LiaisonNotificationUtilisateur->addBy($id_utilisateurs, array(
			'id_notification' => $this->getId(),
		));
!!!217730.php!!!	modifier()

		$Manager=$this->Manager();
		$Manager->update(array(
			'type'           => $this->getType(),
			'date_publication' => date('Y-m-d H:i:s'),
			'contenu_defaut' => $this->getContenu_defaut(),
			'contenu_FR'     => $this->getContenu_FR(),
			'contenu_EN'     => $this->getContenu_EN(),
		), $this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonNotificationUtilisateur=new \user\LiaisonNotificationUtilisateur($BDDFactory->MysqlConnexion());
		$id_utilisateurs=$this->getId_utilisateurs();
		$donnees_already_in=$LiaisonNotificationUtilisateur->get(array(
			'id_notification' => $this->getId(),
		), array(
			'id_notification' => '=',
		));
		$id_utilisateurs_already_in=array();
		foreach ($donnees_already_in as $donnee)
		{
			$id_utilisateurs_already_in[]=$donnee['id_utilisateur'];
		}
		$id_utilisateurs_non_modifies=array_intersect($id_utilisateurs_already_in, $id_utilisateurs);
		if(array_diff($id_utilisateurs_non_modifies, $id_utilisateurs_already_in))	// Il y a des utilisateurs qui ne sont plus dans la discussion
		{
			$LiaisonNotificationUtilisateur->deleteBy(array(
				'id_notification' => $this->getId(),
			));
			$LiaisonNotificationUtilisateur->addBy(array(array(
				'id_utilisateur' => $id_utilisateurs,
			)), array(
				'id_notification' => $this->getId(),
			));
		}
		else
		{
			$id_utilisateurs_a_ajouter=array_diff($id_utilisateurs, $id_utilisateurs_non_modifies);
			$LiaisonNotificationUtilisateur->addBy(array(array(
				'id_utilisateur' => $id_utilisateurs_a_ajouter,
			)), array(
				'id_notification' => $this->getId(),
			));
		}
!!!217858.php!!!	supprimer()

		$Manager=$this->Manager();
		$Manager->delete($this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonNotificationUtilisateur=new \user\LiaisonNotificationUtilisateur($BDDFactory->MysqlConnexion());
		$LiaisonNotificationUtilisateur->deleteBy(array(
			'id_notification' => $this->getId(),
		));
!!!217986.php!!!	recupererId_utilisateurs()

		$BDDFactory=new \core\BDDFactory;
		$Liaison=new \user\LiaisonNotificationUtilisateur($BDDFactory->MysqlConnexion());
		$resultats=$Liaison->get(array(
			'id_notification' => $this->getId(),
		), array(
			'id_notification' => '=',
		));
		$id=array();
		foreach ($resultats as $resultat)
		{
			$id[]=$resultat['id_utilisateur'];
		}
		$this->setId_utilisateurs($id);
!!!218114.php!!!	recupererUtilisateurs()

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
