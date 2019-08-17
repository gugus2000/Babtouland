<?php

$Message=new \user\Message(array(
	'contenu'  => $lang['utile_mail_message_erreur_formulaire'],
	'type'     => \user\Message::TYPE_ERREUR,
	'css'      => $config['message_css'],
	'js'       => $config['message_js'],
	'template' => $config['message_template'],
));
$get=$config['utile_mail_lien_erreur_formulaire'];
if(isset($_POST['a_propos_contenu']) & !empty($_POST['a_propos_contenu']))
{
	$Message=new \user\Message(array(
		'contenu'  => $lang['utile_mail_message_succes'],
		'type'     => \user\Message::TYPE_SUCCES,
		'css'      => $config['message_css'],
		'js'       => $config['message_js'],
		'template' => $config['message_template'],
	));
	$get=$config['utile_mail_lien_succes'];

	$objet=$config['nom_site'].' | Message de '.$Visiteur->afficherPseudo();
	$message=$_POST['a_propos_contenu'];
	$mail=$config['mail_dev'];
	if(!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
	{
		$passage_ligne = "\r\n";
	}
	else
	{
		$passage_ligne = "\n";
	}
	//=====Déclaration des messages au format texte et au format HTML.
	$message_txt = $message;
	$message_html = "<html><head></head><body><h2>Message envoyé depuis ".$config['nom_site']." par " . $Visiteur->afficherPseudo() . " :</h2><br />" . $message . "</body></html>";
	//==========
		
	//=====Création de la boundary
	$boundary = "-----=".md5(rand());
	//==========
	 
	//=====Définition du sujet.
	$sujet = $objet;
	//=========
	 
	//=====Création du header de l'e-mail.
	$header = "From: \"" . $Visiteur->afficherPseudo() . "\"<" . $Visiteur->afficherMail() . ">".$passage_ligne;
	$header.= "Reply-to: \"" . $Visiteur->afficherPseudo() . "\" <" . $Visiteur->afficherMail() . ">".$passage_ligne;
	$header.= "MIME-Version: 1.0".$passage_ligne;
	$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
	//==========
		
	//=====Création du message.
	$message = $passage_ligne."--".$boundary.$passage_ligne;
	//=====Ajout du message au format texte.
	$message.= "Content-Type: text/plain; charset=\"UTF-8\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_txt.$passage_ligne;
	//==========
	$message.= $passage_ligne."--".$boundary.$passage_ligne;
	//=====Ajout du message au format HTML
	$message.= "Content-Type: text/html; charset=\"UTF-8\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_html.$passage_ligne;
	//==========
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	//==========
		
	//=====Envoi de l'e-mail.
	$succes=mail($mail,$sujet,$message,$header);
	//==========
	if (!$succes)
	{
    	$Message=new \user\Message(array(
    		'contenu'  => error_get_last()['message'],
			'type'     => \user\Message::TYPE_ATTENTION,
			'css'      => $config['message_css'],
			'js'       => $config['message_js'],
			'template' => $config['message_template'],
		));
	}
}

$_SESSION['message']=serialize($Message);
header('location: index.php'.$get);

?>