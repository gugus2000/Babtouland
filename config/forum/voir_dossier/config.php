<?php

if (!isset($Visiteur->getPage()->getParametres()['id']))
{
	$Visiteur->getPage()->ajouterParametre('id', $config['forum_root_id']);
}
$Dossier=new \forum\Dossier(array(
	'id' => $Visiteur->getPage()->getParametres()['id'],
));
$Dossier->recuperer();
if ($Dossier->getType()!=$Dossier::TYPE)
{
	$get=array_merge($config['forum_voir_dossier_notification_erreur_dossier'], array($config['nom_parametres'] => array('id' => $Visiteur->getPage()->getParametres()['id'])));
	new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['forum_voir_dossier_notification_erreur_dossier'],
	));
	$Visiteur->getPage()->envoyerNotificationsSession();
	header('location: '.$Routeur->creerLien($get));
	exit();
}
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre'].$Dossier->afficherNom());
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].'css/forum.css');
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'   => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));
$chemins=array();
foreach ($Dossier->getDescendance() as $dossier)
{
	$chemins[]=new \user\PageElement(array(
		'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/chemin.html',
		'elements' => array(
			'href'  => $Routeur->creerLien(array_merge($config['forum_voir_dossier_enfants_lien_dossier'], array( $config['nom_parametres'] => array('id' => $dossier->afficherId())))),
			'titre' => $dossier->afficherNom(),
			'nom'   => $dossier->afficherNom(),
		),
	));
}
$Bandeau=new \user\PageElement(array(
	'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/bandeau.html',
	'elements' => array(
		'chemins'     => $chemins,
		'description' => $Dossier->afficherDescription(),
	),
));
$enfants=array();
foreach ($Dossier->recupererEnfants(0,100) as $Enfant)
{
	switch ($Enfant::TYPE)
	{
		case $Enfant::TYPE_DOSSIER:
			$type='dossier';
			$lien_base=$config['forum_voir_dossier_enfants_lien_dossier'];
			$lien_titre=$lang['forum_voir_dossier_enfant_titre_lien_dossier'];
			break;
		case $Enfant::TYPE_FIL:
			$type='fil';
			$lien_base=$config['forum_voir_dossier_enfants_lien_fil'];
			$lien_titre=$lang['forum_voir_dossier_enfant_titre_lien_fil'];
			break;
		default:
			throw new \UnexpectedValueException((string)$Enfant::TYPE.' not exist');
	}
	$enfants[]=new \user\PageElement(array(
		'template' => $config['path_template'].$Visiteur->getPage()->afficherApplication().'/'.$Visiteur->getPage()->afficherAction().'/enfant.html',
		'elements' => array(
			'src'         => $config['path_assets'].'img/icone/'.$type.'.svg',
			'alt'         => $type,
			'lien'        => $Routeur->creerLien(array_merge($lien_base, array($config['nom_parametres'] => array('id' => $Enfant->afficherId())))),
			'titre_lien'  => $lien_titre.$Enfant->afficherNom(),
			'nom'         => $Enfant->afficherNom(),
			'description' => $Enfant->afficherDescription().'/'.\forum\Noeud::newNoeud($Enfant->recentMessage()->getId_fil())->getNom(),
		),
	));
}
$Contenu=new \user\PageElement(array(
	'template' => $Visiteur->getPage()->getTemplatePath(),
	'elements' => array(
		'bandeau' => $Bandeau,
		'enfants' => $enfants,
	),
));
$Tete=new \user\page\MenuUp();
$toast_liens=array(
	'lien'        => array(array_merge($config['forum_voir_dossier_lien_ajout'], array($config['nom_parametres'] => array('id_parent' => $Dossier->getId())))),
	'description' => array($lang['forum_voir_dossier_lien_ajout']),
	'icone'       => array('add'),
);
if ($Visiteur->autorisationModification($Dossier))
{
	$toast_liens['lien'][]=array_merge($config['forum_voir_dossier_lien_edition'], array($config['nom_parametres'] => array('id' => $Dossier->getId())));
	$toast_liens['description'][] =$lang['forum_voir_dossier_lien_edition'];
	$toast_liens['icone'][]='edit';
	$toast_liens['lien'][]=array_merge($config['forum_voir_dossier_lien_suppression'], array($config['nom_parametres'] => array('id' => $Dossier->getId())));
	$toast_liens['description'][] =$lang['forum_voir_dossier_lien_suppression'];
	$toast_liens['icone'][]='delete';
}
if($Visiteur->verifLiens($toast_liens['lien']))
{
	$Toast=new \user\page\Toast($toast_liens);
}
else
{
	$Toast='';
}
$Corps=new \user\page\Corps($Tete, $Contenu, $Toast);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>