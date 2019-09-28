<?php

$Conversations=$Visiteur->recupererConversations();

$titre=$lang[$application.'_'.$action.'_titre'];
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang[$application.'_'.$action.'_description'],
);

$Cartes=array();

foreach ($Conversations as $Conversation)
{
	$Cartes[]=new \user\PageElement(array(
		'template' => $config['path_template'].$application.'/'.$action.'/cartes.html',
		'elements' => array(
			'nom_conversation'        => $Conversation->afficherNom(),
			'description'             => $Conversation->afficherDescription(),
			'nombre_utilisateur'      => $lang['chat_hub_nombre_utilisateur'].count($Conversation->getUtilisateurs()),
			'lien_href_conversation'  => $config['chat_hub_lien_voir_conversation'].'&id='.$Conversation->afficherId(),
			'lien_title_conversation' => $lang['chat_hub_lien_titre_voir_conversation'],
			'lien_conversation'       => $lang['chat_hub_lien_voir_conversation'],
		),
	));
}

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'cartes'         => $Cartes,
	),
));

$toast_liens=array(
	'lien'        => array($config['chat_hub_lien_ajouter_conversation']),
	'description' => array($lang['chat_hub_lien_ajouter_conversation']),
	'icone'       => array('add'),
);


require $config['pageElement_toast_req'];

require $config['pageElement_menuUp_req'];

$Corps=new \user\PageElement(array(
	'template'  => $config['pageElement_corps_template'],
	'fonctions' => $config['pageElement_corps_fonctions'],
	'elements'  => array(
		'haut'   => $MenuUp,
		'centre' => $Contenu,
		'bas'    => $Toast,
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