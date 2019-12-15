function ajouter_survol(div, affichage) {
	div.addEventListener('mouseenter', function (event) {
		div.appendChild(affichage);
	});
	div.addEventListener('mouseleave', function (event_1) {
		if (affichage.parentNode)
		{
			affichage.parentNode.removeChild(affichage);
		}
	});
	div.addEventListener('mousemove', function (event_2) {
		affichage.setAttribute('style', 'position: absolute;left: '+event_2.pageX+'px;top: '+(event_2.pageY+10)+'px;');
	});
}
function survols(divs, affichage) {
	for (var i = divs.length - 1; i >= 0; i--) {
		(function () {
			var div=divs[i];
			ajouter_survol(div, affichage);
		}())
	}
}