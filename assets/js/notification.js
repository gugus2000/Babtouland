(function(){
	function MessageFunc() {
		Notifications=document.getElementsByClassName('notification');
		if (Notifications[Notifications.length-1]) {
			Notification=Notifications[Notifications.length-1];
			Notification.addEventListener('click', function(Event)
			{
				Notification.parentElement.removeChild(Notification);
				MessageFunc();
			});
		}
	}
	window.addEventListener('load', MessageFunc, false);
})();