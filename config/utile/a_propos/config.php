<?php

$titre=$lang['utile_a_propos_titre'];
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang['utile_a_propos_description'],
);

$Contenu=new \user\PageElement(array(
	'template' => $config['path_template'].$application.'/'.$action.'/form.html',
	'elements' => array(
		'action'        => $config['utile_a_propos_formulaire_action'],
		'legend'        => $lang['utile_a_propos_formulaire_legend'],
		'label_contenu' => $lang['utile_a_propos_formulaire_label'],
		'submit'        => $lang['utile_a_propos_formulaire_submit'],
	),
));

require $config['pageElement_formulaire_req'];

$questions_reponses=[];
for ($i=0, $lenght=count($lang['utile_a_propos_contenu_questions']); $i < $lenght; $i++)
{
	$questions_reponses[]=new \user\PageElement(array(
		'template' => $config['path_template'].$application.'/'.$action.'/question_reponse.html',
		'elements' => array(
			'question' => $lang['utile_a_propos_contenu_questions'][$i],
			'reponse'  => $lang['utile_a_propos_contenu_reponses'][$i],
		),
	));
}

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'titre'      => $lang['utile_a_propos_contenu_titre'],
		'contenu'    => $questions_reponses,
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