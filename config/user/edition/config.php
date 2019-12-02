<?php

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));

$admin=False;
$partie_admin='';
$Utilisateur=$Visiteur;
if(isset($_GET['id']) & $Visiteur->getRole()->existPermission(array('application' => $config['user_edition_admin_application'], 'action' => $config['user_edition_admin_action'])))
{
	$admin=True;
	$Utilisateur=new \user\Utilisateur(array(
		'id' => $_GET['id'],
	));
	$Utilisateur->recuperer();
	$config['user_edition_action']=array_merge($config['user_edition_action'], array('id' => $_GET['id']));
	$checked='';
	if($Utilisateur->getBanni())
	{
		$checked=' checked=""';
	}
	$partie_admin=new \user\PageElement(array(
		'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/partie_admin.html',
		'elements' => array(
			'label_banni' => $lang['user_edition_label_banni'],
			'checked'     => $checked,
		),
	));
}

$Contenu=new \user\PageElement(array(
	'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/form.html',
	'elements' => array(
		'action'       => $Routeur->creerLien($config['user_edition_action']),
		'legend'       => $lang['user_edition_legend'].$Utilisateur->afficherPseudo(),
		'label_avatar' => $lang['user_edition_label_avatar'],
		'avatar'       => $Utilisateur->afficherAvatar(),
		'label_mail'   => $lang['user_edition_label_mail'],
		'mail'         => $Utilisateur->afficherMail(),
		'partie_admin' => $partie_admin,
		'submit'       => $lang['user_edition_submit'],
	),
));

$Formulaire=new \user\page\Formulaire($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'formulaire' => $Formulaire,
	),
));

$Carte=new \user\page\Carte($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getpageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Carte, '');

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>