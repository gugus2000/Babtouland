<?php

require $config['bbcode_config'];
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].$config['bbcode_css']);
$BDDFactory=new \core\BDDFactory;
$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
$id=$PostManager->getIdByPos(0, 'date_mise_a_jour');
if(isset($Visiteur->getPage()->getParametres()['id']))
{
	$id=(int)$Visiteur->getPage()->getParametres()['id'];
}
$bbcode=CreateBBcode();
$Post=new \post\Post(array(
	'id' => $id,
));
$Post->recuperer();
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre'].$Post->afficherTitre());
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name' => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].'css/commentaire.css');
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].'css/post.css');


$post=new \user\PageElement(array(
	'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/post.html',
	'elements' => array(
		'titre'               => $Post->afficherTitre(),
		'date_publication'    => $Post->afficherDate_publication(),
		'presentation_auteur' => $lang['post_lecture_auteur_presentation'],
		'lien_auteur_href'    => $Routeur->creerLien(array_merge($config['post_lecture_lien_auteur'], array($config['nom_parametres'] => array('id' => $Post->recupererAuteur()->afficherId())))),
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
			'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/autorisation_commentaire.html',
			'elements' => array(
				'suppression_href'  => $Routeur->creerLien(array_merge($config['post_lecture_lien_commentaire_suppression'], array($config['nom_parametres'] => array('id' => $Commentaire->afficherId())))),
				'suppression_title' => $lang['post_lecture_lien_commentaire_suppression_titre'],
				'edition_href'      => $Routeur->creerLien(array_merge($config['post_lecture_lien_commentaire_edition'], array($config['nom_parametres'] => array('id' => $Commentaire->afficherId())))),
				'edition_title'     => $lang['post_lecture_lien_commentaire_edition_titre'],
			),
		));
	}
	$Auteur=$Commentaire->recupererAuteur();
	$commentaires[]=new \user\PageElement(array(
		'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/commentaire.html',
		'elements' => array(
			'autorisation'           => $autorisation,
			'date_publication'       => $Commentaire->afficherDate_publication(),
			'commentaire_lien_href'  => $Routeur->creerLien(array_merge($config['post_lecture_lien_auteur'], array($config['nom_parametres'] => array('id' => $Auteur->afficherId())))),
			'commentaire_lien_title' => $lang['post_lecture_commentaire_lien_avatar_titre'].$Auteur->afficherPseudo(),
			'commentaire_avatar_src' => $config['chemin_avatar'].$Auteur->afficherAvatar(),
			'commentaire_avatar_alt' => $lang['post_lecture_commentaire_avatar_description'].$Auteur->afficherPseudo(),
			'contenu'                => $bbcode->parse($Commentaire->afficherContenu()),
		),
	));
}
$formulaire='';
if($Visiteur->getRole()->existPermission($config['post_lecture_publication_commentaire']))		// L'utilisateur a la permission de publier un commentaire
{
	$formulaire=new \user\PageElement(array(
		'template' => $config['path_template'].'post/lecture/formulaire.html',
		'elements' => array(
			'action'        => $Routeur->creerLien(array_merge($config['post_lecture_publication_commentaire'], array($config['nom_parametres'] => array('id' => $Post->afficherId())))),
			'legend'        => $lang['post_lecture_legend'],
			'label_contenu' => $lang['post_lecture_commentaire_contenu'],
			'submit'        => $lang['post_lecture_commentaire_submit'],
		),
	));
}

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'post'         => $post,
		'commentaires' => $commentaires,
		'formulaire'   => $formulaire,
	),
));

$toast_liens=array(
	'lien'        => array(array_merge($config['post_lecture_lien_mise_a_jour'], array('parametres' => array('id' => $id))), array_merge($config['post_lecture_lien_suppression'], array($config['nom_parametres'] => array('id' => $id)))),
	'description' => array($lang['post_lecture_lien_mise_a_jour'], $lang['post_lecture_lien_suppression']),
	'icone'       => array('edit', 'delete'),
);

if(verifLiens($Visiteur, $toast_liens['lien']))
{
	$Toast=new \user\page\Toast($toast_liens, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
}
else
{
	$Toast='';
}
$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Contenu, $Toast);

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>