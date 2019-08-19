<?php

namespace chat;

/**
* Liaison entre les tables conversation et utilisateur
*/
class LiaisonConversationUtilisateur extends \core\LiaisonManager
{
	/* Constantes */

	/**
	* Table de donnée utilisé par la liaison
	*
	* @var string
	*/
	const TABLE='liaisonconversationutilisateur';
	/**
	* Attributs
	*
	* @var array
	*/
	const ATTRIBUTES=array(
		0 => 'id_conversation',
		1 => 'id_utilisateur',
	);
}

?>