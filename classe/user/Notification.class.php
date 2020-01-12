<?php


namespace user;

/**
 * Notification à afficher
 */
class Notification extends \core\Managed
{
	/* Attributs */

	/**
	* Id de la notification
	* 
	* @var int
	*/
	protected $id;
	/**
	* Type de la notification
	* 
	* @var string
	*/
	protected $type;
	/**
	* Date de la publication de la notification
	* 
	* @var string
	*/
	protected $date_publication;
	/**
	* Contenu de la notification lorsque la langue n'est pas supportée
	* 
	* @var string
	*/
	protected $contenu_defaut;
	/**
	* Contenu de la notification en français
	* 
	* @var string
	*/
	protected $contenu_FR;
	/**
	* Contenu de la notification en anglais
	* 
	* @var string
	*/
	protected $contenu_EN;
	/**
	* Id des utilisateurs devant voir la notification
	* 
	* @var array
	*/
	protected $id_utilisateurs;

	/* Accesseur */

	/**
	* Accesseur de id
	* 
	* @return int
	*/
	public function getId()
	{
		return $this->id;
	}
	/**
	* Accesseur de type
	* 
	* @return string
	*/
	public function getType()
	{
		return $this->type;
	}
	/**
	* Accesseur de date_publication
	* 
	* @return string
	*/
	public function getDate_publication()
	{
		return $this->date_publication;
	}
	/**
	* Accesseur de contenu_defaut
	* 
	* @return string
	*/
	public function getContenu_defaut()
	{
		return $this->contenu_defaut;
	}
	/**
	* Accesseur de contenu_FR
	* 
	* @return string
	*/
	public function getContenu_FR()
	{
		return $this->contenu_FR;
	}
	/**
	* Accesseur de contenu_EN
	* 
	* @return string
	*/
	public function getContenu_EN()
	{
		return $this->contenu_EN;
	}
	/**
	* Accesseur de id_utilisateurs
	* 
	* @return array
	*/
	public function getId_utilisateurs()
	{
		return $this->id_utilisateurs;
	}

	/* Définisseur */

	/**
	* Définisseur de id
	*
	* @param int id Id de la notification
	* 
	* @return void
	*/
	protected function setId($id)
	{
		$this->id=(int)$id;
	}
	/**
	* Définisseur de type
	*
	* @param string type Type de la notification
	* 
	* @return void
	*/
	protected function setType($type)
	{
		$this->type=$type;
	}
	/**
	* Définisseur de date_publication
	*
	* @param string date_publication Date de la publication de la notification
	* 
	* @return void
	*/
	protected function setDate_publication($date_publication)
	{
		$this->date_publication=$date_publication;
	}
	/**
	* Définisseur de contenu_defaut
	*
	* @param string contenu_defaut Contenu de la notification lorsque la langue n'est pas supportée
	* 
	* @return void
	*/
	protected function setContenu_defaut($contenu_defaut)
	{
		$this->contenu_defaut=$contenu_defaut;
	}
	/**
	* Définisseur de contenu_FR
	*
	* @param string contenu_FR Contenu de la notification en français
	* 
	* @return void
	*/
	protected function setContenu_FR($contenu_FR)
	{
		$this->contenu_FR=$contenu_FR;
	}
	/**
	* Définisseur de contenu_EN
	*
	* @param string contenu_EN Contenu de la notification en anglais
	* 
	* @return void
	*/
	protected function setContenu_EN($contenu_EN)
	{
		$this->contenu_EN=$contenu_EN;
	}
	/**
	* Définisseur de id_utilisateurs
	*
	* @param array id_utilisateurs Id des utilisateurs devant voir la notification
	* 
	* @return void
	*/
	protected function setId_utilisateurs($id_utilisateurs)
	{
		$this->id_utilisateurs=$id_utilisateurs;
	}

	/* Afficheur */

	/**
	* Afficheur de id
	* 
	* @return string
	*/
	public function afficherId()
	{
		return htmlspecialchars((string)$this->id);
	}
	/**
	* Afficheur de type
	* 
	* @return string
	*/
	public function afficherType()
	{
		return htmlspecialchars((string)$this->type);
	}
	/**
	* Afficheur de date_publication
	* 
	* @return string
	*/
	public function afficherDate_publication()
	{
		return htmlspecialchars((string)$this->date_publication);
	}
	/**
	* Afficheur de contenu_defaut
	* 
	* @return string
	*/
	public function afficherContenu_defaut()
	{
		return htmlspecialchars((string)$this->contenu_defaut);
	}
	/**
	* Afficheur de contenu_FR
	* 
	* @return string
	*/
	public function afficherContenu_FR()
	{
		return htmlspecialchars((string)$this->contenu_FR);
	}
	/**
	* Afficheur de contenu_EN
	* 
	* @return string
	*/
	public function afficherContenu_EN()
	{
		return htmlspecialchars((string)$this->contenu_EN);
	}
	/**
	* Affiche date_publication avec le bon format
	*
	* @param string format Format de l'affichage de la date
	*
	* @return string
	*/
	public function afficherDate_publicationFormat($format)
	{
		return date($format, strtotime($this->date_publication));
	}
	/**
	* Afficheur de id_utilisateurs
	*
	* @return string
	*/
	public function afficheId_utilisateurs()
	{
		$affichage='';
		foreach ($this->id_utilisateurs as $id_utilisateur)
		{
			$affichage.=htmlspecialchars($id_utilisateur);
		}
		return $affichage;
	}
	/**
	* Afficheur de notification
	* 
	* @return string
	*/
	public function afficher()
	{
		$this->afficherContenu_defaut();
	}

	/* Autres méthode */

	/**
	* Recuperer une notification
	*
	* @return void
	*/
	public function recuperer()
	{
		$this->get($this->getId());
		$this->recupererId_utilisateurs();
	}
	/**
	* Envoyer la notification sur la page
	*
	* @param \user\page\Page Page Page
	*
	* @param string lang Langue dans laquelle afficher la notification (abbr)
	* 
	* @return void
	*/
	public function envoyerNotification($Page=null, $langue=null)
	{
		global $config, $lang, $Visiteur;
		if (!$Page)
		{
			$Page=$Visiteur->getPage();
		}
		if (!$langue|!\in_array($langue, $config['lang_available']))
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
	}
	/**
	* Créer une notification
	*
	* @return void
	*/
	public function creer()
	{
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
	}
	/**
	* Modifier une notification
	*
	* @return void
	*/
	public function modifier()
	{
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
	}
	/**
	* Supprimer une notification
	*
	* @return void
	*/
	public function supprimer()
	{
		$Manager=$this->Manager();
		$Manager->delete($this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonNotificationUtilisateur=new \user\LiaisonNotificationUtilisateur($BDDFactory->MysqlConnexion());
		$LiaisonNotificationUtilisateur->deleteBy(array(
			'id_notification' => $this->getId(),
		));
	}
	/**
	* Récupère l'id des utilisateurs devant voir la notification
	*
	* @return void
	*/
	public function recupererId_utilisateurs()
	{
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
	}
	/**
	* Récupère les utilisateurs devant voir la notification
	* 
	* @return array
	*/
	public function recupererUtilisateurs()
	{
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
	}

}

?>