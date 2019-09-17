<?php

namespace user;

/**
* Page vu par l'utilisateur
*/
class Page
{
	/* Attributs */

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
	* Élément représentant la page
	* 
	* @var PageElement
	*/
	protected $pageElement;

	/* Accesseurs */

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
	* Accesseur de pageElement
	* 
	* @return PageElement
	*/
	public function getPageElement()
	{
		return $this->pageElement;
	}

	/* Définisseurs */

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
	* Définisseur de pageElement
	*
	* @param PageElement pageElement Élément représentant la page
	* 
	* @return void
	*/
	protected function setPageElement($pageElement)
	{
		$this->pageElement=$pageElement;
	}

	/* Autres méthodes */

	public function afficherMetas()
	{
		$affichage='';
		if($this->getMetas())
		{
			foreach ($this->getMetas() as $key => $value)
			{
				$affichage.=$this->afficherMeta($key);
			}
		}
		return $affichage;
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
	* Afficheur de pageElement
	* 
	* @return string
	*/
	public function afficherPageElement()
	{
		return $this->pageElement->afficher();
	}
	/**
	* Afficheur de Page
	*
	* @return string
	*/
	public function afficher()
	{
		$this->afficherPageElement();
		$page=preg_replace('#\|metas\|#', $this->afficherMetas(), $page);	// On met les balises métas
		$page=preg_replace('#\|css\|#', $this->afficherCss(), $page);	// On met les links vers le CSS
		$page=preg_replace('#\|javascripts\|#', $this->afficherJavascripts(), $page);	// On met les scripts vers le Javascript
		$page=preg_replace('#\|titre\|#', '<title>'.$this->afficherTitre().'</title>', $page);	// On met le titre de la page
		$menu_up='';
		if ($this->getMenuUp())
		{
			$menu_up=$this->afficherMenuUp();
		}
		$page=preg_replace('#\|menu-up\|#', $menu_up, $page);	// On met le menu-up
		$menu_side='';
		if ($this->getMenuSide())
		{
			$menu_side=$this->afficherMenuSide();
		}
		$page=preg_replace('#\|menu-side\|#', $menu_side, $page);	// On met le menu-side
		$toast='';
		if ($this->getToast())
		{
			$toast=$this->afficherToast();
		}
		$page=preg_replace('#\|toast\|#', $toast, $page);	// On met le toast
		$page=preg_replace('#\|contenu\|#', $this->afficherContenu(), $page);	// On met le contenu de la page
		return $page;
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