<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	if ($Visiteur->getPage()->getParametres()['id']!=$config['id_conversation_all'])
	{
		$Conversation=new \chat\Conversation(array(
			'id' => $Visiteur->getPage()->getParametres()['id'],
		));
		$Conversation->recuperer();
		$id_utilisateurs=$Conversation->getId_utilisateurs();
		$index=0;
		while (isset($id_utilisateurs[$index]))
		{
			if ($id_utilisateurs[$index]==$Visiteur->getId())
			{
				break;
			}
			$index++;
		}
		if (isset($id_utilisateurs[$index]))
		{
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
									'contenu' => $lang['chat_validation_editer_conversation_notification_attention_self'],
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
							'id'              => $Visiteur->getPage()->getParametres()['id'],
							'nom'             => $_POST['conversation_nom'],
							'description'     => $_POST['conversation_description'],
							'id_utilisateurs' => $liste_utilisateur,
						));
						$Conversation->modifier();
						new \user\page\Notification(array(
							'type'    => \user\page\Notification::TYPE_SUCCES,
							'contenu' => $lang['chat_validation_editer_conversation_notification_succes'],
						));
						$get=array_merge($config['chat_validation_editer_conversation_notification_succes'], array($config['nom_parametres'] => array('id' => $Conversation->getId())));
					}
					else
					{
						new \user\page\Notification(array(
							'type'    => \user\page\Notification::TYPE_ERREUR,
							'contenu' => $lang['chat_validation_editer_conversation_notification_erreur_pas_utilisateur'],
						));
						$get=$config['chat_validation_editer_conversation_notification_erreur_pas_utilisateur'];
					}
				}
				else
				{
					new \user\page\Notification(array(
						'type'    => \user\page\Notification::TYPE_ERREUR,
						'contenu' => $lang['chat_validation_editer_conversation_notification_erreur_formulaire_vide'],
					));
					$get=$config['chat_validation_editer_conversation_notification_erreur_formulaire_vide'];
				}
			}
			else
			{
				new \user\page\Notification(array(
					'type'    => \user\page\Notification::TYPE_ERREUR,
					'contenu' => $lang['chat_validation_editer_conversation_notification_erreur_formulaire_envoi'],
				));
				$get=$config['chat_validation_editer_conversation_notification_formulaire_envoi'];
			}
		}
		else
		{
			new \user\page\Notification(array(
				'type' => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['chat_validation_editer_conversation_notification_erreur_autorisation'],
			));
			$get=array_merge($config['chat_validation_editer_conversation_notification_erreur_autorisation'], array($config['nom_parametres'] => array('id' => $Visiteur->getPage()->getParametres()['id'])));
		}
	}
	else
	{
		new \user\page\Notification(array(
			'type' => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['chat_validation_editer_conversation_notification_erreur_general'],
		));
		$get=$config['chat_validation_editer_conversation_notification_erreur_general'];
	}
}
else
{
	new \user\page\Notification(array(
		'type' => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['chat_validation_editer_conversation_notification_erreur_id'],
	));
	$get=$config['chat_validation_editer_conversation_notification_erreur_id'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
exit();

?>