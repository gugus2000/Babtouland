<?php

$titre=$lang['user_statut_titre'];
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang['user_statut_description'],
);

if ($Visiteur->getPseudo()!=$config['nom_guest'])
{
	$statut=new \user\PageElement(array(
		'template' => $config['path_template'].$application.'/'.$action.'/statut.html',
		'elements' => array(
			'pseudo'           => $lang['user_statut_pseudo'].$Visiteur->afficherPseudo(),
			'avatar_texte'     => $lang['user_statut_avatar'],
			'avatar_src'       =>  $config['chemin_avatar'].$Visiteur->afficherAvatar(),
			'avatar_alt'       => $lang['user_view_avatar_alt'].$Visiteur->afficherPseudo(),
			'date_connexion'   => $lang['user_statut_derndateco'].$Visiteur->afficherDate_connexion(),
			'date_inscription' => $lang['user_statut_premdatein'].$Visiteur->afficherDate_connexion(),
			'mail'             => $lang['user_statut_mail'].$Visiteur->afficherMail(),
		),
	));
	$lien_connexionEdition='<a href="'.$config['user_statut_lien_edition'].'" title="'.$lang['user_statut_titre_lien_edition'].'">'.$lang['user_statut_affichage_lien_edition'].'</a><br />';
	$lien_inscriptionDeconnexion='<a href="'.$config['user_statut_lien_deconnexion'].'" title="'.$lang['user_statut_titre_lien_deconnexion'].'">'.$lang['user_statut_affichage_lien_deconnexion'].'</a>';
}
else
{
	$statut=$lang['user_statut_nologin'].'<br />';
	$lien_connexionEdition='<a href="'.$config['user_statut_lien_connexion'].'" title="'.$lang['user_statut_titre_lien_connexion'].'">'.$lang['user_statut_affichage_lien_connexion'].'</a><br />';
	$lien_inscriptionDeconnexion='<a href="'.$config['user_statut_lien_inscription'].'" title="'.$lang['user_statut_titre_lien_inscription'].'">'.$lang['user_statut_affichage_lien_inscription'].'</a>';
}

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'statut'                      => $statut,
		'lien_connexionEdition'       => $lien_connexionEdition,
		'lien_inscriptionDeconnexion' => $lien_inscriptionDeconnexion,
	),
));

require $config['pageElement_carte_req'];

require $config['pageElement_menuUp_req'];

$Corps=new \user\PageElement(array(
	'template'  => $config['pageElement_corps_template'],
	'fonctions' => $config['pageElement_corps_fonctions'],
	'elements'  => array(
		'haut'   => $MenuUp,
		'centre' => $Carte,
		'bas'    => '',
	),
));

$Tete=new \user\PageElement(array(
	'template'  => $config['pageElement_tete_template'],
	'fonctions' => $config['pageElement_tete_fonctions'],
	'elements'  => array(
		'metas'       => $config['metas'],
		'titre'       => $titre,
		'css'         => $config['css'],
		'javascripts' => $config['javascripts'],
	),
));

$config['pageElement_elements']['tete']=$Tete;
$config['pageElement_elements']['corps']=$Corps;

?>