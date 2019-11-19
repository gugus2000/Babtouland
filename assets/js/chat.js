(function (){
	var url=window.location.href,
		regex_id=new RegExp('id=([0-9]+)&?'),
		date_dernier_chargement=getDate(),
		Chat,
		childs;

	var id=regex_id.exec(url)[1];

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
				for (var i = 0; i < childs.length; i++) {		// Pourquoi 4? no sé
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
		xhr.open('GET', '?application=xhr&action=chat&id='+encodeURIComponent(id)+'&date_chargement='+encodeURIComponent(date_dernier_chargement));
		xhr.responseType="document";
		xhr.send(null);
		setTimeout('mettre_a_jour()', 10000);
	}
	window.addEventListener('load', scrollerbas, false);
	setTimeout('mettre_a_jour()', 10000);
})()