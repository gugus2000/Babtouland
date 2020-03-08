<?php

$Visiteur->getPage()->ajouterEnteteClassique();

$Contenu=new \user\PageElement(array(
	'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/'.$config['filename_contenu_template'],
	'elements' => array(
		'nettoyage_post_href'                => $Routeur->creerLien($config['admin_nettoyer_post_href']),
		'nettoyage_post_title'               => $lang['admin_nettoyer_post_title'],
		'nettoyage_post_description'         => $lang['admin_nettoyer_post_description'],
		'nettoyage_forum_href'               => $Routeur->creerLien($config['admin_nettoyer_forum_href']),
		'nettoyage_forum_title'              => $lang['admin_nettoyer_forum_title'],
		'nettoyage_forum_description'        => $lang['admin_nettoyer_forum_description'],
		'nettoyage_chat_href'                => $Routeur->creerLien($config['admin_nettoyer_chat_href']),
		'nettoyage_chat_title'               => $lang['admin_nettoyer_chat_title'],
		'nettoyage_chat_description'         => $lang['admin_nettoyer_chat_description'],
		'nettoyage_notification_href'        => $Routeur->creerLien($config['admin_nettoyer_notification_href']),
		'nettoyage_notification_title'       => $lang['admin_nettoyer_notification_title'],
		'nettoyage_notification_description' => $lang['admin_nettoyer_notification_description'],
	),
));
$Carte=new \user\page\Carte($Contenu);
$MenuUp=new \user\page\MenuUp();
$Corps=new \user\page\Corps($MenuUp, $Carte, '');

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>