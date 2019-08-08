<?php

$_SESSION['message']=$lang['post_suppression_message_argument'];
$get=$config['post_suppression_retour'];
if(isset($_GET['id']))
{
	$_SESSION['message']=$lang['post_suppression_message_inexistant'];
	$BDDFactory=new \core\BDDFactory;
	$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
	if($PostManager->existId((int)$_GET['id']))
	{
		$_SESSION['message']=$lang['post_suppression_message_permission'];
		$get=$config['post_suppression_permission'].'&id='.$_GET['id'];
		$Post=new \post\Post(array(
			'id' => $_GET['id'],
		));
		$Post->recuperer();
		if(autorisationModification($Post, $Visiteur->getPage()->getApplication(), $Visiteur->getPage()->getAction()))
		{
			$_SESSION['message']=$lang['post_suppression_message_succes'];
			$get=$config['post_suppression_suivant'];
			$Post->supprimer();
		}
	}
}

header('location: index.php'.$get);

?>