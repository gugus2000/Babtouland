<?php

/**
 * Retourne le nom de la classe sans son namespace
 *
 * @param string className Nom de la classe
 * 
 * @return string
 * 
 * @author  pierstoval at gmail dot com
 **/
function get_class_name($className)
{
    if ($pos = strrpos($className, '\\')) return substr($className, $pos + 1);
    return $pos;
}

/**
 * Charge la classe de façon dynamique
 * 
 * @param string className Nom de la classe
 *
 * @return void
 * 
 * @author  dave at shax dot com
 **/
function loadClass($className)
{
	$fileName = '';
	$namespace = '';

	$includePath = 'classe';

	if (false !== ($lastNsPos = strripos($className, '\\')))
	{
			$namespace = substr($className, 0, $lastNsPos);
			$className = substr($className, $lastNsPos + 1);
			$fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	}
	$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.class.php';
	$fullFileName = $includePath . DIRECTORY_SEPARATOR . $fileName;

	if (file_exists($fullFileName))
	{
		require_once $fullFileName;
	}
	else
	{
		throw new Exception('Class "'.$className.'" does not exist.');
	}
}

/**
 * Vérifie l'autorisation pour l'édition ou la suppression d'un objet
 *
 * @param mixed Objet Objet qui va être modifié
 * 
 * @param string application Application de la page
 * 
 * @param string action Action de la page
 * 
 * @return bool
 * @author gugus2000
 **/
function autorisationModification($Objet, $application, $action)
{
	global $Visiteur, $config;
	return ($Objet->recupererAuteur()->similaire($Visiteur) | $Visiteur->getRole()->existPermission(array('application' =>$config[$application.'_'.$action.'_admin_application'], 'action' => $config[$application.'_'.$action.'_admin_action'])));
}

/**
 * Vérifie si au moins un lien de la liste est ouvert d'accès au visiteur
 *
 * @param Visiteur Visiteur Visiteur à vérifier
 *
 * @param array liens Liens à vérifier
 *
 * @return bool
 * @author gugus2000
 **/
function verifLiens($Visiteur, $liens)
{
	$compteur=0;
	foreach ($liens as $index => $lien)
	{
		if ($Visiteur->getRole()->existPermission($lien))
		{
			$compteur++;
		}
	}
	return $compteur>0;
}

/**
 * Polyfill de array_key_first
 *
 * @author PHP
 **/
if (!function_exists('array_key_first')) {
    function array_key_first(array $arr) {
        foreach($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }
}

/**
 * Voir https://lehollandaisvolant.net/tuto/pagespd/
 *
 * @return void
 * @author LeHollandaisVolant
 **/
function initOutputFilter()
{
   ob_start('ob_gzhandler');
   register_shutdown_function('ob_end_flush');
}
/**
 * Initialise le routage avec la session
 *
 * @return string
 * @author gugus2000
 **/
function initRoutageSession()
{
	$Mode_routage=\core\Routeur::MODE_FULL_ROUTE;
	if (isset($_GET['force_routage']))
	{
		if (isset($_GET['routage_session']))
		{
			$Mode_routage=$_GET['force_routage'];
		}
		else
		{
			$_SESSION['force_routage']=$_GET['force_routage'];
		}
	}
	if (isset($_SESSION['force_routage']))
	{
		if ($_SESSION['force_routage']=='-1')
		{
			unset($_SESSION['force_routage']);
		}
		else
		{
			$Mode_routage=$_SESSION['force_routage'];
		}
	}
	return $Mode_routage;
}

?>