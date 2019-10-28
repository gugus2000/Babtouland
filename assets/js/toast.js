function ToastFunc(){
	Toast_enroule=document.getElementsByClassName('closed')[0];
	Toast_deroule=document.getElementsByClassName('open')[0];
	toast_visibility='hidden';
	Toast_enroule.addEventListener('click', function (Event) {
		if (toast_visibility=='hidden')
		{
			toast_visibility='visible';
		}
		else
		{
			toast_visibility='hidden';
		}
		Event.preventDefault();
		Toast_deroule.setAttribute('style', 'visibility: '+toast_visibility+';');
	});
}

window.addEventListener('load', ToastFunc, false)