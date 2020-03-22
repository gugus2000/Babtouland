<?php

namespace user;

/**
* Manager de Notification
*/
class NotificationManager extends \core\Manager
{
	/* Constantes */

	/**
	* Table de donnée utilisé pour Mot_de_passe
	*
	* @var string
	*/
	const TABLE='notification';
	/**
	* Attributs
	*
	* @var array
	*/
	const ATTRIBUTES=array(
		0 => 'id',
		1 => 'type',
		2 => 'date_publication',
		3 => 'id_contenu',
	);
}

?>