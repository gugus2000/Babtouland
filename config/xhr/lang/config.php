<?php

if(isset($Visiteur->getPage()->getParametres()['clef']))
{
	if (isset($lang[$Visiteur->getPage()->getParametres()['clef']]))
	{
		$Contenu=$lang[$Visiteur->getPage()->getParametres()['clef']];
	}
	else
	{
		$Contenu=$lang['xhr_lang_message_probleme_key'];
	}
	$Contenu=new \user\PageElement(array(
		'elements'  => array(
			'contenu'   => $Contenu,
		),
	));
}
else
{
	/**
	 * Permet l'affichage de l'array lang
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

	$Contenu=new \user\PageElement(array(
		'template'  => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/'.$config['filename_contenu_template'],
		'elements'  => array(
			'lang'   => langAfficher($lang),
		),
	));
}

$Visiteur->getPage()->creerPage($Contenu);

?>