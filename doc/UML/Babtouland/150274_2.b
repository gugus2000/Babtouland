class Formulaire
!!!281986.php!!!	__construct(in contenu : , in Tete :  = null)

		global $config, $lang, $Visiteur;
		if (!$Tete)
		{
			$Tete=$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']);
		}
		$this->setTemplate($config['path_template'].$config['formulaire_path_template']);
		$this->setFonctions($config['path_func'].$config['formulaire_path_fonctions']);
		$this->setElements(array('contenu' => $contenu));
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['formulaire_path_css']);
