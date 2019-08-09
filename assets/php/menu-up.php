<?php ob_start(); ?>
	<nav class="menu-up">
		<div class="conteneur">
			<div class="grand-ecran">
				<a href="?" title="<?= $lang['menu-up_accueil'] ?>">
					<div class="banniere_babtouland">
						<img src="assets/img/logo/logox90px.png" alt="<?= $lang['menu-up_altlogo'] ?><?= $config['nom_site'] ?>" class="logo_babtouland" />
						<h1><?= $config['nom_site'] ?></h1>
					</div>
				</a>
				<div class="lien">
					<?= afficherLiens($config['menu-up_liens'], $lang['menu-up_titres'], $lang['menu-up_affichages'], 'grand-ecran'); ?>
					<a href="<?= $config['menu-up_lien-statut'] ?>" title="<?= $Visiteur->afficherPseudo() ?>" class="image"><img src="assets/img/avatar/<?= $Visiteur->afficherAvatar() ?>" alt="<?= $lang['menu-up_avatar'] ?>"></a>
				</div>
			</div>
			<div class="petit-ecran">
				<a href="#" class="petit-ecran-menu"><i class="material-icons petit-ecran-menu">menu</i></a>
				<div class="lien" style="visibility: hidden;">
					<?= afficherLiens($config['menu-up_liens'], $lang['menu-up_titres'], $config['menu-up_icones'], 'petit-ecran'); ?>
				</div>
			</div>
		</div>
	</nav>
<?php $Contenu=ob_get_clean(); // $Contenu et pas $contenu ?>