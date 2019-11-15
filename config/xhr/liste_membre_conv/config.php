<?php

if (isset($_GET['id']))
{
	if ($_GET['id']!=$config['id_conversation_all'])
	{
		$Conversation=new \chat\Conversation(array(
			'id' => $_GET['id'],
		));
		$Conversation->recupererId_utilisateurs();
		$id_utilisateurs=$Conversation->getId_utilisateurs();
		$index=0;
		while (isset($id_utilisateurs[$index]))
		{
			if ($id_utilisateurs[$index]==$Visiteur->getId())
			{
				break;
			}
			$index++;
		}
		if (isset($id_utilisateurs[$index]))
		{
			$utilisateurs=$Conversation->recupererUtilisateurs();
			$pseudos=array();
			foreach ($utilisateurs as $utilisateur)
			{
				if (!$utilisateur->similaire($Visiteur))
				{
					$pseudos[]=$utilisateur->afficherPseudo();
				}
			}
			$Corps=new \user\page\Corps('', implode('|', $pseudos), '');
			$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
			$this->getPage()->envoyerNotificationsSession();
		}
	}
}

?>