<?php

namespace user;

/**
* Manager de Utilisateur
*/
class UtilisateurManager extends \core\Manager
{
	/* Constantes */

	/**
	* Table de donnée utilisé par Utilisateur
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
		1 => 'pseudo',
		2 => 'avatar',
		3 => 'date_inscription',
		4 => 'date_connexion',
		5 => 'banni',
		6 => 'mail',
	);
}

?>