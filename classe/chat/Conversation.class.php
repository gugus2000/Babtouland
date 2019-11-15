<?php

namespace chat;

/**
* Conversation d'un chat
*/
class Conversation extends \core\Managed
{
	/* Attributs */

	/**
	* Id de la conversation
	*
	* @var int
	*/
	protected $id;
	/**
	* Nom de la conversation
	*
	* @var string
	*/
	protected $nom;
	/**
	* Description de la conversation
	*
	* @var string
	*/
	protected $description;
	/**
	* Id des messages de la conversation
	*
	* @var array
	*/
	protected $id_messages;
	/**
	* Id des utilisateurs de la conversations
	*
	* @var array
	*/
	protected $id_utilisateurs;

	/* Accesseurs */

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
	* Accesseur de nom
	*
	* @return string
	*/
	public function getNom()
	{
		return $this->nom;
	}
	/**
	* Accesseur de description
	*
	* @return string
	*/
	public function getDescription()
	{
		return $this->description;
	}
	/**
	* Accesseur de id_messages
	*
	* @return array
	*/
	public function getId_messages()
	{
		return $this->id_messages;
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

	/* Définisseurs */

	/**
	* Définisseur de id
	*
	* @param int id Id de la conversation
	*
	* @return void
	*/
	protected function setId($id)
	{
		$this->id=(int)$id;
	}
	/**
	* Définisseur de nom
	*
	* @param string nom Nom de la conversation
	*
	* @return void
	*/
	protected function setNom($nom)
	{
		$this->nom=$nom;
	}
	/**
	* Définisseur de description
	*
	* @param string description Description de la conversation
	*
	* @return void
	*/
	protected function setDescription($description)
	{
		$this->description=$description;
	}
	/**
	* Définisseur de id_messages
	*
	* @param array id_messages Messages de la conversation
	*
	* @return void
	*/
	protected function setId_messages($id_messages)
	{
		$this->id_messages=$id_messages;
	}
	/**
	* Définisseur de id_utilisateurs
	*
	* @param array id_utilisateurs Utilisateurs de la conversation
	*
	* @return void
	*/
	protected function setId_utilisateurs($id_utilisateurs)
	{
		$this->id_utilisateurs=$id_utilisateurs;
	}

	/* Autres méthodes */

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
	* Afficheur de nom
	*
	* @return string
	*/
	public function afficherNom()
	{
		return htmlspecialchars((string)$this->nom);
	}
	/**
	* Afficheur de description
	*
	* @return string
	*/
	public function afficherDescription()
	{
		return htmlspecialchars((string)$this->description);
	}
	/**
	* Afficheur de messages
	*
	* @return string
	*/
	public function afficherId_messages()
	{
		$affichage='';
		foreach ($this->id_messages as $id_message)
		{
			$affichage.=htmlspecialchars($id_message).'\n';
		}
		return $affichage;
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
	* Recuperer une conversation
	*
	* @param mixed date_historique Optionnel, date après laquelle les messages de la conversation vont être récupéré
	*
	* @return void
	*/
	public function recuperer($date_historique=null)
	{
		$this->get($this->getId());
		$this->recupererId_messages($date_historique);
		$this->recupererId_utilisateurs();
	}
	/**
	* Créer une conversation
	*
	* @return void
	*/
	public function creer()
	{
		$Manager=$this->Manager();
		$Manager->add(array(
			'nom'         => $this->getNom(),
			'description' => $this->getDescription(),
		));
		$this->setId($Manager->getIdBy(array(
			'nom'         => $this->getNom(),
			'description' => $this->getDescription(),
		)));
		$BDDFactory=new \core\BDDFactory;
		$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$id_utilisateurs=array();
		foreach ($this->getId_utilisateurs() as $id_utilisateur)
		{
			$id_utilisateurs[]=array('id_utilisateur' => $id_utilisateur);
		}
		$LiaisonConversationUtilisateur->addBy($id_utilisateurs, array(
			'id_conversation' => $this->getId(),
		));
	}
	/**
	* Modifier une conversation
	*
	* @return void
	*/
	public function modifier()
	{
		$Manager=$this->Manager();
		$Manager->update(array(
			'nom'         => $this->getNom(),
			'description' => $this->getDescription(),
		), $this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$id_utilisateurs=array();
		foreach ($this->getId_utilisateurs() as $id_utilisateur)
		{
			$id_utilisateurs[]=array('id_utilisateur' => $id_utilisateur);
		}
		$donnees_already_in=$LiaisonConversationUtilisateur->get(array(
			'id_conversation' => $this->getId(),
		), array(
			'id_conversation' => '=',
		));
		$id_utilisateurs_already_in=array();
		foreach ($donnees_already_in as $donnee)
		{
			$id_utilisateurs_already_in[]=$donnee['id_utilisateur'];
		}
		$id_utilisateurs_non_modifies=array_intersect($id_utilisateurs_already_in, $this->getId_utilisateurs());
		if(count(array_diff($id_utilisateurs_already_in, $id_utilisateurs_non_modifies))!=0)	// Il y a des utilisateurs qui ne sont plus dans la discussion
		{
			$LiaisonConversationUtilisateur->deleteBy(array(
				'id_conversation' => $this->getId(),
			));
			$LiaisonConversationUtilisateur->addBy($id_utilisateurs, array(
				'id_conversation' => $this->getId(),
			));
		}
		else
		{
			$id_utilisateurs_a_ajouter=array_diff($this->getId_utilisateurs(), $id_utilisateurs_non_modifies);
			$id_utilisateurs_utile=array();
			foreach ($id_utilisateurs_a_ajouter as $id_utilisateur_a_ajouter)
			{
				$id_utilisateurs_utile[]=array('id_utilisateur' => $id_utilisateur_a_ajouter);
			}
			if (count($id_utilisateurs_utile)!=0)
			{
				$LiaisonConversationUtilisateur->addBy($id_utilisateurs_utile, array(
					'id_conversation' => $this->getId(),
				));
			}
		}
	}
	/**
	* Supprimer une conversation
	*
	* @return void
	*/
	public function supprimer()
	{
		$Manager=$this->Manager();
		$Manager->delete($this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$LiaisonConversationUtilisateur->deleteBy(array(
			'id_conversation' => $this->getId(),
		));
	}
	/**
	* Récupère l'id des utilisateurs participant à la conversation
	*
	* @return void
	*/
	public function recupererId_utilisateurs()
	{
		$BDDFactory=new \core\BDDFactory;
		$Liaison=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$resultats=$Liaison->get(array(
			'id_conversation' => $this->getId(),
		), array(
			'id_conversation' => '=',
		));
		$id=array();
		foreach ($resultats as $resultat)
		{
			$id[]=$resultat['id_utilisateur'];
		}
		$this->setId_utilisateurs($id);
	}
	/**
	* Récupère les utilisateurs participant à la conversation
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
	/**
	* Récupère les id des messages de la conversations
	*
	* @param mixed date_historique Optionnel, date après laquelle les messages de la conversation vont être récupéré
	*
	* @return void
	*/
	public function recupererId_messages($date_historique=null)
	{
		$BDDFactory=new \core\BDDFactory;
		$MessageManager=new \chat\MessageManager($BDDFactory->MysqlConnexion());
		$getByArray=array(
			'id_conversation' => $this->getId(),
		);
		$getByOperateur=array(
			'id_conversation' => '=',
		);
		if ($date_historique)
		{
			$getByArray['date_publication']=$date_historique;
			$getByOperateur['date_publication']='>';
		}
		$resultats=$MessageManager->getBy($getByArray, $getByOperateur);
		$id=array();
		foreach ($resultats as $resultat)
		{
			$id[]=$resultat['id'];
		}
		$this->setId_messages($id);
	}
	/**
	* Récupère les messages de la conversations
	*
	* @return array
	*/
	public function recupererMessages()
	{
		$Messages=array();
		foreach ($this->getId_messages() as $id)
		{
			$Message=new \chat\Message(array(
				'id' => $id,
			));
			$Message->recuperer();
			$Messages[]=$Message;
		}
		return $Messages;
	}
}

?>