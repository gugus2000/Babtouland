<?php

namespace core;

class Routeur
{
	/* Constante */

	/**
	* Mode de fonctionnement du routeur avec GET
	*
	* @var int
	*/
	const MODE_GET=0;
	/**
	* Mode de fonctionnement du routeur avec /
	*
	* @var int
	*/
	const MODE_ROUTE=1;
	/**
	* Mode de fonctionnement purement avec /
	*
	* @var int
	*/
	const MODE_FULL_ROUTE=2;

	/* Attribut */

	/**
	* Mode de fonctionnement du routeur
	* 
	* @var int
	*/
	protected $mode;

	/* Accesseur */

	/**
	* Accesseur de mode
	* 
	* @return int
	*/
	public function getMode()
	{
		return $this->mode;
	}

	/* définisseur */

	/**
	* Définisseur de mode
	*
	* @param int mode Mode de fonctionnement du routeur
	* 
	* @return void
	*/
	protected function setMode($mode)
	{
		$this->mode=$mode;
	}

	/* Méthode particulière */

	public function __construct($mode)
	{
		$this->setMode($mode);
	}

	/* Autre méthode */

	/**
	* Retourne le couple application et action transmise par l'url
	*
	* @param string url URL de la page
	* 
	* @return array
	*/
	public function dechiffrerRoute($url)
	{
		global $config;
		switch ($this->getMode())
		{
			case $this::MODE_GET:
				return $this->recupererWithGet();
				break;
			case $this::MODE_ROUTE:
				return $this->recupererWithRoute($url);
				break;
			case $this::MODE_FULL_ROUTE:
				return $this->recupererWithFullRoute($url);
				break;
			default:
				return array(
					'application' => $config['defaut_application'],
					'action'      => $config['defaut_'.$config['defaut_application'].'_action']
				);
		}
	}
	/**
	* Retourne le couple application et action à partir de get
	* 
	* @return array
	*/
	public function recupererWithGet()
	{
		global $config;
		if (isset($_GET['application']))
		{
			$application=$_GET['application'];
		}
		else
		{
			$application=$config['defaut_application'];
		}
		if (isset($_GET['action']))
		{
			$action=$_GET['action'];
		}
		else
		{
			$action=$config['defaut_'.$application.'_action'];
		}
		return array(
			'application'             => $application,
			'action'                  => $action,
			$config['nom_parametres'] => $_GET,
		);
	}
	/**
	* Retourne le couple application et action à partir de l'url routé
	*
	* @param string url Url de la page
	* 
	* @return mixed
	*/
	public function recupererWithRoute($url)
	{
		global $config;
		$path=parse_url($url, PHP_URL_PATH);
		preg_match('#\/([\w]+)\/([\w]+)#', $path, $matches);
		if($matches)
		{
			$application=$matches[1];
			$action=$matches[2];
		}
		else
		{
			preg_match('#\/([\w]+)#', $path, $matches);
			if ($matches)
			{
				$application=$matches[1];
			}
			else
			{
				$application=$config['defaut_application'];
			}
			$action=$config['defaut_'.$application.'_action'];
		}
		return array(
			'application'             => $application,
			'action'                  => $action,
			$config['nom_parametres'] => $_GET,
		);
	}
	/**
	* Retourne l'array contenant tous les paramètres de l'url routé
	*
	* @param string url Url de la page
	* 
	* @return array
	*/
	public function recupererWithFullRoute($url)
	{
		global $lang, $config, $Visiteur;
		$Permissions=$Visiteur->getRole()->getPermissions();
		$liste_applications=array();
		$liste_actions=array();
		foreach($Permissions as $Permission)
		{
			if (!in_array($Permission->getApplication(), $liste_applications))
			{
				$liste_applications[]=$Permission->getApplication();
			}
			if (!in_array($Permission->getAction(), $liste_actions))
			{
				$liste_actions[]=$Permission->getAction();
			}
			$liste_couple[$Permission->getAction()]=$Permission->getApplication();
		}
		$liste=explode('/', trim(strtok(getenv('REQUEST_URI'), '?'), '/'));
		$parametres=array();
		$possible_parametres=array();
		foreach ($liste as $element)
		{
			if (in_array($element, $config['lang_available']))
			{
				$parametres['lang']=$element;
			}
			else if (in_array($element, $liste_applications))
			{
				$application=$element;
			}
			else if (in_array($element, $liste_actions))
			{
				$action=$element;
			}
			else
			{
				$possible_parametres[]=$element;
			}
		}
		if (!isset($application))
		{
			if (isset($action))
			{
				$application=$liste_couple[$action];
			}
			else
			{
				$application=$config['defaut_application'];
			}
		}
		if (!isset($action))
		{
			$action=$config['defaut_'.$application.'_action'];
		}
		$offset=0;
		foreach ($possible_parametres as $possible_element)
		{
			if (isset($config[$application.'_'.$action.'_parametres'][$offset]))
			{
				$parametres[$config[$application.'_'.$action.'_parametres'][$offset]]=$possible_element;
				$offset++;
			}
			else
			{
				new \core\Exception\Warning($lang['classe_core_routeur_arguments']);
			}
		}
		return array(
			'application'             => $application,
			'action'                  => $action,
			$config['nom_parametres'] => $parametres,
		);
	}
	/**
	* Créer un lien à partir d'un couple application et action
	*
	* @param array parametres Couple application et action du lien à créer
	* 
	* @return string
	*/
	public function creerLien($parametres)
	{
		switch ($this->getMode())
		{
			case $this::MODE_GET:
				return $this->creerLienGet($parametres);
				break;
			case $this::MODE_ROUTE:
				return $this->creerLienRoute($parametres);
				break;
			case $this::MODE_FULL_ROUTE:
				return $this->creerLienFullRoute($parametres);
				break;
			default:
				return '/';
		}
	}
	/**
	* Créer un lien en mode get à partir d'un couple application et action
	*
	* @param array parametres Couple application et action du lien à créer
	* 
	* @return string
	*/
	public function creerLienGet($parametres)
	{
		global $config;
		$ajout='';
		if (isset($parametres[$config['nom_parametres']]))
		{
			foreach ($parametres[$config['nom_parametres']] as $nom => $valeur)
			{
				$ajout.='&'.(string)$nom.'='.(string)$valeur;
			}
		}
		if (isset($parametres['application']))
		{
			if (isset($parametres['action']))
			{
				return '?application='.$parametres['application'].'&action='.$parametres['action'].$ajout;
			}
			else
			{
				return '?application='.$parametres['application'].'&action='.$config['defaut_'.$parametres['application'].'_action'].$ajout;
			}
		}
		else
		{
			return '?application='.$config['defaut_application'].'&action='.$config['defaut_'.$config['defaut_application'].'_action'].$ajout;
		}
	}
	/**
	* Créer un lien en mode route à partir d'un couple application et action
	*
	* @param array parametres Couple application et action du lien à créer
	* 
	* @return string
	*/
	public function creerLienRoute($parametres)
	{
		global $config;
		$ajout='';
		if (isset($parametres[$config['nom_parametres']]))
		{
			foreach ($parametres[$config['nom_parametres']] as $nom => $valeur)
			{
				$ajout.='&'.(string)$nom.'='.(string)$valeur;
			}
		}
		if (strlen($ajout)>0)
		{
			$ajout=substr($ajout, 1);	// On enlève le "&"
			$ajout='?'.$ajout;			// On ajoute le "?"
		}
		if (isset($parametres['application']))
		{
			if (isset($parametres['action']))
			{
				return '/'.$parametres['application'].'/'.$parametres['action'].'/'.$ajout;
			}
			else
			{
				return '/'.$parametres['application'].'/'.$config['defaut_'.$parametres['application'].'_action'].'/'.$ajout;
			}
		}
		else
		{
			return '/'.$config['defaut_application'].'/'.$config['defaut_'.$config['defaut_application'].'_action'].'/'.$ajout;
		}
	}
	/**
	* Créer un lien en mode full route à partir d'un couple application et action et parametres
	*
	* @param array parametres Paramètres de la page
	* 
	* @return string
	*/
	public function creerLienFullRoute($parametres)
	{
		global $config;
		if (isset($parametres['application']))
		{
			$application=$parametres['application'];
		}
		else
		{
			$application=$config['defaut_application'];
		}
		if (isset($parametres['action']))
		{
			$action=$parametres['action'];
		}
		else
		{
			$action=$config['defaut_'.$application.'_action'];
		}
		if (isset($parametres[$config['nom_parametres']]))
		{
			$parametres_string=implode('/', $parametres[$config['nom_parametres']]);
		}
		else
		{
			$parametres_string='';
		}
		return '/'.$application.'/'.$action.'/'.$parametres_string;
	}
	/**
	* Remplit les paramètres incomplets d'un lien si nécessaire
	*
	* @param array parametres Paramètres de l'URL déjà existant
	* 
	* @return array
	*/
	public function remplir($parametres)
	{
		global $config;
		if (!isset($parametres['application']))
		{
			$parametres['application']=$config['defaut_application'];
		}
		if (!isset($parametres['action']))
		{
			$parametres['action']=$config['defaut_'.$parametres['application'].'_action'];
		}
		return $parametres;
	}

}

?>