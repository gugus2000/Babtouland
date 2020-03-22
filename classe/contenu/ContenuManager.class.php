<?php

namespace contenu;

/**
 * Manager de \contenu\Contenu
 *
 * @author gugus2000
 **/
class ContenuManager extends \core\Manager
{
	/* Constantes */

	/**
	* Table de donnée utilisé par Conversation
	*
	* @var string
	*/
	const TABLE='contenu';
	/**
	* Index utilisé (clef primaire)
	*
	* @var string
	*/
	const INDEX='id_contenu';		// Pas CLEF PRIMAIRE /!\
	/**
	* Attributs
	*
	* @var array
	*/
	const ATTRIBUTES=array(
		0 => 'id_contenu',
		1 => 'lang',
		2 => 'texte',
		3 => 'date_publication',
	);
} // END class ContenuManager extends \core\Manager

?>