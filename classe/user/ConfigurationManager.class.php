<?php

namespace user;

/**
* Manager de Notification
*/
class ConfigurationManager extends \core\Manager
{
	/* Constantes */

	/**
	* Table de donnée utilisé pour Mot_de_passe
	*
	* @var string
	*/
	const TABLE='configuration';
	/**
	* Attributs
	*
	* @var array
	*/
	const ATTRIBUTES=array(
		0 => 'id',
		1 => 'id_utilisateur',
		2 => 'nom',
		3 => 'valeur',
	);
}

?>