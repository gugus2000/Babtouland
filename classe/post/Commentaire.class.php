<?php

namespace post;

/**
* Commentaire d'un post
*/
class Commentaire extends \core\Managed
{
	/* Attributs */

	/**
	* Id du Commentaire
	*
	* @var int
	*/
	protected $id;
	/**
	* Id de l'auteur du Commentaire
	*
	* @var int
	*/
	protected $id_auteur;
	/**
	* Id du Post du Commentaire
	*
	* @var int
	*/
	protected $id_post;
	/**
	* Contenu du Commentaire
	*
	* @var string
	*/
	protected $contenu;
	/**
	* Date de la publication du Commentaire
	*
	* @var string
	*/
	protected $date_publication;
	/**
	* Date de la mise à jour du Commentaire
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
	* Accesseur de id_auteur
	*
	* @return int
	*/
	public function getId_auteur()
	{
		return $this->id_auteur;
	}
	/**
	* Accesseur de id_post
	*
	* @return int
	*/
	public function getId_post()
	{
		return $this->id_post;
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
	* @param int id Id du Commentaire
	*
	* @return void
	*/
	protected function setId($id)
	{
		$this->id=(int)$id;
	}
	/**
	* Définisseur de id_auteur
	*
	* @param int id_auteur Id de l'auteur du Commentaire
	*
	* @return void
	*/
	protected function setId_auteur($id_auteur)
	{
		$this->id_auteur=(int)$id_auteur;
	}
	/**
	* Définisseur de id_post
	*
	* @param int id_post Id du Post du Commentaire
	*
	* @return void
	*/
	protected function setId_post($id_post)
	{
		$this->id_post=(int)$id_post;
	}
	/**
	* Définisseur de contenu
	*
	* @param string contenu Contenu du Commentaire
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
	* @param string date_publication Date de la publication du Commentaire
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
	* @param string date_mise_a_jour Date de la mise à jour du Commentaire
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
	* Afficheur de id_auteur
	*
	* @return string
	*/
	public function afficherId_auteur()
	{
		return htmlspecialchars((string)$this->id_auteur);
	}
	/**
	* Afficheur de id_post
	*
	* @return string
	*/
	public function afficherid_post()
	{
		return htmlspecialchars((string)$this->id_post);
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
	* Converti l'objet Post en string
	*
	* @return string
	*/
	public function afficher()
	{
		return $this->afficherContenu();
	}
	/**
	* Obtient l'auteur du Commentaire
	*
	* @return Utilisateur
	*/
	public function recupererAuteur()
	{
		$Utilisateur=new \user\Utilisateur(array(
			'id' => $this->getId_auteur(),
		));
		$Utilisateur->recuperer();
		return $Utilisateur;
	}
	/**
	* Obtient le Post du Commentaire
	*
	* @return Post
	*/
	public function recupererPost()
	{
		$Post=new \post\Post(array(
			'id' => $this->getId_post(),
		));
		$Post->recuperer();
		return $Post;
	}
}

?>