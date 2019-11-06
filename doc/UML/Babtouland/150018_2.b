class Corps
!!!281730.php!!!	__construct(in haut :  = '', in centre :  = '', in bas :  = '')

		global $config, $lang, $Visiteur;
		$this->setTemplate($config['path_template'].$config['corps_path_template']);
		$this->setFonctions($config['path_func'].$config['corps_path_fonctions']);
		$this->setElements(array(
			'haut'   => $haut,
			'centre' => $centre,
			'bas'    => $bas,
		));
