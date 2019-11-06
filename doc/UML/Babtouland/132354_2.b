class Corps
!!!175234.php!!!	__construct(in haut : mixed, in centre : mixed, in bas : mixed) : void

		global $config, $lang, $Visiteur;
		$this->setTemplate($config['path_template'].$config['corps_path_template']);
		$this->setFonctions($config['path_func'].$config['corps_path_fonctions']);
		$this->setElements(array(
			'haut'   => $haut,
			'centre' => $centre,
			'bas'    => $bas,
		));
