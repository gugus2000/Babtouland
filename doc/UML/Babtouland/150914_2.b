class Toast
!!!282754.php!!!	__construct(in elements : , in Tete :  = null)

		global $config, $lang, $Visiteur;
		if (!$Tete)
		{
			$Tete=$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']);
		}
		$this->setTemplate($config['path_template'].$config['toast_path_template']);
		$this->setFonctions($config['path_func'].$config['toast_path_fonctions']);
		$this->setElements(array(
			'toast_liens' => $elements,
		));
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['toast_path_css']);
		$Tete->ajouterValeurElement('javascripts', $config['path_assets'].$config['toast_path_javascript']);