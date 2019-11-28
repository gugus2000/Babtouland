<?php

require $config['bbcode_config'];

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].'css/navigation_nombre.css');

$page=$config['post_fil_post_default_page'];
if(isset($_GET['page']))
{
	$page=(int)$_GET['page'];
}

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre'].(string)$page);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));

$bbcode=CreateBBcode();

$BDDFactory=new \core\BDDFactory;
$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
$nbr_post=$PostManager->count();

$liste_navigation=[];
for ($numero_page=1; $numero_page <= $nbr_post/$Visiteur->getConfiguration('post_fil_post_nombre_posts'); $numero_page++)
{ 
	if ($numero_page==$page)
	{
		$liste_navigation[]='<span class="active"><li>'.$page.'</li></span>';
	}
	else
	{
		$liste_navigation[]='<a href="'.$config['post_fil_post_nav_page_lien'].'&page='.$numero_page.'" title="'.$lang['post_fil_post_nav_description'].$numero_page.'"><li>'.$numero_page.'</li></a>';
	}
}

$Pagination=new \user\PageElement(array(
	'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/navigation_nombre.html',
	'elements' => array(
		'liste_navigation' => $liste_navigation,
	),
));

$liste_post=[];
for ($position_post=$config['post_fil_post_position_debut']; $position_post < $Visiteur->getConfiguration('post_fil_post_nombre_posts'); $position_post++)
{
	$position_vraie=$page*$Visiteur->getConfiguration('post_fil_post_nombre_posts')-($Visiteur->getConfiguration('post_fil_post_nombre_posts')-$position_post);	// Calcul de la position du Post
	$Post=new \post\Post(array(
		'id' => $PostManager->getIdByPos($position_vraie, $config['post_fil_post_tri']),
	));
	if($PostManager->existId($Post->getId()))
	{
		$Post->recuperer();
		$PostElement=new \user\PageElement(array(
			'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/post.html',
			'elements' => array(
				'titre'               => $Post->afficherTitre(),
				'date_publication'    => $Post->afficherDate_publication(),
				'presentation_auteur' => $lang['post_fil_post_auteur_presentation'],
				'auteur_lien_href'    => $config['post_fil_post_lien_auteur'].'&id='.$Post->recupererAuteur()->afficherId(),
				'auteur_lien_title'   => $lang['post_fil_post_lien_auteur_titre'],
				'auteur'              => $Post->recupererAuteur()->afficherPseudo(),
				'contenu'             => $bbcode->parse($Post->afficherContenu()),
				'post_lien_href'      => $config['post_fil_post_lien_detail'].'&id='.$Post->afficherId(),
				'post_lien_title'     => $lang['post_fil_post_lien_detail_titre'],
				'post_lien'           => $lang['post_fil_post_detail'],
			),
		));
		$liste_post[]=$PostElement;
	}
}

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'liste_post' => $liste_post,
		'pagination' => $Pagination,
	),
));

$toast_liens=array(
	'lien'        => array($config['post_fil_post_lien_publication']),
	'description' => array($lang['post_fil_post_publication']),
	'icone'       => array('add'),
);

if(verifLiens($Visiteur, $toast_liens['lien']))
{
	$Toast=new \user\page\Toast($toast_liens, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
}
else
{
	$Toast='';
}
$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getpageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Contenu, $Toast);

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>