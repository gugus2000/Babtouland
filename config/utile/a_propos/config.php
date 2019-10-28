<?php

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));

$Contenu=new \user\PageElement(array(
	'template' => $config['path_template'].$application.'/'.$action.'/form.html',
	'elements' => array(
		'action'        => $config['utile_a_propos_formulaire_action'],
		'legend'        => $lang['utile_a_propos_formulaire_legend'],
		'label_contenu' => $lang['utile_a_propos_formulaire_label'],
		'submit'        => $lang['utile_a_propos_formulaire_submit'],
	),
));

$Formulaire=new \user\page\Formulaire($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));

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

$Carte=new \user\page\Carte($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getpageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Carte, '');

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);

?>