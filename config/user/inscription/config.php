<?php

$titre=$lang['user_inscription_titre'];
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang['user_inscription_description'],
);

ob_start();?>
<form action="<?= $config['post_inscription_action'] ?>" method="POST" accept-charset="utf-8">
	<fieldset>
		<legend><?= $lang['user_inscription_fieldset'] ?></legend>
		<label for="inscription_pseudo"><?= $lang['user_formulairepseudo'] ?></label>
		<input type="text" name="inscription_pseudo"><br />
		<label for="inscription_mdp"><?= $lang['user_formulairemdp'] ?></label>
		<input type="password" name="inscription_mdp"><br />
		<label for="inscription_mail"><?= $lang['user_formulairemail'] ?></label>
		<input type="text" name="inscription_mail"><br />
		<input type="submit" value="<?= $lang['user_inscription_submit'] ?>">
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

$config['pageElement_elements']['tete']=$Tete;
$config['pageElement_elements']['corps']=$Corps;

?>