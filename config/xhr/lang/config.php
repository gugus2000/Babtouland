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
}
else
{
	$Contenu=new \user\PageElement(array(
		'template'  => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/'.$config['filename_contenu_template'],
		'fonctions' => $config['path_func'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/'.$config['filename_contenu_fonctions'],
		'elements'  => array(
			'lang'   => $lang,
		),
	));
}

$Corps=new \user\page\Corps('',$Contenu,'');
$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Contenu);
$this->getPage()->envoyerNotificationsSession();

?>