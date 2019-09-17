<?php

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

ob_start();?>
<h1><?= $Post->afficherTitre() ?></h1>
<i class="date_publication"><?= $Post->afficherDate_publication() ?></i>
<br />
<i class="auteur"><?= $lang['post_lecture_auteur_presentation'] ?><a href="<?= $config['post_lecture_lien_auteur'] ?>&id=<?= $Post->recupererAuteur()->afficherId() ?>" title="<?= $lang['post_lecture_lien_auteur_titre'] ?>"><?= $Post->recupererAuteur()->afficherPseudo() ?></a></i>
<br />
<br />
<br />
<div class="contenu"><?= $bbcode->parse($Post->afficherContenu()) ?></div>
<br />
<?php
$contenu=ob_get_clean();

ob_start();?>
<?php

$Commentaires=$Post->recupererCommentaires();
foreach ($Commentaires as $index => $Commentaire)
{
	$Auteur=$Commentaire->recupererAuteur();
	?>
	<section class="espace_colonne">
		
	</section>
	<section class="carte">
		<?php
		if(autorisationModification($Commentaire, 'post', 'commentaire_suppression'))
		{
			?>
			<a class='suppression' href="<?= $config['post_lecture_lien_commentaire_suppression'] ?>&id=<?= $Commentaire->afficherId() ?>" title="<?= $lang['post_lecture_lien_commentaire_suppression_titre'] ?>"><i class="material-icons petit-ecran-menu">close</i></a>
			<a class="edition" href="<?= $config['post_lecture_lien_commentaire_edition'] ?>&id=<?= $Commentaire->afficherId() ?>" title="<?= $lang['post_lecture_lien_commentaire_edition_titre'] ?>"><i class="material-icons petit-ecran-menu">edit</i></a>
			<?php
		}
		?>
		<section class="contenu commentaire">
			<section class="ligne">
				<div class="colonne cote_gauche">
					<i class="date_publication"><?= $Commentaire->afficherDate_publication() ?></i>
					<a href="<?= $config['post_lecture_lien_auteur'] ?>&id=<?= $Auteur->afficherId() ?>" title="<?= $lang['post_lecture_commentaire_lien_avatar_titre'] ?><?= $Auteur->afficherPseudo() ?>"><img src="<?= $config['chemin_avatar'] ?><?= $Auteur->afficherAvatar() ?>" alt="<?= $lang['post_lecture_commentaire_avatar_description'] ?><?= $Auteur->afficherPseudo() ?>"></a>	
				</div>
				<div class="colonne cote_droit">
					<div class="contenu"><?= $bbcode->parse($Commentaire->afficherContenu()) ?></div>
				</div>
			</section>
		</section>
	</section>
	<?php
}

?>
<?php
$commentaires=ob_get_clean();

$formulaire='';
$array=recuperationApplicationActionLien($config['post_lecture_publication_commentaire']);
if($Visiteur->getRole()->existPermission($array['application'], $array['action']))		// L'utilisateur a la permission de publier un commentaire
{
	?>
	<form action="<?= $config['post_lecture_publication_commentaire'] ?>&id=<?= $Post->afficherId() ?>" method="POST" accept-charset="utf-8">
		<fieldset>
			<legend><?= $lang['post_lecture_legend'] ?></legend>
			<label for="commentaire_contenu"><?= $lang['post_lecture_commentaire_contenu'] ?></label>
			<textarea name="commentaire_contenu"></textarea><br />
			<input type="submit" value="<?= $lang['post_lecture_commentaire_submit'] ?>">
		</fieldset>
	</form>
	<?php
	$Contenu=ob_get_clean();

	require $config['pageElement_formulaire_req'];

	$formulaire=new \user\PageElement(array(
		'template' => $config['path_template'].'post/lecture/formulaire.html',
		'elements' => array(
			'formulaire' => $Formulaire,
		),
	));
}

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'post'         => $contenu,
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

$config['pageElement_elements']=array(
	'tete'  => $Tete,
	'corps' => $Corps,
);

?>