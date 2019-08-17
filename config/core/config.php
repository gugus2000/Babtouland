<?php
$lang='FR';

/**
 * Créé un lien vers la page à partir de son application et action
 *
 * @param string application Application de la page
 * 
 * @param string action Action de la page
 * 
 * @return string
 * @author gugus2000
 **/
function createPageLink($application, $action)
{
	return '?application='.$application.'&action='.$action;
}

$config=array(
	/* Paramètre par défaut modifiable */
		/* Page */
			'default_application' => 'user',					// Application par défaut
			'default_action'      => 'statut',					// Action par défaut
			'default_lang'        => $lang,						// Langue de la page par défaut
			'default_template'    => 'template/template.php',	// Template de la page par défaut
			'default_css'         => array('assets/css/main.css', 'assets/css/reset.css', 'assets/css/normalize.css', 'assets/font/material icons/material-icons.css', 'assets/css/bbcode.css'),	// Css de la page par défaut
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
				'default_post_fil_post_nombre_posts'   => 4,	// Nombre de posts dans fil_post par défaut
				'default_post_fil_post_position_debut' => 0,	// Position du premier post dans fil_post
	/* Paramètre non modifiable */
		/* Général */
			'nom_site'      => 'Babtouland',					// Nom du site
			'chemin_avatar' => 'assets/img/avatar/',			// Chemin vers le dossier contenant les avatars
			'size_avatar'   => 1000000,							// Taille de l'avatar maximum
			'width_avatar'  => 1000,							// Longueur horizontale maximum de l'avatar
			'height_avatar' => 1000,							// Longueur verticale maximum de l'avatar
			'ext_avatar'    => array('jpg','gif','png','jpeg'),	// Extensions autorisé pour uploader un avatar
			'mail_dev'      => 'gugus2000@protonmail.com',		// Mail du développeur
			/* Message */
				'message_css'     => 'assets/css/message.css',		// Css des messages
				'message_js'      => 'assets/js/message.js',		// Js des messages
				'message_template' => 'assets/html/message.html',	// Template des messages
			/* Menu-up */
				'menu-up_liens'       => array('?', createPageLink('post', 'fil_post'), createPageLink('utile', 'a_propos')),	// Liste des liens dans le menu_up (dans l'ordre)
				'menu-up_icones'      => array('home', 'message', 'info'),														// Liste des icones du menu_up version petit_ecran (dans l'ordre)
				'menu-up_lien-statut' => createPageLink('user', 'statut'),														// Lien lors du clic sur l'avatar dans le menu_up
				'menu-up_css'         => 'assets/css/menu-up.css',																// Css du menu-up
				'menu-up_js'          => 'assets/js/menu-up.js',																// Js du menu-up
				'menu-up_contenu'     => 'assets/php/menu-up.php',																// Contenu dynamique du menu-up
				'menu-up_req'         => 'func/core/menu-up.func.php',															// Fonctions utilisé dans menu-up
			/* Toast */
				'toast_css'     => 'assets/css/toast.css',		// Css du toast
				'toast_js'      => 'assets/js/toast.js',		// Js du toast
				'toast_contenu' => 'assets/php/toast.php',		// Contenu dynamique du toast
				'toast_req'     => 'func/core/toast.func.php',	// Fonctions utilisé dans toast
			/* Session Guest */
				'nom_guest' => 'guest',	// pseudo de l'utilisateur "guest"
				'mdp_guest' => 'guest',	// mot de passe de l'utilisateur "guest"
			/* Erreur */
				'erreur_path' => 'erreur/page.php',	// Chemin vers la page d'erreur
		/* user */
			/* inscription */
				'default_avatar'          => 'default.png',										// Avatar par défaut des nouveaux utilisateurs
				'default_banni'           => False,												// Statut par défaut des nouveaux utilisateurs
				'default_role'            => 'membre',											// Role par défaut des nouveaux utilisateurs
				'post_inscription_action' => createPageLink('user', 'validation_inscription'),	// Lien redirigeant le formulaire d'inscription
			/* connexion */
				'post_connexion_action' => createPageLink('user', 'validation_connexion'),	// Lien redirigeant le formulaire de connexion
			/* statut */
				'user_statut_lien_connexion'   => createPageLink('user', 'connexion'),		// Lien pour se connecter affiché dans la page de statut
				'user_statut_lien_inscription' => createPageLink('user', 'inscription'),	// Lien pour s'inscrire affiché dans la page de statut
				'user_statut_lien_deconnexion' => createPageLink('user', 'deconnexion'),	// Lien pour se déconnecter affiché dans la page de statut
				'user_statut_lien_edition' => createPageLink('user', 'edition'),			// Lien pour éditer son profil affiché dans la page de statut
			/* validation_connexion */
				'user_validation_connexion_retour'  => createPageLink('user', 'connexion'),	// Lien de la page à charger lorsque la connexion échoue
				'user_validation_connexion_suivant' => '?',										// Lien de la page à charger lorsque la connexion réussie
			/* validation_inscription */
				'user_validation_inscription_retour'  => createPageLink('user', 'inscription'),	// Lien de la page à charger lorsque l'inscription échoue
				'user_validation_inscription_suivant' => '?',										// lien de la page à charger lorsque l'inscription réussie
			/* edition */
				'user_edition_action'            => createPageLink('user', 'validation_edition'),	// Lien redirigeant le formulaire d'édition d'utilisateur
				'user_edition_admin_application' => 'core',											// Application dont la permission est nécessaire pour éditer un aure utiliasateur
				'user_edition_admin_action'      => 'edition_user',									// Action dont la permission est nécessaire pour éditer un aure utiliasateur
			/* validation_edition */
				'user_validation_edition_lien_erreur_formulaire'       => createPageLink('user', 'statut'),	// Lien de la page à charger lorsque l'édition de l'utilisateur échoue
				'user_validation_edition_lien_succes'                  => createPageLink('user', 'statut'),	// Lien de la page à charger lorsque l'édition de son profil réussie
				'user_validation_edition_lien_admin_succes'            => createPageLink('user', 'view'),		// Lien de la page à charger lorsque l'édition d'un autre utilisateur réussie
				'user_validation_edition_avatar_lien_erreur_dossier'   => createPageLink('user', 'statut'),	// Lien de la page à charger lorsque l'édition de l'avatar échoue pour cause de droit de dossier
				'user_validation_edition_avatar_lien_erreur_upload'    => createPageLink('user', 'statut'),	// Lien de la page à charger lorsque l'édition de l'avatar échoue pour cause d'upload non fonctionnel
				'user_validation_edition_avatar_lien_erreur_interne'   => createPageLink('user', 'statut'),	// Lien de la page à charger lorsque l'édition de l'avatar échoue pour cause d'erreur interne
				'user_validation_edition_avatar_lien_erreur_type'      => createPageLink('user', 'statut'),	// Lien de la page à charger lorsque l'édition de l'avatar échoue pour cause d'erreur de type de fichier
				'user_validation_edition_avatar_lien_erreur_extension' => createPageLink('user', 'statut'),	// Lien de la page à charger lorsque l'édition de l'avatar échoue pour cause de mauvaise extension de fichier
				'user_validation_edition_avatar_lien_erreur_dimension' => createPageLink('user', 'statut'),	// Lien de la page à charger lorsque l'édition de l'avatar écgoue pour cause de mauvaise dimension
		/* utile */
			/* a_propos */
				'utile_a_propos_formulaire_action' => createPageLink('utile', 'mail'),	// Lien redirigeant le formulaire d'envoi de mail
			/* mail */
				'utile_mail_lien_erreur_formulaire' => createPageLink('utile', 'a_propos'),	// Lien de la page à charger lorsque l'envoi du mail échoue
				'utile_mail_lien_succes'            => createPageLink('utile', 'a_propos'),	// Lien de la page à charger lorsque l'envoi du mail réussi
		/* post */
			/* fil_post */
				'post_fil_post_default_page'     => 1,											// Numéro de la page a afficher si non précisé
				'post_fil_post_lien_detail'      => createPageLink('post', 'lecture'),			// Lien vers la page de lecture complète du post
				'post_fil_post_lien_auteur'      => createPageLink('user', 'view'),			// Lien vers la page de présentation de l'auteur
				'post_fil_post_lien_publication' => createPageLink('post', 'publication'),		// Lien vers la page de publication de post
				'post_fil_post_tri'              => 'date_publication',							// Attribut fixant la position des posts
			/* publication */
				'post_publication_action' => createPageLink('post', 'validation_publication'),	// Lien redirigeant le formulaire de publication de post
			/* validation_publication */
				'post_validation_publication_suivant' => createPageLink('post', 'fil_post'),			// Lien de la page à charger lorque la publication du post échoue
				'post_validation_publication_retour'  => createPageLink('post', 'publication'),		// Lien de la page à charger lorque la publication du post réussie
			/* lecture */
				'post_lecture_lien_auteur'                  => createPageLink('user', 'view'),						// Lien vers la page de présentation de l'auteur
				'post_lecture_lien_mise_a_jour'             => createPageLink('post', 'edition'),					// Lien vers la page de la mise à jour dudit post
				'post_lecture_lien_suppression'             => createPageLink('post', 'suppression'),				// Lien vers la page de la suppression dudit post
				'post_lecture_publication_commentaire'      => createPageLink('post', 'commentaire_publication'),	// Lien redirigeant le formulaire de publication de commentaire
				'post_lecture_lien_commentaire_suppression' => createPageLink('post', 'commentaire_suppression'),	// Lien vers la page de la suppression dudit commentaire
				'post_lecture_lien_commentaire_edition'     => createPageLink('post', 'commentaire_edition'),		// Lien vers la page d'édition dudit commentaire
			/* commentaire_publication */
				'post_commentaire_publication_suivant' => createPageLink('post', 'lecture'),	// Lien de la page à charger lorsque la publication du commentaire a échoué
				'post_commentaire_publication_retour'  => createPageLink('post', 'lecture'),	// Lien de la page à charger lorsque la publication du commentaire a réussie
			/* suppression */
				'post_suppression_retour'            => createPageLink('post', 'fil_post'),	// Lien de la page à charger lorsque la suppression d'un post échoue faute d'id
				'post_suppression_permission'        => createPageLink('post', 'lecture'),		// Lien de la page à charger lorsque la suppression d'un post échoue faute de permission
				'post_suppression_suivant'           => createPageLink('post', 'fil_post'),	// Lien de la page à charger lorsque la suppression d'un post réussie
				'post_suppression_admin_application' => 'core',									// Application dont la permission est nécessaire pour supprimer les posts des autres
				'post_suppression_admin_action'      => 'suppression_post',						// Action dont la permission est nécessaire pour supprimer les posts des autres
			/* commentaire_suppression */
				'post_commentaire_suppression_retour'            => createPageLink('post', 'fil_post'),	// Lien de la page à charger lorsque la suppression d'un commentaire échoue faute d'id
				'post_commentaire_suppression_permission'        => createPageLink('post', 'lecture'),		// Lien de la page à charger lorsque la suppression d'un commentaire échoue faute de permission
				'post_commentaire_suppression_suivant'           => createPageLink('post', 'lecture'),		// Lien de la page à charger lorsque la suppression d'un commentaire réussie
				'post_commentaire_suppression_admin_application' => 'core',									// Application dont la permission est nécessaire pour supprimer les posts des autres
				'post_commentaire_suppression_admin_action'      => 'suppression_commentaire',				// Action dont la permission est nécessaire pour supprimer les posts des autres
			/* edition */
				'post_edition_lien_erreur_id'           => createPageLink('post', 'fil_post'),				// Lien de la page à charger lorsqu'il n'y a pas l'id du post à éditer précisé
				'post_edition_lien_erreur_autorisation' => createPageLink('post', 'lecture'),				// Lien de la page à charger lorsque le visiteur n'a pas la permission d'éditer le post
				'post_edition_lien_erreur_existe'       => createPageLink('post', 'fil_post'),				// Lien de la page à charger lorsque le post à éditer n'existe pas
				'post_edition_formulaire_action'        => createPageLink('post', 'validation_edition'),	// Lien redirigeant le formulaire d'édition de post
				'post_edition_admin_application'        => 'core',											// Application dont la permission est nécessaire pour éditer les posts des autres
				'post_edition_admin_action'             => 'edition_post',									// Action dont la permission est nécessaire pour éditer les posts des autres
			/* validation_edition */
				'post_validation_edition_lien_formulaire' => createPageLink('post', 'fil_post'),	// Lien de la page à charger lorsque l'édition du post échoue faute d'arguments
				'post_validation_edition_lien_id'         => createPageLink('post', 'fil_post'),	// Lien de la page à charger lorsque l'édition du post échoue faut d'id valide
				'post_validation_edition_lien_succes'     => createPageLink('post', 'lecture'),	// Lien de la page à charger lorsque l'édition du post réussie
			/* commentaire_edition */
				'post_commentaire_edition_lien_erreur_id'           => createPageLink('post', 'fil_post'),							// Lien de la page à charger lorsqu'il n'y a pas l'id du commentaire à éditer précisé
				'post_commentaire_edition_lien_erreur_autorisation' => createPageLink('post', 'lecture'),							// Lien de la page à charger lorsque le visiteur n'a pas la permission d'éditer le commentaire
				'post_commentaire_edition_lien_erreur_existe'       => createPageLink('post', 'fil_post'),							// Lien de la page à charger lorsque le commentaire à éditer n'existe pas
				'post_commentaire_edition_formulaire_action'        => createPageLink('post', 'commentaire_validation_edition'),	// Lien redirigeant le formulaire d'édition de commentaire
				'post_commentaire_edition_admin_application'        => 'core',														// Application dont la permission est nécessaire pour éditer les commentaires des autres
				'post_commentaire_edition_admin_action'             => 'edition_commentaire',										// Action dont la permission est nécessaire pour éditer les commentaires des autres
			/* commentaire_validation_edition */
				'post_commentaire_validation_edition_lien_formulaire' => createPageLink('post', 'fil_post'),	// Lien de la page à charger lorsque l'édition du commentaire échoue faute d'arguments
				'post_commentaire_validation_edition_lien_id'         => createPageLink('post', 'fil_post'),	// Lien de la page à charger lorsque l'édition du commentaire échoue faut d'id valide
				'post_commentaire_validation_edition_lien_succes'     => createPageLink('post', 'lecture'),	// Lien de la page à charger lorsque l'édition du commentaire réussie
);

?>