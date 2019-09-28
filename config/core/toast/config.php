<?php

$compteur=0;
foreach ($toast_liens['lien'] as $index => $toast_lien)
{
	$page=recuperationApplicationActionLien($toast_lien);
	if ($Visiteur->getRole()->existPermission($page['application'], $page['action']))
	{
		$compteur++;
	}
}
if ($compteur>0)
{
	$config['css'][]=$config['toast_css'];
	$config['javascripts'][]=$config['toast_js'];

	$Toast=new \user\PageElement(array(
		'template'  => $config['path_template'].'core/toast/toast.html',
		'fonctions' => $config['path_func'].'core/toast/toast.func.php',
		'elements'  => array(
			'toast_liens' => $toast_liens,
		),
	));
}
else
{
	$Toast='';
}

?>