<?php

namespace forum;

/**
 * Fil du forum
 *
 * @author gugus2000
 **/
class Fil extends \forum\Noeud
{
	/* Constante */

	/**
	* Type du nœud
	*
	* @var int
	*/
	const TYPE=1;

	/* Autre méthode */

	/**
	* Récupère les messages dans le fil
	*
	* @param int intervalle_depart Nombre de messages ignorés avant
	*
	* @param int nombre Nombre de messages à afficher
	* 
	* @return array
	*/
	public function recupererMessages($intervalle_depart=0, $nombre=1)
	{
		$array=array();
		$MessageManager=new \forum\MessageManager(\core\BDDFactory::MysqlConnexion());
		foreach ($MessageManager->getBy(array('id_fil' => $this->getId()), array('id_fil' => '='), array('debut' => $intervalle_depart, 'nombre' => $nombre, 'ordre' => 'date_publication')) as $message)
		{
			$Message=new \forum\Message($message);
			$array[]=$Message;
		}
		return $array;
	}
	/**
	* Récupère le dernier message posté
	* 
	* @return \forum\Message
	*/
	public function recentMessage()
	{
		$MessageManager=new \forum\MessageManager(\core\BDDFactory::MysqlConnexion());
		return new \forum\Message($MessageManager->getBy(array('id_fil' => $this->getId()), array('id_fil' => '='), array('fin' => 0, 'ordre' => 'date_publication'))[0]);
	}

} // END class Fil extends \forum\Noeud

?>