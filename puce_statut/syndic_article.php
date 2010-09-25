<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-200                                                 *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined("_ECRIRE_INC_VERSION")) return;



// http://doc.spip.org/@puce_statut_syndic_article_dist
function puce_statut_syndic_article_dist($id_syndic, $statut, $id_rubrique, $type, $ajax=''){
	if ($statut=='publie') {
		$puce='puce-verte.gif';
	}
	else if ($statut == "refuse") {
		$puce = 'puce-poubelle.gif';
	}
	else if ($statut == "dispo") { // moderation : a valider
		$puce = 'puce-rouge.gif';
	}
	else  // i.e. $statut=="off" feed d'un site en mode "miroir"
		$puce = 'puce-rouge-anim.gif';

	return http_img_pack($puce, $statut, "class='puce'");
}



?>