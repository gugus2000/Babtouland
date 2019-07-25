Menu_enroule=document.getElementsByClassName('petit-ecran-menu')[0];
Menu_deroule=document.getElementsByClassName('lien-item')[0].parentElement;
visibility='hidden';
Menu_enroule.addEventListener('click', function (Event) {
	if (visibility=='hidden')
	{
		visibility='visible';
	}
	else
	{
		visibility='hidden';
	}
	Menu_deroule.setAttribute('style', 'visibility: '+visibility+';');
});