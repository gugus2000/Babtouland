<?php

$titre=$lang['utile_a_propos_titre'];
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang['utile_a_propos_description'],
);

ob_start();?>
<form action="<?= $config['utile_a_propos_formulaire_action'] ?>" method="POST" accept-charset="utf-8">
	<fieldset>
		<legend><?= $lang['utile_a_propos_formulaire_legend'] ?></legend>
		<label for="a_propos_contenu"><?= $lang['utile_a_propos_formulaire_label'] ?></label>
		<textarea name="a_propos_contenu"></textarea><br />
		<input type="submit" value="<?= $lang['utile_a_propos_formulaire_submit'] ?>">
	</fieldset>
</form>
<?php
$Contenu=ob_get_clean();

require $config['pageElement_formulaire_req'];

ob_start();?>
<h1><?= $lang['utile_a_propos_contenu_titre'] ?></h1>
<?php
for ($i=0, $lenght=count($lang['utile_a_propos_contenu_questions']); $i < $lenght; $i++)
{
	?>
<h2><?= $lang['utile_a_propos_contenu_questions'][$i] ?></h2>
<p class="left_align"><?= $lang['utile_a_propos_contenu_reponses'][$i] ?></p>
	<?php
}
?>
<?php
$contenu=ob_get_clean();

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'contenu'    => $contenu,
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