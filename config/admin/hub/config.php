<?php

$UtilisateurManager=new \user\UtilisateurManager(\core\BDDFactory::Mysqlconnexion());
$nombre_utilisateurs=$UtilisateurManager->count()-1;		// Guest pas pris en compte
$date=new \DateTime(date('Y-m-d H:i:s'));
$date->sub(new \DateInterval($config['intervalle_connecte']));
$connectes=$UtilisateurManager->getBy(array(
	'date_connexion' => $date->format('Y-m-d H:i:s'),
	'pseudo'         => $config['nom_guest'],
), array(
	'date_connexion' => '>=',
	'pseudo'         => '!=',
));
$nombre_connectes=count($connectes);
$this->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$this->getPage()->getApplication().'_'.$this->getPage()->getAction().'_titre']);
$this->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$this->getPage()->getApplication().'_'.$this->getPage()->getAction().'_description'],
));
$Contenu=new \user\PageElement(array(
	'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/template.html',
	'elements' => array(
		'nombre_utilisateurs' => $lang['admin_hub_nombre_utilisateurs'].$nombre_utilisateurs,
		'nombre_connectes'    => $lang['admin_hub_nombre_connectes'].$nombre_connectes,
		'ratio_connectes'     => $lang['admin_hub_ratio_connectes_debut'].substr((string)(($nombre_connectes/$nombre_utilisateurs)*100),0,5).$lang['admin_hub_ratio_connectes_fin'],
		'liste_utilisateurs'  => '<a href="'.createPageLink('utile', 'liste_user').'">'.$lang['admin_hub_liste_utilisateurs'].'</a>',
	),
));
$MenuUp=new \user\page\MenuUp();
$Carte=new \user\page\Carte($Contenu);
$liens_toast=array(
	'lien'        => array(createPageLink('admin', 'publier_notification')),
	'description' => array($lang['admin_hub_publier_notification_description']),
	'icone'       => array('add_alert'),
);
$Toast=new \user\page\Toast($liens_toast);
$Corps=new \user\page\Corps($MenuUp, $Carte, $Toast);
$this->getpage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>