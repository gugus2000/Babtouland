<?php
$id_auteur=null;
$date_publication=new \DateTime($config['chat_temps_0']);
$date_comparaison=new \DateInterval($config['chat_voir_conversation_date_comparaison']);
$date_custom=new \DateTime(date($config['format_date']));

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	$id=(int)$Visiteur->getPage()->getParametres()['id'];
	$Conversation=new \chat\Conversation(array(
		'id' => $id,
	));
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
	if (!$present)
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
$Messages=$Conversation->recupererMessages();
foreach ($Messages as $Message)
{
	$date_comparaison1=clone $date_custom;
	$date_comparaison2=clone $date_custom;
	$date_diff=$date_publication->diff(new DateTime($Message->afficherDate_publicationFormat($config['format_date'])), True);
	$date_comparaison1->add($date_comparaison);
	$date_comparaison2->add($date_diff);
	if ($Message->getId_auteur()!=$id_auteur || $date_comparaison1<$date_comparaison2)
	{
		$Auteur=$Message->recupererAuteur();
		$id_auteur=$Auteur->getId();
		$date_publication=new \DateTime($Message->afficherDate_publicationFormat($config['format_date']));

		$Detail_message=new \user\PageElement(array(
			'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/detail_message.html',
			'elements' => array(
				'auteur' => $lang['chat_voir_conversation_auteur'].$Auteur->afficherPseudo(),
				'date'   => $lang['chat_voir_conversation_date'].$Message->afficherDate_publication(),
			),
		));

		$Separation=new \user\PageElement(array(
			'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/separation.html',
			'elements' => array(),
		));
	}
	else
	{
		$Detail_message='';
		$Separation='';
	}
	if ($Visiteur->getId()==$id_auteur)		// le test doit être rapide, donc je n'utilise pas la méthode \user\Utilisateur->similaire();
	{
		$lien_editer=$config['chat_voir_conversation_message_edition'];
		$lien_supprimer=$config['chat_voir_conversation_message_suppression'];
		$action_chat=new \user\PageElement(array(
			'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/action_chat.html',
			'elements' => array(
				'lien_editer'    => $Routeur->creerLien(array_merge($lien_editer, array($config['nom_parametres'] => array('id' => $Message->afficherId())))),
				'lien_supprimer' => $Routeur->creerLien(array_merge($lien_supprimer, array($config['nom_parametres'] => array('id' => $Message->afficherId())))),
			),
		));
	}
	else
	{
		$action_chat='';
	}
	$MessagesElements[]=new \user\PageElement(array(
		'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/message.html',
		'elements' => array(
			'detail_message' => $Detail_message,
			'action_chat'    => $action_chat,
			'contenu'        => $Message->afficherContenu(),
			'separation'     => $Separation,
		),
	));
}

if (!$Messages)
{
	$MessagesElements[]=new \user\PageElement(array(
		'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/message.html',
		'elements' => array(
			'detail_message'  => '',
			'contenu_message' => $lang['chat_voir_conversation_conversation_vide'],
			'separation'      => '',
		),
	));
}

$Chat=new \user\PageElement(array(
	'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/chat.html',
	'elements' => array(
		'messages' => $MessagesElements,
	),
));

$Contenu=new \user\PageElement(array(
	'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/form.html',
	'elements' => array(
		'action'        => $Routeur->creerLien(array_merge($config['chat_voir_conversation_form_action'], array($config['nom_parametres'] => array('id' => $Conversation->afficherId())))),
		'legend'        => $lang['chat_voir_conversation_form_legend'],
		'label_message' => $lang['chat_voir_conversation_form_label_message'],
		'submit'        => $lang['chat_voir_conversation_form_submit'],
	),
));

$Formulaire=new \user\page\Formulaire($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));

$boutons=array();
foreach ($Utilisateurs as $Utilisateur)
{
	$classe_bouton='';
	if ($Utilisateur->estConnecte())
	{
		$classe_bouton='success';
	}
	$boutons[]=new \user\page\MenuSide\Bouton($Routeur->creerLien(array_merge($config['chat_voir_conversation_menuside_lien_utilisateur'], array($config['nom_parametres'] => array('id' => $Utilisateur->afficherId())))), $lang['chat_voir_conversation_menuside_title_utilisateur'].$Utilisateur->afficherPseudo(), $Utilisateur->afficherPseudo(), $classe_bouton);
}
$BoutonsListe=new \user\page\MenuSide\BoutonsListe($lang['chat_voir_conversation_menuside_titre'], $boutons);
$MenuSide=new \user\page\MenuSide($BoutonsListe);

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_template'],
	'elements' => array(
		'menuSide' => $MenuSide,
		'chat'     => $Chat,
		'form'     => $Formulaire,
		'id'       => $Conversation->afficherId(),
	),
));

$toast_liens=array(
	'lien'        => array(array_merge($config['chat_voir_conversation_toast_editer_conversation'], array($config['nom_parametres'] => array('id' => $Conversation->afficherId()))), array_merge($config['chat_voir_conversation_toast_supprimer_conversation'], array($config['nom_parametres'] => array('id' => $Conversation->afficherId())))),
	'description' => array($lang['chat_voir_conversation_toast_editer_conversation'], $lang['chat_voir_conversation_toast_supprimer_conversation']),
	'icone'       => array('edit', 'delete'),
);


if($Visiteur->verifLiens($toast_liens['lien']) & $Conversation->getId()!=$config['id_conversation_all'])
{
	$Toast=new \user\page\Toast($toast_liens);
}
else
{
	$Toast='';
}

$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getpageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Contenu, $Toast);

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>