<?php

$lang=array(
	/* Général */
	'inv_lang' => 'FR',
	'pseudo'   => 'pseudo',
	'mdp'      => 'password',
	/* menu-up */
		'menu-up_accueil'    => 'Home',
		'menu-up_altlogo'    => 'Logo of ',
		'menu-up_avatar'     => 'Your avatar',
		'menu-up_titres'     => array('Home', 'Post thread', 'About'),
		'menu-up_affichages' => array('Home', 'Post', 'About'),
	/* user */
		'user_formulairepseudo' => 'Username:',
		'user_formulairemdp'    => 'Password:',
		'user_formuliaremail'   => 'E-Mail: ',
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
			'user_statut_mail'                       => 'E-Mail: ',
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
			'user_statut_titre_lien_langage'         => 'View in french',
			'user_statut_affichage_lien_langage'     => 'Change language',
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
			'user_validation_edition_message_formulaire'   => 'Form not or incorrectly completed',
			'user_validation_edition_message_succes'       => 'Your profile has been modified',
			'user_validation_edition_message_admin_succes' => 'The user\'s profile has been modified',
			'user_validation_edition_avatar_message_erreur_dossier'   => 'Unable to create the folder for avatars',
			'user_validation_edition_avatar_message_erreur_upload'    => 'Problem when uploading the avatar',
			'user_validation_edition_avatar_message_erreur_interne'   => 'An internal error prevented the upload of the avatar',
			'user_validation_edition_avatar_message_erreur_type'      => 'The avatar to upload is not an image',
			'user_validation_edition_avatar_message_erreur_extension' => 'The avatar extension is invalid',
			'user_validation_edition_avatar_message_erreur_dimension' => 'Error in the avatar dimensions',
		/* view */
			'user_view_titre'       => 'See profile',
			'user_view_description' => 'Page to view another user\'s profile',
			'user_view_pseudo'      => 'Pseudo: ',
			'user_view_avatar'      => 'Avatar: ',
			'user_view_derndateco'  => 'Last Login: ',
			'user_view_premdatein'  => 'Registration: ',
			'user_view_avatar_alt'  => 'Avatar of ',
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