<?php

$Message=new \user\Message(array(
	'contenu'  => $lang['post_suppression_message_argument'],
	'type'     => \user\Message::TYPE_ERREUR,
	'css'      => $config['message_css'],
	'js'       => $config['message_js'],
	'template' => $config['message_template'],
));
$get=$config['post_suppression_retour'];
if(isset($_GET['id']))
{
	$Message=new \user\Message(array(
		'contenu'  => $lang['post_suppression_message_inexistant'],
		'type'     => \user\Message::TYPE_ERREUR,
		'css'      => $config['message_css'],
		'js'       => $config['message_js'],
		'template' => $config['message_template'],
	));
	$BDDFactory=new \core\BDDFactory;
	$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
	if($PostManager->existId((int)$_GET['id']))
	{
		$Message=new \user\Message(array(
			'contenu'  => $lang['post_suppression_message_permission'],
			'type'     => \user\Message::TYPE_ERREUR,
			'css'      => $config['message_css'],
			'js'       => $config['message_js'],
			'template' => $config['message_template'],
		));
		$get=$config['post_suppression_permission'].'&id='.$_GET['id'];
		$Post=new \post\Post(array(
			'id' => $_GET['id'],
		));
		$Post->recuperer();
		if(autorisationModification($Post, $application, $action))
		{
			$Message=new \user\Message(array(
				'contenu'  => $lang['post_suppression_message_succes'],
				'type'     => \user\Message::TYPE_SUCCES,
				'css'      => $config['message_css'],
				'js'       => $config['message_js'],
				'template' => $config['message_template'],
			));
			$get=$config['post_suppression_suivant'];
			$Post->supprimer();
		}
	}
}

$_SESSION['message']=serialize($Message);
header('location: index.php'.$get);

?>