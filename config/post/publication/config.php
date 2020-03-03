<?php

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));

$Contenu=new \user\PageElement(array(
	'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/form.html',
	'elements' => array(
		'action'        => $Routeur->creerLien($config['post_publication_action']),
		'legend'        => $lang['post_publication_legend'],
		'label_titre'   => $lang['post_publication_titreForm'],
		'label_contenu' => $lang['post_publication_contenu'],
		'submit'        => $lang['post_publication_submit'],
	),
));

$Formulaire=new \user\page\Formulaire($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_template'],
	'elements'  => array(
		'formulaire' => $Formulaire,
	),
));

$Carte=new \user\page\Carte($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getpageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Carte, '');

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>