<?php

namespace chat;

/**
* Manager de Message
*/
class MessageManager extends \core\Manager
{
	/* Constantes */

	/**
	* Table de donnée utilisé par Conversation
	*
	* @var string
	*/
	const TABLE='message';
	/**
	* Attributs
	*
	* @var array
	*/
	const ATTRIBUTES=array(
		0 => 'id',
		1 => 'id_conversation',
		2 => 'id_auteur',
		3 => 'contenu',
		4 => 'date_publication',
		5 => 'date_mise_a_jour',
	);
}

?>