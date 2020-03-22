<?php

namespace contenu;

/**
 * Texte dans la base de donnée
 *
 * @author gugus2000
 **/
class Contenu extends \core\Managed
{
	/* Attribut */

	/**
	* Id du contenu (non unique)
	* 
	* @var int
	*/
	protected $id_contenu;
	/**
	* Langue du texte
	* 
	* @var string
	*/
	protected $lang;
	/**
	* Texte du contenu
	* 
	* @var string
	*/
	protected $texte;
	/**
	* Date de la publication du contenu
	* 
	* @var string
	*/
	protected $date_publication;

	/* Accesseur */

	/**
	* Accesseur de id_contenu
	* 
	* @return int
	*/
	public function getId_contenu()
	{
		return $this->id_contenu;
	}
	/**
	* Accesseur de lang
	* 
	* @return string
	*/
	public function getLang()
	{
		return $this->lang;
	}
	/**
	* Accesseur de texte
	* 
	* @return string
	*/
	public function getTexte()
	{
		return $this->texte;
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

	/* Définisseur */

	/**
	* Définisseur de id_contenu
	*
	* @param int id_contenu Id du contenu (non unique)
	* 
	* @return void
	*/
	protected function setId_contenu($id_contenu)
	{
		$this->id_contenu=(int)$id_contenu;
	}
	/**
	* Définisseur de lang
	*
	* @param string lang Langue du contenu
	* 
	* @return void
	*/
	protected function setLang($lang)
	{
		$this->lang=(string)$lang;
	}
	/**
	* Définisseur de texte
	*
	* @param string texte Texte du contenu
	* 
	* @return void
	*/
	protected function setTexte($texte)
	{
		$this->texte=(string)$texte;
	}
	/**
	* Définisseur de date_publication
	*
	* @param string date_publication Date de la publication du contenu
	* 
	* @return void
	*/
	protected function setDate_publication($date_publication)
	{
		$this->date_publication=(string)$date_publication;
	}

	/* afficheur */

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
	* Afficheur de lang
	* 
	* @return string
	*/
	public function afficherLang()
	{
		return htmlspecialchars((string)$this->lang);
	}
	/**
	* Afficheur de texte
	* 
	* @return string
	*/
	public function afficherTexte()
	{
		return htmlspecialchars((string)$this->texte);
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

	/* Autre méthode */

	/**
	* Récupère le contenu en fonction de sa langue (retourne si oui ou non le contenu correspond à la langue)
	*
	* @param string lang Langue voulue
	* 
	* @return void
	*/
	public function recupererLang($lang)
	{
		global $lang, $config;
		$Manager=$this->Manager();
		$resultats=$Manager->getBy(array(
			'id_contenu' => $this->getId_contenu(),
		), array(
			'id_contenu' => '=',
		));
		if (!(bool)$resultats)
		{
			throw new \Exception($lang['classe_contenu_contenu_recupererLang_no_result']);
		}
		foreach ($resultats as $resultat)
		{
			if ($resultat['lang']==$lang)
			{
				$this->hydrater($resultat);
				return True;
			}
			else if (!isset($this->texte) & $resultat['lang']==$config['config_utilisateur']['lang'])
			{
				$this->hydrater($resultat);
			}
		}
		if (!isset($this->text))
		{
			$this->hydrater($resultats[0]);
		}
		return False;
	}
	/**
	* Affiche le contenu
	* 
	* @return string
	*/
	public function afficher()
	{
		return $this->afficherTexte();
	}
	/**
	* Détermine la prochaine id de contenu non prise
	* 
	* @return int
	*/
	static public function determination_new_id()
	{
		$Manager=new \contenu\ContenuManager(\core\BDDFactory::MysqlConnexion());
		if ((bool)$Manager->getBy(array(
			'id_contenu' => '-1',
		), array(
			'id_contenu' => '!=',
		), array(
			'ordre' => 'id_contenu',
			'fin'   => 0,
		)))
		{
			return (int)$Manager->getBy(array(
				'id_contenu' => '-1',
			), array(
				'id_contenu' => '!=',
			), array(
				'ordre' => 'id_contenu',
				'fin'   => 0,
			))[0]['id_contenu']+1;
		}
		return 1;
	}
	/**
	* Insérer le Contenu dans la base de donnée
	* 
	* @return void
	*/
	public function creer()
	{
		$this->Manager()->add($this->table());
	}

} // END class Contenu extends \core\Managed

?>