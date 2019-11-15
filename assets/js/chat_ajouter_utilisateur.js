(function(){
	var trie=new Trie();
	window.addEventListener('load', function(){
		xhr=new XMLHttpRequest();
		xhr.open('GET', '?application=xhr&action=liste_utilisateur');
		xhr.responseType="document";
		xhr.send(null);
		xhr.onload=function() {
			var content=xhr.responseXML.getElementsByTagName('body')[0].firstChild;
			var text=content.textContent || content.innerText;
			text=text.trim();
			liste_utilisateur=text.split('|');
			for (var i = liste_utilisateur.length - 1; i >= 0; i--) {
				trie.insert(liste_utilisateur[i]);
			}
			var boutonAjouter=document.getElementById('bouton_ajouter'),
				conteneurUtilisateur=document.getElementById('conteneur_utilisateur'),
				id=0;
			boutonAjouter.addEventListener('click', function(event){
				event.preventDefault();
				var utilisateur=document.createElement('div'),
					utilisateur_gauche=document.createElement('div'),
					utilisateur_input=document.createElement('input'),
					utilisateur_autocomplete=document.createElement('div'),
					utilisateur_moins=document.createElement('button'),
					utilisateur_moins_i=document.createElement('i'),
					utilisateur_moins_contenu=document.createTextNode('delete');
				utilisateur.setAttribute('class', 'utilisateur');
				utilisateur_gauche.setAttribute('class', 'gauche');
				utilisateur_moins.setAttribute('class', 'droite');
				utilisateur_autocomplete.setAttribute('class', 'autocomplete');
				utilisateur_input.setAttribute('type', 'text');
				utilisateur_input.setAttribute('name', 'utilisateur'+id.toString());
				utilisateur_moins_i.setAttribute('class', 'material-icons');
				utilisateur_input.addEventListener('keyup', function(event_input){
					var ancien_nodes=utilisateur_autocomplete.childNodes;
					for (var i = ancien_nodes.length - 1; i >= 0; i--) {
						ancien_nodes[i].remove();
					}
					var liste_autocomplete=trie.autoComplete(utilisateur_input.value);
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
				utilisateur.appendChild(utilisateur_gauche);
				utilisateur_moins_i.appendChild(utilisateur_moins_contenu);
				utilisateur_moins.appendChild(utilisateur_moins_i);
				utilisateur.appendChild(utilisateur_moins);
				utilisateur_moins.addEventListener('click', function(event_moins){
					event_moins.preventDefault();
					utilisateur_moins.parentNode.remove();
				});
				conteneur_utilisateur.appendChild(utilisateur);
				id++;
			});
		};
	}, false);
})()