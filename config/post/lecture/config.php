<?php

require $config['bbcode_config'];

$BDDFactory=new \core\BDDFactory;
$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
$id=$PostManager->getIdByPos(0, 'date_mise_a_jour');
if(isset($_GET['id']))
{
	$id=(int)$_GET['id'];
}

$bbcode=CreateBBcode();

$Post=new \post\Post(array(
	'id' => $id,
));
$Post->recuperer();

$titre=$lang[$application.'_'.$action.'_titre'].$Post->afficherTitre();
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang[$application.'_'.$action.'_description'],
);
$config['css'][]=$config['path_assets'].'css/commentaire.css';
$config['css'][]=$config['path_assets'].'css/post.css';


$post=new \user\PageElement(array(
	'template' => $config['path_template'].$application.'/'.$action.'/post.html',
	'elements' => array(
		'titre'               => $Post->afficherTitre(),
		'date_publication'    => $Post->afficherDate_publication(),
		'presentation_auteur' => $lang['post_lecture_auteur_presentation'],
		'lien_auteur_href'    => $config['post_lecture_lien_auteur'].'&id='.$Post->recupererAuteur()->afficherId(),
		'lien_auteur_title'   => $lang['post_lecture_lien_auteur_titre'],
		'auteur'              => $Post->recupererAuteur()->afficherPseudo(),
		'contenu'             => $bbcode->parse($Post->afficherContenu()),
	),
));

$commentaires=[];
$Commentaires=$Post->recupererCommentaires();
foreach ($Commentaires as $index => $Commentaire)
{
	$autorisation='';
	if(autorisationModification($Commentaire, 'post', 'commentaire_suppression'))
	{
		$autorisation=new \user\PageElement(array(
			'template' => $config['path_template'].$application.'/'.$action.'/autorisation_commentaire.html',
			'elements' => array(
				'suppression_href'  => $config['post_lecture_lien_commentaire_suppression'].'&id='.$Commentaire->afficherId(),
				'suppression_title' => $lang['post_lecture_lien_commentaire_suppression_titre'],
				'edition_href'      => $config['post_lecture_lien_commentaire_edition'].'>&id='.$Commentaire->afficherId(),
				'edition_title'     => $lang['post_lecture_lien_commentaire_edition_titre'],
			),
		));
	}
	$Auteur=$Commentaire->recupererAuteur();
	$commentaires[]=new \user\PageElement(array(
		'template' => $config['path_template'].$application.'/'.$action.'/commentaire.html',
		'elements' => array(
			'autorisation'           => $autorisation,
			'date_publication'       => $Commentaire->afficherDate_publication(),
			'commentaire_lien_href'  => $config['post_lecture_lien_auteur'].'&id='.$Auteur->afficherId(),
			'commentaire_lien_title' => $lang['post_lecture_commentaire_lien_avatar_titre'].$Auteur->afficherPseudo(),
			'commentaire_avatar_src' => $config['chemin_avatar'].$Auteur->afficherAvatar(),
			'commentaire_avatar_alt' => $lang['post_lecture_commentaire_avatar_description'].$Auteur->afficherPseudo(),
			'contenu'                => $bbcode->parse($Commentaire->afficherContenu()),
		),
	));
}

$Contenu='';

require $config['pageElement_formulaire_req'];

$formulaire='';
$array=recuperationApplicationActionLien($config['post_lecture_publication_commentaire']);
if($Visiteur->getRole()->existPermission($array['application'], $array['action']))		// L'utilisateur a la permission de publier un commentaire
{
	$formulaire=new \user\PageElement(array(
		'template' => $config['path_template'].'post/lecture/formulaire.html',
		'elements' => array(
			'action'        => $config['post_lecture_publication_commentaire'].'&id='.$Post->afficherId(),
			'legend'        => $lang['post_lecture_legend'],
			'label_contenu' => $lang['post_lecture_commentaire_contenu'],
			'submit'        => $lang['post_lecture_commentaire_submit'],
		),
	));
}

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'post'         => $post,
		'commentaires' => $commentaires,
		'formulaire'   => $formulaire,
	),
));

$toast_liens=array(
	'lien'        => array($config['post_lecture_lien_mise_a_jour'].'&id='.$id, $config['post_lecture_lien_suppression'].'&id='.$id),
	'description' => array($lang['post_lecture_lien_mise_a_jour'], $lang['post_lecture_lien_suppression']),
	'icone'       => array('edit', 'delete'),
);

require $config['pageElement_toast_req'];

require $config['pageElement_menuUp_req'];

$Corps=new \user\PageElement(array(
	'template'  => $config['pageElement_corps_template'],
	'fonctions' => $config['pageElement_corps_fonctions'],
	'elements'  => array(
		'haut'   => $MenuUp,
		'centre' => $Contenu,
		'bas'    => $Toast,
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