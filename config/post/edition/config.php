<?php

if(!isset($_GET['id']))
{
	$_SESSION['message']=$lang['post_edition_message_erreur_id'];
	header('location: index.php'.$config['post_edition_lien_erreur_id']);
	exit();
}
$BDDFactory=new \core\BDDFactory;
$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
if(!$PostManager->existId((int)$_GET['id']))
{
	$_SESSION['message']=$lang['post_edition_message_erreur_existe'];
	header('location: index.php'.$config['post_edition_lien_erreur_existe']);
	exit();
}
$id=$_GET['id'];

$Post=new \post\Post(array(
	'id' => $id,
));
$Post->recuperer();

if(!autorisationModification($Post, $application, $action))
{
	$_SESSION['message']=$lang['post_edition_message_erreur_autorisation'];
	header('location: index.php'.$config['post_edition_lien_erreur_autorisation'].'&id='.$id);
	exit();
}

$titre=$lang[$application.'_'.$action.'_titre'];
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang[$application.'_'.$action.'_description'],
);


ob_start();?>
<form action="<?= $config['post_edition_formulaire_action'] ?>&id=<?= $Post->afficherId() ?>" method="POST" accept-charset="utf-8">
	<fieldset>
		<legend><?= $lang['post_edition_formulaire_legend'] ?></legend>
		<label for="edition_titre"><?= $lang['post_edition_formulaire_titre'] ?></label>
		<input type="text" name="edition_titre" value="<?= $Post->afficherTitre() ?>"><br />
		<label for="edition_contenu"><?= $lang['post_edition_formulaire_contenu'] ?></label>
		<textarea name="edition_contenu"><?= $Post->afficherContenu() ?></textarea><br />
		<input type="submit" value="<?= $lang['post_edition_formulaire_submit'] ?>">
	</fieldset>
</form>
<?php
$Contenu=ob_get_clean();

require $config['pageElement_formulaire_req'];

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'formulaire' => $Formulaire,
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

$config['pageElement_elements']=array(
	'tete'  => $Tete,
	'corps' => $Corps,
);

?>