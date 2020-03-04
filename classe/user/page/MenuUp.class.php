<?php

namespace user\page;

/**
 * Menu-up classique
 */
class MenuUp extends \user\PageElement
{
	/*Autres méthodes */

	/**
	* Constructeur de Menu-up
	* 
	* @param PageElement Tete Tête de la page
	* 
	* @return void
	*/
	public function __construct($Tete=null)
	{
		global $config, $lang, $Visiteur, $Routeur;
		require $config['path_lang'].$Visiteur->getConfiguration('lang').'/lang.php';	// Chargement de la traduction
		if (!$Tete)
		{
			$Tete=$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']);
		}
		$this->setTemplate($config['path_template'].$config['menuUp_path_template']);
		$Logo=new \user\PageElement(array(
			'template'  => $config['path_template'].$config['menuUp_logo_path_template'],
			'elements'  => array(
				'lien'               => $Routeur->creerLien($config['menuUp_lien_logo']),
				'titre_lien_accueil' => $lang['menuUp_accueil'],
				'src_logo'           => $config['path_assets'].'img/icone/icone-transparent.png',
				'alt_logo'           => $lang['menuUp_altlogo'].$config['nom_site'],
				'titre_texte'        => strtoupper($config['nom_site']),
			),
		));
		$DropdownLang=new \user\page\Dropdown($lang['lang_self']['full'], $lang['lang_others'], $Tete);
		$Avatar=new \user\PageElement(array(
			'template'  => $config['path_template'].$config['menuUp_avatar_path_template'],
			'elements'  => array(
				'lien_avatar' => $Routeur->creerLien($config['menuUp_lien-statut']),
				'lien_titre'  => $Visiteur->afficherPseudo(),
				'src_avatar'  => $config['path_assets'].'img/avatar/'.$Visiteur->afficherAvatar(),
				'alt_avatar'  => $lang['menuUp_avatar'],
			),
		));
		$liens_grand=array();
		$liens_petit=array();
		foreach($config['menuUp_liens'] as $index => $href)
		{
			if ($Visiteur->getRole()->existPermission($href))
			{
				$liens_grand[]=new \user\PageElement(array(
					'template' => $config['path_template'].$config['menuUp_lien_grand_path_template'],
					'elements' => array(
						'href'        => $Routeur->creerLien($href),
						'title'       => $lang['menuUp_titres'][$index],
						'description' => $lang['menuUp_affichages'][$index],
					),
				));
				$liens_petit[]=new \user\PageElement(array(
					'template' => $config['path_template'].$config['menuUp_lien_petit_path_template'],
					'elements' => array(
						'href'  => $Routeur->creerLien($href),
						'title' => $lang['menuUp_titres'][$index],
						'icon'  => $config['menuUp_icones'][$index],
					),
				));
			}
		}
		$this->setElements(array(
			'logo'              => $Logo,
			'liens_grand_ecran' => $liens_grand,
			'dropdown_lang'     => $DropdownLang,
			'avatar'            => $Avatar,
			'liens_petit_ecran' => $liens_petit,
		));
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['menuUp_path_css']);
		$Tete->ajouterValeurElement('javascripts', $config['path_assets'].$config['menuUp_path_javascript']);
	}
}

?>