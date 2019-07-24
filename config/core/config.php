<?php
$lang='FR';

$config=array(
	/* Paramètre par défaut modifiable */
		/* Page */
			'default_application' => 'user',
			'default_action'      => 'statut',
			'default_lang'        => $lang,
			'default_template'    => 'template/template.php',
			'default_css'         => array('assets/css/main.css', 'assets/css/reset.css', 'assets/css/normalize.css'),
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
			),
	/* Paramètre non modifiable */
		/* Général */
			'nom_site' => 'Babtouland',
		/* Session Guest */
			'nom_guest' => 'guest',
			'mdp_guest' => 'guest',
		/* Inscription */
			'default_avatar' => 'default.png',
			'default_banni'  => False,
			'default_role'   => 'membre',
		/* Message */
			'message_css'     => 'assets/css/message.css',
			'message_js'      => 'assets/js/message.js',
			'message_contenu' => 'assets/html/message.html',
);

?>