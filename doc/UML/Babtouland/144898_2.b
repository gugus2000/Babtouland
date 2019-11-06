class Notification
!!!232194.php!!!	__construct(in elements : , in Page :  = null)

		global $config, $lang, $Visiteur;
		if (!$Page)
		{
			$Page=$Visiteur->getPage()->getPageElement();
		}
		$this->setTemplate($config['path_template'].$config['notification_path_template']);
		$this->setElements($elements);
		$this->ajouterTete($Page->getElement($config['tete_nom']));
		$Page->ajouterValeurElement($config['notification_nom'], $this);
!!!232322.php!!!	ajouterTete(in Tete : )

		global $config;
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['notification_path_css']);
		$Tete->ajouterValeurElement('javascripts', $config['path_assets'].$config['notification_path_js']);
