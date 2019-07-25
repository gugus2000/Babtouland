<?php

session_destroy();
session_start();

$_SESSION['message']=$lang['user_deconnexion_message'];

header('location: index.php')

?>