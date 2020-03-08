<?php

$compteur_elements_supprimes=0;
$CommentaireManager=new \post\CommentaireManager(\core\BDDFactory::MysqlConnexion());
$PostManager=new \post\PostManager(\core\BDDFactory::MysqlConnexion());
$commentaires=$CommentaireManager->getBy(array(
	'id' => -1,
), array(
	'id' => '!=',
));
foreach ($commentaires as $commentaire)
{
	if (!$PostManager->existId((int)$commentaire['id_post']))
	{
		$compteur_elements_supprimes++;
		$Commentaire=new \post\Commentaire(array(
			'id' => $commentaire['id'],
		));
		$Commentaire->supprimer();
	}
}

new \user\page\Notification(array(
	'type' => \user\page\Notification::TYPE_SUCCES,
	'contenu' => $lang['admin_nettoyer_post_notification_debut'].(string)$compteur_elements_supprimes.$lang['admin_nettoyer_post_notification_fin'],
));
$Visiteur->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($config['admin_nettoyer_post_notification_lien']));
exit();

?>