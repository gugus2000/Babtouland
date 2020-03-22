<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	$Utilisateur=new \user\Utilisateur(array(
		'id' => $Visiteur->getPage()->getParametres()['id'],
	));
	$Utilisateur->recuperer();
	if ($Utilisateur->getPseudo()!=$config['nom_guest'])
	{
		if (!$Utilisateur->similaire($this))
		{
			$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur(\core\BDDFactory::MysqlConnexion());
			$resultats=$LiaisonConversationUtilisateur->getByGroup(array(
				array(
					'id_utilisateur' => $this->getId(),
				),
				array(
					'id_utilisateur' => $Utilisateur->getId(),
				)
			),
			array(
				array(
					'id_utilisateur' => '=',
				),
				array(
					'id_utilisateur' => '=',
				),
			), 'id_conversation', True);
			if (!(bool)$resultats)
			{
				$Conversation=new \chat\Conversation(array(
					'nom'             => $lang['chat_mp_nom_conversation_debut'].$this->getPseudo().$lang['chat_mp_nom_conversation_milieu'].$Utilisateur->getPseudo().$lang['chat_mp_nom_conversation_fin'],
					'description'     => $lang['chat_mp_description_conversation_debut'].$this->getPseudo().$lang['chat_mp_description_conversation_milieu'].$Utilisateur->getPseudo().$lang['chat_mp_description_conversation_fin'],
					'id_utilisateurs' => array($this->getId(), $Utilisateur->getId()),
				));
				$Conversation->creer(array($Visiteur->getId(), $Utilisateur->getId()));
				$resultats=$LiaisonConversationUtilisateur->getByGroup(array(
					array(
						'id_utilisateur' => $this->getId(),
					),
					array(
						'id_utilisateur' => $Utilisateur->getId(),
					)
				),
				array(
					array(
						'id_utilisateur' => '=',
					),
					array(
						'id_utilisateur' => '=',
					),
				), 'id_conversation', True);
			}
			if (count($resultats)==1)
			{
				$Conversation=new \chat\Conversation(array(
					'id' => $resultats[0]['id_conversation'],
				));
				$Conversation->recuperer();
				if (isset($_POST['mp_message']))
				{
					if (!empty($_POST['mp_message']))
					{
						$Message=new \chat\Message(array(
							'id_conversation' => $Conversation->getId(),
							'id_auteur'       => $this->getId(),
							'contenu'         => $_POST['mp_message'],
							'date_publication' => date($config['format_date']),
							'date_mise_a_jour' => date($config['format_date']),
						));
						$Message->creer();
						new \user\page\Notification(array(
							'type'    => \user\page\Notification::TYPE_SUCCES,
							'contenu' => $lang['chat_validation_envoyer_mp_notification_succes'],
						));
						$get=array_merge($config['chat_validation_envoyer_mp_notification_succes'], array($config['nom_parametres'] => array('id' => $Conversation->getId())));
					}
					else
					{
						new \user\page\Notification(array(
							'type'    => \user\page\Notification::TYPE_ERREUR,
							'contenu' => $lang['chat_validation_envoyer_mp_notification_erreur_message_vide'],
						));
						$get=array_merge($config['chat_validation_envoyer_mp_notification_erreur_message_vide'], array($config['nom_parametres'] => array('id' => $Utilisateur->getId())));
					}
				}
				else
				{
					new \user\page\Notification(array(
						'type'    => \user\page\Notification::TYPE_ERREUR,
						'contenu' => $lang['chat_validation_envoyer_mp_notification_erreur_formulaire'],
					));
					$get=array_merge($config['chat_validation_envoyer_mp_notification_erreur_formulaire'], array($config['nom_parametres'] => array('id' => $Utilisateur->getId())));
				}
			}
			else
			{
				new \user\page\Notification(array(
					'type'    => \user\page\Notification::TYPE_ERREUR,
					'contenu' => $lang['chat_validation_envoyer_mp_notification_erreur_plusieurs_mp'],
				));
				$get=array_merge($config['chat_validation_envoyer_mp_notification_erreur_plusieurs_mp'], array($config['nom_parametres'] => array('id' => $Utilisateur->getId())));
			}
		}
		else
		{
			new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['chat_validation_envoyer_mp_notification_erreur_soi_meme'],
			));
			$get=$config['chat_validation_envoyer_mp_notification_erreur_soi_meme'];
		}
	}
	else
	{
		new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['chat_validation_envoyer_mp_notification_erreur_guest'],
		));
		$get=$config['chat_validation_envoyer_mp_notification_erreur_guest'];
	}
}
else
{
	new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['chat_validation_envoyer_mp_notification_erreur_no_id'],
	));
	$get=$config['chat_validation_envoyer_mp_notification_erreur_no_id'];
}
$this->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
exit();

?>