<?php

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));

$id=$Visiteur->getId();
if(isset($Visiteur->getPage()->getParametres()['id']))
{
	$id=$Visiteur->getPage()->getParametres()['id'];
}
$Utilisateur=new \user\Utilisateur(array(
	'id' => $id,
));
$Utilisateur->recuperer();

if ($Utilisateur->similaire($this))
{
	$Action=new \user\PageElement(array(
		'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/action.html',
		'elements' => array(
			'href'  => $Routeur->creerLien($config['user_view_action_statut_editer_lien']),
			'title' => $lang['user_view_action_statut_editer_title'],
			'text'  => $lang['user_view_action_statut_editer'],
		),
	));
}
else
{
	if ($this->getPseudo()==$config['nom_guest'])
	{
		$text='';
	}
	else
	{
		$text=$lang['user_view_action_envoyer_mp'];
	}
	$Action=new \user\PageElement(array(
		'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/action.html',
		'elements' => array(
			'href'  => $Routeur->creerLien(array_merge($config['user_view_action_envoyer_mp_lien'], array($config['nom_parametres'] => array('id' => $Utilisateur->afficherId())))),
			'title' => $lang['user_view_action_envoyer_mp_title'],
			'text'  => $text,
		),
	));
}

$contenu=new \user\PageElement(array(
	'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/contenu.html',
	'elements' => array(
		'pseudo'           => $lang['user_view_pseudo'].$Utilisateur->afficherPseudo(),
		'avatar_texte'     => $lang['user_view_avatar'],
		'avatar_src'       => $config['chemin_avatar'].$Utilisateur->afficherAvatar(),
		'avatar_alt'       => $lang['user_view_avatar_alt'].$Utilisateur->afficherPseudo(),
		'date_connexion'   => $lang['user_view_derndateco'].$Utilisateur->afficherDate_connexion(),
		'date_inscription' => $lang['user_view_premdatein'].$Utilisateur->afficherDate_inscription(),
		'action'           => $Action,
	),
));

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_template'],
	'elements'  => array(
		'contenu' => $contenu,
	),
));

$Carte=new \user\page\Carte($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Carte, '');

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>