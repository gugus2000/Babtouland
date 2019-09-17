<?php

$titre=$lang[$application.'_'.$action.'_titre'];
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang[$application.'_'.$action.'_description'],
);


ob_start();?>
<form action="<?= $config['post_publication_action'] ?>" method="POST" accept-charset="utf-8">
	<fieldset>
		<legend><?= $lang['post_publication_legend'] ?></legend>
		<label for="publication_titre"><?= $lang['post_publication_titreForm'] ?></label>
		<input type="text" name="publication_titre"><br />
		<label for="publication_contenu"><?= $lang['post_publication_contenu'] ?></label>
		<textarea name="publication_contenu"></textarea><br />
		<input type="submit" value="<?= $lang['post_publication_submit'] ?>">
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