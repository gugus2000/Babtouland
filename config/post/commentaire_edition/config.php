<?php

if(!isset($_GET['id']))
{
	$_SESSION['message']=$lang['post_commentaire_edition_message_erreur_id'];
	header('location: index.php'.$config['post_commentaire_edition_lien_erreur_id']);
	exit();
}
$BDDFactory=new \core\BDDFactory;
$CommentaireManager=new \post\CommentaireManager($BDDFactory->MysqlConnexion());
if(!$CommentaireManager->existId((int)$_GET['id']))
{
	$_SESSION['message']=$lang['post_commentaire_edition_message_erreur_existe'];
	header('location: index.php'.$config['post_commentaire_edition_lien_erreur_existe']);
	exit();
}
$id=$_GET['id'];

$Commentaire=new \post\Commentaire(array(
	'id' => $id,
));
$Commentaire->recuperer();

if(!autorisationModification($Commentaire, $application, $action))
{
	$_SESSION['message']=$lang['post_commentaire_edition_message_erreur_autorisation'];
	header('location: index.php'.$config['post_commentaire_edition_lien_erreur_autorisation'].'&id='.$id);
	exit();
}

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));

$Contenu=new \user\PageElement(array(
	'template' => $config['path_template'].$application.'/'.$action.'/form.html',
	'elements' => array(
		'action'        => $config['post_commentaire_edition_formulaire_action'].'&id='.$Commentaire->afficherId(),
		'legend'        => $lang['post_commentaire_edition_formulaire_legend'],
		'label_contenu' => $lang['post_commentaire_edition_formulaire_contenu'],
		'contenu'       => $Commentaire->afficherContenu(),
		'submit'        => $lang['post_commentaire_edition_formulaire_submit'],
	),
));

$Formulaire=new \user\page\Formulaire($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
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