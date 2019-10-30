class Toast
!!!176258.php!!!	__construct(in elements : array, in Tete : PageElement) : void

		global $config, $lang, $Visiteur;
		$this->setTemplate($config['path_template'].$config['toast_path_template']);
		$this->setFonctions($config['path_func'].$config['toast_path_fonctions']);
		$this->setElements(array(
			'toast_liens' => $elements,
		));
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['toast_path_css']);
		$Tete->ajouterValeurElement('javascripts', $config['path_assets'].$config['toast_path_javascript']);
