<?php
$lang='FR';

$config=array(
	/* Paramètre par défaut modifiable */
		/* Page */
			'default_application' => 'user',					// Application par défaut
			'default_action'      => 'statut',					// Action par défaut
			'default_lang'        => $lang,						// Langue de la page par défaut
			'default_template'    => 'template/template.php',	// Template de la page par défaut
			'default_css'         => array('assets/css/main.css', 'assets/css/reset.css', 'assets/css/normalize.css', 'assets/font/material icons/material-icons.css'),	// Css de la page par défaut
			'default_javascripts' => array(),					// javascripts de la page par défaut
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
			),													// Métadonnées de la page par défaut
			'default_contenu' => '',							// Contenu de la page par défaut
		/* Post */
			/* Fil post */
				'default_post_filPost_nombre_posts'   => 4,	// Nombre de posts dans fil_post par défaut
				'default_post_filPost_position_debut' => 0,	// Position du premier post dans fil_post
	/* Paramètre non modifiable */
		/* Général */
			'nom_site' => 'Babtouland',	// Nom du site
		/* Session Guest */
			'nom_guest' => 'guest',	// pseudo de l'utilisateur "guest"
			'mdp_guest' => 'guest',	// mot de passe de l'utilisateur "guest"
		/* Inscription */
			'default_avatar' => 'default.png',	// Avatar par défaut des nouveaux utilisateurs
			'default_banni'  => False,			// Statut par défaut des nouveaux utilisateurs
			'default_role'   => 'membre',		// Role par défaut des nouveaux utilisateurs
		/* Message */
			'message_css'     => 'assets/css/message.css',		// Css des messages
			'message_js'      => 'assets/js/message.js',		// Js des messages
			'message_contenu' => 'assets/html/message.html',	// Contenu des messages
		/* Menu-up */
			'menu-up_liens'       => array('?', '?application=post&action=fil_post'),						// Liste des liens dans le menu_up (dans l'ordre)
			'menu-up_icones'      => array('home', 'message'),						// Liste des icones du menu_up version petit_ecran (dans l'ordre)
			'menu-up_lien-statut' => '?application=user&action=statut',	// Lien lors du clic sur l'avatar dans le menu_up
			'menu-up_css'         => 'assets/css/menu-up.css',			// Css du menu-up
			'menu-up_js'          => 'assets/js/menu-up.js',			// Js du menu_-up
			'menu-up_contenu'     => 'assets/php/menu-up.php',			// Contenu dynamique du menu-up
			'menu-up_req'         => 'func/core/menu-up.func.php',		// Fonctions utilisé dans menu-up
		/* Statut */
			'user_statut_lien-connexion'   => '?application=user&action=connexion',		// Lien pour se connecter affiché dans la page de statut
			'user_statut_lien-inscription' => '?application=user&action=inscription',	// Lien pour s'inscrire affiché dans la page de statut
			'user_statut_lien-deconnexion' => '?application=user&action=deconnexion',	// Lien pour se déconnecter affiché dans la page de statut
		/* Fil post */
			'post_filPost_default_page' => 1,									// Numéro de la page a afficher si non précisé
			'post_filPost_lien_detail'  => '?application=post&action=lecture',	// Lien vers la page de lecture complète du post
			'post_filPost_lien_auteur'  => '?application=user&action=view',		// Lien vers la page de présentation de l'auteur
);

?>