class Tete
!!!232578.php!!!	__construct()

		global $config, $lang, $Visiteur;
		$this->setTemplate($config['path_template'].$config['tete_path_template']);
		$this->setFonctions($config['path_func'].$config['tete_path_fonctions']);
		$this->setElements(array(
			'metas'       => $config['tete_metas'],
			'css'         => $config['tete_css'],
			'javascripts' => $config['tete_javascripts'],
		));
