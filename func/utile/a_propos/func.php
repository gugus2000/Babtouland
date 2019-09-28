<?php

/**
 * permet l'affichage des questions-répones dans la page à propos
 *
 * @param array questions_reponses Liste des pageElement des questions et réponses
 *
 * @return string
 * @author gugus2000
 **/
function contenuAfficher($questions_reponses)
{
	$affichage='';
	foreach ($questions_reponses as $question_reponse)
	{
		$affichage.=$question_reponse->afficher();
	}
	return $affichage;
}

?>