<?php
$id_auteur=null;
$date_publication=new \DateTime($config['chat_temps_0']);
$date_comparaison=new \DateInterval($config['chat_voir_conversation_date_comparaison']);
$date_custom=new \DateTime(date($config['format_date']));

if (isset($Visiteur->getPage()->getParametres()['date_chargement']))
{
	$date_chargement=new \DateTime($Visiteur->getPage()->getParametres()['date_chargement']);
}
else
{
	$date_chargement=$date_publication;
}
if (isset($Visiteur->getPage()->getParametres()['id']))
{
	$id=(int)$Visiteur->getPage()->getParametres()['id'];
	$Conversation=new \chat\Conversation(array(
		'id' => $id,
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
	if (!$present)
	{
		throw new \Exception($lang['chat_voir_conversation_erreur_pas_membre']);
	}
}
else
{
	throw new \Exception($lang['chat_voir_conversation_erreur_no_id']);
}


$MessagesElements=[];
foreach ($Conversation->recupererMessages() as $Message)
{
	$date_comparaison1=clone $date_custom;
	$date_comparaison2=clone $date_custom;
	$Detail_message='';
	$Separation='';
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
	$action_chat='';
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
if (!$Conversation->recupererMessages())
{
	$MessagesElements[]=new \user\PageElement(array(
		'template' => $config['path_template'].'chat'.'/'.'voir_conversation'.'/message.html',
		'elements' => array(
			'detail_message'  => '',
			'contenu_message' => '',
			'separation'      => '',
		),
	));
}

$Chat=new \user\PageElement(array(
	'template' => $config['path_template'].'chat'.'/'.'voir_conversation'.'/chat.html',
	'elements' => array(
		'messages' => $MessagesElements,
	),
));

$Visiteur->getPage()->creerPage($Chat);

?>