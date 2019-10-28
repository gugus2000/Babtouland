<?php

/**
 * Permet l'affichage des messages du chat
 *
 * @param array messages Liste des PageElement (messages) à afficher
 *
 * @return string
 * @author gugus2000
 **/
function messagesAfficher($messages)
{
	$affichage='';
	foreach ($messages as $message)
	{
		$affichage.=$message->afficher();
	}
	return $affichage;
}

?>