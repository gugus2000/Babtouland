<?php

namespace forum;

/**
 * Manager de \forum\Message
 *
 * @author gugus2000
 **/
class MessageManager extends \core\Manager
{

	/* Constante */

	/**
	* Table de donnée utilisé par Noeud
	*
	* @var string
	*/
	const TABLE='message_forum';
	/**
	* Attributs
	*
	* @var array
	*/
	const ATTRIBUTES=array(
		0 => 'id',
		1 => 'id_fil',
		2 => 'id_auteur',
		3 => 'contenu',
		4 => 'date_publication',
		5 => 'date_maj',
	);

} // END class MessageManager extends \core\Manager

?>