<?php

$Conversations=$Visiteur->recupererConversations();

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));

$Cartes=array();

foreach ($Conversations as $Conversation)
{
	$connecte=[];
	foreach ($Conversation->recupererUtilisateurs() as $Utilisateur)
	{
		if ($Utilisateur->estConnecte())
		{
			$connecte[]=$Utilisateur;
		}
	}
	$Cartes[]=new \user\PageElement(array(
		'template' => $config['path_template'].$application.'/'.$action.'/cartes.html',
		'elements' => array(
			'nom_conversation'        => $Conversation->afficherNom(),
			'description'             => $Conversation->afficherDescription(),
			'nombre_utilisateur'      => $lang['chat_hub_nombre_utilisateur'].count($Conversation->getId_utilisateurs()).'/'.count($connecte),
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


if(verifLiens($Visiteur, $toast_liens['lien']))
{
	$Toast=new \user\page\Toast($toast_liens, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
}
else
{
	$Toast='';
}

$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getpageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Contenu, $Toast);

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);

?>