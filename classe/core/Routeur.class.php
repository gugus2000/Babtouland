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
			'application' => $application,
			'action'      => $action,
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
			'application' => $application,
			'action'      => $action,
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
		foreach ($parametres as $nom => $valeur)
		{
			if ($nom!='application' & $nom!='action')
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
		foreach ($parametres as $nom => $valeur)
		{
			if ($nom!='application' & $nom!='action')
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