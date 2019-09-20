<?php

$config['css'][]=$config['path_assets'].'css/liste.css';

$titre=$lang[$application.'_'.$action.'_titre'];
$config['metas'][]=array(
	'name'    => 'description',
	'content' => $lang[$application.'_'.$action.'_description'],
);

ob_start();?>
<table>
	<caption><?= $lang['utile_liste_user_table_caption'] ?></caption>
	<thead>
		<tr>
			<th><?= $lang['utile_liste_user_table_th_nom'] ?></th>
			<th><?= $lang['utile_liste_user_table_th_avatar'] ?></th>
			<th><?= $lang['utile_liste_user_table_th_date_derniere_connexion'] ?></th>
			<th><?= $lang['utile_liste_user_table_th_date_inscription'] ?></th>
			<th><?= $lang['utile_liste_user_table_th_role'] ?></th>
		</tr>
	</thead>
	<tbody>
<?php
$BDDFactory=new \core\BDDFactory;
$UtilisateurManager=new \user\UtilisateurManager($BDDFactory->MysqlConnexion());
$attributs=array('pseudo' => 'guest');
$operations=array('pseudo' => '!=');
$resultats=$UtilisateurManager->getBy($attributs, $operations);
foreach ($resultats as $index => $resultat)
{
	$Utilisateur=new \user\Utilisateur(array(
		'id' => $resultat['id'],
	));
	$Utilisateur->recuperer();
	$classe='';
	if ($index%2==1)
	{
		$classe=' class="impair"';
	}
	?>
		<tr<?= $classe ?>>
			<td><?= $Utilisateur->afficherPseudo() ?></td>
			<td><img src="<?= $config['chemin_avatar'] ?><?= $Utilisateur->afficherAvatar() ?>" alt="<?= $lang['utile_liste_user_table_td_avatar_alt'] ?><?= $Utilisateur->afficherPseudo() ?>"></td>
			<td><?= $Utilisateur->afficherDate_connexion() ?></td>
			<td><?= $Utilisateur->afficherDate_inscription() ?></td>
			<td><?= $Utilisateur->afficherRole() ?></td>
		</tr>
	<?php
}
?>

	</tbody>
</table>
<?php
$contenu=ob_get_clean();

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$application.'/'.$action.'/'.$config['filename_contenu_template'],
	'fonctions' => $config['path_func'].$application.'/'.$action.'/'.$config['filename_contenu_fonctions'],
	'elements'  => array(
		'contenu'    => $contenu,
	),
));

require $config['pageElement_carte_req'];

require $config['pageElement_menuUp_req'];

$Corps=new \user\PageElement(array(
	'template'  => $config['pageElement_corps_template'],
	'fonctions' => $config['pageElement_corps_fonctions'],
	'elements'  => array(
		'haut'   => $MenuUp,
		'centre' => $Carte,
		'bas'    => '',
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