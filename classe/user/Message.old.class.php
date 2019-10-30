<?php

namespace user;

/**
* Message type notification alertant l'utilisateur au chargement de la page
*/
class Message
{
	/* Attributs */

	/**
	* Contenu du message
	*
	* @var strong
	*/
	protected $contenu;
	/**
	* Type du message
	*
	* @var string
	*/
	protected $type;
	/**
	* Chemin vers la template utilisé
	*
	* @var string
	*/
	protected $template;
	/**
	* Chemin vers le css utilisé
	*
	* @var string
	*/
	protected $css;
	/**
	* Chemin vers le js utilisé
	*
	* @var string
	*/
	protected $js;

	/* Constantes */

	/**
	* Type de message: succès
	*
	* @var int
	*/
	const TYPE_SUCCES='succes';
	/**
	* Type de message: attention
	*
	* @var int
	*/
	const TYPE_ATTENTION='attention';
	/**
	* Type de message: erreur
	*
	* @var int
	*/
	const TYPE_ERREUR='erreur';

	/* Accesseurs */

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
	* Accesseur de type
	*
	* @return string
	*/
	public function getType()
	{
		return $this->type;
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
	* Accesseur de css
	*
	* @return string
	*/
	public function getCss()
	{
		return $this->css;
	}
	/**
	* Accesseur de js
	*
	* @return string
	*/
	public function getJs()
	{
		return $this->js;
	}

	/* Définisseurs */

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
	* Définisseur de type
	*
	* @param string type Type du message
	*
	* @return void
	*/
	protected function setType($type)
	{
		$this->type=$type;
	}
	/**
	* Définisseur de template
	*
	* @param string template Chemin vers ka tmplate utilisé
	*
	* @return void
	*/
	protected function setTemplate($template)
	{
		$this->template=$template;
	}
	/**
	* Définisseur de css
	*
	* @param string css Chemin vers le css utilisé
	*
	* @return void
	*/
	protected function setCss($css)
	{
		$this->css=$css;
	}
	/**
	* Définisseur de js
	*
	* @param string js Chemin vers le js utilisé
	*
	* @return void
	*/
	protected function setJs($js)
	{
		$this->js=$js;
	}

	/* Autres méthodes */

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
	* Afficheur de type
	*
	* @return string
	*/
	public function afficherType()
	{
		return htmlspecialchars((string)$this->type);
	}
	/**
	* Afficheur de template
	*
	* @return string
	*/
	public function afficherTemplate()
	{
		return htmlspecialchars((string)$this->template);
	}
	/**
	* Afficheur de css
	*
	* @return string
	*/
	public function afficherCss()
	{
		return htmlspecialchars((string)$this->css);
	}
	/**
	* Afficheur de js
	*
	* @return string
	*/
	public function afficherJs()
	{
		return htmlspecialchars((string)$this->js);
	}
	/**
	* Afficheur de Message
	*
	* @return string
	*/
	public function afficher()
	{
		$this->recupererTemplate();
		return $this->getContenu();
	}
	/**
	* Met la template dans le conteny
	*
	* @return void
	*/
	public function recupererTemplate()
	{
		$template_contenu=file_get_contents($this->getTemplate());
		$contenu=preg_replace('#\|message\|#', $this->afficherContenu(), $template_contenu);
		$contenu=preg_replace('#\|message_type\|#', $this->afficherType(), $contenu);
		$this->setContenu($contenu);
	}
	/**
	* Construction de l'objet
	*
	* @param array attributs Attributs du message
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
}

?>