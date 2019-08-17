<?php

session_destroy();
session_start();

$Message=new \user\Message(array(
	'contenu'  => $lang['user_deconnexion_message'],
	'type'     => \user\Message::TYPE_SUCCES,
	'css'      => $config['message_css'],
	'js'       => $config['message_js'],
	'template' => $config['message_template'],
));

$_SESSION['message']=serialize($Message);
header('location: index.php')

?>