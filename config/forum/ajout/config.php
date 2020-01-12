<?php

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->afficherApplication().'_'.$Visiteur->getPage()->afficherAction().'_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'   => 'description',
	'content' => $lang[$Visiteur->getPage()->afficherApplication().'_'.$Visiteur->getPage()->afficherAction().'_description'],
));
$types=array(\forum\Noeud::TYPE_DOSSIER, \forum\Noeud::TYPE_FIL);
$options=array();
foreach ($types as $type)
{
	$options[]=new \user\pageElement(array(
		'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/option.html',
		'elements' => array(
			'valeur' => $type,
			'nom'    => $lang['forum_nom_type_'.(string)$type],
		),
	));
}
$form=new \user\PageElement(array(
	'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/form.html',
	'elements' => array(
		'action'            => $Routeur->creerLien(array_merge($config['forum_ajout_formulaire_action'], array($config['nom_parametres'] => array('id_parent' => $Visiteur->getPage()->getParametres()['id_parent'])))),
		'legend'            => $lang['forum_ajout_formulaire_legend'],
		'label_nom'         => $lang['forum_ajout_formulaire_label_nom'],
		'label_description' => $lang['forum_ajout_formulaire_label_description'],
		'label_type'        => $lang['forum_ajout_formulaire_label_type'],
		'options'           => $options,
		'submit'            => $lang['forum_ajout_formulaire_submit'],
	),
));
$Formulaire=new \user\page\Formulaire($form);
$contenu=new \user\PageElement(array(
	'template' => $Visiteur->getPage()->getTemplatePath(),
	'elements' => array(
		'formulaire' => $Formulaire,
	),
));
$Carte=new \user\page\Carte($contenu);
$Tete=new \user\page\MenuUp();
$Corps=new \user\page\Corps($Tete, $Carte, '');
$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);

?>