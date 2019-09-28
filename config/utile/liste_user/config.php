<?php

$config['css'][]=$config['path_assets'].'css/liste.css';

$titre=$lang[$application.'_'.$action.'_titre'];
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang[$application.'_'.$action.'_description'],
);

$BDDFactory=new \core\BDDFactory;
$UtilisateurManager=new \user\UtilisateurManager($BDDFactory->MysqlConnexion());
$attributs=array('pseudo' => 'guest');
$operations=array('pseudo' => '!=');
$resultats=$UtilisateurManager->getBy($attributs, $operations);
$lignes=[];
foreach ($resultats as $index => $resultat)
{
	$Utilisateur=new \user\Utilisateur(array(
		'id' => $resultat['id'],
	));
	$Utilisateur->recuperer();
	$classe='';
	if ($index%2==1)
	{
		$classe=' class="impair"';
	}
	$lignes[]=new \user\PageElement(array(
		'template' => $config['path_template'].$application.'/'.$action.'/ligne.html',
		'elements' => array(
			'classe'                 => $classe,
			'pseudo'                 => $Utilisateur->afficherPseudo(),
			'avatar_src'             => $config['chemin_avatar'].$Utilisateur->afficherAvatar(),
			'avatar_alt'             => $lang['utile_liste_user_table_td_avatar_alt'].$Utilisateur->afficherPseudo(),
			'date_derniere_connexion' => $Utilisateur->afficherDate_connexion(),
			'date_inscription'       => $Utilisateur->afficherDate_inscription(),
			'role'                   => $Utilisateur->afficherRole(),
		),
	));
}

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'caption'                      => $lang['utile_liste_user_table_caption'],
		'user_nom'                     => $lang['utile_liste_user_table_th_nom'],
		'user_avatar'                  => $lang['utile_liste_user_table_th_avatar'],
		'user_date_derniere_connexion' => $lang['utile_liste_user_table_th_date_derniere_connexion'],
		'user_date_inscription'        => $lang['utile_liste_user_table_th_date_inscription'],
		'user_role'                    => $lang['utile_liste_user_table_th_role'],
		'contenu'                      => $lignes,
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