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
	const TABLE='noeud';
	/**
	* Attributs
	*
	* @var array
	*/
	const ATTRIBUTES=array(
		0 => 'id',
		1 => 'id_parent',
		2 => 'id_auteur',
		3 => 'nom',
		4 => 'description',
		5 => 'date_publication',
		6 => 'date_maj',
		7 => 'type',
	);
} // END class NoeudManager extends \core\Manager

?>