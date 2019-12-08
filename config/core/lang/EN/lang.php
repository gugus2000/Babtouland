<?php

$lang=array(
	/* Général */
		'pseudo'   => 'pseudo',
		'mdp'      => 'password',
	/* Langue */
		'lang_self'   => array(
			'abbr' => 'EN',
			'full' => 'English',
		),
		'lang_others' => array(
			'FR' => array(
				'abbr' => 'FR',
				'full' => 'Français',
			),
		),
	/* Erreur */
		'erreur_general_fichier_introuvable'         => 'Page not found',
		'erreur_general_autorisations_insuffisantes' => 'Don\'t have permission',
		'erreur_connexion_mot_de_passe'              => 'Login error',
		'erreur_connexion_utilisateur'               => 'User don\'t exist',
		'erreur_titre'                               => 'Error',
		'erreur_description'                         => 'Error page',
	/* menu-up */
		'menu-up_accueil'    => 'Home',
		'menu-up_altlogo'    => 'Logo of ',
		'menu-up_avatar'     => 'Your avatar',
		'menu-up_titres'     => array('Home', 'Post thread', 'About', 'Chat', 'Admin'),
		'menu-up_affichages' => array('Home', 'Post', 'About', 'Chat', 'Admin'),
	/* tete */
		'tete_titre' => 'untitled',
	/* temps */
		'temps_debut' => 'Time to generate the webpage: ',
		'temps_fin'   => ' seconds',
	/* admin */
		/* hub */
			'admin_hub_titre'                            => 'Admin Control Panel',
			'admin_hub_description'                      => 'Page to admin the entire website',
			'admin_hub_nombre_utilisateurs'              => 'Number of users: ',
			'admin_hub_nombre_connectes'                 => 'Nomber of connected users: ',
			'admin_hub_ratio_connectes_debut'            => '',
			'admin_hub_ratio_connectes_fin'              => '% connected users',
			'admin_hub_liste_utilisateurs'               => 'List of users',
			'admin_hub_publier_notification_description' => 'Send a notification',
		/* publier_notification */
			'admin_publier_notification_titre'                         => 'Send a notification',
			'admin_publier_notification_description'                   => 'Allows to send a cibled public notification',
			'admin_publier_notification_formulaire_legend'             => 'Publish a notification',
			'admin_publier_notification_formulaire_label_message'      => 'Notification: ',
			'admin_publier_notification_formulaire_label_type'         => 'Type: ',
			'admin_publier_notification_formulaire_succes'             => 'Success',
			'admin_publier_notification_formulaire_erreur'             => 'Error',
			'admin_publier_notification_formulaire_attention'          => 'Warning',
			'admin_publier_notification_formulaire_label_groupe'       => 'Concerned group: ',
			'admin_publier_notification_formulaire_tous'               => 'All',
			'admin_publier_notification_formulaire_label_utilisateurs' => 'Concerned users of the group: ',
			'admin_publier_notification_formulaire_submit'             => 'SEND',
		/* validation_publier_notification */
			'admin_validation_publier_notification_attention_utilisateurs_vide'    => 'Warning: this notification don\'t gave any receiver',
			'admin_validation_publier_notification_succes'                         => 'Notification well published',
			'admin_validation_publier_notification_erreur_vide'                    => 'Some needed input are empty',
			'admin_validation_publier_notification_utilisateurs_erreur_formulaire' => 'Form not or incorrectly completed',
	/* user */
		'user_formulairepseudo' => 'Username:',
		'user_formulairemdp'    => 'Password:',
		'user_formulairemail'   => 'E-Mail: ',
		/* connexion */
			'user_connexion_fieldset'    => 'Login',
			'user_connexion_submit'      => 'LOG IN',
			'user_connexion_titre'       => 'sign in',
			'user_connexion_description' => 'Login page',
		/* inscription */
			'user_inscription_fieldset'    => 'Registration',
			'user_inscription_submit'      => 'REGISTER',
			'user_inscription_titre'       => 'sign up',
			'user_inscription_description' => 'Registration page',
		/* validation_connexion */
			'user_validation_connexion_succes'     => 'You are well logged in',
			'user_validation_connexion_formulaire' => 'Form not or incorrectly completed',
		/* validation_inscription */
			'user_validation_inscription_succes'     => 'You are well registered',
			'user_validation_inscription_pseudo'     => 'The username already exists',
			'user_validation_inscription_formulaire' => 'Form not or incorrectly completed',
		/* statut */
			'user_statut_nologin'                       => 'You are not logged in',
			'user_statut_pseudo'                        => 'Your username: ',
			'user_statut_avatar'                        => 'Your avatar: ',
			'user_statut_derndateco'                    => 'Last login date: ',
			'user_statut_premdatein'                    => 'Registration date: ',
			'user_statut_mail'                          => 'E-Mail: ',
			'user_statut_titre'                         => 'status',
			'user_statut_description'                   => 'Visitor status',
			'user_statut_titre_lien_connexion'          => 'Login page',
			'user_statut_affichage_lien_connexion'      => 'Sign in',
			'user_statut_titre_lien_inscription'        => 'Registration page',
			'user_statut_affichage_lien_inscription'    => 'Sign up',
			'user_statut_titre_lien_deconnexion'        => 'Logout page',
			'user_statut_affichage_lien_deconnexion'    => 'Log out',
			'user_statut_titre_lien_edition'            => 'profile edition page',
			'user_statut_affichage_lien_edition'        => 'Edit your profile',
			'user_statut_titre_lien_langage'            => 'View in french',
			'user_statut_affichage_lien_langage'        => 'Change language',
			'user_statut_titre_lien_configurations'     => 'Configure the settings',
			'user_statut_affichage_lien_configurations' => 'Configure',
		/* deconnexion */
			'user_deconnexion_message' => 'Succesful logout',
		/* edition */
			'user_edition_titre'        => 'User editing',
			'user_edition_description'  => 'This page allowing you to edit certain characteristics of your profile',
			'user_edition_legend'       => 'Edition of ',
			'user_edition_label_avatar' => 'Avatar: ',
			'user_edition_label_mail'   => 'E-Mail :',
			'user_edition_submit'       => 'EDIT',
			'user_edition_label_banni'  => 'Banned: ',
		/* validation_edition */
			'user_validation_edition_message_formulaire'              => 'Form not or incorrectly completed',
			'user_validation_edition_message_succes'                  => 'Your profile has been modified',
			'user_validation_edition_message_admin_succes'            => 'The user\'s profile has been modified',
			'user_validation_edition_avatar_message_erreur_dossier'   => 'Unable to create the folder for avatars',
			'user_validation_edition_avatar_message_erreur_upload'    => 'Problem when uploading the avatar',
			'user_validation_edition_avatar_message_erreur_interne'   => 'An internal error prevented the upload of the avatar',
			'user_validation_edition_avatar_message_erreur_type'      => 'The avatar to upload is not an image',
			'user_validation_edition_avatar_message_erreur_extension' => 'The avatar extension is invalid',
			'user_validation_edition_avatar_message_erreur_dimension' => 'Error in the avatar dimensions',
		/* view */
			'user_view_titre'                      => 'See profile',
			'user_view_description'                => 'Page to view another user\'s profile',
			'user_view_pseudo'                     => 'Pseudo: ',
			'user_view_avatar'                     => 'Avatar: ',
			'user_view_derndateco'                 => 'Last Login: ',
			'user_view_premdatein'                 => 'Registration: ',
			'user_view_avatar_alt'                 => 'Avatar of ',
			'user_view_action_statut_editer_title' => 'Edit your account',
			'user_view_action_statut_editer'       => 'Edit',
			'user_view_action_envoyer_mp_title'    => 'Send a Private Message',
			'user_view_action_envoyer_mp'          => 'Send PM',
		/* configurations */
			'user_configurations_titre'                                       => 'Configurations',
			'user_configurations_description'                                 => 'Set up your use of the site',
			'user_configurations_formulaire_legend'                           => 'Configurations',
			'user_configurations_formulaire_label_lang'                       => 'Language',
			'user_configurations_formulaire_label_post_fil_post_nombre_posts' => 'Number of posts per page in the posts thread',
			'user_configurations_formulaire_submit'                           => 'VALIDATE',
		/* validation_configurations */
			'user_validation_configurations_erreur_formulaire_mal_remplit'                      => 'Form not or incorrectly completed',
			'user_validation_configurations_erreur_formulaire_vide'                             => 'Some needed input are empty',
			'user_validation_configurations_attention_lang_pas_valide'                          => 'The asked language dosn\'t exist (or is not available)',
			'user_validation_configurations_attention_post_fil_post_nombre_posts_pas_numerique' => 'The number of post in the post thread must be a number',
			'user_validation_configurations_attention_post_fil_post_nombre_posts_pas_valide'    => 'The number of post in the post thread is invalid',
			'user_validation_configurations_succes'                                             => 'Configuration correctly applied',
	/* utile */
		/* a_propos */
			'utile_a_propos_titre'             => 'About',
			'utile_a_propos_description'       => 'Page about this website',
			'utile_a_propos_formulaire_legend' => 'Send a message',
			'utile_a_propos_formulaire_label'  => 'Message: ',
			'utile_a_propos_formulaire_submit' => 'SEND',
			'utile_a_propos_contenu_titre'     => 'About',
			'utile_a_propos_contenu_questions' => array('What is the purpose of this website?', 'Who his creator is ?', 'Confidentiality and data collection'),
			'utile_a_propos_contenu_reponses'  => array(
				'This site is a blog in which I express what I have in mind. Therefore, it is possible to see me express opinions, sometimes contrary to your own opinions: you can always make constructive comments or from this site. <br />
				You need to log in to write comments. Registration is, of course, free of charge. Over time, the site will develop new features through updates. <br />
				The code of this site is freely and openly accessible on Github <a href="https://github.com/gugus2000/Babtouland" title="Github of this site">here</a>.',
				'I am gugus2000, the creator of this site. This is for me the opportunity to test for the first time the launch of a fully operational website. <br />
				You have to know that development (web or not) is not my job. That\'s why this site is far from perfect, despite the fact that it\'s already at its 5th iteration. <br />
				The form at the bottom of this page allows you to contact me directly. I am also on Mastodont (@gugus2000@framapiaf.org) and on Discord (gugus2000#5074). Feel free to contact me if you need anything.',
				'Internet privacy is an important issue: this site does not include any user tracking used by advertising agencies or other tools external to the site.
				However, I use one and only one cookie: a session cookie. This is a cookie that allows you to authenticate yourself between each page of the site without having to log in again. This cookie is mandatory for the proper functioning of the site and is in no way distributed to third parties. <br />
				When you publish a comment on this site, you remain the author: you keep your rights and can modify or delete it without any problem. On the other hand, if this comment is defamatory or illegal in any way, it may be deleted by moderation ( including me). It is therefore a "retrospective" moderation <br />
				The site does not use any external resources, and is free of advertising. <br />
				As of August 8, 2019 (08/08/2019), this site is hosted by a service whose coordinates are as follows:<br />
				<ul>
					<li>Name: 000WEBHOST</li>
					<li>Web site: <a href="https://www.000webhost.com/" target="_blank">www.000webhost.com</a></li>
					<li>Contact information:<br />
					Address: 61 Lordou Vironos Street<br />
					6023 Larnaca, Cyprus<br />
					Email: contact@000webhost.com</li>
				</ul>
				<p class="left_align">As a result, some cookies can be set by this host, but it doesn\'t depend on me, don\'t hesitate to block them.<br />
				Finally, all my posts and the content of this site are available: you can distribute them, modify them for free. However, you will need to cite the source and clearly explain the change made if it occurs.<br />
				Any change in this text will be announced visibly to any user who is visibly new to the change.',
			),
		/* mail */
			'utile_mail_message_erreur_formulaire' => 'Form not or incorrectly completed',
			'utile_mail_message_succes'            => 'Message send',
		/* liste_user */
			'utile_liste_user_titre'                            => 'List of users',
			'utile_liste_user_description'                      => 'Listing of users registered on this website',
			'utile_liste_user_table_caption'                    => 'Listing of users registered on this website',
			'utile_liste_user_table_th_nom'                     => 'Pseudo',
			'utile_liste_user_table_th_avatar'                  => 'Avatar',
			'utile_liste_user_table_th_date_derniere_connexion' => 'Last login date',
			'utile_liste_user_table_th_date_inscription'        => 'Registration date',
			'utile_liste_user_table_th_role'                    => 'Role',
			'utile_liste_user_table_td_avatar_alt'              => 'Avatar of ',
	/* post */
		/* fil_post */
			'post_fil_post_detail'              => 'See more',
			'post_fil_post_titre'               => 'Page ',
			'post_fil_post_nav_description'     => 'Go to page ',
			'post_fil_post_lien_detail_titre'   => 'Read the post with his comments',
			'post_fil_post_auteur_presentation' => 'By ',
			'post_fil_post_lien_auteur_titre'   => 'See the author\'s profile',
			'post_fil_post_publication'         => 'Publish a post',
			'post_fil_post_description'         => 'Post thread display',
		/* publication */
			'post_publication_titre'       => 'Publishing',
			'post_publication_description' => 'Post publishing page',
			'post_publication_legend'      => 'Publishing',
			'post_publication_titreForm'   => 'Title: ',
			'post_publication_contenu'     => 'Content: ',
			'post_publication_submit'      => 'PUBLISH',
		/* validation_publication */
			'post_validation_publication_message_formulaire' => 'Form not or incorrectly completed',
			'post_validation_publication_message_succes'     => 'Post published',
		/* lecture */
			'post_lecture_titre'                              => '',
			'post_lecture_description'                        => 'Display post page',
			'post_lecture_auteur_presentation'                => 'By ',
			'post_lecture_lien_auteur_titre'                  => 'See the author\'s profile',
			'post_lecture_lien_mise_a_jour'                   => 'Upfate the post',
			'post_lecture_lien_suppression'                   => 'Delete the post',
			'post_lecture_legend'                             => 'Publishing of comments',
			'post_lecture_commentaire_contenu'                => 'Comments: ',
			'post_lecture_commentaire_submit'                 => 'PUBLISH',
			'post_lecture_commentaire_lien_avatar_titre'      => 'See the profile of ',
			'post_lecture_commentaire_avatar_description'     => 'Avatar of ',
			'post_lecture_lien_suppression_titre'             => 'Delete this post',
			'post_lecture_lien_commentaire_suppression_titre' => 'Delte this comments',
			'post_lecture_lien_commentaire_edition_titre'     => 'Edit this comments',
		/* commentaire_publication */
			'post_commentaire_publication_message_formulaire' => 'Form not or incorrectly completed',
			'post_commentaire_publication_message_succes'     => 'Comment published',
		/* suppression */
			'post_suppression_message_argument'   => 'Cannot delete a post without an id',
			'post_suppression_message_inexistant' => 'No post has this id',
			'post_suppression_message_permission' => 'No permission to delete this postt',
			'post_suppression_message_succes'     => 'Post deleted',
		/* commentaire_suppression */
			'post_commentaire_suppression_message_argument'   => 'Cannot delete a comment without an id',
			'post_commentaire_suppression_message_inexistant' => 'No comment has this id',
			'post_commentaire_suppression_message_permission' => 'No permission to delete this comment',
			'post_commentaire_suppression_message_succes'     => 'Comment deleted',
		/* edition */
			'post_edition_message_erreur_id'           => 'Cannot change a post without an id',
			'post_edition_message_erreur_autorisation' => 'No permission to edit this post',
			'post_edition_message_erreur_existe'       => 'This post does\'nt exist',
			'post_edition_titre'                       => 'Post editing',
			'post_edition_description'                 => 'post editing page',
			'post_edition_formulaire_legend'           => 'Editing',
			'post_edition_formulaire_titre'            => 'Title: ',
			'post_edition_formulaire_contenu'          => 'Content: ',
			'post_edition_formulaire_submit'           => 'EDIT',
		/* validation_edition */
			'post_validation_edition_message_formulaire' => 'Form not or incorrectly completed',
			'post_validation_edition_message_id'         => 'No post with this id',
			'post_validation_edition_message_permission' => 'No permission to edit this post',
			'post_validation_edition_message_succes'     => 'Post well edited',
		/* commentaire_edition */
			'post_commentaire_edition_message_erreur_id'           => 'Cannot change a comment without an id',
			'post_commentaire_edition_message_erreur_autorisation' => 'No permission to edit this comment',
			'post_commentaire_edition_message_erreur_existe'       => 'This comment does\'nt exist',
			'post_commentaire_edition_titre'                       => 'Comment editing',
			'post_commentaire_edition_description'                 => 'comment editing page',
			'post_commentaire_edition_formulaire_legend'           => 'Editing',
			'post_commentaire_edition_formulaire_contenu'          => 'Content: ',
			'post_commentaire_edition_formulaire_submit'           => 'EDIT',
		/* commentaire_validation_edition */
			'post_commentaire_validation_edition_message_formulaire' => 'Form not or incorrectly completed',
			'post_commentaire_validation_edition_message_id'         => 'No comment with this id',
			'post_commentaire_validation_edition_message_permission' => 'No permission to edit this comment',
			'post_commentaire_validation_edition_message_succes'     => 'Comment well edited',
	/* erreur */
		/* erreur */
			'erreur_erreur_titre'       => 'Error',
			'erreur_erreur_description' => 'Error page',
	/* chat */
		'chat_mp_nom_conversation_debut'          => 'PM between ',
		'chat_mp_nom_conversation_milieu'         => ' and ',
		'chat_mp_nom_conversation_fin'            => '',
		'chat_mp_description_conversation_debut'  => 'Private Message between ',
		'chat_mp_description_conversation_milieu' => ' and ',
		'chat_mp_description_conversation_fin'    => '',
		/* hub */
			'chat_hub_titre'                        => 'Hub',
			'chat_hub_description'                  => 'Control panel for chat',
			'chat_hub_nombre_utilisateur'           => 'Members in the conversation/Connected now',
			'chat_hub_lien_titre_voir_conversation' => 'View the conversation',
			'chat_hub_lien_voir_conversation'       => 'View',
			'chat_hub_lien_ajouter_conversation'    => 'Add a new conversation',
		/* voir_conversation */
			'chat_voir_conversation_titre'                        => 'Conversation - ',
			'chat_voir_conversation_description'                  => 'View a conversation',
			'chat_voir_conversation_erreur_no_id'                 => 'Id of the conversation needed to read it',
			'chat_voir_conversation_erreur_pas_membre'            => 'You are not a member of this conversation',
			'chat_voir_conversation_conversation_vide'            => 'Beginning of the conversation: no messages yet',
			'chat_voir_conversation_auteur'                       => 'By ',
			'chat_voir_conversation_date'                         => 'at ',
			'chat_voir_conversation_form_legend'                  => 'Send a message',
			'chat_voir_conversation_form_label_message'           => 'Message',
			'chat_voir_conversation_form_submit'                  => 'SEND',
			'chat_voir_conversation_toast_editer_conversation'    => 'Edit the conversation',
			'chat_voir_conversation_toast_supprimer_conversation' => 'Delete the conversation',
		/* envoyer_message */
			'chat_envoyer_message_erreur_id_conversation' => 'Id of the conversation needed to write a message in it',
			'chat_envoyer_message_erreur_permission'      => 'You haven\'t the right to write a message in this conversation',
			'chat_envoyer_message_erreur_contenu'         => 'Form not or incorrectly completed',
			'chat_envoyer_message_succes'                 => 'Message well sent',
		/* editer_message */
			'chat_editer_message_titre'                            => 'Message editing',
			'chat_editer_message_description'                      => 'Message editing page',
			'chat_editer_message_erreur_id_message'                => 'Id of the message needed to edit it',
			'chat_editer_message_erreur_conversation_autorisation' => 'You haven\'t the right to access to the conversation of this message',
			'chat_editer_message_erreur_message_autorisation'      => 'You haven\'t the right to edit this message',
			'chat_editer_message_form_legend'                      => 'Edit a message',
			'chat_editer_message_form_label_message'               => 'Message',
			'chat_editer_message_form_submit'                      => 'EDIT',
		/* supprimer_message */
			'chat_supprimer_message_erreur_id_message'                => 'Id of the message needed to delete it',
			'chat_supprimer_message_erreur_conversation_autorisation' => 'You haven\'t the right to access to the conversation of this message',
			'chat_supprimer_message_erreur_message_autorisation'      => 'You haven\'t the right to delete this message',
			'chat_supprimer_message_succes'                           => 'Message well deleted',
		/* validation_editer_message */
			'chat_validation_editer_message_succes' => 'Message well edited',
		/* envoyer_mp */
			'chat_envoyer_mp_titre'                        => 'Send a mp',
			'chat_envoyer_mp_description'                  => 'Allows a user to send a private message to another user',
			'chat_envoyer_mp_notification_erreur_soi_meme' => 'You cannot send a message to yourself',
			'chat_envoyer_mp_notification_erreur_guest'    => 'Guest is not a user',
			'chat_envoyer_mp_notification_erreur_no_id'    => 'Id of the user needed',
			'chat_envoyer_mp_form_legend'                  => 'Send a private message',
			'chat_envoyer_mp_form_label_message'           => 'Message',
			'chat_envoyer_mp_form_submit'                  => 'SEND',
		/* validation_envoyer_mp */
			'chat_validation_envoyer_mp_notification_succes'              => 'Message well sent',
			'chat_validation_envoyer_mp_notification_erreur_message_vide' => 'The message is empty',
			'chat_validation_envoyer_mp_notification_erreur_formulaire'   => 'Form not completed',
			'chat_validation_envoyer_mp_notification_erreur_plusieurs_mp' => 'Problem in the database: you have more than one conversation of mp with the same user ! CONTACT AN ADMINISTRATOR !',
			'chat_validation_envoyer_mp_notification_erreur_soi_meme'     => 'You cannot send a message to yourself',
			'chat_validation_envoyer_mp_notification_erreur_guest'        => 'Guest is not a user',
			'chat_validation_envoyer_mp_notification_erreur_no_id'        => 'Id of the user needed',
		/* ajouter_conversation */
			'chat_ajouter_conversation_titre'                          => 'Crate a conversation',
			'chat_ajouter_conversation_description'                    => 'Creare a group of conversation',
			'chat_ajouter_conversation_formulaire_legend'              => 'Create a new conversation',
			'chat_ajouter_conversation_formulaire_label_nom'           => 'Name: ',
			'chat_ajouter_conversation_formulaire_label_description'   => 'Description: ',
			'chat_ajouter_conversation_formulaire_utilisateurs_legend' => 'Add users',
			'chat_ajouter_conversation_formulaire_submit'              => 'CREATE',
		/* validation_ajouter_conversation */
			'chat_validation_ajouter_conversation_notification_attention_self'          => 'You don\'t have to be in the user list, this will be done automatically',
			'chat_validation_ajouter_conversation_notification_succes'                  => 'Conversation well added',
			'chat_validation_ajouter_conversation_notification_erreur_pas_utilisateur'  => 'The conversation doesn\' have any members',
			'chat_validation_ajouter_conversation_notification_erreur_formulaire_vide'  => 'Form empty',
			'chat_validation_ajouter_conversation_notification_erreur_formulaire_envoi' => 'Form not completed',
		/* editer_conversation */
			'chat_editer_conversation_titre'                            => 'Edit a conversation',
			'chat_editer_conversation_description'                      => 'Edit a group of conversation',
			'chat_editer_conversation_formulaire_legend'                => 'Edit a conversation',
			'chat_editer_conversation_formulaire_label_nom'             => 'Name: ',
			'chat_editer_conversation_formulaire_label_description'     => 'Description: ',
			'chat_editer_conversation_formulaire_utilisateurs_legend'   => 'Add users',
			'chat_editer_conversation_formulaire_submit'                => 'EDIT',
			'chat_editer_conversation_notification_erreur_autorisation' => 'You don\'t have access to this conversation',
			'chat_editer_conversation_notification_erreur_general'      => 'This conversation isn\'t editable',
			'chat_editer_conversation_notification_erreur_id'           => 'Id of the conversation is needed',
		/* validation_editer_conversation */
			'chat_validation_editer_conversation_notification_erreur_autorisation'     => 'You don\'t have access to this conversation',
			'chat_validation_editer_conversation_notification_erreur_general'          => 'This conversation isn\'t editable',
			'chat_validation_editer_conversation_notification_erreur_id'               => 'Id of the conversation is needed',
			'chat_validation_editer_conversation_notification_attention_self'          => 'You don\'t have to be in the user list, this will be done automatically',
			'chat_validation_editer_conversation_notification_succes'                  => 'Conversation well edited',
			'chat_validation_editer_conversation_notification_erreur_pas_utilisateur'  => 'The conversation doesn\' have any members',
			'chat_validation_editer_conversation_notification_erreur_formulaire_vide'  => 'Form empty',
			'chat_validation_editer_conversation_notification_erreur_formulaire_envoi' => 'Form not completed',
		/* supprimer_conversation */
			'chat_supprimer_conversation_notification_succes'              => 'Conversation well deleted',
			'chat_supprimer_conversation_notification_erreur_autorisation' => 'You don\'t have access to this conversation',
			'chat_supprimer_conversation_notification_erreur_general'      => 'You cannot delete this conversation',
			'chat_supprimer_conversation_notification_erreur_id'           => 'Id of the conversation is needed',
);

?>