<?php

namespace user;

/**
* Page vu par l'utilisateur
*/
class Page
{
	/* Attributs */

	/**
	* Titre de la page
	*
	* @var string
	*/
	protected $titre;
	/**
	* Metasdonnées de la page
	*
	* @var array
	*/
	protected $metas;
	/**
	* CSS de la page
	*
	* @var array
	*/
	protected $css;
	/**
	* Javascript de la page
	*
	* @var array
	*/
	protected $javascripts;
	/**
	* Contenu de la page
	*
	* @var string
	*/
	protected $contenu;
	/**
	* Template de la page
	*
	* @var string
	*/
	protected $template;
	/**
	* Application de la page
	*
	* @var string
	*/
	protected $application;
	/**
	* Action de la page
	*
	* @var string
	*/
	protected $action;
	/**
	* Message
	*
	* @var string
	*/
	protected $message;

	/* Accesseurs */

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
	* Accesseur de metas
	*
	* @return array
	*/
	public function getMetas()
	{
		return $this->metas;
	}
	/**
	* Accesseur de css
	*
	* @return array
	*/
	public function getCss()
	{
		return $this->css;
	}
	/**
	* Accesseur de javascripts
	*
	* @return array
	*/
	public function getJavascripts()
	{
		return $this->javascripts;
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
	* Accesseur de template
	*
	* @return string
	*/
	public function getTemplate()
	{
		return $this->template;
	}
	/**
	* Accesseur de application
	*
	* @return string
	*/
	public function getApplication()
	{
		return $this->application;
	}
	/**
	* Accesseur de action
	*
	* @return string
	*/
	public function getAction()
	{
		return $this->action;
	}
	/**
	* Accesseur de message
	*
	* @return string
	*/
	public function getMessage()
	{
		return $this->message;
	}

	/* Définisseurs */

	/**
	* Définisseur de titre
	*
	* @param string titre Titre de la page
	*
	* @return void
	*/
	protected function setTitre($titre)
	{
		$this->titre=$titre;
	}
	/**
	* Définisseur de metas
	*
	* @param array metas Metasdonnées de la page
	*
	* @return void
	*/
	protected function setMetas($metas)
	{
		$this->metas=$metas;
	}
	/**
	* Définisseur de css
	*
	* @param array css CSS de la page
	*
	* @return void
	*/
	protected function setCss($css)
	{
		$this->css=$css;
	}
	/**
	* Définisseur de javascripts
	*
	* @param array javascripts Javascripts de la page
	*
	* @return void
	*/
	protected function setJavascripts($javascripts)
	{
		$this->javascripts=$javascripts;
	}
	/**
	* Définisseur de contenu
	*
	* @param string contenu Contenu de la page
	*
	* @return void
	*/
	protected function setContenu($contenu)
	{
		$this->contenu=$contenu;
	}
	/**
	* Définisseur de template
	*
	* @param string template Template de la page
	*
	* @return void
	*/
	protected function setTemplate($template)
	{
		$this->template=$template;
	}
	/**
	* Définisseur de application
	*
	* @param string application Application de la page
	*
	* @return void
	*/
	protected function setApplication($application)
	{
		$this->application=$application;
	}
	/**
	* Définisseur de action
	*
	* @param string action Action de la page
	*
	* @return void
	*/
	protected function setAction($action)
	{
		$this->action=$action;
	}
	/**
	* Définisseur de message
	*
	* @param string message Message
	*
	* @return void
	*/
	protected function setMessage($message)
	{
		$this->message=$message;
	}

	/* Autres méthodes */

	/**
	* Afficheur de titre
	*
	* @return string
	*/
	public function afficherTitre()
	{
		return (string)$this->titre;
	}
	/**
	* Afficheur de metas
	*
	* @return string
	*/
	public function afficherMetas()
	{
		$affichage='';
		if($this->getMetas())
		{
			foreach ($this->getMetas() as $key => $value)
			{
				$affichage.=$this->afficherMeta($key).'
	';
			}
		}
		return $affichage;
	}
	/**
	* Afficheur de css
	*
	* @return string
	*/
	public function afficherCss()
	{
		$affichage='';
		if($this->getCss())
		{
			foreach ($this->getCss() as $key => $value)
			{
				$affichage.='<link rel="stylesheet" type="text/css" href="'.$value.'">
	';
			}
		}
		return $affichage;
	}
	/**
	* Afficheur de javascripts
	*
	* @return string
	*/
	public function afficherJavascripts()
	{
		$affichage='';
		if($this->getJavascripts())
		{
			foreach ($this->getJavascripts() as $key => $value)
			{
				$affichage.='<script src="'.$value.'" type="text/javascript" charset="utf-8" async defer></script>
	';
			}
		}
		return $affichage;
	}
	/**
	* Afficheur de contenu
	*
	* @return string
	*/
	public function afficherContenu()
	{
		return (string)$this->contenu;
	}
	/**
	* Afficheur de template
	*
	* @return string
	*/
	public function afficherTemplate()
	{
		return (string)$this->template;
	}
	/**
	* Afficheur de application
	*
	* @return string
	*/
	public function afficherApplication()
	{
		return htmlspecialchars((string)$this->application);
	}
	/**
	* Afficheur de action
	*
	* @return string
	*/
	public function afficherAction()
	{
		return htmlspecialchars((string)$this->action);
	}
	/**
	* Afficheur de message
	*
	* @return string
	*/
	public function afficherMessage()
	{
		return htmlspecialchars((string)$this->message);
	}
	/**
	* Afficheur de Page
	* 
	* @param string message_css Chemin du css d'un message
	* 
	* @param string message_js Chemin du js d'un message
	* 
	* @param string message_contenu Chemin du contenu d'un message
	*
	* @return string
	*/
	public function afficher($message_css='', $message_js='', $message_contenu='')
	{
		$page=$this->afficherTemplate();
		if(!empty($this->getMessage()))	// Il y a une notification a afficher
		{
			if($this->getCss())
			{
				$css=$this->getCss();
				array_push($css, $message_css);
				$this->setCss($css);
			}
			else
			{
				$this->setCss(array($message_css));
			}

			if($this->getJavascripts())
			{
				$javascripts=$this->getJavascripts();
				array_push($javascripts, $message_js);
				$this->setJavascripts($javascripts);
			}
			else
			{
				$this->setJavascripts(array($message_js));
			}

			$contenu=$this->getContenu();
			$contenu=file_get_contents($message_contenu).'
'.$contenu;
			$contenu=preg_replace('#message_notification#', $this->afficherMessage(), $contenu);
			$this->setContenu($contenu);

			$_SESSION['message']=null;	// ON SUPPRIME LE MESSAGE APRES L'AFFICHAGE

		}
		$page=preg_replace('#metas#', $this->afficherMetas(), $page);	// On met les balises métas
		$page=preg_replace('#css#', $this->afficherCss(), $page);	// On met les links vers le CSS
		$page=preg_replace('#javascripts#', $this->afficherJavascripts(), $page);	// On met les scripts vers le Javascript
		$page=preg_replace('#<title></title>#', '<title>'.$this->afficherTitre().'</title>', $page);	// On met le titre de la page
		$page=preg_replace('#contenu#', $this->afficherContenu(), $page);	// On met le contenu de la page
		return $page;
	}
	/**
	* Accesseur de meta
	*
	* @param int index Index du tableau contenant les méta-données à mettre ensemble
	*
	* @return array
	*/
	public function getMeta($index)
	{
		return $this->metas[$index];
	}
	/**
	* Afficheur de meta
	*
	* @param int index Index du tableau contenant les méta-données à mettre ensemble
	*
	* @return string
	*/
	public function afficherMeta($index)
	{
		$affichage='<meta';
		foreach ($this->getMeta($index) as $key => $value)
		{
			$affichage.=' '.$key.'="'.$value.'"';
		}
		$affichage.='>';
		return $affichage;
	}
	/**
	* Construction de l'objet Page
	*
	* @param array attributs Attributs de la page
	*
	* @return void
	*/
	public function __construct($attributs)
	{
		foreach ($attributs as $key => $value)
		{
			$method='set'.ucfirst($key);
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}
	/**
	* Permet de set certains attributs en cours de route
	*
	* @param array attributs Attributs à set
	*
	* @return void
	*/
	public function set($attributs)
	{
		foreach ($attributs as $key => $value)
		{
			if(!in_array($key, array('application', 'action')))
			{
				$method='set'.ucfirst($key);
				if (method_exists($this, $method))
				{
					$this->$method($value);
				}
			}
		}
	}
	/**
	* Obtient le path du fichier de définition de la page à afficher
	*
	* @return string
	*/
	public function getPath()
	{
		return 'view/'.$this->getApplication().'/'.$this->getAction().'/page.php';
	}
}

?>