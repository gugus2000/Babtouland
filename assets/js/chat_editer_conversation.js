(function(){
	var trie_edit=new Trie();
	function EventMoins(element_moins)
	{
		element_moins.addEventListener('click', function(event_moins){
			event_moins.preventDefault();
			element_moins.parentNode.remove();
		});
	}
	var url=window.location.href,
		regex_id=new RegExp('id=([0-9]+)&?');
	var id=regex_id.exec(url)[1];
	window.addEventListener('load', function(){	
		xhr_edit=new XMLHttpRequest();
		xhr_edit.open('GET', '?force_routage=0&application=xhr&action=liste_membre_conv&id='+encodeURIComponent(id));
		xhr_edit.responseType="document";
		xhr_edit.send(null);
		xhr_edit.onload=function() {
			var content=xhr_edit.responseXML.getElementsByTagName('body')[0].firstChild;
			var text_edit=content.textContent || content.innerText;
			text_edit=text_edit.trim();
			liste_membre_conv_edit=text_edit.split('|');
			for (var i = liste_membre_conv_edit.length - 1; i >= 0; i--) {
				trie_edit.insert(liste_membre_conv_edit[i]);
			}
			var conteneurUtilisateur=document.getElementById('conteneur_utilisateur'),
				id=-1;
			for (var i = liste_membre_conv_edit.length - 1; i >= 0; i--) {
				var utilisateur_edit=document.createElement('div'),
					utilisateur_gauche=document.createElement('div'),
					utilisateur_input=document.createElement('input'),
					utilisateur_autocomplete=document.createElement('div'),
					utilisateur_moins_edit=document.createElement('button'),
					utilisateur_moins_i=document.createElement('i'),
					utilisateur_moins_contenu=document.createTextNode('delete');
				utilisateur_edit.setAttribute('class', 'utilisateur');
				utilisateur_gauche.setAttribute('class', 'gauche');
				utilisateur_moins_edit.setAttribute('class', 'droite');
				utilisateur_autocomplete.setAttribute('class', 'autocomplete');
				utilisateur_input.setAttribute('type', 'text');
				utilisateur_input.setAttribute('name', 'utilisateur'+id.toString());
				utilisateur_input.setAttribute('value', liste_membre_conv_edit[i]);
				utilisateur_moins_i.setAttribute('class', 'material-icons');
				utilisateur_input.addEventListener('keyup', function(event_input){
					var ancien_nodes=utilisateur_autocomplete.childNodes;
					for (var i = ancien_nodes.length - 1; i >= 0; i--) {
						ancien_nodes[i].remove();
					}
					var liste_autocomplete=trie_edit.autoComplete(utilisateur_input.value);
					if (liste_autocomplete.length!=1 || liste_autocomplete[0]!=utilisateur_input.value)
					{
						for (var i = liste_autocomplete.length - 1; i >= 0; i--) {
							var utilisateur_nom_autocomplete=document.createTextNode(liste_autocomplete[i]),
								utilisateur_div_autocomplete=document.createElement('div');
							utilisateur_div_autocomplete.addEventListener('click', function(event_div_autocomplete){
								utilisateur_input.value=event_div_autocomplete.target.textContent || event_div_autocomplete.srcElement.innerText;
							});
							utilisateur_div_autocomplete.appendChild(utilisateur_nom_autocomplete);
							utilisateur_autocomplete.appendChild(utilisateur_div_autocomplete);
						}
					}
					document.addEventListener('click', function(event_all){
						if (event_all.target!=utilisateur_input && event_all.target!=liste_autocomplete && event_all.target!=utilisateur_gauche)
						{
							var nodes_actuels=utilisateur_autocomplete.childNodes,
								est_dans_liste=false;
							for (var i = nodes_actuels.length - 1; i >= 0; i--) {
								if (nodes_actuels[i]==event_all.target)
								{
									est_dans_liste=true;
									break;
								}
							}
							if (!est_dans_liste)
							{
								for (var i = nodes_actuels.length - 1; i >= 0; i--) {
									nodes_actuels[i].remove();
								}
							}
						}
					})
				});
				utilisateur_gauche.appendChild(utilisateur_input);
				utilisateur_gauche.appendChild(utilisateur_autocomplete);
				utilisateur_edit.appendChild(utilisateur_gauche);
				utilisateur_moins_i.appendChild(utilisateur_moins_contenu);
				utilisateur_moins_edit.appendChild(utilisateur_moins_i);
				utilisateur_edit.appendChild(utilisateur_moins_edit);
				EventMoins(utilisateur_moins_edit);
				conteneur_utilisateur.appendChild(utilisateur_edit);
				id--;
			};
		}
	}, false);
})()