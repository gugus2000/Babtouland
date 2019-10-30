<?php

/**
 * Afficheur de notifications pour Page
 *
 * @param array notifications Notifications à afficher
 *
 * @return void
 * @author gugus2000
 **/
function notificationsAfficher($notifications)
{
	$affichage='';
	foreach ($notifications as $notification)
	{
		$affichage.=$notification->afficher();
	}
	return $affichage;
}

?>