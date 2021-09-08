<?php

/***************************************************************************\
 *  SPIP, Système de publication pour l'internet                           *
 *                                                                         *
 *  Copyright © avec tendresse depuis 2001                                 *
 *  Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribué sous licence GNU/GPL.     *
 *  Pour plus de détails voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}  #securite

// Le contexte indique dans quelle rubrique le visiteur peut proposer le site


// https://code.spip.net/@balise_FORMULAIRE_SITE
function balise_FORMULAIRE_SITE($p) {
	return calculer_balise_dynamique($p, 'FORMULAIRE_SITE', ['id_rubrique']);
}

// https://code.spip.net/@balise_FORMULAIRE_SITE_stat
function balise_FORMULAIRE_SITE_stat($args, $context_compil) {

	// Pas d'id_rubrique ? Erreur de contexte
	if (!$args[0]) {
		$msg = [
			'zbug_champ_hors_motif',
			[
				'champ' => 'FORMULAIRE_SITE',
				'motif' => 'RUBRIQUES'
			]
		];
		erreur_squelette($msg, $context_compil);

		return '';
	}

	// Verifier que les visisteurs sont autorises a proposer un site

	return (($GLOBALS['meta']['proposer_sites'] != 2) ? '' : $args);
}
