window.addEventListener('load', function () {
	var xhr=new XMLHttpRequest();
	xhr.open('GET', '?force_routage=0&application=xhr&action=lang&clef=chat_hub_survol_connectes');
	xhr.responseType="document";
	xhr.send(null);
	xhr.onload=function() {
		var content=xhr.responseXML.getElementsByTagName('body')[0].firstChild;
		var text_connectes=content.textContent || content.innerText;
			text_connectes=text_connectes.trim();
		xhr.open('GET', '?force_routage=0&application=xhr&action=lang&clef=chat_hub_survol_total');
		xhr.responseType="document";
		xhr.send(null);
		xhr.onload=function() {
			var content=xhr.responseXML.getElementsByTagName('body')[0].firstChild;
			var text_total=content.textContent || content.innerText;
			text_total=text_total.trim();

			var divs=document.getElementsByClassName('survol_connecte'),
				affichage=document.createElement('div');
			texte=document.createTextNode(text_connectes);
			affichage.appendChild(texte);
			affichage.setAttribute('class', 'survol');
			survols(divs, affichage);
			var divs=document.getElementsByClassName('survol_total'),
				affichage=document.createElement('div');
			texte=document.createTextNode(text_total);
			affichage.appendChild(texte);
			affichage.setAttribute('class', 'survol');
			survols(divs, affichage);
		}
	};
});