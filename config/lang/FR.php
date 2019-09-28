<?php

$lang=array(
	/* Général */
		'pseudo'   => 'pseudo',
		'mdp'      => 'mot de passe',
	/* Langue */
		'lang_self'   => array(
			'abbr' => 'FR',
			'full' => 'Français',
		),
		'lang_others' => array(
			'EN' => array(
				'abbr' => 'EN',
				'full' => 'English',
			),
		),
	/* Erreur */
		'erreur_general_fichier_introuvable'         => 'Page non trouvé',
		'erreur_general_autorisations_insuffisantes' => 'Pas la permission',
		'erreur_connexion_mot_de_passe'              => 'Problème lors de la connexion',
		'erreur_connexion_utilisateur'               => 'L\'utilisateur n\'existe pas',
		'erreur_titre'                               => 'Erreur',
		'erreur_description'                         => 'Page d\'erreur',
	/* menu-up */
		'menu-up_accueil'    => 'Accueil',
		'menu-up_altlogo'    => 'Logo de ',
		'menu-up_avatar'     => 'Votre avatar',
		'menu-up_titres'     => array('Accueil', 'Fil des posts', 'À propos', 'Chat'),
		'menu-up_affichages' => array('Accueil', 'Post', 'À propos', 'Chat'),
	/* user */
		'user_formulairepseudo' => 'Pseudo:',
		'user_formulairemdp'    => 'Mot de passe:',
		'user_formulairemail'   => 'Mail: ',
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
			'user_statut_mail'                       => 'Mail: ',
			'user_statut_titre'                      => 'statut',
			'user_statut_description'                => 'Statut du visiteur',
			'user_statut_titre_lien_connexion'       => 'Page de connexion',
			'user_statut_affichage_lien_connexion'   => 'Se connecter',
			'user_statut_titre_lien_inscription'     => 'Page d\'inscription',
			'user_statut_affichage_lien_inscription' => 'S\'inscrire',
			'user_statut_titre_lien_deconnexion'     => 'Page de déconnexion',
			'user_statut_affichage_lien_deconnexion' => 'Se déconnecter',
			'user_statut_titre_lien_edition'         => 'Page d\'édition de profil',
			'user_statut_affichage_lien_edition'     => 'Éditer son profil',
			'user_statut_titre_lien_langage'         => 'Voir en anglais',
			'user_statut_affichage_lien_langage'     => 'Changer de langue',
		/* deconnexion */
			'user_deconnexion_message' => 'Déconnexion réussie',
		/* edition */
			'user_edition_titre'        => 'Édition de l\'utilisateur',
			'user_edition_description'  => 'Page permettant d\'éditer certaines caractéristiques de son profil',
			'user_edition_legend'       => 'Édition de ',
			'user_edition_label_avatar' => 'Avatar: ',
			'user_edition_label_mail'   => 'Mail :',
			'user_edition_submit'       => 'EDITER',
			'user_edition_label_banni'  => 'Banni: ',
		/* validation_edition */
			'user_validation_edition_message_formulaire'              => 'Formulaire non ou mal remplit',
			'user_validation_edition_message_succes'                  => 'Le profil à bien été modifié',
			'user_validation_edition_message_admin_succes'            => 'Le profil de l\'utilisateur a bien été modifié',
			'user_validation_edition_avatar_message_erreur_dossier'   => 'Impossible de créer le dossier pour les avatars',
			'user_validation_edition_avatar_message_erreur_upload'    => 'Problème lors de l\'upload de l\'avatar',
			'user_validation_edition_avatar_message_erreur_interne'   => 'Une erreur interne a empêché l\'upload de l\'avatar',
			'user_validation_edition_avatar_message_erreur_type'      => 'L\'avatar à uploader n\'est pas une image',
			'user_validation_edition_avatar_message_erreur_extension' => 'L\'extension de l\'avatar est invalide',
			'user_validation_edition_avatar_message_erreur_dimension' => 'Erreur dans les dimensions de l\'avatar',
		/* view */
			'user_view_titre'       => 'Voir l\'utilisateur',
			'user_view_description' => 'Page permettant de voir le profil d\'un autre utilisateur',
			'user_view_pseudo'      => 'Pseudo: ',
			'user_view_avatar'      => 'Avatar: ',
			'user_view_derndateco'  => 'Dernière connexion: ',
			'user_view_premdatein'  => 'Inscription: ',
			'user_view_avatar_alt'  => 'Avatar de ',
	/* utile */
		/* a_propos */
			'utile_a_propos_titre'             => 'À propos',
			'utile_a_propos_description'       => 'Page expliquant le site',
			'utile_a_propos_formulaire_legend' => 'Envoyer un message',
			'utile_a_propos_formulaire_label'  => 'Message: ',
			'utile_a_propos_formulaire_submit' => 'ENVOYER',
			'utile_a_propos_contenu_titre'     => 'À propos',
			'utile_a_propos_contenu_questions' => array('Quel est le but de ce site ?', 'Quel est son créateur ?', 'Confidentialité et collecte de donnée'),
			'utile_a_propos_contenu_reponses'  => array(
				'Ce site est un blogue dans lequel j\'exprime ce qu\'il me passe par la tête. Par conséquent, il est possible de m\'y voir exprimer des opinions, parfois contraires à vos propre opinions: vous pouvez toujours faire des commentaires constructifs ou partir de ce site.<br />
				Il faut se connecter pour rédiger des commentaires. L\'inscription est évidemment gratuite. Au fil du temps, le site développera de nouvelles fonctionnalités à travers des mises à jours.<br />
				Le code de ce site est accessible gratuitement et librement sur Github <a href="https://github.com/gugus2000/Babtouland" title="Github de ce site">ici</a>.',
				'Je suis gugus2000, le créateur de ce site. Celui-ci est pour moi l\'occasion de tester pour la première fois la mise en ligne d\'un site pleinement opérationnel.<br />
				Il faut savoir que le développement (web ou non) n\'est pas mon métier. C\'est pourquoi ce site est loin d\'être parfait, malgrès le fait qu\'il en soit déjà à sa 5ème itération.<br />
				Le formulaire en bas de la page permet de me contacter directement. Je suis aussi sur Mastodont (@gugus2000@framapiaf.org) et sur Discord (gugus2000#5074). N\'hésitez pas à me contacter en cas de besoin',
				'La confidentialité sur internet est une problématique importante: ce site ne comporte aucun suivi de l\'utilisateur utilisé par des agences publicitaires ou autres outils externe au site.<br />
				Je fais cependant usage d\'un et de seulement un cookie: un cookie de session. Il s\'agit d\'un cookie permettant de vous authentifier entre chaque page du site sans avoir besoin de se reconnecter. Ce cookie est obligatoire au bon fonctionnement du site et n\'est en aucun cas distribué à des personnes tierces.<br />
				Lorsque vous publiez un commentaire sur ce site, vous en restez l\'auteur: vous conservez vos droits et pouvez le modifier ou le supprimer sans problème. En revanche si ce commentaire est diffamant ou non réglementaire de quelque façon que ce soit, il pourra être supprimé par une modération (dont je fais partie). Il s\'agit donc d\'une modération "a posteriori"<br />
				Le site n\'utilise aucune ressource externe, et est sans publicité.<br />
				À cette date du 8 août 2019 (08/08/2019), ce site est hébergé par un service dont voici les coordonnées:<br />
				<ul>
					<li>Nom: 000WEBHOST</li>
					<li>Site web: <a href="https://www.000webhost.com/" target="_blank">www.000webhost.com</a></li>
					<li>Coordonnées:<br />
					Adresse: 61 Lordou Vironos Street<br />
					6023 Larnaca, Cyprus<br />
					Email: contact@000webhost.com</li>
				</ul>
				<p class="left_align">De ce fait, certains cookies peuvent être mis par cet hébergeur, mais ça ne dépend pas de moi, n\'hésitez pas à les bloquer.<br />
				Finalement, tout mes posts et le contenu de ce site sont disponible: vous pouvez les distribuer, modifier gratuitement. Cependant, il vous faudra citer la source et expliquer de façon claire la modification faite si elle a lieu.<br />
				Tout changement dans ce texte sera annoncée de façon visible pour tout utilisateur visiblement nouveau à ce changement.',
			),
		/* mail */
			'utile_mail_message_erreur_formulaire' => 'Formulaire non ou mal remplit',
			'utile_mail_message_succes'            => 'Message envoyé',
		/* liste_user */
			'utile_liste_user_titre'                            => 'Liste d\'utilisateurs',
			'utile_liste_user_description'                      => 'Page listant les utilisateurs inscrits au site',
			'utile_liste_user_table_caption'                    => 'Liste des utilisateurs inscrits sur le site',
			'utile_liste_user_table_th_nom'                     => 'Pseudo',
			'utile_liste_user_table_th_avatar'                  => 'Avatar',
			'utile_liste_user_table_th_date_derniere_connexion' => 'Date de dernière connexion',
			'utile_liste_user_table_th_date_inscription'        => 'Date d\'inscription',
			'utile_liste_user_table_th_role'                    => 'Role',
			'utile_liste_user_table_td_avatar_alt'              => 'Avatar de ',
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
			'post_validation_edition_message_permission' => 'Vous n\'avez pas la permission d\'éditer ce post',
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
			'post_commentaire_validation_edition_message_permission' => 'Vous n\'avez pas la permission d\'éditer ce commentaire',
			'post_commentaire_validation_edition_message_succes'     => 'Commentaire bien édité',
	/* erreur */
		/* erreur */
			'erreur_erreur_titre'       => 'Erreur',
			'erreur_erreur_description' => 'Page d\'erreur',
	/* chat */
		/* hub */
			'chat_hub_titre'                        => 'Hub',
			'chat_hub_description'                  => 'Centre de contrôle du chat',
			'chat_hub_nombre_utilisateur'           => 'Membres dans la conversation: ',
			'chat_hub_lien_titre_voir_conversation' => 'Voir la conversation',
			'chat_hub_lien_voir_conversation'       => 'Voir',
			'chat_hub_lien_ajouter_conversation'    => 'Ajouter une nouvelle conversation',
);

?>