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

if (!defined("_ECRIRE_INC_VERSION")) return;

// http://doc.spip.org/@action_editer_site_dist
function action_editer_site_dist($arg=null) {

	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}
	$resyndiquer = false;

	include_spip('inc/filtres'); // pour vider_url()

	if ($id_syndic = intval($arg)) {
		// resyndiquer si resume modifie et pas deja un reload demande
		if (!_request('reload') AND _request('resume') AND _request('resume') != sql_getfetsel('resume', 'spip_syndic', "id_syndic=".intval($id_syndic)))
			$resyndiquer = true;
		revisions_sites($id_syndic);
	
	}
	// Cas de la creation d'un site
	elseif (strlen(vider_url(_request('url_site')))
	          AND strlen(_request('nom_site'))) {
		set_request('reload', 'oui');
		$id_syndic = insert_syndic(_request('id_parent'));
		revisions_sites($id_syndic);
		if ($logo = _request('logo')
		  AND $format_logo = _request('format_logo')) {
			@rename($logo,_DIR_IMG . 'siteon'.$id_syndic.'.'.$format_logo);
		}
	}
	// Erreur
	else {
		if (!_request('redirect'))
			return array(0,'');
		include_spip('inc/headers');
		redirige_url_ecrire();
	}

	// Re-syndiquer le site
	if (_request('reload') == 'oui') {
		// Effacer les messages si on supprime la syndication
		if (_request('syndication') == 'non')
			sql_delete("spip_syndic_articles", "id_syndic=".sql_quote($id_syndic));

		$t = sql_getfetsel('descriptif', 'spip_syndic', "id_syndic=$id_syndic AND syndication IN ('oui', 'sus', 'off')", '','', 1);
		if ($t !== NULL) {

			// Si descriptif vide, chercher le logo si pas deja la
			$chercher_logo = charger_fonction('chercher_logo', 'inc');
			if (!$logo = $chercher_logo($id_syndic, 'id_syndic', 'on')
			OR !$t) {
				if ($auto = vider_url(_request('url_auto'))) {
					$auto = analyser_site($auto);
					if (!strlen($t) AND strlen($auto['descriptif']))
						revisions_sites($id_syndic, array('descriptif' => $auto['descriptif']));
				}
				if (!$logo
				AND $auto['logo'] AND $auto['format_logo']){
					include_spip('inc/distant');
					@rename($auto['logo'],
					_DIR_IMG . 'siteon'.$id_syndic.'.'.$auto['format_logo']);
				}
			}
			
			$resyndiquer = true;
		}
	}

	if ($resyndiquer) {
		$syndiquer_site = charger_fonction('syndiquer_site','action');
	  $syndiquer_site($id_syndic);
	}

	if (_request('redirect')) {
		$redirect = parametre_url(urldecode(_request('redirect')),'id_syndic', $id_syndic, '&');
		include_spip('inc/headers');
		redirige_par_entete($redirect);
	}
	else 
		return array($id_syndic,'');
}

// Cette fonction redefinit la tache standard de syndication
// pour la forcer a syndiquer le site dans la globale genie_syndic_now

// http://doc.spip.org/@genie_syndic
function genie_syndic($t) {
	include_spip('genie/syndic');
	define('_GENIE_SYNDIC', 2); // Pas de faux message d'erreur
	$t = syndic_a_jour(_GENIE_SYNDIC_NOW);
	return $t ? 0 : _GENIE_SYNDIC_NOW;
}

// http://doc.spip.org/@insert_syndic
function insert_syndic($id_rubrique) {

	include_spip('inc/rubriques');

	// Si id_rubrique vaut 0 ou n'est pas definie, creer le site
	// dans la premiere rubrique racine
	if (!$id_rubrique = intval($id_rubrique)) {
		$id_rubrique = sql_getfetsel("id_rubrique", "spip_rubriques", "id_parent=0",'', '0+titre,titre', "1");
	}

	// Le secteur a la creation : c'est le secteur de la rubrique

	$id_secteur = sql_getfetsel("id_secteur", "spip_rubriques", "id_rubrique=".intval($id_rubrique));

	$champs = array(
		'id_rubrique' => $id_rubrique,
		'id_secteur' => $id_secteur,
		'statut' => 'prop',
		'date' => date('Y-m-d H:i:s'));
	
	// Envoyer aux plugins
	$champs = pipeline('pre_insertion',
		array(
			'args' => array(
				'table' => 'spip_syndic',
			),
			'data' => $champs
		)
	);

	$id_syndic = sql_insertq("spip_syndic", $champs);
	pipeline('post_insertion',
		array(
			'args' => array(
				'table' => 'spip_syndic',
				'id_objet' => $id_syndic
			),
			'data' => $champs
		)
	);

	return $id_syndic;
}


