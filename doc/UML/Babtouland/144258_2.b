class Carte
!!!231554.php!!!	__construct(in contenu : )

		global $config, $lang, $Visiteur;
		$this->setTemplate($config['path_template'].$config['carte_path_template']);
		$this->setFonctions($config['path_func'].$config['carte_path_fonctions']);
		$this->setElements(array('contenu' => $contenu));
