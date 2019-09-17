<?php

$titre=$lang['user_edition_titre'];
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang['user_edition_description'],
);

$admin=False;
$Utilisateur=$Visiteur;
if(isset($_GET['id']) & $Visiteur->getRole()->existPermission($config['user_edition_admin_application'], $config['user_edition_admin_action']))
{
	$admin=True;
	$Utilisateur=new \user\Utilisateur(array(
		'id' => $_GET['id'],
	));
	$Utilisateur->recuperer();
	$config['user_edition_action']=$config['user_edition_action'].'&id='.$_GET['id'];
}

ob_start();?>
<form enctype="multipart/form-data" action="<?= $config['user_edition_action'] ?>" method="POST" accept-charset="utf-8">
	<fieldset>
		<legend><?= $lang['user_edition_legend'] ?><?= $Utilisateur->afficherPseudo() ?></legend>
		<label for="edition_avatar"><?= $lang['user_edition_label_avatar'] ?></label>
		<input type="file" name="edition_avatar" value="<?= $Utilisateur->afficherAvatar() ?>"><br />
		<label for="edition_mail"><?= $lang['user_edition_label_mail'] ?></label>
		<input type="text" name="edition_mail" value="<?= $Visiteur->afficherMail() ?>"><br />
		<?php
		if($admin)
		{
			?>
		<label for="edition_banni"><?= $lang['user_edition_label_banni'] ?></label>
		<input type="checkbox" name="edition_banni" value="oui"<?= $checked ?>><br />
			<?php
		}
		?>
		<input type="submit" value="<?= $lang['user_edition_submit'] ?>">
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