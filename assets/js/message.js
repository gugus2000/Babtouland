Message=document.getElementsByClassName('warning-box')[0];
Message.addEventListener('click', function(Event)
{
	Message.parentElement.removeChild(Message);
});