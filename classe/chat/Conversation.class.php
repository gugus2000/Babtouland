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
	* Recuperer une conversation
	*
	* @return void
	*/
	public function recuperer()
	{
		$this->get($this->getId());
	}
	/**
	* Créer une conversation
	*
	* @param array id_utilisateurs Id des utilisateurs dans la conversation
	*
	* @return void
	*/
	public function creer($ids_utilisateurs=null)
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
		foreach ($ids_utilisateurs as $id)
		{
			$id_utilisateurs[]=array('id_utilisateur' => $id);
		}
		$LiaisonConversationUtilisateur->addBy($id_utilisateurs, array(
			'id_conversation' => $this->getId(),
		));
	}
	/**
	* Modifier une conversation
	*
	* @param array id_utilisateurs Id des utilisateurs maintenant dans la conversation
	*
	* @return void
	*/
	public function modifier($ids_utilisateurs=null)
	{
		$Manager=$this->Manager();
		$Manager->update(array(
			'nom'         => $this->getNom(),
			'description' => $this->getDescription(),
		), $this->getId());
		$BDDFactory=new \core\BDDFactory;
		$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur($BDDFactory->MysqlConnexion());
		$id_utilisateurs=array();
		foreach ($ids_utilisateurs as $id)
		{
			$id_utilisateurs[]=array('id_utilisateur' => $id);
		}
		$donnees_already_in=$LiaisonConversationUtilisateur->get('id_conversation', $this->getId());
		$id_utilisateurs_already_in=array_column($donnees_already_in, 'id_utilisateur');
		$id_utilisateurs_non_modifies=array_intersect($id_utilisateurs_already_in, array_column($id_utilisateurs, 'id_utilisateur'));
		if(count(array_diff($id_utilisateurs_already_in, $id_utilisateurs_non_modifies))!=0)	// Il y a des utilisateurs qui ne sont plus dans la discussion
		{
			$LiaisonConversationUtilisateur->deleteBy(array(
				'id_conversation' => $this->getId(),
			), array(
				'id_conversation' => '=',
			));
			$LiaisonConversationUtilisateur->addBy($id_utilisateurs, array(
				'id_conversation' => $this->getId(),
			));
		}
		else
		{
			$id_utilisateurs_a_ajouter=array_diff(array_column($id_utilisateurs, 'id_utilisateur'), $id_utilisateurs_non_modifies);
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
		), array(
			'id_conversation' => '=',
		));
	}
	/**
	* Récupère les utilisateurs participant à la conversation
	*
	* @return array
	*/
	public function recupererUtilisateurs()
	{
		$Liaison=new \chat\LiaisonConversationUtilisateur(\core\BDDFactory::MysqlConnexion());
		return $Liaison->recuperateBy(array(
			'id_conversation' => $this->getId(),
		), array(
			'id_conversation' => '=',
		), '\\user\\Utilisateur');
	}
	/**
	* Récupère les messages de la conversations
	*
	* @param mixed date_historique Date après laquelle les messages de la conversation vont être récupéré
	*
	* @return array
	*/
	public function recupererMessages($date_historique=null)
	{
		$MessageManager=new \chat\MessageManager(\core\BDDFactory::MysqlConnexion());
		$getByArray=array(
			'id_conversation' => $this->getId(),
		);
		$getByOperateur=array(
			'id_conversation' => '=',
		);
		if ($date_historique!==null)
		{
			$getByArray['date_publication']=$date_historique;
			$getByOperateur['date_publication']='>';
		}
		return $MessageManager->recuperateBy($getByArray, $getByOperateur);
	}
}

?>