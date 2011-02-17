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


/**
 * Ajouter les sites et syndication a valider sur les rubriques 
 *
 * @param 
 * @return 
**/
function sites_rubrique_encours($flux){
	if ($flux['args']['type'] == 'rubrique') {
		$lister_objets = charger_fonction('lister_objets','inc');

		$id_rubrique = $flux['args']['id_objet'];
	
		//
		// Les sites references a valider
		//
		if ($GLOBALS['meta']['activer_sites'] != 'non') {
			$flux['data'] .= $lister_objets('sites',array('titre'=> _T('info_site_valider') ,'statut'=>'prop','id_rubrique'=>$id_rubrique, 'par'=>'nom_site'));
		}

		//
		// Les sites a probleme
		//
		if ($GLOBALS['meta']['activer_sites'] != 'non'
		AND autoriser('publierdans','rubrique',$id_rubrique)) {
			$flux['data'] .= $lister_objets('sites',array('titre'=> _T('avis_sites_syndiques_probleme') ,'statut'=>'publie', 'syndication'=>array('off','sus'),'id_rubrique'=>$id_rubrique, 'par'=>'nom_site'));
		}

		// Les articles syndiques en attente de validation
		if ($id_rubrique == 0
		AND autoriser('publierdans','rubrique',$id_rubrique)) {

			$cpt = sql_countsel("spip_syndic_articles", "statut='dispo'");
			if ($cpt)
				$flux['data'] .= "<br /><small><a href='" .
					generer_url_ecrire("sites") .
					"' style='color: black;'>" .
					$cpt .
					" " .
					_T('info_liens_syndiques_1') .
					" " .
					_T('info_liens_syndiques_2') .
					"</a></small>";
		}
	}
	
	return $flux;
}


/**
 * Ajouter les sites et syndication a valider sur la page d'accueil 
 *
 * @param 
 * @return 
**/
function sites_accueil_encours($flux){
	$lister_objets = charger_fonction('lister_objets','inc');
	
	//
	// Les sites references a valider
	//
	if ($GLOBALS['meta']['activer_sites'] != 'non') {
		$flux .= $lister_objets('sites',array('titre'=>afficher_plus_info(generer_url_ecrire('sites')). _T('info_site_valider') ,'statut'=>'prop', 'par'=>'nom_site'));
	}

	if ($GLOBALS['visiteur_session']['statut'] == '0minirezo') {
		//
		// Les sites a probleme
		//
		if ($GLOBALS['meta']['activer_sites'] != 'non') {
			$flux .= $lister_objets('sites',array('titre'=>afficher_plus_info(generer_url_ecrire('sites')). _T('avis_sites_syndiques_probleme') ,'statut'=>'publie', 'syndication'=>array('off','sus'), 'par'=>'nom_site'));
		}

		// Les articles syndiques en attente de validation
		$cpt = sql_countsel("spip_syndic_articles", "statut='dispo'");
		if ($cpt)
			$flux .= "\n<br /><small><a href='"
			. generer_url_ecrire("sites","")
			. "' style='color: black;'>"
			. $cpt
			. " "
			. _T('info_liens_syndiques_1')
			. " "
			. _T('info_liens_syndiques_2')
			. "</a></small>";

	}
	return $flux;
}


/**
 * Ajouter les sites references sur les vues de rubriques
 *
 * @param 
 * @return 
**/
function sites_affiche_enfants($flux) {
	global $spip_lang_right;
	
	if ($flux['args']['exec'] == 'naviguer') {
		$id_rubrique = $flux['args']['id_rubrique'];
  
		if ($GLOBALS['meta']["activer_sites"] == 'oui') {
			$lister_objets = charger_fonction('lister_objets','inc');
			$bouton_sites = '';
			if (autoriser('creersitedans','rubrique',$id_rubrique)) {
				$bouton_sites .= icone_inline(_T('info_sites_referencer'), generer_url_ecrire('site_edit', "id_rubrique=$id_rubrique"), "site-24.png", "new", $spip_lang_right)
					. "<br class='nettoyeur' />";
			}
			
			$flux['data'] .= $lister_objets('sites',array('titre'=>_T('titre_sites_references_rubrique') ,'where'=>"statut!='refuse' AND statut != 'prop' AND syndication NOT IN ('off','sus')", 'id_rubrique'=>$id_rubrique,'par'=>'nom_site'));
			$flux['data'] .= $bouton_sites;
		}
	}
	return $flux;
}



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
 * Publier et dater les rubriques qui ont un site publie
 * 
 * @param <type> $flux
 * @return <type>
 */
function sites_calculer_rubriques($flux) {
	
	$r = sql_select("R.id_rubrique AS id, max(A.date) AS date_h", "spip_rubriques AS R, spip_syndic AS A", "R.id_rubrique = A.id_rubrique AND R.date_tmp <= A.date AND A.statut='publie' ", "R.id_rubrique");
	while ($row = sql_fetch($r))
		sql_updateq('spip_rubriques', array('statut_tmp'=>'publie', 'date_tmp'=>$row['date_h']),"id_rubrique=".$row['id']);

	return $flux;
}

/**
 * Compter les sites dans une rubrique
 * 
 * @param array $flux
 * @return array
 */
function sites_objet_compte_enfants($flux){
	if ($flux['args']['objet']=='rubrique'
	  AND $id_rubrique=intval($flux['args']['id_objet'])) {
		// juste les publies ?
		if (array_key_exists('statut', $flux['args']) and ($flux['args']['statut'] == 'publie')) {
			$flux['data']['site'] = sql_countsel('spip_syndic', "id_rubrique=".intval($id_rubrique)." AND (statut='publie')");
		} else {
			$flux['data']['site'] = sql_countsel('spip_syndic', "id_rubrique=".intval($id_rubrique)." AND (statut='publie' OR statut='prop')");
		}
	}
	return $flux;
}


function sites_trig_propager_les_secteurs($flux){
	// reparer les sites
	$r = sql_select("A.id_syndic AS id, R.id_secteur AS secteur", "spip_syndic AS A, spip_rubriques AS R", "A.id_rubrique = R.id_rubrique AND A.id_secteur <> R.id_secteur");
	while ($row = sql_fetch($r))
		sql_update("spip_syndic", array("id_secteur" => $row['secteur']), "id_syndic=".$row['id']);

	return $flux;
}


?>
