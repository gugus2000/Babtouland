<?php

if (isset($_POST['conversation_nom']) & isset($_POST['conversation_description']))
{
	if (!empty($_POST['conversation_nom']) & !empty($_POST['conversation_description']))
	{
		$liste_utilisateur=array();
		foreach ($_POST as $nom => $valeur)
		{
			if ($nom!='conversation_nom' & $nom!='conversation_description')
			{
				if ($Visiteur->getPseudo()==$valeur)
				{
					new \user\page\Notification(array(
						'type'    => \user\page\Notification::TYPE_ATTENTION,
						'contenu' => $lang['chat_validation_ajouter_conversation_notification_attention_self'],
					));
				}
				else
				{
					$utilisateur=new \user\Utilisateur(array(
						'pseudo' => $valeur,
					));
					$utilisateur->recuperer();
					$liste_utilisateur[]=$utilisateur->getId();
				}
			}
		}
		$liste_utilisateur[]=$Visiteur->getId();
		if (count($liste_utilisateur)>1)
		{
			$Conversation=new \chat\Conversation(array(
				'nom'             => $_POST['conversation_nom'],
				'description'     => $_POST['conversation_description'],
				'id_utilisateurs' => $liste_utilisateur,
			));
			$Conversation->creer();
			new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['chat_validation_ajouter_conversation_notification_succes'],
			));
			$get=$config['chat_validation_ajouter_conversation_notification_succes'].'&id='.$Conversation->getId();
		}
		else
		{
			new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['chat_validation_ajouter_conversation_notification_erreur_pas_utilisateur'],
			));
			$get=$config['chat_validation_ajouter_conversation_notification_erreur_pas_utilisateur'];
		}
	}
	else
	{
		new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['chat_validation_ajouter_conversation_notification_erreur_formulaire_vide'],
		));
		$get=$config['chat_validation_ajouter_conversation_notification_erreur_formulaire_vide'];
	}
}
else
{
	new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['chat_validation_ajouter_conversation_notification_erreur_formulaire_envoi'],
	));
	$get=$config['chat_validation_ajouter_conversation_notification_erreur_formulaire_envoi'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: index.php'.$get)

?>