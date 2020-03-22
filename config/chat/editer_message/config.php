<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	$ChatMessage=new \chat\Message(array(
		'id' => $Visiteur->getPage()->getParametres()['id'],
	));
	$ChatMessage->recuperer();
	$Conversation=new \chat\Conversation(array(
		'id' => $ChatMessage->getId_conversation(),
	));
	$Conversation->recuperer();
	$Utilisateurs=$Conversation->recupererUtilisateurs();
	$present=False;
	foreach ($Utilisateurs as $Utilisateur)
	{
		if ($Utilisateur->similaire($Visiteur))
		{
			$present=True;
			break;
		}
	}
	if ($present)
	{
		if($Visiteur->autorisationModification($ChatMessage))	// On peut le modifier
		{

			$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
			$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
				'name'    => 'description',
				'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
			));

			$Contenu=new \user\PageElement(array(
				'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/form.html',
				'elements' => array(
					'action'         => $Routeur->creerLien(array_merge($config['chat_editer_message_form_action'], array($config['nom_parametres'] => array('id' => $ChatMessage->afficherId())))),
					'legend'         => $lang['chat_editer_message_form_legend'],
					'label_message'  => $lang['chat_editer_message_form_label_message'],
					'ancien_message' => $ChatMessage->afficherContenu(),
					'submit'         => $lang['chat_editer_message_form_submit'],
				),
			));

			$Formulaire=new \user\page\Formulaire($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));

			$Contenu=new \user\PageElement(array(
				'template'  => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/'.$config['filename_contenu_template'],
				'elements' => array(
					'formulaire' => $Formulaire,
				),
			));

			$Carte=new \user\page\Carte($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
			$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getpageElement()->getElement($config['tete_nom']));
			$Corps=new \user\page\Corps($MenuUp, $Carte, '');

			$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
			$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));
		}
		else
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['chat_editer_message_erreur_message_autorisation'],
			));
			$this->getPage()->envoyerNotificationsSession();
			header('location: '.$Routeur->creerLien($config['chat_editer_message_erreur_message_autorisation']));
			exit();
		}
	}
	else
	{
		$Notification=new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['chat_editer_message_erreur_conversation_autorisation'],
		));
		$this->getPage()->envoyerNotificationsSession();
		header('location: '.$Routeur->creerLien($config['chat_editer_message_erreur_conversation_autorisation']));
		exit();
	}
}
else
{
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['chat_editer_message_erreur_id_message'],
	));
	$this->getPage()->envoyerNotificationsSession();
	header('location: '.$Routeur->creerLien($config['chat_editer_message_erreur_id_message']));
	exit();
}

?>