<?php

/**
 * Permet l'affichage de l'array lang dans xhr/lang
 *
 * @return string
 * @author gugus2000
 **/
function langAfficher($lang, $i=0)
{
	$affichage='';
	foreach ($lang as $key => $value)
	{
		$affichage.=str_repeat('----',$i);
		if (is_array($value))
		{
			$affichage.=(string)$key.'=><br />'.langAfficher($value,$i+1);
		}
		else
		{
			$affichage.=(string)$key.'=>'.(string)$value.'<br />';
		}
	}
	return $affichage;
}

?>