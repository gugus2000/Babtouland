<?php

$compteur_noeuds_supprimes=0;
$compteur_messages_supprimes=0;
$Root=new \forum\Dossier(array(
	'id' => $config['forum_root_id'],
));
$Root->recuperer();
$NoeudManager=new \forum\NoeudManager(\core\BDDFactory::MysqlConnexion());
$noeuds=$NoeudManager->getBy(array(
	'id' => -1,
), array(
	'id' => '!=',
));
$noeud_graph=array();

/**
 * Retourne FALSE si la clef n'est pas dans le tableau, sinon retourne la valeur correspondante à la clef
 *
 * @param mixed key Clef à vérifier
 *
 * @param array haystack Tableau dans lequel vérifier la présence de la clef
 *
 * @return mixed
 * @author gugus2000
 **/
function recursive_array_value($key, $haystack)
{
	if (isset($haystack[$key]))
	{
		return $haystack[$key];
	}
	foreach ($haystack as $needle)
	{
		if (is_array($needle))
		{
			$result=recursive_array_value($key, $needle);
			if($result!==False)
			{
				return $result;
			}
		}
	}
	return False;
}

/**
 * Retourne FALSE si la clef n'est pas dans le tableau, sinon retourne le chemin qui mène jusqu'à la clef
 *
 * @param mixed key Clef à vérifier
 *
 * @param array haystack Tableau dans lequel vérifier la présence de la clef
 *
 * @param array path Chemin
 *
 * @return mixed
 * @author gugus2000
 **/
function recursive_array_path($key, $haystack, $path=array())
{
	if (isset($haystack[$key]))
	{
		$path[]=$key;
		return $path;
	}
	foreach ($haystack as $index => $needle)
	{
		if (is_array($needle))
		{
			$path[]=$index;
			$result=recursive_array_path($key, $needle, $path);
			if($result!==False)
			{
				return $result;
			}
		}
	}
	return False;
}

/**
 * Insère une valeur dans le tableau associé à la clef demandé (renvoie True)
 *
 * @param mixed needle Valeur à ajouter
 *
 * @param array path Chemin vers la clef de l'array dans laquelle insérer la valeur
 *
 * @param array haystack Tableau contenant la clef
 *
 * @return array
 * @author gugus2000
 **/
function recursive_array_append($key, $needle, $path, $haystack)
{
	if (count($path)===0)
	{
		$haystack[$key]=$needle;
		return $haystack;
	}
	$haystacki=$haystack[$path[0]];
	$pathi=$path;
	array_shift($pathi);
	$result=recursive_array_append($key, $needle, $pathi, $haystacki);
	$haystack[$path[0]]=$result;
	return $haystack;
}

/**
 * Supprime tous les noeuds contenu dans l'array (renvoie le nombre de noeuds supprimés)
 *
 * @param array haystack Array à vider
 *
 * @param int key Clef de l'array haystack
 *
 * @return int
 * @author gugus2000
 **/
function recursive_array_delete_noeud($haystack, $key=0, $compteur=0)
{
	if (count($haystack)===0)
	{
		if ($key!=0)
		{
			$Noeud=\forum\Noeud::newNoeud($key);
			$Noeud->supprimer();
			return $compteur+1;
		}
		return 0;
	}
	foreach ($haystack as $key => $needle)
	{
		$compteur=recursive_array_delete_noeud($needle, $key, $compteur);
	}
	return $compteur;
}

foreach ($noeuds as $noeud)
{
	$result=recursive_array_value((int)$noeud['id'], $noeud_graph);
	if ($result!==False)
	{
		$append=$result;
	}
	else
	{
		$append=array();
	}
	$result=recursive_array_path((int)$noeud['id_parent'], $noeud_graph);
	if ($result!==False)
	{
		$noeud_graph=recursive_array_append((int)$noeud['id'], $append, $result, $noeud_graph);
	}
	else
	{
		$noeud_graph[(int)$noeud['id_parent']]=array((int)$noeud['id'] => $append);
	}
}
unset($noeud_graph[$Root->getId_parent()]);
$compteur_noeuds_supprimes=recursive_array_delete_noeud($noeud_graph);

new \user\page\Notification(array(
	'type' => \user\page\Notification::TYPE_SUCCES,
	'contenu' => $lang['admin_nettoyer_forum_notification_noeud_debut'].(string)$compteur_noeuds_supprimes.$lang['admin_nettoyer_forum_notification_noeud_fin'],
));
$MessageManager=new \forum\MessageManager(\core\BDDFactory::MysqlConnexion());
$messages=$MessageManager->getBy(array(
	'id' => -1,
), array(
	'id' => '!=',
));
foreach ($messages as $message)
{
	if (!$NoeudManager->existId((int)$message['id_fil']))
	{
		$compteur_messages_supprimes++;
		$Message=new \forum\Message(array(
			'id' => $message['id'],
		));
		$Message->supprimer();
	}
}

new \user\page\Notification(array(
	'type' => \user\page\Notification::TYPE_SUCCES,
	'contenu' => $lang['admin_nettoyer_forum_notification_message_debut'].(string)$compteur_messages_supprimes.$lang['admin_nettoyer_forum_notification_message_fin'],
));
$Visiteur->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($config['admin_nettoyer_forum_notification_lien']));
exit();

?>