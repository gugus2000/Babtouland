<?php

require $config['bbcode_config'];
$PostManager=new \post\PostManager(\core\BDDFactory::MysqlConnexion());
$lastBuildDate=new \DateTime('jan 01 00:00:00 2016');
$Posts=$PostManager->getBy(array(), array(), array('ordre' => 'date_mise_a_jour','fin' => 0, 'nombre' => $PostManager->count()));
$items=array();
foreach ($Posts as $post)
{
	$Post=new \post\Post($post);
	$Auteur=new \user\Utilisateur(array(
		'id' => $Post->getId_auteur(),
	));
	$Auteur->recuperer();
	$lastBuildDate=new \DateTime($Post->getDate_mise_a_jour());
	$items[]=array('item' => array(
		'title'       => $Post->afficherTitre(),
		'link'        => $config['url_website'].$Routeur->creerLien(array_merge($config['rss_post_item_link'], array($config['nom_parametres'] => array('id' => $Post->getId(), 'lang' => $lang['lang_self']['abbr'])))),
		'description' => $Post->afficherContenu(),
		'author'      => $Auteur->afficherPseudo(),
		'guid'        => $Post->afficherId(),
		'pubDate'     => $lastBuildDate->format('D, d M Y H:i:s T'),
	));
}
$plus=array(
	'webMaster'     => 'gugus2000@protonmail.com',
	'lastBuildDate' => $lastBuildDate->format('D, d M Y H:i:s T'),
);

$channels=array(new \user\page\rss\Channel(array(
	'title'       => $lang['rss_post_title'],
	'link'        => $config['url_website'].$Routeur->creerLien(array_merge($config['rss_post_link'], array($config['nom_parametres'] => array('lang' => $lang['lang_self']['abbr'])))),
	'description' => $lang['rss_post_description'].$config['nom_site'],
	'language'    => $Visiteur->getConfigurations()['lang'],
	'copyright'   => 'beerware',
	'autres'      => array_merge($plus, $items),
)));
$PageElement=new \user\page\rss\Rss(array(
	'channels' => $channels,
));
$Visiteur->getPage()->creerPage($PageElement);

?>