<?php

namespace post;

/**
* Post du site
*/
class Post extends \core\Managed
{
	/* Attributs */

	/**
	* Id du Post
	*
	* @var int
	*/
	protected $id;
	/**
	* Id de l'auteur du Post
	*
	* @var int
	*/
	protected $id_auteur;
	/**
	* Titre du Post
	*
	* @var string
	*/
	protected $titre;
	/**
	* Contenu du Post
	*
	* @var string
	*/
	protected $contenu;
	/**
	* Date de la publication du Post
	*
	* @var string
	*/
	protected $date_publication;
	/**
	* Date de la dernière mise à jour du Post
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
	* Accesseur de titre
	*
	* @return string
	*/
	public function getTitre()
	{
		return $this->titre;
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
	* @param int id Id du Post
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
	* @param int id_auteur Id de l'auteur du Post
	*
	* @return void
	*/
	protected function setId_auteur($id_auteur)
	{
		$this->id_auteur=(int)$id_auteur;
	}
	/**
	* Définisseur de titre
	*
	* @param string titre Titre du Post
	*
	* @return void
	*/
	protected function setTitre($titre)
	{
		$this->titre=$titre;
	}
	/**
	* Définisseur de contenu
	*
	* @param string contenu Contenu du Post
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
	* @param string date_publication Date de publication du Post
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
	* @param string date_mise_a_jour Date de la dernière mise à jour du Post
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
	* Afficheur de titre
	*
	* @return string
	*/
	public function afficherTitre()
	{
		return htmlspecialchars((string)$this->titre);
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
	* Converti l'objet Post en string via une template
	* 
	* @param string template Chemin vers la template à utiliser
	*
	* @return string
	*/
	public function afficher($template)
	{
		return $this->afficherContenu();
	}
	/**
	* Publie le Post
	*
	* @return void
	*/
	public function publier()
	{
		$Manager=$this->Manager();
		$Manager->add(array(
			'id_auteur'        => $this->getId_auteur(),
			'titre'            => $this->getTitre(),
			'contenu'          => $this->getContenu(),
			'date_publication' => $this->getDate_publication(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		));
		$this->setId($Manager->getIdBy(array(
			'id_auteur'        => $this->getId_auteur(),
			'titre'            => $this->getTitre(),
			'contenu'          => $this->getContenu(),
			'date_publication' => $this->getDate_publication(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		)));
	}
	/**
	* Met à jour le Post
	*
	* @return void
	*/
	public function mettre_a_jour()
	{
		$Manager=$this->Manager();
		$Manager->update(array(
			'titre'            => $this->getTitre(),
			'contenu'          => $this->getContenu(),
			'date_mise_a_jour' => $this->getDate_mise_a_jour(),
		), $this->getId());
	}
	/**
	* Supprime le Post
	*
	* @return void
	*/
	public function supprimer()
	{
		$Manager=$this->Manager();
		$Manager->delete($this->getId());
	}
	/**
	* Obtient l'auteur du Post
	*
	* @return Utilisateur
	*/
	public function recupererAuteur()
	{
		$Utilisateur=new \user\Utilisateur(array());
		$Utilisateur->get($this->getId_auteur());
		return $Utilisateur;
	}
	/**
	* Obtient les Commentaires du Post
	*
	* @return array
	*/
	public function recupererCommentaires()
	{
		$BDDFactory=new \core\BDDFactory;
		$CommentaireManager=new \post\CommentaireManager($BDDFactory->MysqlConnexion());
		$commentaires=array();
		$donnees=$CommentaireManager->getBy(array(
			'id_post' => $this->getId(),
		), array(
			'id_post' => '=',
		));
		foreach ($donnees as $key => $donnee)
		{
			$Commentaire=new \post\Commentaire($donnee);
			$commentaires[]=$Commentaire;
		}
		return $commentaires;
	}
	/**
	* Récupère le Post à partir de son id
	*
	* @return void
	*/
	public function recuperer()
	{
		$this->get($this->getId());
	}
}

?>