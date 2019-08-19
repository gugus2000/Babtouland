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
	* Messages de la conversation
	*
	* @var array
	*/
	protected $messages;
	/**
	* Utilisateurs de la conversations
	*
	* @var array
	*/
	protected $utilisateurs;

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
	* Accesseur de messages
	*
	* @return array
	*/
	public function getMessages()
	{
		return $this->messages;
	}
	/**
	* Accesseur de utilisateurs
	*
	* @return array
	*/
	public function getUtilisateurs()
	{
		return $this->utilisateurs;
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
	* Définisseur de messages
	*
	* @param array messages Messages de la conversation
	*
	* @return void
	*/
	protected function setMessages($messages)
	{
		$this->messages=$messages;
	}
	/**
	* Définisseur de utilisateurs
	*
	* @param array utilisateurs Utilisateurs de la conversation
	*
	* @return void
	*/
	protected function setUtilisateurs($utilisateurs)
	{
		$this->utilisateurs=$utilisateurs;
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
	public function afficherMessages()
	{
		$affichage='';
		foreach ($this->messages as $key => $message)
		{
			$affichage.=$message->afficher();
		}
		return $affichage;
	}
	/**
	* Afficheur de utilisateurs
	*
	* @return string
	*/
	public function afficherUtilisateurs()
	{
		$affichage='';
		foreach ($this->utilisateurs as $key => $utilisateur)
		{
			$affichage.=$utilisateur->afficher();
		}
		return $affichage;
		return htmlspecialchars((string)$this->utilisateurs);
	}
	/**
	* Recuperer une conversation
	*
	* @return void
	*/
	public function recuperer()
	{
		$this->get($this->getId());
		$this->recupererMessages();
		$this->recupererUtilisateurs();
	}
	/**
	* Créer une conversation
	*
	* @return void
	*/
	public function creer()
	{
		$this->Manager();
		$Manager->add(array(
			'nom'         => $this->getNom(),
			'description' => $this->getDescription(),
		));
		$this->setId($Manager->getIdBy(array(
			'nom'         => $this->getNom(),
			'description' => $this->getDescription(),
		)));
		$id_utilisateurs=array();
		foreach ($this->getUtilisateurs as $key => $Utilisateur)
		{
			$id_utilisateurs[]==$Utilisateur->getId();
		}
		$BDDFactory=new \core\BDDFactory;
		$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$LiaisonConversationUtilisateur->addBy(array(
			'id_utilisateur' => $id_utilisateurs,
		), array(
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
		$this->Manager();
		$Manager->update(array(
			'nom'         => $this->getNom(),
			'description' => $this->getDescription(),
		), $this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$LiaisonConversationUtilisateur->deleteBy(array(
			'id_conversation' => $this->getId(),
		));
		$LiaisonConversationUtilisateur->(array(
			'id_utilisateur' =>$this->getUtilisateurs(),
		), array(
			'id_conversation' => $this->getId(),
		));
	}
	/**
	* Supprimer une conversation
	*
	* @return void
	*/
	public function supprimer()
	{
		$this->Manager();
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
	public function recupererUtilisateurs()
	{
		$BDDFactory=new \core\BDDFactory;
		$Liaison=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$resultats=$Liaison->get(array(
			'id_conversation' => $this->getId(),
		), array(
			'id_conversation' => '=',
		));
		$utilisateurs=array();
		foreach ($resultats as $key => $resultat)
		{
			$utilisateur=new \user\Utilisateur(array(
				'id' => $resultat['id_utilisateur'],
			));
			$utilisateur->recuperer();
			$utilisateurs[]=$utilisateur;
		}
		$this->setUtilisateurs($utilisateurs);
	}
	/**
	* Récupère les messages de la conversations
	*
	* @return void
	*/
	public function recupererMessages()
	{
		$BDDFactory=new \core\BDDFactory;
		$MessageManager=new \chat\MessageManager($BDDFactory->MysqlConnexion());
		$resultats=$MessageManager->getBy(array(
			'id_conversation' => $this->getId(),
		), array(
			'id_conversation' => '=',
		));
		$Messages=array();
		foreach ($resultats as $key => $resultat)
		{
			$Message=new \chat\Message(array(
				'id' => $resultat['id'],
			));
			$Message->recuperer();
			$Messages[]=$Message;
		}
		$this->setMessages($Messages);
	}
}

?>