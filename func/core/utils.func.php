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
 * Retourne l'action et l'application du lien
 *
 * @param string lien Lien à déchiffrer
 * 
 * @return array
 * @author gugus2000
 **/
function recuperationApplicationActionLien($lien)
{
	preg_match('#application=(\S+)&action=(\S+)&?#', $lien, $matches);
	$array['application']=$matches[1];
	$array['action']=$matches[2];
	return $array;
}

?>