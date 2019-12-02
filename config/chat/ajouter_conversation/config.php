<?php

$this->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
$this->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));
$this->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('javascripts', $config['path_assets'].'js/trie.js');
$this->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('javascripts', $config['path_assets'].'js/chat_ajouter_utilisateur.js');
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].'css/chat_ajouter_utilisateur.css');

$Form=new \user\PageElement(array(
	'template'  => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/form.html',
	'elements'  => array(
		'action'                         => $Routeur->creerLien($config['chat_ajouter_conversation_formulaire_action']),
		'legend'                         => $lang['chat_ajouter_conversation_formulaire_legend'],
		'label_conversation_nom'         => $lang['chat_ajouter_conversation_formulaire_label_nom'],
		'label_conversation_description' => $lang['chat_ajouter_conversation_formulaire_label_description'],
		'legend_ajouter_utilisateurs'    => $lang['chat_ajouter_conversation_formulaire_utilisateurs_legend'],
		'submit'                         => $lang['chat_ajouter_conversation_formulaire_submit'],
	),
));
$Formulaire=new \user\page\Formulaire($Form);
$Contenu=new \user\PageElement(array(
	'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getpage()->getAction().'/template.html',
	'elements' => array(
		'formulaire' => $Formulaire,
	),
));
$Carte=new \user\page\Carte($Contenu);

$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getpageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Carte, '');

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>