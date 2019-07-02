<?php

require 'func/core/utils.func.php';
spl_autoload_register('loadClass');

$Visiteur=new \user\Visiteur(array(
	'pseudo' => 'test',
));
$Visiteur->recuperer();
$Visiteur->connexion('secret');

if (isset($_SESSION['id']))
{
	echo $_SESSION['id'];
}

/*$permissionManager=new user\PermissionManager($BDDFactory->MysqlConnexion());

$permissionManager->add(array(
	'nom_role' => 'membre',
	'application' => 'user',
	'action' => 'statut',
));*/

print_r($Visiteur->estConnecte('PT5M'));

?>