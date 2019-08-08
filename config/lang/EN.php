<?php

$lang=array(
	/* Général */
	'pseudo' => 'pseudo',
	'mdp'    => 'password',
	/* menu-up */
		'menu-up_accueil'    => 'Home',
		'menu-up_altlogo'    => 'Logo of ',
		'menu-up_profil'     => 'Your profile',
		'menu-up_avatar'     => 'Your avatar',
		'menu-up_titres'     => array('Home', 'Post thread'),
		'menu-up_affichages' => array('Home', 'Post'),
	/* user */
		'user_formulairepseudo' => 'Username:',
		'user_formulairemdp'    => 'Password:',
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
			'user_statut_nologin'                    => 'Vous n\'êtes pas connecté',
			'user_statut_pseudo'                     => 'Your username: ',
			'user_statut_avatar'                     => 'Your avatar: ',
			'user_statut_derndateco'                 => 'Last login date: ',
			'user_statut_premdatein'                 => 'Registration date: ',
			'user_statut_titre'                      => 'status',
			'user_statut_titre_lien_connexion'       => 'Login page',
			'user_statut_affichage_lien_connexion'   => 'Sign in',
			'user_statut_titre_lien_inscription'     => 'Registration page',
			'user_statut_affichage_lien_inscription' => 'Sign up',
			'user_statut_titre_lien_deconnexion'     => 'Logout page',
			'user_statut_affichage_lien_deconnexion' => 'Log out',
			'user_statut_description'                => 'Visitor status',
			'user_statut_titre_lien_edition'         => 'profile edition page',
			'user_statut_affichage_lien_edition'     => 'Edit your profile',
		/* deconnexion */
			'user_deconnexion_message' => 'Succesful logout',
		/* edition */
			'user_edition_titre'        => 'User editing',
			'user_edition_description'  => 'This page allowing you to edit certain characteristics of your profile',
			'user_edition_legend'       => 'Edition of ',
			'user_edition_label_avatar' => 'Avatar: ',
			'user_edition_submit'       => 'EDIT',
			'user_edition_label_banni'  => 'Banned: ',
		/* validation_edition */
			'user_validation_edition_message_formulaire'   => 'Form not or incorrectly completed',
			'user_validation_edition_message_succes'       => 'Your profile has been modified',
			'user_validation_edition_message_admin_succes' => 'The user\'s profile has been modified',
	/* post */
		/* fil_post */
			'post_fil_post_detail'              => 'See more',
			'post_fil_post_titre'               => 'Page ',
			'post_fil_post_nav_description'     => 'Post thread',
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
			'post_commentaire_validation_edition_message_succes'     => 'Comment well edited',
);

?>