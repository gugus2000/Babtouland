<?php

namespace forum;

/**
 * Manager de Noeud
 *
 * @author gugus2000
 **/
class NoeudManager extends \core\Manager
{
	/* Constante */

	/**
	* Table de donnée utilisé par Noeud
	*
	* @var string
	*/
	const TABLE='forum';
	/**
	* Attributs
	*
	* @var array
	*/
	const ATTRIBUTES=array(
		0 => 'id',
		1 => 'type',
		2 => 'id_parent',
		3 => 'id_auteur',
		4 => 'nom',
		5 => 'description',
		6 => 'date_publication',
		7 => 'date_maj',
	);
} // END class NoeudManager extends \core\Manager

?>