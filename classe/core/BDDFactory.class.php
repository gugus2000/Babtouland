<?php

namespace core;

/**
* Permet la création de connexion à la base de donnée
*/
class BDDFactory
{
	/* Autres méthodes */

	/**
	* Création d'une connexion à la base de donnée
	*
	* @param string dbname Nom de la base de donnée à laquelle il faut se connecter
	*
	* @return PDO
	*/
	public static function MysqlConnexion($dbname='babtouland')
	{
		$bdd = new \PDO('mysql:host=localhost;dbname='.$dbname.';charset=utf8', 'root', '', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
		return $bdd;
	}
}

?>