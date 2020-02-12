<?php

namespace forum;

/**
 * Nœud du forum (composant de base)
 *
 * @author gugus2000
 **/
abstract class Noeud extends \core\Managed
{
	/* Constante */

	/**
	* Type dossier
	*
	* @var int
	*/
	const TYPE_DOSSIER=0;
	/**
	* Type fil
	*
	* @var int
	*/
	const TYPE_FIL=1;

	/* Attribut */

	/**
	* Id du nœud
	* 
	* @var int
	*/
	protected $id;
	/**
	* Id du nœud parent
	* 
	* @var int
	*/
	protected $id_parent;
	/**
	* Id de l'auteur du nœud
	* 
	* @var int
	*/
	protected $id_auteur;
	/**
	* Nom du nœud
	* 
	* @var string
	*/
	protected $nom;
	/**
	* Description du nœud
	* 
	* @var string
	*/
	protected $description;
	/**
	* Date de la création du nœud
	* 
	* @var string
	*/
	protected $date_publication;
	/**
	* Date de la dernière mise à jour du nœeud
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
	* Accesseur de id_parent
	* 
	* @return int
	*/
	public function getId_parent()
	{
		return $this->id_parent;
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
	* @param int id Id du nœud
	* 
	* @return void
	*/
	protected function setId($id)
	{
		$this->id=(int)$id;
	}
	/**
	* Définisseur de id_parent
	*
	* @param int id_parent Id du nœud parent
	* 
	* @return void
	*/
	protected function setId_parent($id_parent)
	{
		$this->id_parent=(int)$id_parent;
	}
	/**
	* Définisseur de id_auteur
	*
	* @param int id_auteur Id de l'auteur du nœud
	* 
	* @return void
	*/
	protected function setId_auteur($id_auteur)
	{
		$this->id_auteur=(int)$id_auteur;
	}
	/**
	* Définisseur de nom
	*
	* @param string nom Nom du nœud
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
	* @param string description Description du nœud
	* 
	* @return void
	*/
	protected function setDescription($description)
	{
		$this->description=$description;
	}
	/**
	* Définisseur de date_publication
	*
	* @param string date_publication Date de la création du nœud
	* 
	* @return void
	*/
	protected function setDate_publication($date_publication)
	{
		$this->date_publication=$date_publication;
	}
	/**
	* Définisseur de date_maj
	*
	* @param string date_maj Date de la dernière mise à jour
	* 
	* @return void
	*/
	protected function setDate_maj($date_maj)
	{
		$this->date_maj=$date_maj;
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
	* Afficheur de id_parent
	* 
	* @return string
	*/
	public function afficherId_parent()
	{
		return htmlspecialchars((string)$this->id_parent);
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
	* Affiche date_maj avec le bon format
	*
	* @param string format Format de l'affichage de la date
	* 
	* @return string
	*/
	public function afficherDate_majFormat($format)
	{
		return date($format, strtotime($this->date_maj));
	}
	/**
	* Afficheur de nœud
	* 
	* @return string
	*/
	public function afficher()
	{
		return 'nom:'.$this->afficherNom().'|description:'.$this->afficherDescription().'|id:'.$this->afficherId();
	}
	/**
	* Récupérer le nœud parent
	* 
	* @return mixed
	*/
	public function recupererParent()
	{
		if ($this->getId_parent()>0)
		{
			$Parent=new \forum\Noeud(array(
				'id' => $this->getId_parent(),
			));
			$Parent->recuperer();
			return $Parent;
		}
		return False;
	}
	/**
	* Récupérer l'auteur du nœud
	* 
	* @return \user\Utilisateur
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
	* Récupère toute la descendance du nœud
	* 
	* @return array
	*/
	public function getDescendance()
	{
		global $config;
		if ($this->getId()==$config['id_conversation_all'])
		{
			return array($this);
		}
		else
		{
			$Dossier=new \forum\Dossier(array(
				'id' => $this->getId_parent(),
			));
			$Dossier->recuperer();
			return array_merge($Dossier->getDescendance(), array($this));
		}
	}
	/**
	* Insérer le nœud dans la base de donnée
	* 
	* @return void
	*/
	public function creer()
	{
		$this->Manager()->add(array_merge($this->table(), array('type' => $this::TYPE)));
		$this->setId($this->Manager()->getIdBy(array_merge($this->table(), array('type' => $this::TYPE))));
	}
	/**
	* Accesseur de TYPE
	*
	* @param int index Index du nœud
	* 
	* @return int
	*/
	public function getType($index=null)
	{
		if (!$index)
		{
			$index=$this->getId();
		}
		$resultats=$this->manager()->get($index);
		return $resultats['type'];
	}
	/**
	* Afficheur de TYPE
	*
	* @param int type Type du noeud
	* 
	* @return string
	*/
	public function afficherType($type)
	{
		switch($type)
		{
			case 0:
				return 'dossier';
			case 1:
				return 'fil';
			default:
				throw new \Exception('Type unknown');
		}
	}
	/**
	* Instancie le nœud dont l'index correspond
	*
	* @param int index Index du nœud
	* 
	* @return \forum\Noeud
	*/
	static public function newNoeud($index)
	{
		$manager=new \forum\NoeudManager(\core\BDDFactory::MysqlConnexion());
		$resultats=$manager->get($index);
		switch ($resultats['type'])
		{
			case self::TYPE_DOSSIER:
				$Noeud=new \forum\Dossier(array(
					'id' => $index,
				));
				break;
			case self::TYPE_FIL:
				$Noeud=new \forum\Fil(array(
					'id' => $index,
				));
				break;
			default:
				throw new \UnexpectedValueException('type undefined');
				break;
		}
		$Noeud->recuperer();
		return $Noeud;
	}

} // END class Noeud extends \core\Managed

?>