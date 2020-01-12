<?php

namespace chat;

/**
* Message d'une conversation
*/
class Message extends \core\Managed
{
	/* Attributs */

	/**
	* Id du message
	*
	* @var int
	*/
	protected $id;
	/**
	* Id de la conversation dans lauelle est le message
	*
	* @var int
	*/
	protected $id_conversation;
	/**
	* Id de l'auteur du message
	*
	* @var int
	*/
	protected $id_auteur;
	/**
	* Contenu du message
	*
	* @var string
	*/
	protected $contenu;
	/**
	* Date de la publication du message
	*
	* @var string
	*/
	protected $date_publication;
	/**
	* Date de la dernière mise à jour du message
	*
	* @var string
	*/
	protected $date_mise_a_jour;

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
	* Accesseur de id_conversation
	*
	* @return int
	*/
	public function getId_conversation()
	{
		return $this->id_conversation;
	}
	/**
	* Accesseur de id_auteur
	*
	* @return int
	*/
	public function getId_auteur()
	{
		return $this->id_auteur;
	}
	/**
	* Accesseur de contenu
	*
	* @return string
	*/
	public function getContenu()
	{
		return $this->contenu;
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
	* Accesseur de date_mise_a_jour
	*
	* @return string
	*/
	public function getDate_mise_a_jour()
	{
		return $this->date_mise_a_jour;
	}

	/* Définisseurs */

	/**
	* Définisseur de id
	*
	* @param int id Id du message
	*
	* @return void
	*/
	protected function setId($id)
	{
		$this->id=(int)$id;
	}
	/**
	* Définisseur de id_conversation
	*
	* @param int id_conversation Id de la conversation dans laquelle est le message
	*
	* @return void
	*/
	protected function setId_conversation($id_conversation)
	{
		$this->id_conversation=(int)$id_conversation;
	}
	/**
	* Définisseur de id_auteur
	*
	* @param int id_auteur Id de l'auteur du message
	*
	* @return void
	*/
	protected function setId_auteur($id_auteur)
	{
		$this->id_auteur=(int)$id_auteur;
	}
	/**
	* Définisseur de contenu
	*
	* @param string contenu Contenu du message
	*
	* @return void
	*/
	protected function setContenu($contenu)
	{
		$this->contenu=$contenu;
	}
	/**
	* Définisseur de date_publication
	*
	* @param string date_publication Date de la publication du message
	*
	* @return void
	*/
	protected function setDate_publication($date_publication)
	{
		$this->date_publication=$date_publication;
	}
	/**
	* Définisseur de date_mise_a_jour
	*
	* @param string date_mise_a_jour Date de la dernière mise à jour du message
	*
	* @return void
	*/
	protected function setDate_mise_a_jour($date_mise_a_jour)
	{
		$this->date_mise_a_jour=$date_mise_a_jour;
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
	* Afficheur de id_conversation
	*
	* @return string
	*/
	public function afficherId_conversation()
	{
		return htmlspecialchars((string)$this->id_conversation);
	}
	/**
	* Afficheur de id_auteur
	*
	* @return string
	*/
	public function afficherId_auteur()
	{
		return htmlspecialchars((string)$this->id_auteur);
	}
	/**
	* Afficheur de contenu
	*
	* @return string
	*/
	public function afficherContenu()
	{
		return htmlspecialchars((string)$this->contenu);
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
	* Afficheur de date_mise_a_jour
	*
	* @return string
	*/
	public function afficherDate_mise_a_jour()
	{
		return htmlspecialchars((string)$this->date_mise_a_jour);
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
	* Affiche date_mise_a_jour avec le bon format
	*
	* @param string format Format de l'affichage de la date
	*
	* @return string
	*/
	public function afficherDate_mise_a_jourFormat($format)
	{
		return date($format, strtotime($this->date_mise_a_jour));
	}
	/**
	* Afficheur de Message
	*
	* @return string
	*/
	public function afficher()
	{
		return $this->afficherContenu();
	}
	/* Récupère l'auteur du Message */
	/**
	* Récupère l'auteur du Message
	* 
	* @return Utilisateur
	*/
	public function recupererAuteur()
	{
		$Auteur=new \user\Utilisateur(array(
			'id' => $this->getId_auteur(),
		));
		$Auteur->recuperer();
		return $Auteur;
	}
}

?>