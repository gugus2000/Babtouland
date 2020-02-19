<?php

global $e;

if (!isset($e))
{
	throw new \Exception($lang['erreur_erreur_no_erreur']);
}

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'    => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));

ob_start();?>
<section class="contenu">
	<?= htmlspecialchars($e->getMessage()).'<br />' ?>
	<?= $lang['erreur_erreur_explication'].'<a href="'.$Routeur->creerLien(array('application' => 'utile', 'action' => 'a_propos')).'">'. $lang['erreur_erreur_explication_ici'] .'</a>.' ?>
</section>
<?php
$Contenu=ob_get_clean();

$Carte=new \user\page\Carte($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getpageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Carte, '');

$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>