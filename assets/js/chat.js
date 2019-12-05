window.addEventListener('load', function () {

	function getDate()
	{
		var date=new Date(Date.now());
		var iso = date.toISOString().match(/(\d{4}\-\d{2}\-\d{2})T(\d{2}:\d{2}:\d{2})/);
		date=iso[1]+' '+iso[2];
		return date;
	}

	function scrollerbas() {
		Chat=document.getElementById('chat');
		Chat.scrollTop=Chat.scrollHeight;
	}

	function mettre_a_jour() {
		xhr=new XMLHttpRequest();
		xhr.onload=function() {
			childs=xhr.responseXML.getElementById('chat').childNodes;
			if (childs.length>1)
			{
				for (var i = 0; i < childs.length; i++) {
					if (childs.nodeType==1)	//  pas Noeuds textuels (utile)
					{
						Chat.appendChild(childs[0]);
					}
					else
					{
						i--;
						Chat.appendChild(childs[0]);
					}
				}
				date_dernier_chargement=getDate();
			}
		}
		xhr.open('GET', '?force_routage=0&application=xhr&action=chat&id='+encodeURIComponent(id)+'&date_chargement='+encodeURIComponent(date_dernier_chargement));
		xhr.responseType="document";
		xhr.send(null);
	}
	var url=window.location.href,
		date_dernier_chargement=getDate(),
		Chat,
		childs,
		id=parseInt((document.getElementById('id_chat').textContent || document.getElementById('id_chat').innerText), 10);
	setTimeout('mettre_a_jour()', 10000);
	scrollerbas();
});
