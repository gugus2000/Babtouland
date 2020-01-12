<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	$Noeud=\forum\Noeud::newNoeud($Visiteur->getPage()->getParametres()['id']);
	if ($Visiteur->autorisationModification($Noeud))
	{
		if (isset($_POST['nom'] & isset($_POST['description'])))
		{
			$type=$Noeud->getType();
			$MajNoeud=new \forum\ucfirst($type)(array(
				'id'          => $Noeud->getId(),
				'nom'         => $_POST['nom'],
				'description' => $_POST['description'],
				'date_maj'    => date('Y-m-d H:i:s'),
			));
			$MajNoeud->modifier();
		}
		else
		{

		}
	}
	else
	{

	}
}
else
{

}

?>