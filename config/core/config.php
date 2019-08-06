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
			'nom_site'      => 'Babtouland',			// Nom du site
			'chemin_avatar' => 'assets/img/avatar/',	// Chemin vers le dossier contenant les avatars
			/* Message */
				'message_css'     => 'assets/css/message.css',		// Css des messages
				'message_js'      => 'assets/js/message.js',		// Js des messages
				'message_contenu' => 'assets/html/message.html',	// Contenu des messages
			/* Menu-up */
				'menu-up_liens'       => array('?', '?application=post&action=fil_post'),	// Liste des liens dans le menu_up (dans l'ordre)
				'menu-up_icones'      => array('home', 'message'),							// Liste des icones du menu_up version petit_ecran (dans l'ordre)
				'menu-up_lien-statut' => '?application=user&action=statut',					// Lien lors du clic sur l'avatar dans le menu_up
				'menu-up_css'         => 'assets/css/menu-up.css',							// Css du menu-up
				'menu-up_js'          => 'assets/js/menu-up.js',							// Js du menu-up
				'menu-up_contenu'     => 'assets/php/menu-up.php',							// Contenu dynamique du menu-up
				'menu-up_req'         => 'func/core/menu-up.func.php',						// Fonctions utilisé dans menu-up
			/* Toast */
				'toast_css'     => 'assets/css/toast.css',		// Css du toast
				'toast_js'      => 'assets/js/toast.js',		// Js du toast
				'toast_contenu' => 'assets/php/toast.php',		// Contenu dynamique du toast
				'toast_req'     => 'func/core/toast.func.php',	// Fonctions utilisé dans toast
			/* Session Guest */
				'nom_guest' => 'guest',	// pseudo de l'utilisateur "guest"
				'mdp_guest' => 'guest',	// mot de passe de l'utilisateur "guest"
		/* user */
			/* inscription */
				'default_avatar'          => 'default.png',										// Avatar par défaut des nouveaux utilisateurs
				'default_banni'           => False,												// Statut par défaut des nouveaux utilisateurs
				'default_role'            => 'membre',											// Role par défaut des nouveaux utilisateurs
				'post_inscription_action' => '?application=user&action=validation_inscription',	// Lien redirigeant le formulaire d'inscription
			/* connexion */
				'post_connexion_action' => '?application=user&action=validation_connexion',	// Lien redirigeant le formulaire de connexion
			/* statut */
				'user_statut_lien-connexion'   => '?application=user&action=connexion',		// Lien pour se connecter affiché dans la page de statut
				'user_statut_lien-inscription' => '?application=user&action=inscription',	// Lien pour s'inscrire affiché dans la page de statut
				'user_statut_lien-deconnexion' => '?application=user&action=deconnexion',	// Lien pour se déconnecter affiché dans la page de statut
			/* validation_connexion */
				'user_validationConnexion_retour'  => '?application=user&action=connexion',	// Lien de la page à charger lorsque la connexion échoue
				'user_validationConnexion_suivant' => '',									// Lien de la page à charger lorsque la connexion réussie
			/* validation_inscription */
				'user_validationInscription_retour'  => '?application=user&action=inscription',	// Lien de la page à charger lorsque l'inscription échoue
				'user_validationInscription_suivant' => '',										// lien de la page à charger lorsque l'inscription réussie
		/* post */
			/* fil_post */
				'post_filPost_default_page'     => 1,											// Numéro de la page a afficher si non précisé
				'post_filPost_lien_detail'      => '?application=post&action=lecture',			// Lien vers la page de lecture complète du post
				'post_filPost_lien_auteur'      => '?application=user&action=view',				// Lien vers la page de présentation de l'auteur
				'post_filPost_lien_publication' => '?application=post&action=publication',		// Lien vers la page de publication de post
				'post_filPost_tri'              => 'date_publication',							// Attribut fixant la position des posts
			/* publication */
				'post_publication_action' => '?application=post&action=validation_publication',	// Lien redirigeant le formulaire de publication
			/* validation_publication */
				'post_validationPublication_suivant' => '?application=post&action=fil_post',		// Lien de la page à charger lorque la publication du post échoue
				'post_validationPublication_retour'  => '?application=post&action=publication',		// Lien de la page à charger lorque la publication du post réussie
			/* lecture */
				'post_lecture_lien_auteur'                  => '?application=user&action=view',						// Lien vers la page de présentation de l'auteur
				'post_lecture_lien_mise_a_jour'             => '?application=post&action=mise_a_jour',				// Lien vers la page de la mise à jour dudit post
				'post_lecture_lien_suppression'             => '?application=post&action=suppression',				// Lien vers la page de la suppression dudit post
				'post_lecture_publication_commentaire'      => '?application=post&action=commentaire_publication',	// Lien redirigeant le formulaire de publication de commentaire
				'post_lecture_lien_commentaire_suppression' => '?application=post&action=commentaire_suppression',	// Lien vers la page de la suppression dudit commentaire
			/* commentaire_publication */
				'post_commentairePublication_suivant' => '?application=post&action=lecture',	// Lien de la page à charger lorsque la publication du commentaire a échoué
				'post_commentairePublication_retour'  => '?application=post&action=lecture',	// Lien de la page à charger lorsque la publication du commentaire a réussie
			/* suppression */
				'post_suppression_retour'            => '?application=post&action=fil_post',	// Lien de la page à charger lorsque la suppression d'un post échoue faute d'id
				'post_suppression_permission'        => '?application=post&action=lecture',		// Lien de la page à charger lorsque la suppression d'un post échoue faute de permission
				'post_suppression_suivant'           => '?application=post&action=fil_post',	// Lien de la page à charger lorsque la suppression d'un post réussie
				'post_suppression_admin_application' => 'core',									// Application dont la permission est nécessaire pour supprimer les posts des autres
				'post_suppression_admin_action'      => 'suppression_post',						// Action dont la permission est nécessaire pour supprimer les posts des autres
			/* commentaire_suppression */
				'post_commentaireSuppression_retour'            => '?application=post&action=fil_post',		// Lien de la page à charger lorsque la suppression d'un commentaire échoue faute d'id
				'post_commentaireSuppression_permission'        => '?application=post&action=lecture',		// Lien de la page à charger lorsque la suppression d'un commentaire échoue faute de permission
				'post_commentaireSuppression_suivant'           => '?application=post&action=lecture',		// Lien de la page à charger lorsque la suppression d'un commentaire réussie
				'post_commentaireSuppression_admin_application' => 'core',									// Application dont la permission est nécessaire pour supprimer les posts des autres
				'post_commentaireSuppression_admin_action'      => 'suppression_commentaire',				// Action dont la permission est nécessaire pour supprimer les posts des autres
);

?>