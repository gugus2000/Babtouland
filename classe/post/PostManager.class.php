<?php

namespace post;

/**
* Manager de Post
*/
class PostManager extends \core\Manager
{
	/* Constantes */

	/**
	* Table de donnée utilisé par Post
	*
	* @var string
	*/
	const TABLE='post';
	/**
	* Attributs
	*
	* @var array
	*/
	const ATTRIBUTES=array(
		0 => 'id',
		1 => 'id_auteur',
		2 => 'titre',
		3 => 'contenu',
		4 => 'date_publication',
		5 => 'date_mise_a_jour',
	);
}

?>