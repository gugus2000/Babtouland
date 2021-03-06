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
	/* classe */
		/* core */
			'classe_core_routeur_arguments'   => 'Il y a plus d\'arguments que prévu',
			'classe_core_routeur_no_argument' => 'Il manque un ou plusieurs arguments',
		/* contenu */
			'classe_contenu_contenu_recupererLang_no_result' => 'Il n\'y a pas de texte associé',
	/* erreur */
		'erreur_general_fichier_introuvable'         => 'Page non trouvé',
		'erreur_general_autorisations_insuffisantes' => 'Vous n\'avez pas la permission de consulter cette page, ou cette page n\'existe pas/plus.',
		'erreur_connexion_mot_de_passe'              => 'Problème lors de la connexion',
		'erreur_connexion_utilisateur'               => 'L\'utilisateur n\'existe pas',
	/* menu-up */
		'menuUp_accueil'    => 'Accueil',
		'menuUp_altlogo'    => 'Logo de ',
		'menuUp_avatar'     => 'Votre avatar',
		'menuUp_titres'     => array('Accueil', 'Fil des posts', 'À propos', 'Chat', 'Forum', 'Admin'),
		'menuUp_affichages' => array('Accueil', 'Post', 'À propos', 'Chat', 'Forum', 'Admin'),
	/* tete */
		'tete_titre' => 'sans titre',
	/* temps */
		'temps_debut' => 'Temps de génération de la page: ',
		'temps_fin'   => ' secondes',
	/* admin */
		/* hub */
			'admin_hub_titre'                            => 'Centre de Contrôle',
			'admin_hub_description'                      => 'Page d\'administration pour contrôler le site web',
			'admin_hub_nombre_utilisateurs'              => 'Nombre d\'utilisateurs: ',
			'admin_hub_nombre_connectes'                 => 'Nombre d\'utilisateurs connectés: ',
			'admin_hub_ratio_connectes_debut'            => 'Soit un pourcentage de ',
			'admin_hub_ratio_connectes_fin'              => '% utilisateurs connectés',
			'admin_hub_liste_utilisateurs'               => 'Liste des utilisateurs',
			'admin_hub_publier_notification_description' => 'Publier une notification',
			'admin_hub_lien_nettoyage_title'             => 'Nettoyer la base de donnée',
			'admin_hub_lien_nettoyage_description'       => 'Nettoyage BDD',
		/* publier_notification */
			'admin_publier_notification_titre'                         => 'Envoyer une notification',
			'admin_publier_notification_description'                   => 'Permet l\'envoi d\'une notification publique ciblée',
			'admin_publier_notification_formulaire_legend'             => 'Publier une notification',
			'admin_publier_notification_formulaire_label_message'      => 'Notification: ',
			'admin_publier_notification_formulaire_label_type'         => 'Type: ',
			'admin_publier_notification_formulaire_succes'             => 'Succès',
			'admin_publier_notification_formulaire_erreur'             => 'Erreur',
			'admin_publier_notification_formulaire_attention'          => 'Attention',
			'admin_publier_notification_formulaire_label_groupe'       => 'Groupe concerné: ',
			'admin_publier_notification_formulaire_tous'               => 'Tous',
			'admin_publier_notification_formulaire_label_utilisateurs' => 'Utilisateurs du groupe concernés: ',
			'admin_publier_notification_formulaire_submit'             => 'ENVOYER',
		/* validation_publier_notification */
			'admin_validation_publier_notification_attention_utilisateurs_vide'    => 'Attention: cette notification n\'a pas de destinataires',
			'admin_validation_publier_notification_succes'                         => 'La notification a bien été envoyé',
			'admin_validation_publier_notification_erreur_vide'                    => 'Certains champs obligatoires du formulaire ont été laissé vide',
			'admin_validation_publier_notification_utilisateurs_erreur_formulaire' => 'Formulaire non ou mal remplit',
		/* nettoyer */
			'admin_nettoyer_titre'                    => 'Nettoyage',
			'admin_nettoyer_description'              => 'Permet le nettoyage de la base de donnée de différentes parties du site',
			'admin_nettoyer_post_title'               => 'Supprimer les entrées inutiles pour le système de post',
			'admin_nettoyer_post_description'         => 'Nettoyer le blogue',
			'admin_nettoyer_forum_title'              => 'Supprimer les entrées inutiles pour le forum',
			'admin_nettoyer_forum_description'        => 'Nettoyer le forum',
			'admin_nettoyer_chat_title'               => 'Supprimer les entrées inutiles pour le chat',
			'admin_nettoyer_chat_description'         => 'Nettoyer le chat',
			'admin_nettoyer_notification_title'       => 'Supprimer les entrées inutiles pour le système de notification',
			'admin_nettoyer_notification_description' => 'Nettoyer les notifications',
		/* nettoyer_post */
			'admin_nettoyer_post_notification_debut' => 'Nettoyage de ',
			'admin_nettoyer_post_notification_fin'   => ' commentaire(s) terminé avec succès',
		/* nettoyer_chat */
			'admin_nettoyer_chat_notification_message_debut'      => 'Nettoyage de ',
			'admin_nettoyer_chat_notification_message_fin'        => ' messsage(s) terminé avec succès',
			'admin_nettoyer_chat_notification_conversation_debut' => 'Nettoyage de ',
			'admin_nettoyer_chat_notification_conversation_fin'   => ' conversation(s) terminé avec succès',
		/* nettoyer_notification */
			'admin_nettoyer_notification_notification_debut' => 'Nettoyage de ',
			'admin_nettoyer_notification_notification_fin'   => ' notification(s) terminé avec succès',
		/* nettoyer_forum */
			'admin_nettoyer_forum_notification_noeud_debut'   => 'Nettoyage de ',
			'admin_nettoyer_forum_notification_noeud_fin'     => ' nœud(s) terminé avec succès',
			'admin_nettoyer_forum_notification_message_debut' => 'Nettoyage de ',
			'admin_nettoyer_forum_notification_message_fin'   => ' message(s) terminé avec succès',
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
			'user_statut_nologin'                       => 'Vous n\'êtes pas connecté',
			'user_statut_pseudo'                        => 'Votre pseudo: ',
			'user_statut_avatar'                        => 'Votre avatar: ',
			'user_statut_derndateco'                    => 'Dernière date de connexion: ',
			'user_statut_premdatein'                    => 'Date d\'inscription: ',
			'user_statut_mail'                          => 'Mail: ',
			'user_statut_titre'                         => 'Statut',
			'user_statut_description'                   => 'Statut du visiteur',
			'user_statut_titre_lien_connexion'          => 'Page de connexion',
			'user_statut_affichage_lien_connexion'      => 'Se connecter',
			'user_statut_titre_lien_inscription'        => 'Page d\'inscription',
			'user_statut_affichage_lien_inscription'    => 'S\'inscrire',
			'user_statut_titre_lien_deconnexion'        => 'Page de déconnexion',
			'user_statut_affichage_lien_deconnexion'    => 'Se déconnecter',
			'user_statut_titre_lien_edition'            => 'Page d\'édition de profil',
			'user_statut_affichage_lien_edition'        => 'Éditer son profil',
			'user_statut_titre_lien_langage'            => 'Voir en anglais',
			'user_statut_affichage_lien_langage'        => 'Changer de langue',
			'user_statut_titre_lien_configurations'     => 'Configurer les paramètres',
			'user_statut_affichage_lien_configurations' => 'Configurer',
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
			'user_view_titre'                      => 'Voir l\'utilisateur',
			'user_view_description'                => 'Page permettant de voir le profil d\'un autre utilisateur',
			'user_view_pseudo'                     => 'Pseudo: ',
			'user_view_avatar'                     => 'Avatar: ',
			'user_view_derndateco'                 => 'Dernière connexion: ',
			'user_view_premdatein'                 => 'Inscription: ',
			'user_view_avatar_alt'                 => 'Avatar de ',
			'user_view_action_statut_editer_title' => 'Éditer son compte',
			'user_view_action_statut_editer'       => 'Éditer',
			'user_view_action_envoyer_mp_title'    => 'Envoyer un Message Privé',
			'user_view_action_envoyer_mp'          => 'Envoyer un MP',
		/* configurations */
			'user_configurations_titre'                                       => 'Configurations',
			'user_configurations_description'                                 => 'Paramétrer son utilisation du site',
			'user_configurations_formulaire_legend'                           => 'Configurations',
			'user_configurations_formulaire_label_lang'                       => 'Langue',
			'user_configurations_formulaire_label_post_fil_post_nombre_posts' => 'Nombre de posts par page dans la fil des posts',
			'user_configurations_formulaire_submit'                           => 'VALIDER',
		/* validation_configurations */
			'user_validation_configurations_erreur_formulaire_mal_remplit'                      => 'Formulaire mal remplit',
			'user_validation_configurations_erreur_formulaire_vide'                             => 'Certains champs obligatoires du formulaire ont été laissé vide',
			'user_validation_configurations_attention_lang_pas_valide'                          => 'La langue demandé n\'existe pas (ou n\'est pas disponible)',
			'user_validation_configurations_attention_post_fil_post_nombre_posts_pas_numerique' => 'Le nombre de post dans le fil de post doit être un nombre',
			'user_validation_configurations_attention_post_fil_post_nombre_posts_pas_valide'    => 'Le nombre de post dans le fil de post n\'est pas valide',
			'user_validation_configurations_succes'                                             => 'La configuration a été appliqué',
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
			'post_fil_post_nav_description'     => 'Aller à la page ',
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
			'erreur_erreur_titre'           => 'Erreur',
			'erreur_erreur_description'     => 'Page d\'erreur',
			'erreur_erreur_explication'     => 'Ceci est une page d\'erreur. Vous pouvez me rapporter cette erreur via le formulaire ',
			'erreur_erreur_explication_ici' => 'ici',
			'erreur_erreur_no_erreur'       => 'Tentative d\'accès à la page sans erreur',
	/* chat */
		'chat_mp_nom_conversation_debut'          => 'MP entre ',
		'chat_mp_nom_conversation_milieu'         => ' et ',
		'chat_mp_nom_conversation_fin'            => '',
		'chat_mp_description_conversation_debut'  => 'Messages privés entre ',
		'chat_mp_description_conversation_milieu' => ' et ',
		'chat_mp_description_conversation_fin'    => '',
		/* hub */
			'chat_hub_titre'                        => 'Hub',
			'chat_hub_description'                  => 'Centre de contrôle du chat',
			'chat_hub_connectes'                    => 'person',
			'chat_hub_total'                        => 'person_outline',
			'chat_hub_lien_titre_voir_conversation' => 'Voir la conversation',
			'chat_hub_lien_voir_conversation'       => 'Voir',
			'chat_hub_lien_ajouter_conversation'    => 'Ajouter une nouvelle conversation',
			'chat_hub_survol_connectes'             => 'Nombre de membres connectés',
			'chat_hub_survol_total'                 => 'Nombre de membres au total',
		/* voir_conversation */
			'chat_voir_conversation_titre'                        => 'Conversation - ',
			'chat_voir_conversation_description'                  => 'Page de consultation d\'une conversation',
			'chat_voir_conversation_erreur_no_id'                 => 'Il faut l\'id de la conversation pour la lire',
			'chat_voir_conversation_erreur_pas_membre'            => 'Vous n\'êtes pas membre de la conversation',
			'chat_voir_conversation_conversation_vide'            => 'Début de la conversation: pas encore de messages',
			'chat_voir_conversation_auteur'                       => 'Par ',
			'chat_voir_conversation_date'                         => 'le ',
			'chat_voir_conversation_form_legend'                  => 'Envoyer un message',
			'chat_voir_conversation_form_label_message'           => 'Message',
			'chat_voir_conversation_form_submit'                  => 'ENVOYER',
			'chat_voir_conversation_toast_editer_conversation'    => 'Éditer la conversation',
			'chat_voir_conversation_toast_supprimer_conversation' => 'Supprimer la conversation',
			'chat_voir_conversation_menuside_titre'               => 'Liste des membres',
			'chat_voir_conversation_menuside_title_utilisateur'   => 'Voir le profil de ',
		/* envoyer_message */
			'chat_envoyer_message_erreur_id_conversation' => 'Il faut l\'id de la conversation pour y écrire un message',
			'chat_envoyer_message_erreur_permission'      => 'Vous ne pouvez pas écrire dans cette conversation',
			'chat_envoyer_message_erreur_contenu'         => 'Le formulaire est vide ou mal remplit',
			'chat_envoyer_message_succes'                 => 'Le message a bien été envoyé',
		/* editer_message */
			'chat_editer_message_titre'                            => 'Édition de message',
			'chat_editer_message_description'                      => 'Permet l\'édition d\'un message déjà envoyé',
			'chat_editer_message_erreur_id_message'                => 'Il vous faut l\'id du message pour l\'éditer',
			'chat_editer_message_erreur_conversation_autorisation' => 'Vous n\'avez pas la permission d\'accéder à la conversation de ce message',
			'chat_editer_message_erreur_message_autorisation'      => 'Vous n\'avez pas la permission d\'éditer ce message',
			'chat_editer_message_form_legend'                      => 'Éditer un message',
			'chat_editer_message_form_label_message'               => 'Message',
			'chat_editer_message_form_submit'                      => 'ÉDITER',
		/* supprimer_message */
			'chat_supprimer_message_erreur_id_message'                => 'Il vous faut l\'id du message pour le supprimer',
			'chat_supprimer_message_erreur_conversation_autorisation' => 'Vous n\'avez pas la permission d\'accéder à la conversation de ce message',
			'chat_supprimer_message_erreur_message_autorisation'      => 'Vous n\'avez pas la permission de supprimer ce message',
			'chat_supprimer_message_succes'                           => 'Vous avez bien supprimé le message',
		/* validation_editer_message */
			'chat_validation_editer_message_succes' => 'Vous avez bien édité le message',
		/* envoyer_mp */
			'chat_envoyer_mp_titre'                        => 'Envoyer un mp',
			'chat_envoyer_mp_description'                  => 'Page permettant à l\'utilisateur d\'envoyer un message privé à un autre utilisateur',
			'chat_envoyer_mp_notification_erreur_soi_meme' => 'Vous ne pouvez pas vous envoyer des messages',
			'chat_envoyer_mp_notification_erreur_guest'    => 'Guest n\'est pas un utilisateur précis',
			'chat_envoyer_mp_notification_erreur_no_id'    => 'L\'id de l\'utilisateur est nécessaire',
			'chat_envoyer_mp_form_legend'                  => 'Envoyer un message privé',
			'chat_envoyer_mp_form_label_message'           => 'Message',
			'chat_envoyer_mp_form_submit'                  => 'ENVOYER',
		/* validation_envoyer_mp */
			'chat_validation_envoyer_mp_notification_succes'              => 'Le message a bien été envoyé',
			'chat_validation_envoyer_mp_notification_erreur_message_vide' => 'Le message est vide',
			'chat_validation_envoyer_mp_notification_erreur_formulaire'   => 'Le formulaire n\'a pas été remplit',
			'chat_validation_envoyer_mp_notification_erreur_plusieurs_mp' => 'Problème dans la base de donnée: vous avez plusieurs conversations de mp avec une même personne ! CONTACTEZ UN ADMINISTRATEUR !',
			'chat_validation_envoyer_mp_notification_erreur_soi_meme'     => 'Vous ne pouvez pas vous envoyer des messages',
			'chat_validation_envoyer_mp_notification_erreur_guest'        => 'Guest n\'est pas un utilisateur précis',
			'chat_validation_envoyer_mp_notification_erreur_no_id'        => 'L\'id de l\'utilisateur est nécessaire',
		/* ajouter_conversation */
			'chat_ajouter_conversation_titre'                          => 'Créer une conversation',
			'chat_ajouter_conversation_description'                    => 'Créer un groupe de conversation',
			'chat_ajouter_conversation_formulaire_legend'              => 'Créer une nouvelle conversation',
			'chat_ajouter_conversation_formulaire_label_nom'           => 'Nom: ',
			'chat_ajouter_conversation_formulaire_label_description'   => 'Description: ',
			'chat_ajouter_conversation_formulaire_utilisateurs_legend' => 'Ajouter des utilisateurs',
			'chat_ajouter_conversation_formulaire_submit'              => 'CREER',
		/* validation_ajouter_conversation */
			'chat_validation_ajouter_conversation_notification_attention_self'          => 'Vous n\'avez pas à vous mettre dans la liste des membre de la conversation, cela sera fait automatiquement',
			'chat_validation_ajouter_conversation_notification_succes'                  => 'La conversation a bien été créé',
			'chat_validation_ajouter_conversation_notification_erreur_pas_utilisateur'  => 'La conversation ne possède pas de membre',
			'chat_validation_ajouter_conversation_notification_erreur_formulaire_vide'  => 'Le formulaire est vide',
			'chat_validation_ajouter_conversation_notification_erreur_formulaire_envoi' =>  'Le formulaire a mal été remplit',
		/* editer_conversation */
			'chat_editer_conversation_titre'                            => 'Éditer une conversation',
			'chat_editer_conversation_description'                      => 'Éditer un groupe de conversation',
			'chat_editer_conversation_formulaire_legend'                => 'Éditer une conversation',
			'chat_editer_conversation_formulaire_label_nom'             => 'Nom: ',
			'chat_editer_conversation_formulaire_label_description'     => 'Description: ',
			'chat_editer_conversation_formulaire_utilisateurs_legend'   => 'Ajouter des utilisateurs',
			'chat_editer_conversation_formulaire_submit'                => 'ÉDITER',
			'chat_editer_conversation_notification_erreur_autorisation' => 'Vous n\'avez pas accès à cette conversation',
			'chat_editer_conversation_notification_erreur_general'      => 'Cette conversation n\'est pas modifiable',
			'chat_editer_conversation_notification_erreur_id'           => 'Il faut l\'id de la conversation pour l\'éditer',
		/* validation_editer_conversation */
			'chat_validation_editer_conversation_notification_erreur_autorisation'     => 'Vous n\'avez pas accès à cette conversation',
			'chat_validation_editer_conversation_notification_erreur_general'          => 'Cette conversation n\'est pas modifiable',
			'chat_validation_editer_conversation_notification_erreur_id'               => 'Il faut l\'id de la conversation pour l\'éditer',
			'chat_validation_editer_conversation_notification_attention_self'          => 'Vous n\'avez pas à vous mettre dans la liste des membre de la conversation, cela sera fait automatiquement',
			'chat_validation_editer_conversation_notification_succes'                  => 'La conversation a bien été édité',
			'chat_validation_editer_conversation_notification_erreur_pas_utilisateur'  => 'La conversation ne possède pas de membre',
			'chat_validation_editer_conversation_notification_erreur_formulaire_vide'  => 'Le formulaire est vide',
			'chat_validation_editer_conversation_notification_erreur_formulaire_envoi' =>  'Le formulaire a mal été remplit',
		/* supprimer_conversation */
			'chat_supprimer_conversation_notification_succes'              => 'La conversation a bien été supprimé',
			'chat_supprimer_conversation_notification_erreur_autorisation' => 'Vous n\'avez pas accès à cette conversation',
			'chat_supprimer_conversation_notification_erreur_general'      => 'Vous ne pouvez pas supprimer cette conversation',
			'chat_supprimer_conversation_notification_erreur_id'           => 'Il faut l\'id de la conversation pour la supprimer',
	/* xhr */
		/* lang */
			'xhr_lang_message_probleme_key' => 'La clef demandé n\'existe pas (ou plus)',
		/* liste_membre_conv */
			'xhr_liste_membre_conv_erreur_pas_dans_conv' => 'Vous n\'êtes pas dans la conversation',
			'xhr_liste_membre_conv_erreur_conv_all'      => 'Tous les utilisateurs sont dans cette conversation',
			'xhr_liste_membre_conv_erreur_no_id'         => 'Id de la conversation nécessaire',
	/* forum */
		'forum_nom_type_0' => 'Dossier',
		'forum_nom_type_1' => 'Fil',
		/* voir_dossier */
			'forum_voir_dossier_titre'                       => 'Dossier: ',
			'forum_voir_dossier_description'                 => 'Consulter les dossiers du forum',
			'forum_voir_dossier_notification_erreur_dossier' => 'Cet id ne correspond pas à un dossier',
			'forum_voir_dossier_enfant_titre_lien_dossier'   => 'Consulter le dossier ',
			'forum_voir_dossier_enfant_titre_lien_fil'       => 'Consulter le fil ',
			'forum_voir_dossier_lien_ajout'                  => 'Ajouter un dossier ou un fil',
			'forum_voir_dossier_lien_edition'                => 'Éditer ce dossier',
			'forum_voir_dossier_lien_suppression'            => 'Supprimer ce dossier',
		/* ajout */
			'forum_ajout_titre'                        => 'Ajouter un nœud',
			'forum_ajout_description'                  => 'Ajouter un nœud enfant au dossier sélectionné',
			'forum_ajout_formulaire_legend'            => 'Ajouter un nœud',
			'forum_ajout_formulaire_label_nom'         => 'Nom du nœud: ',
			'forum_ajout_formulaire_label_description' => 'Description du nœud: ',
			'forum_ajout_formulaire_label_type'        => 'Type du nœud: ',
			'forum_ajout_formulaire_submit'            => 'AJOUTER',
		/* validation_ajout */
			'forum_validation_ajout_renseignement_recursion'        => 'Pour éviter l\'existence de dossier vide inutile, il vous est demandé de recréer un noeud tant que celui que vous avez crée n\'est pas un fil',
			'forum_validation_ajout_renseignement_fil'              => 'Pour éviter l\'existence de fil vide inutile, il vous est demandé de créer un premier message pour ce fil',
			'forum_validation_ajout_notification_succes'            => 'Le nœud a bien été créé',
			'forum_validation_ajout_notification_erreur_formulaire' => 'Le formulaire a mal été remplit',
			'forum_validation_ajout_notification_erreur_id'         => 'Un id est nécessaire pour créer un nœeud',
		/* voir_fil */
			'forum_voir_fil_titre'                   => 'Fil: ',
			'forum_voir_fil_description'             => 'Consulter les fils du forum',
			'forum_voir_fil_notification_erreur_id'  => 'L\'id du fil est nécessaire pour voir le fil',
			'forum_voir_fil_notification_erreur_fil' => 'Cet id ne correspond pas à un fil',
			'forum_voir_fil_message_titre_auteur'    => 'Voir le profil de ',
			'forum_voir_fil_lien_message_ajout'      => 'Publier un nouveau message',
			'forum_voir_fil_lien_edition'            => 'Éditer le fil',
			'forum_voir_fil_lien_suppression'        => 'Supprimer le fil',
		/* edition */
			'forum_edition_titre'                        => 'Édition de dossier',
			'forum_edition_description'                  => 'Édition du dossier précedemment sélectionné',
			'forum_edition_formulaire_legend'            => 'Éditer le dossier',
			'forum_edition_formulaire_label_nom'         => 'Nom',
			'forum_edition_formulaire_label_description' => 'Description',
			'forum_edition_formulaire_submit'            => 'ÉDITER',
			'forum_edition_notification_erreur_droit'    => 'Vous n\'avez pas le droit d\'éditer ce nœud',
			'forum_edition_notification_erreur_id'       => 'Il faut l\'id du nœud pour l\'éditer',
		/* validation_edition */
			'forum_validation_edition_notification_succes'              => 'Le noeud a bien été édité',
			'forum_validation_edition_notification_erreur_formulaire'   => 'Le formulaire a mal été remplit',
			'forum_validation_edition_notification_erreur_autorisation' => 'Vous n\'avez pas l\'autorisation d\'éditer ce noeud',
			'forum_validation_edition_notification_erreur_id'           => 'Impossible de modifier un noeud sans son id',
		/* message ajout */
			'forum_message_ajout_titre'                    => 'Écrire un message',
			'forum_message_ajout_description'              => 'Écrire un nouveau message dans le fil',
			'forum_message_ajout_notification_erreur_id'   => 'Impossible de publier un message sans fil parent',
			'forum_message_ajout_notification_erreur_type' => 'L\'id du fil ne correspond pas à un fil',
			'forum_message_ajout_formulaire_legend'        => 'Publier un message',
			'forum_message_ajout_formulaire_label_contenu' => 'Contenu',
			'forum_message_ajout_formulaire_submit'        => 'PUBLIER',
		/* validation_message_ajout */
			'forum_validation_message_ajout_notification_succes'                  => 'Le message a bien été publié',
			'forum_validation_message_ajout_notification_erreur_fil'              => 'L\'id du fil ne correspond pas à un fil',
			'forum_validation_message_ajout_notification_erreur_contenu_vide'     => 'Le contenu du message est vide',
			'forum_validation_message_ajout_notification_erreur_contenu_indefini' => 'Le formulaire a mal été remplit',
			'forum_validation_message_ajout_notification_erreur_id'               => 'Impossible de publier un message sans fil parent',
		/* message_edition */
			'forum_message_edition_titre'                            => 'Éditer un message',
			'forum_message_edition_description'                      => 'Édition d\'un message',
			'forum_message_edition_formulaire_legend'                => 'Éditer le message',
			'forum_message_edition_formulaire_label_contenu'         => 'Contenu',
			'forum_message_edition_formulaire_submit'                => 'Éditer',
			'forum_message_edition_notification_erreur_autorisation' => 'Vous n\'avez pas l\'autorisation d\'éditer ce message',
			'forum_message_edition_notification_erreur_id'           => 'Impossible d\'éditer un message sans son id',
		/* validation_message_edition */
			'forum_validation_message_edition_notification_succes'              => 'Le message a bien été édité',
			'forum_validation_message_edition_notification_erreur_autorisation' => 'Vous n\'avez pas l\'autorisation d\'éditer ce message',
			'forum_validation_message_edition_notification_erreur_vide'         => 'Le message ne peut pas être vide',
			'forum_validation_message_edition_notification_erreur_formulaire'   => 'Le formulaire a mal été remplit',
			'forum_validation_message_edition_notification_erreur_id'           => 'Impossible d\'éditer un message sans id',
		/* message_suppression */
			'forum_message_suppression_notification_succes'              => 'Le message a bien été supprimé',
			'forum_message_suppression_notification_erreur_autorisation' => 'Vous n\'avez pas l\'autorisation de supprimer ce message',
			'forum_message_suppression_notification_erreur_id'           => 'Impossible de supprimer un message sans id',
		/* suppression */
			'forum_suppression_notification_succes'              => 'Le noeud a bien été supprimé',
			'forum_suppression_notification_erreur_autorisation' => 'Vous n\'avez pas l\'autorisation de supprimer ce noeud',
			'forum_suppression_notification_erreur_id'           => 'Impossible de supprimer ce noeud',
	/* rss */
		/* post */
			'rss_post_title'       => 'Post',
			'rss_post_description' => 'Les derniers posts sur le site ',
);

?>