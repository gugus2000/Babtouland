<?php

$titre=$lang['user_connexion_titre'];
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang['user_connexion_description'],
);

ob_start();?>
<form action="<?= $config['post_connexion_action'] ?>" method="POST" accept-charset="utf-8">
	<fieldset>
		<legend><?= $lang['user_connexion_fieldset'] ?></legend>
		<label for="connexion_pseudo"><?= $lang['user_formulairepseudo'] ?></label>
		<input type="text" name="connexion_pseudo"><br />
		<label for="connexion_mdp"><?= $lang['user_formulairemdp'] ?></label>
		<input type="password" name="connexion_mdp"><br />
		<input type="submit" value="<?= $lang['user_connexion_submit'] ?>">
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