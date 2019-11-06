<?php

namespace user;

/**
* Liaison entre les tables notification et utilisateur
*/
class LiaisonNotificationUtilisateur extends \core\LiaisonManager
{
	/* Constantes */

	/**
	* Table de donnée utilisé par la liaison
	*
	* @var string
	*/
	const TABLE='liaisonnotificationutilisateur';
	/**
	* Attributs
	*
	* @var array
	*/
	const ATTRIBUTES=array(
		0 => 'id_notification',
		1 => 'id_utilisateur',
	);
}

?>