// Enregistre une revision de syndic
// $c est un contenu (par defaut on prend le contenu via _request())
// http://doc.spip.org/@revisions_sites
function revisions_sites($id_syndic, $c=false) {

	include_spip('inc/rubriques');

	// champs normaux
	if ($c === false) {
		$c = array();
		foreach (array(
			'nom_site', 'url_site', 'descriptif', 'url_syndic', 'syndication', 'statut', 'id_parent',
		  'moderation','miroir','oubli','resume'
		) as $champ)
			if (($a = _request($champ)) !== null)
				$c[$champ] = $a;
	}

	// Si le site est publie, invalider les caches et demander sa reindexation
	$t = sql_getfetsel("statut", "spip_syndic", "id_syndic=".intval($id_syndic));
	if ($t == 'publie') {
		$invalideur = "id='site/$id_syndic'";
		$indexation = true;
	}
	include_spip('inc/modifier');

	modifier_contenu('syndic', $id_syndic,
		array(
			'nonvide' => array('nom_site' => _T('info_sans_titre')),
			'invalideur' => $invalideur,
			'indexation' => $indexation
		),
		$c);


	$row = sql_fetsel("statut, id_rubrique, id_secteur", "spip_syndic", "id_syndic=".intval($id_syndic));
	$id_rubrique = $row['id_rubrique'];
	$statut_ancien = $row['statut'];
	$id_secteur_old = $row['id_secteur'];

	$statut = $c['statut'];

	if ($statut
	  AND $statut != $statut_ancien
	  AND autoriser('publierdans','rubrique',$id_rubrique)) {
		$champs['statut'] = $statut;
		if ($statut == 'publie') {
			if ($d = _request('date', $c)) {
				$champs['date'] = $d;
			} else {
				$champs['date'] = date('Y-m-d H:i:s');
			}
		}
	} else
		$statut = $statut_ancien;

	// Changer de rubrique ?
	// Verifier que la rubrique demandee est differente de l'actuelle,
	// et qu'elle existe. Recuperer son secteur

	if ($id_parent = intval(_request('id_parent', $c))
	  AND $id_parent != $id_rubrique
	  AND ($id_secteur = sql_getfetsel('id_secteur', 'spip_rubriques', "id_rubrique=".intval($id_parent)))) {
		$champs['id_rubrique'] = $id_parent;
		if ($id_secteur_old != $id_secteur)
			$champs['id_secteur'] = $id_secteur;
		// si le site est publie
		// et que le demandeur n'est pas admin de la rubrique
		// repasser le site en statut 'prop'.
		if ($statut == 'publie') {
			if (!autoriser('publierdans','rubrique',$id_parent))
				$champs['statut'] = $statut = 'prop';
		}
	}

	if (!$champs) return;

	// Enregistrer les modifications
	sql_updateq('spip_syndic', $champs, "id_syndic=".intval($id_syndic));

	// Invalider les caches
	if ($statut == 'publie') {
		include_spip('inc/invalideur');
		suivre_invalideur("id='site/$id_syndic'");
	}

	// Notifications
	if ($notifications = charger_fonction('notifications', 'inc')) {
		$notifications('instituersite', $id_syndic,
			array('statut' => $statut, 'statut_ancien' => $statut_ancien, 'date'=>($champs['date']?$champs['date']:$row['date']))
		);
	}

	include_spip('inc/rubriques');
	calculer_rubriques_if($id_rubrique, $champs, $statut_ancien);
}


?>