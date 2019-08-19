<?php ob_start(); ?>
<?php

$Conversations=$Visiteur->recupererConversations();

print_r($Conversations);

?>
<?php $contenu.=ob_get_clean(); ?>