<?php

namespace user;

/**
* Manager de Mot_de_passe
*/
class MotdepasseManager extends \core\Manager
{
	/* Constantes */

	/**
	* Table de donnée utilisé pour Mot_de_passe
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
		1 => 'mot_de_passe',
	);
}

?>