<?php

$this->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$this->getPage()->getApplication().'_'.$this->getPage()->getAction().'_titre']);
$this->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$this->getPage()->getApplication().'_'.$this->getPage()->getAction().'_description'],
));

$bdd=\core\BDDFactory::MysqlConnexion();
$requete=$bdd->prepare('SELECT nom_role FROM '.\user\RoleManager::TABLE.' GROUP BY nom_role');
$requete->execute();
$OptionsGroupe=array();
while ($resultat=$requete->fetch(\PDO::FETCH_ASSOC))
{
	$OptionsGroupe[]=new \user\PageElement(array(
		'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/option.html',
		'elements' => array(
			'value'       => $resultat['nom_role'],
			'description' => $resultat['nom_role'],
		),
	));
}
$Form=new \user\PageElement(array(
	'template'  => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/form.html',
	'fonctions' => $config['path_func'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/func.php',
	'elements'  => array(
		'action'                          => createPageLink('admin', 'validation_publier_notification'),
		'legend'                          => $lang['admin_publier_notification_formulaire_legend'],
		'label_notification_message'      => $lang['admin_publier_notification_formulaire_label_message'],
		'label_notification_type'         => $lang['admin_publier_notification_formulaire_label_type'],
		'type_succes'                     => \user\page\Notification::TYPE_SUCCES,
		'succes'                          => $lang['admin_publier_notification_formulaire_succes'],
		'type_erreur'                     => \user\page\Notification::TYPE_ERREUR,
		'erreur'                          => $lang['admin_publier_notification_formulaire_erreur'],
		'type_attention'                  => \user\page\Notification::TYPE_ATTENTION,
		'attention'                       => $lang['admin_publier_notification_formulaire_attention'],
		'label_notification_groupe'       => $lang['admin_publier_notification_formulaire_label_groupe'],
		'tous'                          => $lang['admin_publier_notification_formulaire_tous'],
		'options_groupe'                  => $OptionsGroupe,
		'label_notification_utilisateurs' => $lang['admin_publier_notification_formulaire_label_utilisateurs'],
		'submit'                          => $lang['admin_publier_notification_formulaire_submit'],
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
$MenuUp=new \user\page\MenuUp();
$Corps=new \user\page\Corps($MenuUp, $Carte, '');
$this->getPage()->getPageElement()->ajouterElement($config['corps_nom'],$Corps);

?>