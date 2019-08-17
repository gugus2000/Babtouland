Message=document.getElementsByClassName('message')[0];
Message.addEventListener('click', function(Event)
{
	Message.parentElement.removeChild(Message);
});