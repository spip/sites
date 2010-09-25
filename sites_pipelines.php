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

/**
 * Definir les meta de configuration liee aux syndications et sites
 *
 * @param array $metas
 * @return array
 */
function sites_configurer_liste_metas($metas){
	$metas['activer_sites']    = 'non';
	$metas['proposer_sites']   = 0;
	$metas['activer_syndic']   = 'oui';
	$metas['moderation_sites'] = 'non';
	return $metas;
}



/**
 * Permet des calculs de noms d'url sur les sites. 
 *
 * @param array $array liste des objets acceptant des urls
 * @return array
**/
function sites_declarer_url_objets($array){
	$array[] = 'site';
	$array[] = 'syndic';
	return $array;
}



/**
 * Taches periodiques de syndication 
 *
 * @param 
 * @return 
**/
function sites_taches_generales_cron($taches_generales){

	if ($GLOBALS['meta']["activer_syndic"] == "oui") {
		$taches_generales['syndic'] = 90; 
	}
		
	return $taches_generales;
}


/**
 * Optimiser la base de donnee en supprimant les liens orphelins
 *
 * @param int $n
 * @return int
 */
function sites_optimiser_base_disparus($flux){
	$n = &$flux['data'];



	sql_delete("spip_syndic", "maj < $mydate AND statut = 'refuse'");


	# les articles syndiques appartenant a des sites effaces
	$res = sql_select("S.id_syndic AS id",
		      "spip_syndic_articles AS S
		        LEFT JOIN spip_syndic AS syndic
		          ON S.id_syndic=syndic.id_syndic",
			"syndic.id_syndic IS NULL");

	$n+= optimiser_sansref('spip_syndic_articles', 'id_syndic', $res);
	

	return $flux;

}




/**
 * Definir la liste des champs de recherche sur la table syndic_articles 
 *
 * @param array $liste
 * @return array
 */
function sites_rechercher_liste_des_champs($liste){
	$liste['syndic_article'] = array(
	  'titre' => 5, 'descriptif' => 1
	);

	return $liste;
}

?>
