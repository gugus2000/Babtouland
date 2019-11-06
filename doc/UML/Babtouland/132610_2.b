class Formulaire
!!!175490.php!!!	__construct(in contenu : PageElement, in Tete : PageElement) : void

		global $config, $lang, $Visiteur;
		$this->setTemplate($config['path_template'].$config['formulaire_path_template']);
		$this->setFonctions($config['path_func'].$config['formulaire_path_fonctions']);
		$this->setElements(array('contenu' => $contenu));
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['formulaire_path_css']);
