<?php

namespace core\Exception;

/**
 * Exception qui ne fait pas terminer le script
 *
 * @author gugus2000
 */
class Warning extends \Exception
{
	/* Méthode spéciale */

	/**
	* Constructeur de Warning
	*
	* @param string contenu Description de l'erreur affiché
	* 
	* @return void
	*/
	public function __construct($contenu)
	{
		global $Visiteur;
		parent::__construct($contenu);
		if (isset($Visiteur))
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ATTENTION,
				'contenu' => $contenu,
			));
			\user\Page::ajouterNotificationSession($Notification);
		}
		else
		{
			throw new \Exception('Warning: '.$contenu);
		}
	}
}

?>