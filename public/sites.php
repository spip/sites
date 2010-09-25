<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2009                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/


//
// <BOUCLE(SYNDICATION)>
//
// http://doc.spip.org/@boucle_SYNDICATION_dist
function boucle_SYNDICATION_dist($id_boucle, &$boucles) {
	$boucle = &$boucles[$id_boucle];
	$id_table = $boucle->id_table;
	$mstatut = $id_table .'.statut';

	// Restreindre aux elements publies

	if (!isset($boucle->modificateur['criteres']['statut'])) {
		if (!$GLOBALS['var_preview']) {
			array_unshift($boucle->where,array("'='", "'$mstatut'", "'\\'publie\\''"));
		} else
			array_unshift($boucle->where,array("'IN'", "'$mstatut'", "'(\\'publie\\',\\'prop\\')'"));
	}
	return calculer_boucle($id_boucle, $boucles); 
}

function boucle_SITES_dist($id_boucle, &$boucles) {
	$boucle = &$boucles[$id_boucle];
	$boucle->type_requete = 'syndication'; // pas sur que ce soit indispensable
	if (!function_exists($f='boucle_SYNDICATION'))
		$f.='_dist';
	return $f($id_boucle, $boucles);
}
//
// <BOUCLE(SYNDIC_ARTICLES)>
//
// http://doc.spip.org/@boucle_SYNDIC_ARTICLES_dist
function boucle_SYNDIC_ARTICLES_dist($id_boucle, &$boucles) {
	$boucle = &$boucles[$id_boucle];
	$id_table = $boucle->id_table;
	$mstatut = $id_table .'.statut';

	// Restreindre aux elements publies, sauf critere contraire
	if (isset($boucle->modificateur['criteres']['statut']) AND $boucle->modificateur['criteres']['statut']) {}
	else if ($GLOBALS['var_preview'])
		array_unshift($boucle->where,array("'IN'", "'$mstatut'", "'(\\'publie\\',\\'prop\\')'"));
	else {
		$jointure = array_search("spip_syndic", $boucle->from);
		if (!$jointure) {
			fabrique_jointures($boucle, array(array($id_table, array('spip_syndic'), 'id_syndic')), true, $boucle->show, $id_table);
			$jointure = array_search('spip_syndic', $boucle->from);
		}
		array_unshift($boucle->where,array("'='", "'$mstatut'", "'\\'publie\\''"));
		$boucle->where[]= array("'='", "'$jointure" . ".statut'", "'\\'publie\\''");

	}
	return calculer_boucle($id_boucle, $boucles);
}


?>
