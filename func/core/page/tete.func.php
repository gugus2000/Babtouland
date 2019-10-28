<?php

/**
 * Transforme l'array metas en string pour la template
 *
 * @param  array metas Balises metas à insérer
 * 
 * @return string
 * @author gugus2000
 **/
function metasAfficher($metas)
{
	$affichage='';
	if($metas)
	{
		foreach ($metas as $value)
		{
			$affichage.=metaAfficher($value);
		}
	}
	return $affichage;
}
/**
 * Transforme un élément de l'array en string pour la template
 *
 * @param  array meta Élément de l'array metas à afficher
 *
 * @return string
 * @author gugus2000
 **/
function metaAfficher($meta)
{
	$affichage='<meta';
	foreach ($meta as $key => $value)
	{
		$affichage.=' '.$key.'="'.$value.'"';
	}
	$affichage.='>';
	return $affichage;
}
/**
 * Transforme l'array css en string pour la template
 *
 * @param array css Css à insérer
 *
 * @return string
 * @author gugus2000
 **/
function cssAfficher($css)
{
	$affichage='';
	if ($css)
	{
		foreach ($css as $value)
		{
			$affichage.='<link rel="stylesheet" type="text/css" href="'.$value.'">';
		}
	}
	return $affichage;
}
/**
 * Transforme l'array javascripts en string pour la template
 *
 * @param array javascripts Javascripts à insérer
 *
 * @return string
 * @author gugus2000
 **/
function javascriptsAfficher($javascripts)
{
	$affichage='';
	if ($javascripts)
	{
		foreach ($javascripts as $value)
		{
			$affichage.='<script src="'.$value.'" type="text/javascript" charset="utf-8"></script>';
		}
	}
	return $affichage;
}

?>