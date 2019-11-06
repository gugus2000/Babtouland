class Motdepasse
!!!212994.php!!!	getId()

		return $this->id;
!!!213122.php!!!	getMdp_clair()

		return $this->mdp_clair;
!!!213250.php!!!	getMot_de_passe()

		return $this->mot_de_passe;
!!!213378.php!!!	setId(in id : )

		$this->id=$id;
!!!213506.php!!!	setMdp_clair(in mdp_clair : )

		$this->mdp_clair=$mdp_clair;
!!!213634.php!!!	setMot_de_passe(in mot_de_passe : )

		$this->mot_de_passe=$mot_de_passe;
!!!213762.php!!!	afficherId()

		return htmlspecialchars((string)$this->id);
!!!213890.php!!!	afficherMdp_clair()

		return htmlspecialchars((string)$this->mdp_clair);
!!!214018.php!!!	afficherMdp_hash()

		return htmlspecialchars((string)$this->mdp_hash);
!!!214146.php!!!	hash()

		if ($this->getMdp_clair())
		{
			$mdp_hash=password_hash($this->getMdp_clair(), PASSWORD_DEFAULT);
			$this->setMot_de_passe($mdp_hash);
		}
!!!214274.php!!!	verif(in mot_de_passe : )

		if ($this->getMot_de_passe())
		{
			$password=$mot_de_passe;
			$hash=$this->getMot_de_passe();
			$options=array(
				'cost' => $this::HASH_COST,
			);
			if (password_verify($password, $hash))
			{
			    if (password_needs_rehash($hash, PASSWORD_DEFAULT, $options))
			    {
			        $this->setMot_de_passe(password_hash($password, PASSWORD_DEFAULT, $options));
			        $Mot_de_passeManager=$this->Manager();
			        $Mot_de_passeManager->update(array(
			        	'mot_de_passe' => $this->getMot_de_passe(),
			        ), $this->getId());
			    }
			    $this->setMdp_clair($mot_de_passe);
			    return True;
			}
			return False;
		}
		return False;
