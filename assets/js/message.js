function MessageFunc() {
	Message=document.getElementsByClassName('message')[0];
	Message.addEventListener('click', function(Event)
	{
		Message.parentElement.removeChild(Message);
	});
}

window.addEventListener('load', MessageFunc, false)