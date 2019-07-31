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
	Event.preventDefault();
	Menu_deroule.setAttribute('style', 'visibility: '+visibility+';');
});