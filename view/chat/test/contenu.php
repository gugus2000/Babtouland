<?php ob_start(); ?>
<?php

$Conversations=$Visiteur->recupererConversations();

print_r($Conversations);

/*$Utilisateurs=array();
$Utilisateurs[]=$Visiteur;

$NewConversations=new chat\Conversation(array(
	'nom'          => 'GénéralEdit',
	'description'  => $Conversations[0]->getDescription(),
	'Utilisateurs' => $Utilisateurs,
));
$NewConversations->creer();*/

?>
<?php $contenu.=ob_get_clean(); ?>