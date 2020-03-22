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
 * Polyfill de array_key_first
 *
 * @author PHP (PHP.net)
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
			if ((bool)$_GET['routage_session'])
			{
				$_SESSION['force_routage']=(bool)$_GET['force_routage'];
			}
		}
		$Mode_routage=$_GET['force_routage'];
	}
	if (isset($_SESSION['force_routage']))
	{
		if ($_SESSION['force_routage']==False)
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
/**
 * Récupère le tableau des clefs d'un tableau multi-dimensionnel
 *
 * @return array
 * @author Meliborn at https://stackoverflow.com/questions/11234852/how-to-get-all-the-key-in-multi-dimensional-array-in-php (edited by gugus2000)
 **/
function array_keys_multi($array)
{
    $keys = array();

    foreach ($array as $key => $value) {

        if (!is_array($value))		// I don't want key of array to be given
        {
	        $keys[] = $key;
        }
        else
        {
            $keys = array_merge($keys, array_keys_multi($value));
        }
    }

    return $keys;
}
/**
 * flatten an arbitrarily deep multidimensional array
 * into a list of its scalar values
 * (may be inefficient for large structures)
 *  (will infinite recurse on self-referential structures)
 *  (could be extended to handle objects)
 *
 * @return array
 * @author Anonymous at https://www.php.net/manual/fr/function.array-values.php
*/
function array_values_recursive($ary)
{
   $lst = array();
   foreach( array_keys($ary) as $k ){
      $v = $ary[$k];
      if (is_scalar($v)) {
         $lst[] = $v;
      } elseif (is_array($v)) {
         $lst = array_merge( $lst,
            array_values_recursive($v)
         );
      }
   }
   return $lst;
}

?>