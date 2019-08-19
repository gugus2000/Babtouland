<?php

namespace chat;

/**
* Manager de Conversation
*/
class ConversationManager extends \core\Manager
{
	/* Constantes */

	/**
	* Table de donnée utilisé par Conversation
	*
	* @var string
	*/
	const TABLE='conversation';
	/**
	* Attributs
	*
	* @var array
	*/
	const ATTRIBUTES=array(
		0 => 'id',
		1 => 'nom',
		2 => 'description',
	);
}

?>