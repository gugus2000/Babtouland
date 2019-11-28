<?php

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].'css/liste.css');

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));

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
		'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/ligne.html',
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
	'template'  => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_fonctions'],
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

$Carte=new \user\page\Carte($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getpageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Carte, '');

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>