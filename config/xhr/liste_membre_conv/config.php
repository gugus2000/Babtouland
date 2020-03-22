<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	if ($Visiteur->getPage()->getParametres()['id']!=$config['id_conversation_all'])
	{
		$Conversation=new \chat\Conversation(array(
			'id' => $Visiteur->getPage()->getParametres()['id'],
		));
		$Conversation->recuperer();
		$Utilisateurs=$Conversation->recupererUtilisateurs();
		$pseudos=array();
		$est_dans_conv=False;
		foreach ($Utilisateurs as $Utilisateur)
		{
			if (!$Utilisateur->similaire($Visiteur))
			{
				$pseudos[]=$Utilisateur->afficherPseudo();
			}
			else
			{
				$est_dans_conv=True;
			}
		}
		if ($est_dans_conv)
		{
			$pseudos=implode('|', $pseudos);
			$Contenu=new \user\PageElement(array(
				'elements' => array(
					'contenu' => $pseudos,
				),
			));
			$Visiteur->getPage()->creerPage($Contenu);
		}
		else
		{
			new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['xhr_liste_membre_conv_erreur_pas_dans_conv'],
			));
		}
	}
	else
	{
		new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['xhr_liste_membre_conv_erreur_conv_all'],
		));
	}
}
else
{
	new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['xhr_liste_membre_conv_erreur_no_id'],
	));
}

?>