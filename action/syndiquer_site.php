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
function action_syndiquer_site_dist($id_syndic=null) {

	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$id_syndic = $securiser_action();
	}

	if ($id_syndic=intval($id_syndic)) {
	  // ah si PHP connaisait les fermetures...
	  // A la place, une constante utilisee exclusivement
	  // dans la fct suivante.
		define('_GENIE_SYNDIC_NOW', $id_syndic);
		// forcer l'execution immediate de cette tache
		// (i.e. appeler la fct suivante avec gestion du verrou)
		cron(0, array('syndic' => -91));
	}
}

?>