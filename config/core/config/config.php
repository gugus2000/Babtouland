<?php

$config=array(
	/* Paramètre par défaut modifiable */
		'config_utilisateur' => array(
			/* Général */
				'lang' => 'FR',
			/* Post */
				/* Fil post */
					'post_fil_post_nombre_posts' => 4,	// Nombre de posts dans fil_post par défaut

		),
	/* Paramètre non modifiable */
		/* Routage */
			'nom_parametres' => 'parametres',
		/* Page */
			/* PageElement */
				/* Page */
					'pageElement_page_template'  => 'assets/html/core/page/page.html',		// Chemin vers la template de la page
					'pageElement_page_fonctions' => 'func/core/page/page.func.php',			// Chemin vers les fonctions de la page
					'pageElement_page_elements'       => array(),							// Chemin vers les éléments de la page
				/* Contenu */
					'filename_contenu_template'  => 'template.html',
					'filename_contenu_fonctions' => 'func.php',
				/* Tete */
					'tete_path_template'  => 'core/page/tete.html',
					'tete_path_fonctions' => 'core/page/tete.func.php',
					'tete_metas'       => array(
						array(
							'http-equiv' => 'X-UA-Compatible',
							'content'    => 'IE=edge',
						),
						array(
							'name'    => 'viewport',
							'content' => 'width=device-width, initial-scale=1',
						),
					),																																																			// Métadonnées de la page par défaut
					'tete_css'         => array(
						'assets/font/material icons/material-icons.css',
						'assets/font/Jaapokki/Jaapokki.css',
						'assets/font/Roboto/Roboto.css',
						'assets/css/main.css',
						'assets/css/reset.css',
						'assets/css/normalize.css',
					),							// Css de la page par défaut
					'tete_javascripts' => array(),																																												// javascripts de la page par défaut
					'tete_nom'         => 'tete',
				/* Titre */
					'prefixe_titre' => ' | Babtouland',
				/* Corps */
					'corps_path_template'  => 'core/page/corps.html',
					'corps_path_fonctions' => 'core/page/corps.func.php',
					'corps_nom'            => 'corps',
				/* Temps */
					'temps_nom'           => 'temps',
					'temps_path_template' => 'core/page/temps.html',
					'temps_path_css'      => 'css/temps.css',
				/* MenuSide */
					'menuSide_path_template'               => 'core/menu-side/menu-side.html',
					'menuSide_path_css'                    => 'css/menu-side.css',
					'menuSide_bouton_path_template'        => 'core/menu-side/bouton.html',
					'menuSide_boutonsListe_path_template'  => 'core/menu-side/liste_boutons.html',
					'menuSide_boutonsListe_path_fonctions' => 'core/boutons-liste/boutons-liste.func.php',
				/* MenuUp */
					'menuUp_path_template'   => 'core/menu-up/menu-up.html',
					'menuUp_path_fonctions'  => 'core/menu-up/menu-up.func.php',
					'menuUp_path_css'        => 'css/menu-up.css',
					'menuUp_path_javascript' => 'js/menu-up.js',
					'menuUp_lien_logo'       => array(),
				/* Dropdown */
					'dropdown_path_template'  => 'core/menu-up/dropdown.html',
					'dropdown_path_fonctions' => 'core/menu-up/dropdown.func.php',
					'dropdown_path_css'       => 'css/dropdown.css',
				/* Carte */
					'carte_path_template'  => 'core/carte/carte.html',
					'carte_path_fonctions' => 'core/carte/carte.func.php',
				/* Formulaire */
					'formulaire_path_template'  => 'core/formulaire/formulaire.html',
					'formulaire_path_fonctions' => 'core/formulaire/formulaire.func.php',
					'formulaire_path_css'       => 'css/formulaire.css',
				/* Toast */
					'toast_path_template'   => 'core/toast/toast.html',
					'toast_path_fonctions'  => 'core/toast/toast.func.php',
					'toast_path_css'        => 'css/toast.css',
					'toast_path_javascript' => 'js/toast.js',
				/* Notification */
					'notification_path_template' => 'core/notification/notification.html',	// Template des messages
					'notification_path_css'      => 'css/notification.css',								// Css des messages
					'notification_path_js'       => 'js/notification.js',								// Js des messages
					'notification_elements'      => array(),
					'notification_nom'          => 'notifications',
		/* BBcode */
			'bbcode_css'    => 'css/bbcode.css',
			'bbcode_config' => 'config/core/bbcode/bbcode.php',
		/* Général */
			'nom_site'                 => 'Babtouland',					// Nom du site
			'mail_dev'                 => 'gugus2000@protonmail.com',		// Mail du développeur
			'defaut_application'       => 'user',
			'lang_available'           => array('FR', 'EN'),
			'application_modification' => 'core',
			'format_date'              => 'Y-m-d H:i:s',
			/* Utilisateur */
				'chemin_avatar'       => 'assets/img/avatar/',				// Chemin vers le dossier contenant les avatars
				'size_avatar'         => 1000000,							// Taille de l'avatar maximum
				'width_avatar'        => 1000,								// Longueur horizontale maximum de l'avatar
				'height_avatar'       => 1000,								// Longueur verticale maximum de l'avatar
				'ext_avatar'          => array('jpg','gif','png','jpeg'),	// Extensions autorisé pour uploader un avatar
				'id_conversation_all' => 1, 								// Id de la conversation disponible à tous
				'intervalle_connecte' => 'PT5M',
			/* Path */
				/*'assets */
					'path_assets'   => 'assets/',
					'path_template' => 'assets/html/',
				/* config */
					'path_config' => 'config/',
					'path_lang'   => 'config/core/lang/',
				/* Func */
					'path_func' => 'func/',
				/* Définitions des pages */
					'path_pageDef_root'     => 'config/',			// Chemin vers la racine des configurations des pages
					'path_pageDef_filename' => 'config.php',		// Nom du fichier de la configuration d'une page
			/* Menu-up */
				'menu-up_liens'       => array(array(), array('application' => 'post', 'action' => 'fil_post'), array('application' => 'utile', 'action' => 'a_propos'), array('application' => 'chat', 'action' => 'hub'), array('application' => 'forum', 'action' => 'voir_dossier'), array('application' => 'admin', 'action' => 'hub')),	// Liste des liens dans le menu_up (dans l'ordre)
				'menu-up_icones'      => array('home', 'view_list', 'info', 'chat', 'forum', 'security'),														// Liste des icones du menu_up version petit_ecran (dans l'ordre)
				'menu-up_lien-statut' => array('application' => 'user', 'action' => 'statut'),														// Lien lors du clic sur l'avatar dans le menu_up
			/* Menu-side */
				'menu-side_css'      => 'assets/css/menu-side.css',
				'menu-side_js'       => '',
				'menu-side_template' => 'assets/html/menu-side.html',
				'menu-side_func'     => 'func/user/menu-side.func.php',
			/* Session Guest */
				'nom_guest' => 'guest',	// pseudo de l'utilisateur "guest"
				'mdp_guest' => 'guest',	// mot de passe de l'utilisateur "guest"
				'id_guest'  => 12,		// A CHANGER POUR CHAQUE BDD
			/* Erreur */
				'erreur_path' => 'erreur/page.php',	// Chemin vers la page d'erreur
		/* admin */
			'defaut_admin_action' => 'hub',
			/* hub */
				'admin_hub_lien_liste_utilisateur'    => array('application' => 'utile', 'action' => 'liste_user'),
				'admin_hub_publier_notification_lien' => array('application' => 'admin', 'action' => 'publier_notification'),
			/* publier_notification */
				'admin_publier_notification_formulaire_action' => array('application' => 'admin', 'action' => 'validation_publier_notification'),
			/* validation_publier_notification */
				'admin_validation_publier_notification_succes'                         => array('application' => 'admin', 'action' => 'hub'),
				'admin_validation_publier_notification_erreur_vide'                    => array('application' => 'admin', 'action' => 'publier_notification'),
				'admin_validation_publier_notification_utilisateurs_erreur_formulaire' => array('application' => 'admin', 'action' => 'publier_notification'),
		/* user */
			'defaut_user_action' => 'statut',
			/* inscription */
				'default_avatar'          => 'default.png',										// Avatar par défaut des nouveaux utilisateurs
				'default_banni'           => False,												// Statut par défaut des nouveaux utilisateurs
				'default_role'            => 'membre',											// Role par défaut des nouveaux utilisateurs
				'user_inscription_action' => array('application' => 'user', 'action' => 'validation_inscription'),	// Lien redirigeant le formulaire d'inscription
			/* connexion */
				'user_connexion_action' => array('application' => 'user', 'action' => 'validation_connexion'),	// Lien redirigeant le formulaire de connexion
			/* 'user_deconnexion */
				'user_deconnexion_lien' => array('application' => 'user', 'action' => 'statut'),
			/* statut */
				'user_statut_lien_connexion'      => array('application' => 'user', 'action' => 'connexion'),		// Lien pour se connecter affiché dans la page de statut
				'user_statut_lien_inscription'    => array('application' => 'user', 'action' => 'inscription'),	// Lien pour s'inscrire affiché dans la page de statut
				'user_statut_lien_deconnexion'    => array('application' => 'user', 'action' => 'deconnexion'),	// Lien pour se déconnecter affiché dans la page de statut
				'user_statut_lien_edition'        => array('application' => 'user', 'action' => 'edition'),			// Lien pour éditer son profil affiché dans la page de statut
				'user_statut_lien_configurations' => array('application' => 'user', 'action' => 'configurations'),
			/* validation_connexion */
				'user_validation_connexion_retour'  => array('application' => 'user', 'action' => 'connexion'),	// Lien de la page à charger lorsque la connexion échoue
				'user_validation_connexion_suivant' => array(),					// Lien de la page à charger lorsque la connexion réussie
			/* validation_inscription */
				'user_validation_inscription_retour'  => array('application' => 'user', 'action' => 'inscription'),	// Lien de la page à charger lorsque l'inscription échoue
				'user_validation_inscription_suivant' => array(),													// lien de la page à charger lorsque l'inscription réussie
			/* edition */
				'user_edition_action'            => array('application' => 'user', 'action' => 'validation_edition'),	// Lien redirigeant le formulaire d'édition d'utilisateur
				'user_edition_admin_application' => 'core',											// Application dont la permission est nécessaire pour éditer un aure utiliasateur
				'user_edition_admin_action'      => 'edition_user',									// Action dont la permission est nécessaire pour éditer un aure utiliasateur
				'user_edition_parametres'        => array('id'),
			/* validation_edition */
				'user_validation_edition_lien_erreur_formulaire'       => array('application' => 'user', 'action' => 'statut'),	// Lien de la page à charger lorsque l'édition de l'utilisateur échoue
				'user_validation_edition_lien_succes'                  => array('application' => 'user', 'action' => 'statut'),	// Lien de la page à charger lorsque l'édition de son profil réussie
				'user_validation_edition_lien_admin_succes'            => array('application' => 'user', 'action' => 'view'),		// Lien de la page à charger lorsque l'édition d'un autre utilisateur réussie
				'user_validation_edition_avatar_lien_erreur_dossier'   => array('application' => 'user', 'action' => 'statut'),	// Lien de la page à charger lorsque l'édition de l'avatar échoue pour cause de droit de dossier
				'user_validation_edition_avatar_lien_erreur_upload'    => array('application' => 'user', 'action' => 'statut'),	// Lien de la page à charger lorsque l'édition de l'avatar échoue pour cause d'upload non fonctionnel
				'user_validation_edition_avatar_lien_erreur_interne'   => array('application' => 'user', 'action' => 'statut'),	// Lien de la page à charger lorsque l'édition de l'avatar échoue pour cause d'erreur interne
				'user_validation_edition_avatar_lien_erreur_type'      => array('application' => 'user', 'action' => 'statut'),	// Lien de la page à charger lorsque l'édition de l'avatar échoue pour cause d'erreur de type de fichier
				'user_validation_edition_avatar_lien_erreur_extension' => array('application' => 'user', 'action' => 'statut'),	// Lien de la page à charger lorsque l'édition de l'avatar échoue pour cause de mauvaise extension de fichier
				'user_validation_edition_avatar_lien_erreur_dimension' => array('application' => 'user', 'action' => 'statut'),	// Lien de la page à charger lorsque l'édition de l'avatar écgoue pour cause de mauvaise dimension
				'user_validation_edition_parametres'                   => array('id'),
			/* configurations */
				'user_configurations_formulaire_action' => array('application' => 'user', 'action' => 'validation_configurations'),
			/* validation_configurations */
				'user_validation_configurations_erreur_formulaire_mal_remplit' => array('application' => 'user', 'action' => 'configurations'),
				'user_validation_configurations_erreur_formulaire_vide'        => array('application' => 'user', 'action' => 'configurations'),
				'user_validation_configurations_succes'                        => array(),
			/* view */
				'user_view_action_statut_editer_lien' => array('application' => 'user', 'action' => 'statut'),
				'user_view_action_envoyer_mp_lien'    => array('application' => 'chat', 'action' => 'envoyer_mp'),
				'user_view_parametres'                => array('id'),
		/* utile */
			'defaut_utile_action' => 'a_propos',
			/* a_propos */
				'utile_a_propos_formulaire_action' => array('application' => 'utile', 'action' => 'mail'),	// Lien redirigeant le formulaire d'envoi de mail
			/* mail */
				'utile_mail_lien_erreur_formulaire' => array('application' => 'utile', 'action' => 'a_propos'),	// Lien de la page à charger lorsque l'envoi du mail échoue
				'utile_mail_lien_succes'            => array('application' => 'utile', 'action' => 'a_propos'),	// Lien de la page à charger lorsque l'envoi du mail réussi
		/* post */
			'defaut_post_action' => 'fil_post',
			/* fil_post */
				'post_fil_post_default_page'     => 1,																						// Numéro de la page a afficher si non précisé
				'post_fil_post_lien_detail'      => array('application' => 'post', 'action' => 'lecture'),				// Lien vers la page de lecture complète du post
				'post_fil_post_lien_auteur'      => array('application' => 'user', 'action' => 'view'),				// Lien vers la page de présentation de l'auteur
				'post_fil_post_lien_publication' => array('application' => 'post', 'action' => 'publication'),			// Lien vers la page de publication de post
				'post_fil_post_nav_page_lien'    => array('application' => 'post', 'action' => 'fil_post'),
				'post_fil_post_tri'              => 'date_publication',																		// Attribut fixant la position des posts
				'post_fil_post_parametres'       => array('page'),
			/* publication */
				'post_publication_action' => array('application' => 'post', 'action' => 'validation_publication'),	// Lien redirigeant le formulaire de publication de post
			/* validation_publication */
				'post_validation_publication_suivant' => array('application' => 'post', 'action' => 'fil_post'),			// Lien de la page à charger lorque la publication du post échoue
				'post_validation_publication_retour'  => array('application' => 'post', 'action' => 'publication'),			// Lien de la page à charger lorque la publication du post réussie
			/* lecture */
				'post_lecture_lien_auteur'                  => array('application' => 'user', 'action' => 'view'),						// Lien vers la page de présentation de l'auteur
				'post_lecture_lien_mise_a_jour'             => array('application' => 'post', 'action' => 'edition'),					// Lien vers la page de la mise à jour dudit post
				'post_lecture_lien_suppression'             => array('application' => 'post', 'action' => 'suppression'),				// Lien vers la page de la suppression dudit post
				'post_lecture_publication_commentaire'      => array('application' => 'post', 'action' => 'commentaire_publication'),	// Lien redirigeant le formulaire de publication de commentaire
				'post_lecture_lien_commentaire_suppression' => array('application' => 'post', 'action' => 'commentaire_suppression'),	// Lien vers la page de la suppression dudit commentaire
				'post_lecture_lien_commentaire_edition'     => array('application' => 'post', 'action' => 'commentaire_edition'),		// Lien vers la page d'édition dudit commentaire
				'post_lecture_parametres'                   => array('id'),
			/* commentaire_publication */
				'post_commentaire_publication_suivant'    => array('application' => 'post', 'action' => 'lecture'),	// Lien de la page à charger lorsque la publication du commentaire a échoué
				'post_commentaire_publication_retour'     => array('application' => 'post', 'action' => 'lecture'),	// Lien de la page à charger lorsque la publication du commentaire a réussie
				'post_commentaire_publication_parametres' => array('id'),
			/* suppression */
				'post_suppression_retour'            => array('application' => 'post', 'action' => 'fil_post'),		// Lien de la page à charger lorsque la suppression d'un post échoue faute d'id
				'post_suppression_permission'        => array('application' => 'post', 'action' => 'lecture'),		// Lien de la page à charger lorsque la suppression d'un post échoue faute de permission
				'post_suppression_suivant'           => array('application' => 'post', 'action' => 'fil_post'),		// Lien de la page à charger lorsque la suppression d'un post réussie
				'post_suppression_admin_application' => 'core',												// Application dont la permission est nécessaire pour supprimer les posts des autres
				'post_suppression_admin_action'      => 'suppression_post',									// Action dont la permission est nécessaire pour supprimer les posts des autres
				'post_suppression_parametres'        => array('id'),
			/* commentaire_suppression */
				'post_commentaire_suppression_retour'            => array('application' => 'post', 'action' => 'fil_post'),	// Lien de la page à charger lorsque la suppression d'un commentaire échoue faute d'id
				'post_commentaire_suppression_permission'        => array('application' => 'post', 'action' => 'lecture'),		// Lien de la page à charger lorsque la suppression d'un commentaire échoue faute de permission
				'post_commentaire_suppression_suivant'           => array('application' => 'post', 'action' => 'lecture'),		// Lien de la page à charger lorsque la suppression d'un commentaire réussie
				'post_commentaire_suppression_admin_application' => 'core',												// Application dont la permission est nécessaire pour supprimer les posts des autres
				'post_commentaire_suppression_admin_action'      => 'suppression_commentaire',							// Action dont la permission est nécessaire pour supprimer les posts des autres
				'post_commentaire_suppression_parametres'        => array('id'),
			/* edition */
				'post_edition_lien_erreur_id'           => array('application' => 'post', 'action' => 'fil_post'),				// Lien de la page à charger lorsqu'il n'y a pas l'id du post à éditer précisé
				'post_edition_lien_erreur_autorisation' => array('application' => 'post', 'action' => 'lecture'),				// Lien de la page à charger lorsque le visiteur n'a pas la permission d'éditer le post
				'post_edition_lien_erreur_existe'       => array('application' => 'post', 'action' => 'fil_post'),				// Lien de la page à charger lorsque le post à éditer n'existe pas
				'post_edition_formulaire_action'        => array('application' => 'post', 'action' => 'validation_edition'),	// Lien redirigeant le formulaire d'édition de post
				'post_edition_admin_application'        => 'core',														// Application dont la permission est nécessaire pour éditer les posts des autres
				'post_edition_admin_action'             => 'edition_post',												// Action dont la permission est nécessaire pour éditer les posts des autres
				'post_edition_parametres'               => array('id'),
			/* validation_edition */
				'post_validation_edition_lien_formulaire' => array('application' => 'post', 'action' => 'fil_post'),	// Lien de la page à charger lorsque l'édition du post échoue faute d'arguments
				'post_validation_edition_lien_id'         => array('application' => 'post', 'action' => 'fil_post'),	// Lien de la page à charger lorsque l'édition du post échoue faut d'id valide
				'post_validation_edition_lien_succes'     => array('application' => 'post', 'action' => 'lecture'),		// Lien de la page à charger lorsque l'édition du post réussie
				'post_validation_edition_parametres'      => array('id'),
			/* commentaire_edition */
				'post_commentaire_edition_lien_erreur_id'           => array('application' => 'post', 'action' => 'fil_post'),							// Lien de la page à charger lorsqu'il n'y a pas l'id du commentaire à éditer précisé
				'post_commentaire_edition_lien_erreur_autorisation' => array('application' => 'post', 'action' => 'lecture'),							// Lien de la page à charger lorsque le visiteur n'a pas la permission d'éditer le commentaire
				'post_commentaire_edition_lien_erreur_existe'       => array('application' => 'post', 'action' => 'fil_post'),							// Lien de la page à charger lorsque le commentaire à éditer n'existe pas
				'post_commentaire_edition_formulaire_action'        => array('application' => 'post', 'action' => 'commentaire_validation_edition'),	// Lien redirigeant le formulaire d'édition de commentaire
				'post_commentaire_edition_admin_application'        => 'core',																	// Application dont la permission est nécessaire pour éditer les commentaires des autres
				'post_commentaire_edition_admin_action'             => 'edition_commentaire',													// Action dont la permission est nécessaire pour éditer les commentaires des autres
				'post_commentaire_edition_parametres'               => array('id'),
			/* commentaire_validation_edition */
				'post_commentaire_validation_edition_lien_formulaire'   => array('application' => 'post', 'action' => 'fil_post'),	// Lien de la page à charger lorsque l'édition du commentaire échoue faute d'arguments
				'post_commentaire_validation_edition_lien_id'           => array('application' => 'post', 'action' => 'fil_post'),	// Lien de la page à charger lorsque l'édition du commentaire échoue faut d'id valide
				'post_commentaire_validation_edition_lien_permission'   => array('application' => 'post', 'action' => 'lecture'),
				'post_commentaire_validation_edition_lien_succes'       => array('application' => 'post', 'action' => 'lecture'),	// Lien de la page à charger lorsque l'édition du commentaire réussie
				'post_commentaire_validation_edition_parametres'        => array('id'),
		/* erreur */
			'defaut_erreur_action' => 'erreur',
		/* chat */
			'defaut_chat_action' => 'hub',
			'chat_temps_0'       => '2019-01-01 00:00:00',
			/* hub */
				'chat_hub_lien_voir_conversation'    => array('application' => 'chat', 'action' => 'voir_conversation'),
				'chat_hub_lien_ajouter_conversation' => array('application' => 'chat', 'action' => 'ajouter_conversation'),
			/* voir_conversation */
				'chat_voir_conversation_form_action'                  => array('application' => 'chat', 'action' => 'envoyer_message'),
				'chat_voir_conversation_date_comparaison'             => 'PT10M',
				'chat_voir_conversation_message_edition'              => array('application' => 'chat', 'action' => 'editer_message'),
				'chat_voir_conversation_message_suppression'          => array('application' => 'chat', 'action' => 'supprimer_message'),
				'chat_voir_conversation_toast_editer_conversation'    => array('application' => 'chat', 'action' => 'editer_conversation'),
				'chat_voir_conversation_toast_supprimer_conversation' => array('application' => 'chat', 'action' => 'supprimer_conversation'),
				'chat_voir_conversation_menuside_lien_utilisateur'    => array('application' => 'user', 'action' => 'view'),
				'chat_voir_conversation_parametres'                   => array('id'),
			/* envoyer_message */
				'chat_envoyer_message_erreur_id_conversation' => array('application' => 'chat', 'action' => 'hub'),
				'chat_envoyer_message_erreur_permission'      => array('application' => 'chat', 'action' => 'voir_conversation'),
				'chat_envoyer_message_erreur_contenu'         => array('application' => 'chat', 'action' => 'voir_conversation'),
				'chat_envoyer_message_succes'                 => array('application' => 'chat', 'action' => 'voir_conversation'),
				'chat_envoyer_message_parametres'             => array('id'),
			/* editer_message */
				'chat_editer_message_admin_application'                => 'core',
				'chat_editer_message_admin_action'                     => 'editer_message',
				'chat_editer_message_erreur_id_message'                => array('application' => 'chat', 'action' => 'hub'),
				'chat_editer_message_erreur_conversation_autorisation' => array('application' => 'chat', 'action' => 'hub'),
				'chat_editer_message_erreur_message_autorisation'      => array('application' => 'chat', 'action' => 'voir_conversation'),
				'chat_editer_message_form_action'                      => array('application' => 'chat', 'action' => 'validation_editer_message'),
				'chat_editer_message_parametres'                       => array('id'),
			/* supprimer_message */
				'chat_supprimer_message_admin_application'                => 'core',
				'chat_supprimer_message_admin_action'                     => 'supprimer_message',
				'chat_supprimer_message_erreur_id_message'                => array('application' => 'chat', 'action' => 'hub'),
				'chat_supprimer_message_erreur_conversation_autorisation' => array('application' => 'chat', 'action' => 'hub'),
				'chat_supprimer_message_erreur_message_autorisation'      => array('application' => 'chat', 'action' => 'voir_conversation'),
				'chat_supprimer_message_succes'                           => array('application' => 'chat', 'action' => 'voir_conversation'),
				'chat_supprimer_message_parametres'                       => array('id'),
			/* validation_editer_message */
				'chat_validation_editer_message_succes'     => array('application' => 'chat', 'action' => 'voir_conversation'),
				'chat_validation_editer_message_parametres' => array('id'),
			/* envoyer_mp */
				'chat_envoyer_mp_notification_erreur_soi_meme' => array('application' => 'user', 'action' => 'statut'),
				'chat_envoyer_mp_notification_erreur_guest'    => array('application' => 'user', 'action' => 'statut'),
				'chat_envoyer_mp_notification_erreur_no_id'    => array('application' => 'user', 'action' => 'statut'),
				'chat_envoyer_mp_form_action'                  => array('application' => 'chat', 'action' => 'validation_envoyer_mp'),
				'chat_envoyer_mp_parametres'                   => array('id'),
			/* validation_envoyer_mp */
				'chat_validation_envoyer_mp_notification_succes'              => array('application' => 'chat', 'action' => 'voir_conversation'),
				'chat_validation_envoyer_mp_notification_erreur_message_vide' => array('application' => 'chat', 'action' => 'envoyer_mp'),
				'chat_validation_envoyer_mp_notification_erreur_formulaire'   => array('application' => 'chat', 'action' => 'envoyer_mp'),
				'chat_validation_envoyer_mp_notification_erreur_plusieurs_mp' => array('application' => 'user', 'action' => 'view'),
				'chat_validation_envoyer_mp_notification_erreur_soi_meme'     => array('application' => 'user', 'action' => 'statut'),
				'chat_validation_envoyer_mp_notification_erreur_guest'        => array('application' => 'user', 'action' => 'statut'),
				'chat_validation_envoyer_mp_notification_erreur_no_id'        => array('application' => 'user', 'action' => 'statut'),
				'chat_validation_envoyer_mp_parametres'                       => array('id'),
			/* ajouter_conversation */
				'chat_ajouter_conversation_formulaire_action' => array('application' => 'chat', 'action' => 'validation_ajouter_conversation'),
			/* validation_ajouter_conversation */
				'chat_validation_ajouter_conversation_notification_succes'                  => array('application' => 'chat', 'action' => 'voir_conversation'),
				'chat_validation_ajouter_conversation_notification_erreur_pas_utilisateur'  => array('application' => 'chat', 'action' => 'ajouter_conversation'),
				'chat_validation_ajouter_conversation_notification_erreur_formulaire_vide'  => array('application' => 'chat', 'action' => 'ajouter_conversation'),
				'chat_validation_ajouter_conversation_notification_erreur_formulaire_envoi' => array('application' => 'chat', 'action' => 'ajouter_conversation'),
			/* editer_conversation */
				'chat_editer_conversation_formulaire_action'                => array('application' => 'chat', 'action' => 'validation_editer_conversation'),
				'chat_editer_conversation_notification_erreur_autorisation' => array('application' => 'chat', 'action' => 'hub'),
				'chat_editer_conversation_notification_erreur_general'      => array('application' => 'chat', 'action' => 'voir_conversation'),
				'chat_editer_conversation_notification_erreur_id'           => array('application' => 'chat', 'action' => 'hub'),
				'chat_editer_conversation_parametres'                       => array('id'),
			/* validation_editer_conversation */
				'chat_validation_editer_conversation_notification_erreur_autorisation'     => array('application' => 'chat', 'action' => 'hub'),
				'chat_validation_editer_conversation_notification_erreur_general'          => array('application' => 'chat', 'action' => 'voir_conversation'),
				'chat_validation_editer_conversation_notification_erreur_id'               => array('application' => 'chat', 'action' => 'hub'),
				'chat_validation_editer_conversation_notification_succes'                  => array('application' => 'chat', 'action' => 'voir_conversation'),
				'chat_validation_editer_conversation_notification_erreur_pas_utilisateur'  => array('application' => 'chat', 'action' => 'ajouter_conversation'),
				'chat_validation_editer_conversation_notification_erreur_formulaire_vide'  => array('application' => 'chat', 'action' => 'ajouter_conversation'),
				'chat_validation_editer_conversation_notification_erreur_formulaire_envoi' => array('application' => 'chat', 'action' => 'ajouter_conversation'),
				'chat_validation_editer_conversation_parametres'                           => array('id'),
			/* supprimer_conversation */
				'chat_supprimer_conversation_notification_succes'              => array('application' => 'chat', 'action' => 'hub'),
				'chat_supprimer_conversation_notification_erreur_autorisation' => array('application' => 'chat', 'action' => 'hub'),
				'chat_supprimer_conversation_notification_erreur_general'      => array('application' => 'chat', 'action' => 'voir_conversation'),
				'chat_supprimer_conversation_notification_erreur_id'           => array('application' => 'chat', 'action' => 'hub'),
				'chat_supprimer_conversation_parametres'                       => array('id'),
		/* xhr */
			'defaut_xhr_action' => 'chat',
			/* chat */
				'xhr_chat_parametres' => array('id', 'date_chargement'),
			/* liste_membre_conversation */
				'xhr_liste_membre_conversation_parametres' => array('id'),
			/* lang */
				'xhr_lang_parametres' => array('clef'),
		/* forum */
			'forum_root_id'       => 1,
			'defaut_forum_action' => 'voir_dossier',
			/* voir_dossier */
				'forum_voir_dossier_notification_erreur_dossier' => array('application' => 'forum', 'action' => 'voir'),
				'forum_voir_dossier_enfants_lien_dossier'        => array('application' => 'forum', 'action' => 'voir_dossier'),
				'forum_voir_dossier_enfants_lien_fil'            => array('application' => 'forum', 'action' => 'voir_fil'),
				'forum_voir_dossier_lien_ajout'                  => array('application' => 'forum', 'action' => 'ajout'),
				'forum_voir_dossier_lien_edition'                => array('application' => 'forum', 'action' => 'edition'),
				'forum_voir_dossier_lien_suppression'            => array('application' => 'forum', 'action' => 'suppression'),
				'forum_voir_dossier_parametres'                  => array('id'),
			/* ajout */
				'forum_ajout_parametres'        => array('id_parent'),
				'forum_ajout_formulaire_action' => array('application' => 'forum', 'action' => 'validation_ajout'),
			/* validation_ajout */
				'forum_validation_ajout_notification_succes'            => array('application' => 'forum'),
				'forum_validation_ajout_notification_erreur_formulaire' => array('application' => 'forum', 'action' => 'voir_dossier'),
				'forum_validation_ajout_notification_erreur_id'         => array('application' => 'forum', 'action' => 'voir_dossier'),
				'forum_validation_ajout_parametres'                     => array('id_parent'),
			/* voir_fil */
				'forum_voir_fil_notification_erreur_id'   => array('application' => 'forum', 'action' => 'voir_dossier'),
				'forum_voir_fil_notification_erreur_fil'  => array('application' => 'forum', 'action' => 'voir'),
				'forum_voir_fil_chemin_lien'              => array('application' => 'forum', 'action' => 'voir'),
				'forum_voir_fil_lien_message_edition'     => array('application' => 'forum', 'action' => 'message_edition'),
				'forum_voir_fil_lien_message_suppression' => array('application' => 'forum', 'action' => 'message_suppression'),
				'forum_voir_fil_lien_message_ajout'       => array('application' => 'forum', 'action' => 'message_ajout'),
				'forum_voir_fil_lien_edition'             => array('application' => 'forum', 'action' => 'edition'),
				'forum_voir_fil_lien_suppression'         => array('application' => 'forum', 'action' => 'suppression'),
				'forum_voir_fil_message_lien_auteur'      => array('application' => 'user', 'action' => 'view'),
				'forum_voir_fil_parametres'               => array('id'),
			/* voir */
				'forum_voir_no_id'      => array('application' => 'forum', 'action' => 'voir_dossier'),
				'forum_voir_dossier'    => array('application' => 'forum', 'action' => 'voir_dossier'),
				'forum_voir_fil'        => array('application' => 'forum', 'action' => 'voir_fil'),
				'forum_voir_defaut'     => array('application' => 'forum', 'action' => 'voir_dossier'),
				'forum_voir_parametres' => array('id'),
			/* edition */
				'forum_edition_formulaire_action' => array('application' => 'forum', 'action' => 'validation_edition'),
				'forum_edition_parametres'        => array('id'),
			/* validation_edition */
				'forum_validation_edition_notification_succes'              => array('application' => 'forum', 'action' => 'voir'),
				'forum_validation_edition_notification_erreur_formulaire'   => array('application' => 'forum', 'action' => 'edition'),
				'forum_validation_edition_notification_erreur_autorisation' => array('application' => 'forum', 'action' => 'voir'),
				'forum_validation_edition_notification_erreur_id'           => array('application' => 'forum', 'action' => 'voir'),
				'forum_validation_edition_parametres'                       => array('id'),
			/* message_ajout */
				'forum_message_ajout_formulaire_action'        => array('application' => 'forum', 'action' => 'validation_message_ajout'),
				'forum_message_ajout_notification_erreur_id'   => array('application' => 'forum', 'action' => 'voir'),
				'forum_message_ajout_notification_erreur_type' => array('application' => 'forum', 'action' => 'voir'),
				'forum_message_ajout_parametres'               => array('id_fil'),
			/* validation_message_ajout */
				'forum_validation_message_ajout_notification_succes'                  => array('application' => 'forum', 'action' => 'voir_fil'),
				'forum_validation_message_ajout_notification_erreur_fil'              => array('application' => 'forum', 'action' => 'voir'),
				'forum_validation_message_ajout_notification_erreur_contenu_vide'     => array('application' => 'forum', 'action' => 'ajout_message'),
				'forum_validation_message_ajout_notification_erreur_contenu_indefini' => array('application' => 'forum', 'action' => 'ajout_message'),
				'forum_validation_message_ajout_notification_erreur_id'               => array('application' => 'forum', 'action' => 'voir'),
				'forum_validation_message_ajout_parametres'                           => array('id_fil'),
			/* message_edition */
				'forum_message_edition_formulaire_action'                => array('application' => 'forum', 'action' => 'validation_message_edition'),
				'forum_message_edition_notification_erreur_autorisation' => array('application' => 'forum', 'action' => 'voir_fil'),
				'forum_message_edition_notification_erreur_id'           => array('application' => 'forum', 'action' => 'voir'),
				'forum_message_edition_parametres'                       => array('id'),
			/* validation_message_edition */
				'forum_validation_message_edition_notification_succes'              => array('application' => 'forum', 'action' => 'voir_fil'),
				'forum_validation_message_edition_notification_erreur_autorisation' => array('application' => 'forum', 'action' => 'voir_fil'),
				'forum_validation_message_edition_notification_erreur_vide'         => array('application' => 'forum', 'action' => 'message_edition'),
				'forum_validation_message_edition_notification_erreur_formulaire'   => array('application' => 'forum', 'action' => 'message_edition'),
				'forum_validation_message_edition_notification_erreur_id'           => array('application' => 'forum', 'action' => 'voir'),
				'forum_validation_message_edition_parametres'                       => array('id'),
			/* message_suppression */
				'forum_message_suppression_notification_succes'              => array('application' => 'forum', 'action' => 'voir_fil'),
				'forum_message_suppression_notification_erreur_autorisation' => array('application' => 'forum', 'action' => 'voir_fil'),
				'forum_message_suppression_notification_erreur_id'           => array('application' => 'forum', 'action' => 'voir'),
				'forum_message_suppression_parametres'                       => array('id'),
			/* suppression */
				'forum_suppression_notification_succes'              => array('application' => 'forum', 'action' => 'voir_dossier'),
				'forum_suppression_notification_erreur_autorisation' => array('application' => 'forum', 'action' => 'voir'),
				'forum_suppression_notification_erreur_id'           => array('application' => 'forum', 'action' => 'voir'),
				'forum_suppression_parametres'                       => array('id'),
);

?>