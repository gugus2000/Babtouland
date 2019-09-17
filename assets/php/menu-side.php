<?php ob_start(); ?>
	<?php echo file_get_contents('assets/html/menu-side.html'); ?>
<?php $Contenu=ob_get_clean(); ?>