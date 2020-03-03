<?php

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));
$options_lang=array();
$options_lang[]=new \user\PageElement(array(
	'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/option.html',
	'elements' => array(
		'value'       => $lang['lang_self']['abbr'],
		'description' => $lang['lang_self']['full'],
	),
));
foreach ($lang['lang_others'] as $langue)
{
	$options_lang[]=new \user\PageElement(array(
		'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/option.html',
		'elements' => array(
			'value'       => $langue['abbr'],
			'description' => $langue['full'],
		),
	));
}
$Form=new \user\PageElement(array(
	'template'  => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/form.html',
	'elements'  => array(
		'action'                           => $Routeur->creerLien($config['user_configurations_formulaire_action']),
		'legend'                           => $lang['user_configurations_formulaire_legend'],
		'label_lang'                       => $lang['user_configurations_formulaire_label_lang'],
		'options_lang'                     => $options_lang,
		'label_post_fil_post_nombre_posts' => $lang['user_configurations_formulaire_label_post_fil_post_nombre_posts'],
		'value_post_fil_post_nombre_posts' => $Visiteur->getConfiguration('post_fil_post_nombre_posts'),
		'submit'                           => $lang['user_configurations_formulaire_submit'],
	),
));
$Formulaire=new \user\page\Formulaire($Form);
$Carte=new \user\PageElement(array(
	'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/'.$config['filename_contenu_template'],
	'elements' => array(
		'formulaire' => $Formulaire,
	),
));
$MenuUp=new \user\page\MenuUp();
$Corps=new \user\page\Corps($MenuUp, $Carte, '');
$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>