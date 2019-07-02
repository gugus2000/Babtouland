<?php

namespace user;

/**
* Manager de Permission
*/
class PermissionManager extends \core\Manager
{
	/* Constantes */

	/**
	* Table de donnée utilisé par Permission
	*
	* @var string
	*/
	const TABLE='permission';
	/**
	* Attributs
	*
	* @var array
	*/
	const ATTRIBUTES=array(
		0 => 'id',
		1 => 'nom_role',
		2 => 'application',
		3 => 'action',
	);
}

?>