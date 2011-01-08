<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

// fonction pour le pipeline
function sites_autoriser() {}

// Moderer le forum ?
// = modifier l'objet correspondant (si forum attache a un objet)
// = droits par defaut sinon (admin complet pour moderation complete)
// http://doc.spip.org/@autoriser_modererforum_dist
function autoriser_moderersyndic_dist($faire, $type, $id, $qui, $opt) {
	return
		autoriser('modifier', $type, $id, $qui, $opt);
}


function autoriser_controle_syndic_bouton_dist($faire, $type, $id, $qui, $opt){
	return 	(sql_countsel('spip_syndic_articles'));
}




// Autoriser a modifier un site
// http://doc.spip.org/@autoriser_site_modifier_dist
function autoriser_site_modifier_dist($faire, $type, $id, $qui, $opt) {
	if ($qui['statut'] == '0minirezo' AND !$qui['restreint'])
		return true;

	$t = sql_fetsel("id_rubrique,statut", "spip_syndic", "id_syndic=".sql_quote($id));
	return ($t
		AND autoriser('voir','rubrique',$t['id_rubrique'])
		AND ($t['statut'] == 'prop'
			OR autoriser('modifier', 'rubrique', $t['id_rubrique'])
		)
	);
}
// Autoriser a voir un site $id_syndic
// http://doc.spip.org/@autoriser_site_voir_dist
function autoriser_site_voir_dist($faire, $type, $id, $qui, $opt) {
	return autoriser_site_modifier_dist($faire, $type, $id, $qui, $opt);
}
?>
