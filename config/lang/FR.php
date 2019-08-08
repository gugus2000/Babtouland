<?php

$lang=array(
	/* Général */
	'pseudo' => 'pseudo',
	'mdp'    => 'mot de passe',
	/* menu-up */
		'menu-up_accueil'    => 'Accueil',
		'menu-up_altlogo'    => 'Logo de ',
		'menu-up_profil'     => 'Votre profil',
		'menu-up_avatar'     => 'Votre avatar',
		'menu-up_titres'     => array('Accueil', 'Fil des posts'),
		'menu-up_affichages' => array('Accueil', 'Post'),
	/* user */
		'user_formulairepseudo' => 'Pseudo:',
		'user_formulairemdp'    => 'Mot de passe:',
		/* connexion */
			'user_connexion_fieldset'    => 'Connexion',
			'user_connexion_submit'      => 'SE CONNECTER',
			'user_connexion_titre'       => 'connexion',
			'user_connexion_description' => 'Page de connexion',
		/* inscription */
			'user_inscription_fieldset'    => 'Inscription',
			'user_inscription_submit'      => 'S\'INSCRIRE',
			'user_inscription_titre'       => 'inscription',
			'user_inscription_description' => 'Page d\'inscription',
		/* validation_connexion */
			'user_validation_connexion_succes'     => 'Vous êtes bien connecté',
			'user_validation_connexion_formulaire' => 'Formulaire non ou mal remplit',
		/* validation_inscription */
			'user_validation_inscription_succes'     => 'Vous êtes bien inscrit',
			'user_validation_inscription_pseudo'     => 'Le pseudo existe déjà',
			'user_validation_inscription_formulaire' => 'Formulaire non ou mal remplit',
		/* statut */
			'user_statut_nologin'                    => 'Vous n\'êtes pas connecté',
			'user_statut_pseudo'                     => 'Votre pseudo: ',
			'user_statut_avatar'                     => 'Votre avatar: ',
			'user_statut_derndateco'                 => 'Dernière date de connexion: ',
			'user_statut_premdatein'                 => 'Date d\'inscription: ',
			'user_statut_titre'                      => 'statut',
			'user_statut_titre_lien_connexion'       => 'Page de connexion',
			'user_statut_affichage_lien_connexion'   => 'Se connecter',
			'user_statut_titre_lien_inscription'     => 'Page d\'inscription',
			'user_statut_affichage_lien_inscription' => 'S\'inscrire',
			'user_statut_titre_lien_deconnexion'     => 'Page de déconnexion',
			'user_statut_affichage_lien_deconnexion' => 'Se déconnecter',
			'user_statut_description'                => 'Statut du visiteur',
			'user_statut_titre_lien_edition'         => 'Page d\'édition de profil',
			'user_statut_affichage_lien_edition'     => 'Éditer son profil',
		/* deconnexion */
			'user_deconnexion_message' => 'Déconnexion réussie',
		/* edition */
			'user_edition_titre'        => 'Édition de l\'utilisateur',
			'user_edition_description'  => 'Page permettant d\'éditer certaines caractéristiques de son profil',
			'user_edition_legend'       => 'Édition de ',
			'user_edition_label_avatar' => 'Avatar: ',
			'user_edition_submit'       => 'EDITER',
			'user_edition_label_banni'  => 'Banni: ',
		/* validation_edition */
			'user_validation_edition_message_formulaire'   => 'Formulaire non ou mal remplit',
			'user_validation_edition_message_succes'       => 'Le profil à bien été modifié',
			'user_validation_edition_message_admin_succes' => 'Le profil de l\'utilisateur a bien été modifié',
	/* post */
		/* fil_post */
			'post_fil_post_detail'              => 'Voir plus',
			'post_fil_post_titre'               => 'Page ',
			'post_fil_post_nav_description'     => 'Liste des posts',
			'post_fil_post_lien_detail_titre'   => 'Lire le post avec ses commentaires',
			'post_fil_post_auteur_presentation' => 'Par ',
			'post_fil_post_lien_auteur_titre'   => 'Voir le profil de l\'auteur',
			'post_fil_post_publication'         => 'Publier un post',
			'post_fil_post_description'         => 'Page d\'affichage des posts',
		/* publication */
			'post_publication_titre'       => 'Publication',
			'post_publication_description' => 'Page de publication de post',
			'post_publication_legend'      => 'Publication',
			'post_publication_titreForm'   => 'Titre: ',
			'post_publication_contenu'     => 'Contenu: ',
			'post_publication_submit'      => 'PUBLIER',
		/* validation_publication */
			'post_validation_publication_message_formulaire' => 'Formulaire non ou mal remplit',
			'post_validation_publication_message_succes'     => 'Post publié',
		/* lecture */
			'post_lecture_titre'                              => '',
			'post_lecture_description'                        => 'Page d\'affichage du post',
			'post_lecture_auteur_presentation'                => 'Par ',
			'post_lecture_lien_auteur_titre'                  => 'Voir le profil de l\'auteur',
			'post_lecture_lien_mise_a_jour'                   => 'Mettre à jour le post',
			'post_lecture_lien_suppression'                   => 'Supprimer le post',
			'post_lecture_legend'                             => 'Publication de commentaire',
			'post_lecture_commentaire_contenu'                => 'Commentaire: ',
			'post_lecture_commentaire_submit'                 => 'PUBLIER',
			'post_lecture_commentaire_lien_avatar_titre'      => 'Voir le profil de ',
			'post_lecture_commentaire_avatar_description'     => 'Avatar de ',
			'post_lecture_lien_suppression_titre'             => 'Supprimer ce post',
			'post_lecture_lien_commentaire_suppression_titre' => 'Supprimer ce commentaire',
			'post_lecture_lien_commentaire_edition_titre'     => 'Editer ce commentaire',
		/* commentaire_publication */
			'post_commentaire_publication_message_formulaire' => 'Formulaire non ou mal remplit',
			'post_commentaire_publication_message_succes'     => 'Commentaire publié',
		/* suppression */
			'post_suppression_message_argument'   => 'Impossible de supprimer un post sans id',
			'post_suppression_message_inexistant' => 'Aucun post n\'a cet id',
			'post_suppression_message_permission' => 'Pas la permission de supprimer ce post',
			'post_suppression_message_succes'     => 'Post supprimé',
		/* commentaire_suppression */
			'post_commentaire_suppression_message_argument'   => 'Impossible de supprimer un commentaire sans id',
			'post_commentaire_suppression_message_inexistant' => 'Aucun commentaire n\'a cet id',
			'post_commentaire_suppression_message_permission' => 'Pas la permission de supprimer ce commentaire',
			'post_commentaire_suppression_message_succes'     => 'Commentaire supprimé',
		/* edition */
			'post_edition_message_erreur_id'           => 'Impossible de modifier un post sans id',
			'post_edition_message_erreur_autorisation' => 'Vous n\'avez pas l\'autorisation d\'éditer ce post',
			'post_edition_message_erreur_existe'       => 'Ce post n\'existe pas',
			'post_edition_titre'                       => 'Édition de post',
			'post_edition_description'                 => 'Page d\'édition de post',
			'post_edition_formulaire_legend'           => 'Édition',
			'post_edition_formulaire_titre'            => 'Titre: ',
			'post_edition_formulaire_contenu'          => 'Contenu: ',
			'post_edition_formulaire_submit'           => 'EDITER',
		/* validation_edition */
			'post_validation_edition_message_formulaire' => 'Formulaire non ou mal remplit',
			'post_validation_edition_message_id'         => 'Pas de post ayant cet id',
			'post_validation_edition_message_succes'     => 'Post bien édité',
		/* commentaire_edition */
			'post_commentaire_edition_message_erreur_id'           => 'Impossible de modifier un commentaire sans id',
			'post_commentaire_edition_message_erreur_autorisation' => 'Vous n\'avez pas l\'autorisation d\'éditer ce commentaire',
			'post_commentaire_edition_message_erreur_existe'       => 'Ce commentaire n\'existe pas',
			'post_commentaire_edition_titre'                       => 'Édition de commentaire',
			'post_commentaire_edition_description'                 => 'Page d\'édition de commentaire',
			'post_commentaire_edition_formulaire_legend'           => 'Édition',
			'post_commentaire_edition_formulaire_contenu'          => 'Contenu: ',
			'post_commentaire_edition_formulaire_submit'           => 'EDITER',
		/* commentaire_validation_edition */
			'post_commentaire_validation_edition_message_formulaire' => 'Formulaire non ou mal remplit',
			'post_commentaire_validation_edition_message_id'         => 'Pas de commentaire ayant cet id',
			'post_commentaire_validation_edition_message_succes'     => 'Commentaire bien édité',
);

?>