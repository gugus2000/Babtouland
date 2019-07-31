<?php

namespace post;

/**
* Manager de Commentaire
*/
class CommentaireManager extends \core\Manager;
{
	/* Constantes */

	/**
	* Table de donnée utilisé par Commentaire
	*
	* @var string
	*/
	const TABLE='commentaire';
	/**
	* Attributs
	*
	* @var array
	*/
	const ATTRIBUTES=array(
		0 => 'id',
		1 => 'id_auteur',
		2 => 'id_post',
		3 => 'contenu',
		4 => 'date_publication',
		5 => 'date_mise_a_jour',
	);
}

?>