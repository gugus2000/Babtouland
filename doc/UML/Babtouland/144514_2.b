class Dropdown
!!!231810.php!!!	__construct(in dropdown_select : , in dropdown_others : , in Tete : )

		global $config, $lang, $Visiteur;
		$this->setTemplate($config['path_template'].$config['dropdown_path_template']);
		$this->setFonctions($config['path_func'].$config['dropdown_path_fonctions']);
		$this->setElements(array(
			'dropdown_select' => $dropdown_select,
			'dropdown_others' => $dropdown_others,
		));
		$Tete->ajouterValeurElement('css', $config['path_assets'].$config['dropdown_path_css']);
