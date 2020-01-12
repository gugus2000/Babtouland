<?php
$Conversations=$Visiteur->recupererConversations();

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].'css/survol.css');
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].'css/chat/hub/main.css');
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('javascripts', $config['path_assets'].'js/survol.js?version=test');
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('javascripts', $config['path_assets'].'js/chat/hub/survol_var.js');

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
		'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/cartes.html',
		'elements' => array(
			'nom_conversation'        => $Conversation->afficherNom(),
			'description'             => $Conversation->afficherDescription(),
			'utilisateur_connecte'   => $lang['chat_hub_connectes'],
			'nombre_connecte'         => count($connecte),
			'utilisateur_en_tout'     => $lang['chat_hub_total'],
			'nombre_total'            => count($Conversation->getId_utilisateurs()),
			'lien_href_conversation'  => $Routeur->creerLien(array_merge($config['chat_hub_lien_voir_conversation'], array($config['nom_parametres'] => array('id' => $Conversation->afficherId())))),
			'lien_title_conversation' => $lang['chat_hub_lien_titre_voir_conversation'],
			'lien_conversation'       => $lang['chat_hub_lien_voir_conversation'],
		),
	));
}

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'cartes'   => $Cartes,
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
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>