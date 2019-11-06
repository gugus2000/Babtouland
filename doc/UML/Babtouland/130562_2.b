class Message
!!!158210.php!!!	getContenu() : string

		return $this->contenu;
!!!158338.php!!!	getType() : string

		return $this->type;
!!!158466.php!!!	getTemplate() : string

		return $this->template;
!!!158594.php!!!	getCss() : string

		return $this->css;
!!!158722.php!!!	getJs() : string

		return $this->js;
!!!158850.php!!!	setContenu(in contenu : string) : void

		$this->contenu=$contenu;
!!!158978.php!!!	setType(in type : string) : void

		$this->type=$type;
!!!159106.php!!!	setTemplate(in template : string) : void

		$this->template=$template;
!!!159234.php!!!	setCss(in css : string) : void

		$this->css=$css;
!!!159362.php!!!	setJs(in js : string) : void

		$this->js=$js;
!!!159490.php!!!	afficherContenu() : string

		return htmlspecialchars((string)$this->contenu);
!!!159618.php!!!	afficherType() : string

		return htmlspecialchars((string)$this->type);
!!!159746.php!!!	afficherTemplate() : string

		return htmlspecialchars((string)$this->template);
!!!159874.php!!!	afficherCss() : string

		return htmlspecialchars((string)$this->css);
!!!160002.php!!!	afficherJs() : string

		return htmlspecialchars((string)$this->js);
!!!160130.php!!!	afficher() : string

		$this->recupererTemplate();
		return $this->getContenu();
!!!160258.php!!!	recupererTemplate() : void

		$template_contenu=file_get_contents($this->getTemplate());
		$contenu=preg_replace('#\|message\|#', $this->afficherContenu(), $template_contenu);
		$contenu=preg_replace('#\|message_type\|#', $this->afficherType(), $contenu);
		$this->setContenu($contenu);
!!!160386.php!!!	__construct(in attributs : array) : void

		foreach ($attributs as $key => $value)
		{
			$method='set'.ucfirst($key);
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
