<?php

session_destroy();
session_start();

$Notification=new \user\page\Notification(array(
	'type'     => \user\page\Notification::TYPE_SUCCES,
	'contenu'  => $lang['user_deconnexion_message'],
), $this->getPage()->getPageElement());

$Visiteur->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($config['user_deconnexion_lien']));
exit();

?>