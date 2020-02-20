<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	if ($Visiteur->getPage()->getParametres()['id']!=$config['id_conversation_all'])
	{
		$Conversation=new \chat\Conversation(array(
			'id' => $Visiteur->getPage()->getParametres()['id'],
		));
		$Conversation->recupererId_utilisateurs();
		$id_utilisateurs=$Conversation->getId_utilisateurs();
		if (in_array($Visiteur->getId(), $id_utilisateurs))
		{
			$pseudos=array();
			foreach ($Conversation->recupererUtilisateurs() as $utilisateur)
			{
				if (!$utilisateur->similaire($Visiteur))
				{
					$pseudos[]=$utilisateur->afficherPseudo();
				}
			}
			$Corps=new \user\page\Corps('', implode('|', $pseudos), '');
			$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
			$this->getPage()->envoyerNotificationsSession();
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