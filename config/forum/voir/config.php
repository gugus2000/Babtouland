<?php

if (!isset($Visiteur->getPage()->getParametres()['id']))
{
	$get=$config['forum_voir_no_id'];
}
else
{
	$Dossier=new \forum\Dossier(array(
		'id' => $Visiteur->getPage()->getParametres()['id'],
	));
	$Dossier->recuperer();
	switch ($Dossier->getType())
	{
		case \forum\Noeud::TYPE_DOSSIER:
			$get=$config['forum_voir_dossier'];
			break;
		case \forum\Noeud::TYPE_FIL:
			$get=$config['forum_voir_fil'];
			break;
		default:
			$get=$config['forum_voir_defaut'];
			break;
	}
	$get[$config['nom_parametres']]=array('id' => $Dossier->getId());
}
header('location: '.$Routeur->creerLien($get));
exit();

?>