<?php ob_start(); ?>
	<nav class="menu-up">
		<div class="grand-ecran">
			<div class="element gros ligne">
				<div class="colonne">
					<a href="?" title="<?= $lang['menu-up_accueil'] ?>">
						<div class="banniere_babtouland">
							<div class="colonne">
								<img src="assets/img/icone/icone-transparent.png" alt="<?= $lang['menu-up_altlogo'] ?><?= $config['nom_site'] ?>" class="logo_babtouland" />
							</div>
							<h1><?= $config['nom_site'] ?></h1>
						</div>
					</a>
				</div>
			</div>
			<?= afficherLiens($config['menu-up_liens'], $lang['menu-up_titres'], $lang['menu-up_affichages'], 'grand-ecran') ?>
			<div class="element ligne">
				<div class="colonne">
					<div class="dropdown">
						<div class="menu">
							<a href="#"><?= $lang['lang_self']['full'] ?></a>
						</div>
						<div class="items">
							<?php
							foreach ($lang['lang_others'] as $language)
							{
								$link='&lang=';
								if(!$_GET & !$_SERVER['REQUEST_URI'][strlen($_SERVER['REQUEST_URI'])-1]=='?')
								{
									$link='?lang=';
								}
								?>
							<a href="<?= $_SERVER['REQUEST_URI'].$link. $language['abbr'] ?>"><?= $language['full'] ?></a>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			<div class="element ligne">
				<div class="colonne">
					<a href="<?= $config['menu-up_lien-statut'] ?>" title="<?= $Visiteur->afficherPseudo() ?>" class="avatar"><img src="assets/img/avatar/<?= $Visiteur->afficherAvatar() ?>" alt="<?= $lang['menu-up_avatar'] ?>"></a>
				</div>
			</div>
			</div>
		</div>
		<div class="petit-ecran">
			<a href="#" class="petit-ecran-menu"><i class="material-icons petit-ecran-menu">menu</i></a>
			<div class="lien" style="visibility: hidden;">
				<?= afficherLiens($config['menu-up_liens'], $lang['menu-up_titres'], $config['menu-up_icones'], 'petit-ecran'); ?>
			</div>
		</div>
	</nav>
<?php $Contenu=ob_get_clean(); // $Contenu et pas $contenu ?>