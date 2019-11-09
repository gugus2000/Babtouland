<?php

$id_auteur=null;
$date_publication=new \DateTime($config['chat_temps_0']);
$date_comparaison=new \DateInterval($config['chat_voir_conversation_date_comparaison']);
$date_custom=new \DateTime(date('Y-m-d H:i:s'));

if (isset($_GET['id']))
{
	$id=(int)$_GET['id'];
	$Conversation=new \chat\Conversation(array(
		'id' => $id,
	));
	$Conversation->recuperer($date_publication->format('Y-m-d H:i:s'));
	$Id_utilisateurs=$Conversation->getId_utilisateurs();
	$index=0;
	while (isset($Id_utilisateurs[$index]))		// Évite de parcourir toute la liste
	{
		if (!$Id_utilisateurs[$index]==$Visiteur->getId())
		{
			break;
		}
		$index++;
	}
	if (!isset($Id_utilisateurs[$index-1]))
	{
		throw new \Exception($lang['chat_voir_conversation_erreur_pas_membre']);
	}
}
else
{
	throw new \Exception($lang['chat_voir_conversation_erreur_no_id']);
}

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].'css/chat.css');
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('javascripts', $config['path_assets'].'js/chat.js');

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre'].$Conversation->afficherNom());
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));

$MessagesElements=[];
foreach ($Conversation->recupererMessages() as $Message)
{
	$date_comparaison1=clone $date_custom;
	$date_comparaison2=clone $date_custom;
	$Detail_message='';
	$Separation='';
	$date_diff=$date_publication->diff(new DateTime($Message->afficherDate_publicationFormat('Y-m-d H:i:s')), True);
	$date_comparaison1->add($date_comparaison);
	$date_comparaison2->add($date_diff);
	if ($Message->getId_auteur()!=$id_auteur | $date_comparaison1<$date_comparaison2)
	{
		$Auteur=new \user\Utilisateur(array(
			'id' => $Message->getId_auteur(),
		));
		$Auteur->recuperer();
		$id_auteur=$Auteur->getId();
		$date_publication=new \DateTime($Message->afficherDate_publicationFormat('Y-m-d H:i:s'));

		$Detail_message=new \user\PageElement(array(
			'template' => $config['path_template'].$application.'/'.$action.'/detail_message.html',
			'elements' => array(
				'auteur' => $lang['chat_voir_conversation_auteur'].$Auteur->afficherPseudo(),
				'date'   => $lang['chat_voir_conversation_date'].$Message->afficherDate_publication(),
			),
		));

		$Separation=new \user\PageElement(array(
			'template' => $config['path_template'].$application.'/'.$action.'/separation.html',
			'elements' => array(),
		));
	}

	$action_chat_editer='';
	$lien_editer=$config['chat_voir_conversation_message_edition'];
	$lien_editer_array=recuperationApplicationActionLien($lien_editer);
	$action_chat_supprimer='';
	if (autorisationModification($Message, $lien_editer_array['application'], $lien_editer_array['action']))
	{
		$action_chat_editer=new \user\PageElement(array(
			'template' => $config['path_template'].$application.'/'.$action.'/action_chat_editer.html',
			'elements' => array(
				'lien' => $lien_editer.'&id='.$Message->afficherId(),
			),
		));
	}
	$lien_supprimer=$config['chat_voir_conversation_message_suppression'];
	$lien_supprimer_array=recuperationApplicationActionLien($lien_supprimer);
	if (autorisationModification($Message, $lien_supprimer_array['application'], $lien_supprimer_array['action']))
	{
		$action_chat_supprimer=new \user\PageElement(array(
			'template' => $config['path_template'].$application.'/'.$action.'/action_chat_supprimer.html',
			'elements' => array(
				'lien' => $lien_supprimer.'&id='.$Message->afficherId(),
			),
		));
	}

	$action_chat=new \user\PageElement(array(
		'template' => $config['path_template'].$application.'/'.$action.'/action_chat.html',
		'elements' => array(
			'editer'    => $action_chat_editer,
			'supprimer' => $action_chat_supprimer,
		),
	));

	$Contenu_message=new \user\PageElement(array(
		'template' => $config['path_template'].$application.'/'.$action.'/contenu_message.html',
		'elements' => array(
			'action_chat' => $action_chat,
			'contenu'     => $Message->afficherContenu(),
		),
	));

	$MessagesElements[]=new \user\PageElement(array(
		'template' => $config['path_template'].$application.'/'.$action.'/message.html',
		'elements' => array(
			'detail_message'  => $Detail_message,
			'contenu_message' => $Contenu_message,
			'separation'      => $Separation,
		),
	));
}
if (!$Conversation->recupererMessages())
{
	$MessagesElements[]=new \user\PageElement(array(
		'template' => $config['path_template'].$application.'/'.$action.'/message.html',
		'elements' => array(
			'detail_message'  => '',
			'contenu_message' => $lang['chat_voir_conversation_conversation_vide'],
			'separation'      => '',
		),
	));
}

$Chat=new \user\PageElement(array(
	'template' => $config['path_template'].$application.'/'.$action.'/chat.html',
	'fonctions' => $config['path_func'].$application.'/'.$action.'/chat.func.php',
	'elements' => array(
		'messages' => $MessagesElements,
	),
));

$Contenu=new \user\PageElement(array(
	'template' => $config['path_template'].$application.'/'.$action.'/form.html',
	'elements' => array(
		'action'        => $config['chat_voir_conversation_form_action'].'&id='.$Conversation->afficherId(),
		'legend'        => $lang['chat_voir_conversation_form_legend'],
		'label_message' => $lang['chat_voir_conversation_form_label_message'],
		'submit'        => $lang['chat_voir_conversation_form_submit'],
	),
));

$Formulaire=new \user\page\Formulaire($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements' => array(
		'chat' => $Chat,
		'form' => $Formulaire,
	),
));

$Carte=new \user\page\Carte($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getpageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Carte, '');

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);

?>