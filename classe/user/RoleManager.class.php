<?php

namespace user;

/**
* Manager de Role
*/
class RoleManager extends \core\Manager
{
	/* Constantes */

	/**
	* Table de donnée utilisé par Role
	*
	* @var string
	*/
	const TABLE='utilisateur';
	/**
	* Attributs
	*
	* @var array
	*/
	const ATTRIBUTES=array(
		0 => 'id',
		1 => 'nom_role',
	);
}

?>