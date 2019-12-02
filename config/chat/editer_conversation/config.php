<?php

if (isset($_GET['id']))
{
	if ($_GET['id']!=$config['id_conversation_all'])
	{
		$Conversation=new \chat\Conversation(array(
			'id' => $_GET['id'],
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
			$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
			$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
				'name'    => 'description',
				'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
			));
			$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('javascripts', $config['path_assets'].'js/trie.js');

			$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('javascripts', $config['path_assets'].'js/chat_editer_conversation.js');
			$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('javascripts', $config['path_assets'].'js/chat_ajouter_utilisateur.js');
			$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].'css/chat_ajouter_utilisateur.css');

			$Form=new \user\PageElement(array(
				'template'  => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/form.html',
				'elements'  => array(
					'action'                         => $Routeur->creerLien(array_merge($config['chat_editer_conversation_formulaire_action'],array('id' => $_GET['id']))),
					'legend'                         => $lang['chat_editer_conversation_formulaire_legend'],
					'label_conversation_nom'         => $lang['chat_editer_conversation_formulaire_label_nom'],
					'value_conversation_nom'         => $Conversation->getNom(),
					'label_conversation_description' => $lang['chat_editer_conversation_formulaire_label_description'],
					'value_conversation_description' => $Conversation->getDescription(),
					'legend_ajouter_utilisateurs'    => $lang['chat_editer_conversation_formulaire_utilisateurs_legend'],
					'submit'                         => $lang['chat_editer_conversation_formulaire_submit'],
				),
			));
			$Formulaire=new \user\page\Formulaire($Form);
			$Contenu=new \user\PageElement(array(
				'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getpage()->getAction().'/template.html',
				'elements' => array(
					'formulaire' => $Formulaire,
				),
			));
			$Carte=new \user\page\Carte($Contenu);

			$MenuUp=new \user\page\MenuUp();
			$Corps=new \user\page\Corps($MenuUp, $Carte, '');

			$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
			$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));
		}
		else
		{
			new \user\page\Notification(array(
				'type' => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['chat_editer_conversation_notification_erreur_autorisation'],
			));
			header('location: '.$Routeur->creerLien(array_merge($config['chat_editer_conversation_notification_erreur_autorisation'], array('id' => $_GET['id']))));
			exit();
		}
	}
	else
	{
		new \user\page\Notification(array(
			'type' => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['chat_editer_conversation_notification_erreur_general'],
		));
		header('location: '.$Routeur->creerLien(['chat_editer_conversation_notification_erreur_general']));
		exit();
	}
}
else
{
	new \user\page\Notification(array(
		'type' => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['chat_editer_conversation_notification_erreur_id'],
	));
	header('location: '.$Routeur->creerLien($config['chat_editer_conversation_notification_erreur_id']));
	exit();
}

?>