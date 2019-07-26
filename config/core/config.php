<?php
$lang='FR';

$config=array(
	/* Paramètre par défaut modifiable */
		/* Page */
			'default_application' => 'user',
			'default_action'      => 'statut',
			'default_lang'        => $lang,
			'default_template'    => 'template/template.php',
			'default_css'         => array('assets/css/main.css', 'assets/css/reset.css', 'assets/css/normalize.css', 'assets/font/material icons/material-icons.css'),
			'default_javascripts' => array(),
			'default_metas'       => array(
				array(
					'charset' => 'utf-8',
					'lang'    => $lang,
				),
				array(
					'http-equiv' => 'X-UA-Compatible',
					'content'    => 'IE=edge',
				),
				array(
					'name'    => 'viewport',
					'content' => 'width=device-width, initial-scale=1',
				),
			),
			'default_contenu' => '',
	/* Paramètre non modifiable */
		/* Général */
			'nom_site' => 'Babtouland',
		/* Session Guest */
			'nom_guest' => 'guest',
			'mdp_guest' => 'guest',
		/* Inscription */
			'default_avatar' => 'default.png',
			'default_banni'  => False,
			'default_role'   => 'membre',
		/* Message */
			'message_css'     => 'assets/css/message.css',
			'message_js'      => 'assets/js/message.js',
			'message_contenu' => 'assets/html/message.html',
		/* Menu-up */
			'menu-up_liens'       => array('?'),
			'menu-up_icones'      => array('home'),
			'menu-up_lien-statut' => '?application=user&action=statut',
			'menu-up_css'         => 'assets/css/menu-up.css',
			'menu-up_js'          => 'assets/js/menu-up.js',
			'menu-up_contenu'     => 'assets/php/menu-up.php',
			'menu-up_req'         => 'func/core/menu-up.func.php',
		/* Statut */
			'user_statut_lien-connexion'   => '?application=user&action=connexion',
			'user_statut_lien-inscription' => '?application=user&action=inscription',
			'user_statut_lien-deconnexion' => '?application=user&action=deconnexion',
);

?>