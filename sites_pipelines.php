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

?>
