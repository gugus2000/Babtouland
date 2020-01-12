<?php

require $config['bbcode_config'];
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].'css/navigation_nombre.css');
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].$config['bbcode_css']);
if(isset($Visiteur->getPage()->getParametres()['page']))
{
	$page=(int)$Visiteur->getPage()->getParametres()['page'];
}
else
{
	$page=$config['post_fil_post_default_page'];
	$Visiteur->getPage()->ajouterParametre('page', $page);
}
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre'].(string)$page);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));
$bbcode=CreateBBcode();
$PostManager=new \post\PostManager(\core\BDDFactory::MysqlConnexion());
$nbr_post=$PostManager->count();
$liste_navigation=[];
for ($numero_page=1; $numero_page <= ceil($nbr_post/$Visiteur->getConfiguration('post_fil_post_nombre_posts')); $numero_page++)
{ 
	if ($numero_page==$page)
	{
		$liste_navigation[]='<span class="active"><li>'.$page.'</li></span>';
	}
	else
	{
		$liste_navigation[]='<a href="'.$Routeur->creerLien(array_merge($config['post_fil_post_nav_page_lien'], array($config['nom_parametres'] => array('page' => $numero_page)))).'" title="'.$lang['post_fil_post_nav_description'].$numero_page.'"><li>'.$numero_page.'</li></a>';
	}
}
$Pagination=new \user\PageElement(array(
	'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/navigation_nombre.html',
	'elements' => array(
		'liste_navigation' => $liste_navigation,
	),
));
$liste_post=[];
foreach ($PostManager->getBy(array(), array(), array('fin' => ($page-1)*$Visiteur->getConfiguration('post_fil_post_nombre_posts'), 'nombre' => $Visiteur->getConfiguration('post_fil_post_nombre_posts'), 'ordre' => $config['post_fil_post_tri'])) as $post)
{
	$Post=new \post\Post($post);
	if($PostManager->existId($Post->getId()))
	{
		$PostElement=new \user\PageElement(array(
			'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/post.html',
			'elements' => array(
				'titre'               => $Post->afficherTitre(),
				'date_publication'    => $Post->afficherDate_publication(),
				'presentation_auteur' => $lang['post_fil_post_auteur_presentation'],
				'auteur_lien_href'    => $Routeur->creerLien(array_merge($config['post_fil_post_lien_auteur'], array($config['nom_parametres'] => array('id' => $Post->recupererAuteur()->afficherId())))),
				'auteur_lien_title'   => $lang['post_fil_post_lien_auteur_titre'],
				'auteur'              => $Post->recupererAuteur()->afficherPseudo(),
				'contenu'             => $bbcode->parse($Post->afficherContenu()),
				'post_lien_href'      => $Routeur->creerLien(array_merge($config['post_fil_post_lien_detail'], array($config['nom_parametres'] => array('id' => $Post->afficherId())))),
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