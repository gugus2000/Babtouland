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
	* Id du Contenu de la notification
	* 
	* @var string
	*/
	protected $id_contenu;
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
	* Accesseur de id_contenu
	* 
	* @return string
	*/
	public function getId_contenu()
	{
		return $this->id_contenu;
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
	* Définisseur de id_contenu
	*
	* @param string id_contenut Id du Contenu de la notification
	* 
	* @return void
	*/
	protected function setId_contenu($id_contenu)
	{
		$this->id_contenu=$id_contenu;
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
	* Afficheur de id_contenu
	* 
	* @return string
	*/
	public function afficherId_contenu()
	{
		return htmlspecialchars((string)$this->id_contenu);
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
	public function afficherId_utilisateurs()
	{
		$affichage='';
		foreach ($this->id_utilisateurs as $id_utilisateur)
		{
			$affichage.=htmlspecialchars($id_utilisateur);
		}
		return $affichage;
	}
	/**
	* Afficheur de Contenu
	* 
	* @return string
	*/
	public function afficherContenu()
	{
		global $Visiteur;
		$Contenu=new \contenu\Contenu(array(
			'id_contenu' => $this->getId_contenu(),
		));
		$Contenu->recupererLang($Visiteur->getConfiguration('lang'));
		return $Contenu->afficher();
	}

	/* Autres méthode */

	/**
	* Afficheur de Notification
	* 
	* @return string
	*/
	public function afficher()
	{
		return $this->afficherContenu();
	}
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
	* Renvoie tous les contenus de toutes les langues
	* 
	* @return array
	*/
	public function getContenus()
	{
		$ContenuManager=new \contenu\ContenuManager(\core\BDDFactory::MysqlConnexion());
		$contenus=$ContenuManager->getBy(array(
			'id_contenu' => $this->getId_contenu(),
		), array(
			'id_contenu' => '=',
		));
		$Contenus=array();
		foreach ($contenus as $contenu)
		{
			$Contenus[]=new \contenu\Contenu($contenu);
		}
		return $Contenus;
	}
	/**
	* Renvoie le contenu pour la langue donnée
	*
	* @param string lang Langue demandée
	* 
	* @return \contenu\Contenu
	*/
	public function getContenu($lang)
	{
		$ContenuManager=new \contenu\ContenuManager(\core\BDDFactory::MysqlConnexion());
		$contenus=$ContenuManager->getBy(array(
			'id_contenu' => $this->getId_contenu(),
			'lang'       => $lang,
		), array(
			'id_contenu' => '=',
			'lang'       => '=',
		), array(
			'ordre' => 'date_publication',
			'fin'   => 0,
		));
		return new \contenu\Contenu($contenus[0]);
	}
	/**
	* Envoyer la notification sur la page
	*
	* @param \user\page\Page Page Page
	* 
	* @return void
	*/
	public function envoyerNotification($Page=null)
	{
		global $config, $Visiteur;
		if (!$Page)
		{
			$Page=$Visiteur->getPage();
		}
		$Notification=new \user\page\Notification(array(
			'type'    => $this->afficherType(),
			'contenu' => $this->afficherContenu(),
		), $Page);
		$BDDFactory=new \core\BDDFactory;
		$LiaisonNotificationUtilisateur=new \user\LiaisonNotificationUtilisateur($BDDFactory->MysqlConnexion());
		$LiaisonNotificationUtilisateur->deleteBy(array(
			'id_notification' => $this->getId(),
			'id_utilisateur'  => $Visiteur->getId(),
		), array(
			'id_notification' => '=',
			'id_utilisateur'  => '=',
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
			'id_contenu'       => $this->getId_contenu(),
		));
		$this->setId($Manager->getIdBy(array(
			'type'    => $this->getType(),
			'id_contenu' => $this->getId_contenu(),
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
			'type'             => $this->getType(),
			'date_publication' => date('Y-m-d H:i:s'),
		), $this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonNotificationUtilisateur=new \user\LiaisonNotificationUtilisateur($BDDFactory->MysqlConnexion());
		$id_utilisateurs=$this->getId_utilisateurs();
		$donnees_already_in=$LiaisonNotificationUtilisateur->get('id_notification', $this->getId());
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
			), array(
				'id_notification' => '=',
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
		$this->recuperer();
		$Manager->delete($this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonNotificationUtilisateur=new \user\LiaisonNotificationUtilisateur($BDDFactory->MysqlConnexion());
		$LiaisonNotificationUtilisateur->deleteBy(array(
			'id_notification' => $this->getId(),
		), array(
			'id_notification' => '=',
		));
		$ContenuManager=new \contenu\ContenuManager(\core\BDDFactory::MysqlConnexion());
		$ContenuManager->deleteBy(array(
			'id_contenu' => $this->getId_contenu(),
		), array(
			'id_contenu' => '=',
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
		$resultats=$Liaison->get('id_notification', $this->getId());
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