<?php

if (isset($_GET['id']))
{
	$Utilisateur=new \user\Utilisateur(array(
		'id' => $_GET['id'],
	));
	$Utilisateur->recuperer();
	if ($Utilisateur->getPseudo()!=$config['nom_guest'])
	{
		if (!$Utilisateur->similaire($this))
		{
			$this->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$this->getPage()->getApplication().'_'.$this->getPage()->getAction().'_titre']);
			$this->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
				'name'    => 'description',
				'content' => $lang[$this->getPage()->getApplication().'_'.$this->getPage()->getAction().'_description'],
			));

			$Contenu=new \user\PageElement(array(
				'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/form.html',
				'elements' => array(
					'action'         => $config['chat_envoyer_mp_form_action'].'&id='.$Utilisateur->afficherId(),
					'legend'         => $lang['chat_envoyer_mp_form_legend'],
					'label_message'  => $lang['chat_envoyer_mp_form_label_message'],
					'submit'         => $lang['chat_envoyer_mp_form_submit'],
				),
			));

			$Formulaire=new \user\page\Formulaire($Contenu);

			$Contenu=new \user\PageElement(array(
				'template'  => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/'.$config['filename_contenu_template'],
				'elements' => array(
					'formulaire' => $Formulaire,
				),
			));

			$Carte=new \user\page\Carte($Contenu);
			$MenuUp=new \user\page\MenuUp();
			$Corps=new \user\page\Corps($MenuUp, $Carte, '');

			$this->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
		}
		else
		{
			new \user\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['chat_envoyer_mp_notification_erreur_soi_meme'],
			));
			$get=$config['chat_envoyer_mp_notification_erreur_soi_meme'];
			$this->getPage()->envoyerNotificationsSession();
			header('location: index.php'.$get);
		}
	}
	else
	{
		new \user\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['chat_envoyer_mp_notification_erreur_guest'],
		));
		$get=$config['chat_envoyer_mp_notification_erreur_guest'];
		$this->getPage()->envoyerNotificationsSession();
		header('location: index.php'.$get);
	}
}
else
{
	new \user\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['chat_envoyer_mp_notification_erreur_no_id'],
	));
	$get=$config['chat_envoyer_mp_notification_erreur_no_id'];
	$this->getPage()->envoyerNotificationsSession();
	header('location: index.php'.$get);
}

?>