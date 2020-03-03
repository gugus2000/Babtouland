<?php

namespace user\page;

/**
 * Tête de page classique
 */
class Tete extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de Tete
	* 
	* @return void
	*/
	public function __construct()
	{
		global $config, $lang, $Visiteur;
		$this->setTemplate($config['path_template'].$config['tete_path_template']);
		$Metas=array();
		if (isset($config['tete_metas']))
		{
			foreach ($config['tete_metas'] as $meta)
			{
				$metas=array();
				foreach ($meta as $key => $value)
				{
					$metas[]=new \user\PageElement(array(
						'template' => $config['path_template'].$config['tete_metas_path_template'],
						'elements' => array(
							'key'   => $key,
							'value' => $value,
						),
					));
				}
				$Metas[]=new \user\PageElement(array(
					'template' => $config['path_template'].$config['tete_meta_path_template'],
					'elements' => array(
						'metas' => $metas,
					),
				));
			}
		}
		$css=array();
		if (isset($config['tete_css']))
		{
			foreach ($config['tete_css'] as $href)
			{
				$css[]=new \user\PageElement(array(
					'template' => $config['path_template'].$config['tete_css_path_template'],
					'elements' => array(
						'href' => $href,
					),
				));
			}
		}
		$javascripts=array();
		if (isset($config['tete_javascripts']))
		{
			foreach ($config['tete_javascripts'] as $src)
			{
				$javascripts[]=new \user\PageElement(array(
					'template' => $config['path_template'].$config['tete_javascript_path_template'],
					'elements' => array(
						'src' => $src,
					),
				));
			}
		}
		$this->setElements(array(
			'metas'       => $Metas,
			'css'         => $css,
			'javascripts' => $javascripts,
		));
	}
	/**
	* Ajoute un élément dans un élément array dans elements
	*
	* @param mixed index Index de l'élément à laquelle ajouter la valeur
	*
	* @param mixed valeur Valeur de l'élément de l'élément à ajouter
	* 
	* @return void
	*/
	public function ajouterValeurElement($index, $valeur)
	{
		switch ($index)
		{
			case 'metas':
				$this->ajouterMetas($valeur);
				break;
			case 'css':
				$this->ajouterCss($valeur);
				break;
			case 'javascripts':
				$this->ajouterJavascripts($valeur);
				break;
			default:
					if (is_array($this->getElement($index)))
					{
						if (!in_array($valeur, $this->elements[$index]))		// La valeur n'existe pas déjà
						{
							$this->elements[$index][]=$valeur;
						}
					}
					else if (is_string($this->getElement($index)))
					{
						$this->elements[$index].=(string)$valeur;
					}
					else
					{
						throw new \Exception("On ne peut pas ajouter la valeur à l'élément s'il n'est pas un array ou une string");
					}
				break;
			}
		}
		/**
		* Ajouter un attribut metas à la page
		*
		* @param array metas Tableau de métadonnées
		* 
		* @return void
		*/
		public function ajouterMetas($meta)
		{
			global $config;
			$metas=$this->getElement('metas');
			$Metas=array();
			foreach ($meta as $key => $value)
			{
				$Metas[]=new \user\PageElement(array(
				'template' => $config['path_template'].$config['tete_metas_path_template'],
				'elements' => array(
					'key'   => $key,
					'value' => $value,
				),
			));
			}
			$Meta=new \user\PageElement(array(
				'template' => $config['path_template'].$config['tete_css_path_template'],
				'elements' => array(
					'metas' => $Metas,
				),
			));
			if (!array_key_exists(spl_object_hash($Meta), $metas))		// La valeur n'existe pas déjà
			{
				$this->setElement('metas', $metas);		    
			}
		}
		/**
		* Ajouter un fichier css à la page
		*
		* @param string href Lien vers le script javascript
		* 
		* @return void
		*/
		public function ajouterCss($href)
		{
			global $config;
			$css=$this->getElement('css');
			$Css=new \user\PageElement(array(
				'template' => $config['path_template'].$config['tete_css_path_template'],
				'elements' => array(
					'href' => $href,
				),
			));
			if (!array_key_exists(spl_object_hash($Css), $css))		// La valeur n'existe pas déjà
			{
				$css[]=$Css;
				$this->setElement('css', $css);		    
			}
		}
		/**
		* Ajouter un script javascript à la page
		*
		* @param string src Lien vers le script javascript
		* 
		* @return void
		*/
		public function ajouterJavascripts($src)
		{
			global $config;
			$javascripts=$this->getElement('javascripts');
			$Javascript=new \user\PageElement(array(
				'template' => $config['path_template'].$config['tete_javascript_path_template'],
				'elements' => array(
					'src' => $src,
				),
			));
			if (!array_key_exists(spl_object_hash($Javascript), $javascripts))	// La valeur n'existe pas déjà
			{
				$javascripts[]=$Javascript;
				$this->setElement('javascripts', $javascripts);		    
			}
		}
		
}

?>