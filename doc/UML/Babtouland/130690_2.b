class Motdepasse
!!!160514.php!!!	getId() : int

		return $this->id;
!!!160642.php!!!	getMdp_clair() : string

		return $this->mdp_clair;
!!!160770.php!!!	getMot_de_passe() : string

		return $this->mot_de_passe;
!!!160898.php!!!	setId(in id : int) : void

		$this->id=$id;
!!!161026.php!!!	setMdp_clair(in mdp_clair : string) : void

		$this->mdp_clair=$mdp_clair;
!!!161154.php!!!	setMot_de_passe(in mot_de_passe : string) : void

		$this->mot_de_passe=$mot_de_passe;
!!!161282.php!!!	afficherId() : string

		return htmlspecialchars((string)$this->id);
!!!161410.php!!!	afficherMdp_clair() : string

		return htmlspecialchars((string)$this->mdp_clair);
!!!161538.php!!!	afficherMdp_hash() : string

		return htmlspecialchars((string)$this->mdp_hash);
!!!161666.php!!!	hash() : void

		if ($this->getMdp_clair())
		{
			$mdp_hash=password_hash($this->getMdp_clair(), PASSWORD_DEFAULT);
			$this->setMot_de_passe($mdp_hash);
		}
!!!161794.php!!!	verif(in mot_de_passe : string) : bool

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
