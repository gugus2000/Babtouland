<?php

namespace forum;

/**
 * Dossier du forum
 *
 * @author gugus2000
 **/
class Dossier extends \forum\Noeud
{
	/* Constante */

	/**
	* Type du nœud
	*
	* @var int
	*/
	const TYPE=0;

	/* Autre méthode */

	/**
	* Récupère les nœuds dans le dossier
	*
	* @param int intervalle_depart Nombre de nœuds ignorés avant
	*
	* @param int nombre Nombre de nœuds à afficher
	* 
	* @return array
	*/
	public function recupererEnfants($intervalle_depart=0, $nombre=null)
	{
		$array=array();
		$Manager=$this->Manager();
		if ($nombre===null)
		{
			$nombre=$Manager->countBy(array('id_parent' => $this->getId()), array('id_parent' => '='));
		}
		foreach ($Manager->getBy(array('id_parent' => $this->getId()), array('id_parent' => '='), array('debut' => $intervalle_depart, 'nombre' => $nombre, 'ordre' => 'date_publication')) as $noeud)
		{
			switch ($noeud['type'])
			{
				case $this::TYPE_DOSSIER:
					$array[]=new \forum\Dossier($noeud);
					break;
				case $this::TYPE_FIL:
					$array[]=new \forum\Fil($noeud);
					break;
				default:
					throw new \UnexpectedValueException((string)$noeud['type'].' not exist');
			}
		}
		return $array;
	}
	/**
	* Retourne le dernier Message posté
	* 
	* @return \forum\Message
	*/
	public function recentMessage()
	{
		$dernierMessage=null;
		foreach ($this->recupererEnfants(0) as $Enfant)
		{
			$Message=$Enfant->recentMessage();
			if ($dernierMessage===null)
			{
				$dernierMessage=$Message;
				$dernierDateMessage=new \DateTime($dernierMessage->getDate_maj());
			}
			else
			{
				$dateMessage=new \DateTime($Message->getDate_maj());
				if ($dernierDateMessage<$dateMessage)
				{
					$dernierMessage=$Message;
					$dernierDateMessage=$dateMessage;
				}
			}
		}
		return $dernierMessage;
	}

} // END class Dossier extends \forum\Noeud

?>