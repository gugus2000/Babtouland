<?php

namespace forum;

/**
 * Message d'un fil du forum
 *
 * @author gugus2000
 **/
class Message extends \core\Managed
{
	/* Attribut */

	/**
	* Id du message
	* 
	* @var int
	*/
	protected $id;
	/**
	* Id du fil du message
	* 
	* @var int
	*/
	protected $id_fil;
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
	* Dernière date de modification du message
	* 
	* @var string
	*/
	protected $date_maj;

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
	* Accesseur de id_fil
	* 
	* @return int
	*/
	public function getId_fil()
	{
		return $this->id_fil;
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
	* Accesseur de date_maj
	* 
	* @return string
	*/
	public function getDate_maj()
	{
		return $this->date_maj;
	}

	/* Définisseur */

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
	* Définisseur de id_fil
	*
	* @param int id_fil Id du fil du message
	* 
	* @return void
	*/
	protected function setId_fil($id_fil)
	{
		$this->id_fil=(int)$id_fil;
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
		$this->contenu=(string)$contenu;
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
		$this->date_publication=(string)$date_publication;
	}
	/**
	* Définisseur de date_maj
	*
	* @param string date_maj Date de la dernière modification du message
	* 
	* @return void
	*/
	protected function setDate_maj($date_maj)
	{
		$this->date_maj=(string)$date_maj;
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
	* Afficheur de id_fil
	* 
	* @return string
	*/
	public function afficherId_fil()
	{
		return htmlspecialchars((string)$this->id_fil);
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
	* Afficheur de date_maj
	* 
	* @return string
	*/
	public function afficherDate_maj()
	{
		return htmlspecialchars((string)$this->date_maj);
	}

	/* Autre méthode */

	/**
	* Récupérer le fil du message
	* 
	* @return \forum\Fil
	*/
	public function recupererFil()
	{
		$Fil=new \forum\Fil(array('id' => $this->getId_fil()));
		$Fil->recuperer();
		return $Fil;
	}
	/**
	* Récupérer l'auteur du message
	* 
	* @return \user\Utilisateur
	*/
	public function recupererAuteur()
	{
		$Utilisateur=new \user\Utilisateur(array('id' => $this->getId_auteur()));
		$Utilisateur->recuperer();
		return $Utilisateur;
	}

} // END class Message extends \core\Managed

?>