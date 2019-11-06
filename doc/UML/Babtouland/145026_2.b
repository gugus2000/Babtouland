class Page
!!!232450.php!!!	__construct()

		global $config, $lang, $Visiteur;
		$this->setTemplate($config['pageElement_page_template']);
		$this->setFonctions($config['pageElement_page_fonctions']);
		$this->setElements($config['pageElement_page_elements']);
