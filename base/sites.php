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
 * Interfaces des tables syndic et syndic article
 *
 * @param array $interfaces
 * @return array
 */
function sites_declarer_tables_interfaces($interfaces){

	$interfaces['table_des_tables']['sites']='syndic'; // compat pour les boucles (SITES)
	$interfaces['table_des_tables']['syndication']='syndic';
	$interfaces['table_des_tables']['syndic']='syndic';
	$interfaces['table_des_tables']['syndic_articles']='syndic_articles';

	# ne sert plus ? verifier balise_URL_ARTICLE
	$interfaces['exceptions_des_tables']['syndic_articles']['url_article']='url';
	# ne sert plus ? verifier balise_LESAUTEURS
	$interfaces['exceptions_des_tables']['syndic_articles']['lesauteurs']='lesauteurs';
	$interfaces['exceptions_des_tables']['syndic_articles']['url_site']=array('syndic', 'url_site');
	$interfaces['exceptions_des_tables']['syndic_articles']['nom_site']=array('syndic', 'nom_site');

	$interfaces['table_date']['syndication'] = 'date';
	$interfaces['table_date']['syndic_articles'] = 'date';

	$interfaces['table_titre']['site'] = "nom_site AS titre, '' AS lang";
	$interfaces['table_titre']['syndic'] = "nom_site AS titre, '' AS lang";

	$interfaces['tables_jointures']['spip_syndic_articles'][]= 'syndic';

	$interfaces['table_des_traitements']['NOM_SITE'][]=  _TRAITEMENT_TYPO;

	// Articles syndiques : passage des donnees telles quelles, sans traitement typo
	// la securite et conformite XHTML de ces champs est assuree par safehtml()
	foreach(array('DESCRIPTIF','SOURCE','URL','URL_SOURCE','LESAUTEURS','TAGS') as $balise)
		if (!isset($interfaces['table_des_traitements'][$balise]['syndic_articles']))
			$interfaces['table_des_traitements'][$balise]['syndic_articles'] = 'safehtml(%s)';
		else
			if (strpos($interfaces['table_des_traitements'][$balise]['syndic_articles'],'safehtml')==false)
				$interfaces['table_des_traitements'][$balise]['syndic_articles'] = 'safehtml('.$interfaces['table_des_traitements'][$balise]['syndic_articles'].')';

	return $interfaces;
}


/**
 * Table principale spip_syndic et spip_syndic_articles 
 *
 * @param array $tables_principales
 * @return array
 */
function sites_declarer_tables_principales($tables_principales){


	$spip_syndic = array(
			"id_syndic"	=> "bigint(21) NOT NULL",
			"id_rubrique"	=> "bigint(21) DEFAULT '0' NOT NULL",
			"id_secteur"	=> "bigint(21) DEFAULT '0' NOT NULL",
			"nom_site"	=> "text DEFAULT '' NOT NULL",
			"url_site"	=> "text DEFAULT '' NOT NULL",
			"url_syndic"	=> "text DEFAULT '' NOT NULL",
			"descriptif"	=> "text DEFAULT '' NOT NULL",
			"maj"	=> "TIMESTAMP",
			"syndication"	=> "VARCHAR(3) DEFAULT '' NOT NULL",
			"statut"	=> "varchar(10) DEFAULT '0' NOT NULL",
			"date"	=> "datetime DEFAULT '0000-00-00 00:00:00' NOT NULL",
			"date_syndic"	=> "datetime DEFAULT '0000-00-00 00:00:00' NOT NULL",
			"date_index"	=> "datetime DEFAULT '0000-00-00 00:00:00' NOT NULL",
			"moderation"	=> "VARCHAR(3) DEFAULT 'non'",
			"miroir"	=> "VARCHAR(3) DEFAULT 'non'",
			"oubli"	=> "VARCHAR(3) DEFAULT 'non'",
			"resume"	=> "VARCHAR(3) DEFAULT 'oui'"
	);

	$spip_syndic_key = array(
			"PRIMARY KEY"	=> "id_syndic",
			"KEY id_rubrique"	=> "id_rubrique",
			"KEY id_secteur"	=> "id_secteur",
			"KEY statut"	=> "statut, date_syndic",
	);
	$spip_syndic_join = array(
			"id_syndic"=>"id_syndic",
			"id_rubrique"=>"id_rubrique");
			
	$spip_syndic_articles = array(
			"id_syndic_article"	=> "bigint(21) NOT NULL",
			"id_syndic"	=> "bigint(21) DEFAULT '0' NOT NULL",
			"titre"	=> "text DEFAULT '' NOT NULL",
			"url"	=> "VARCHAR(255) DEFAULT '' NOT NULL",
			"date"	=> "datetime DEFAULT '0000-00-00 00:00:00' NOT NULL",
			"lesauteurs"	=> "text DEFAULT '' NOT NULL",
			"maj"	=> "TIMESTAMP",
			"statut"	=> "varchar(10) DEFAULT '0' NOT NULL",
			"descriptif"	=> "text DEFAULT '' NOT NULL",
			"lang"	=> "VARCHAR(10) DEFAULT '' NOT NULL",
			"url_source" => "TINYTEXT DEFAULT '' NOT NULL",
			"source" => "TINYTEXT DEFAULT '' NOT NULL",
			"tags" => "TEXT DEFAULT '' NOT NULL");

	$spip_syndic_articles_key = array(
			"PRIMARY KEY"	=> "id_syndic_article",
			"KEY id_syndic"	=> "id_syndic",
			"KEY statut"	=> "statut",
			"KEY url"	=> "url");
	$spip_syndic_articles_join = array(
			"id_syndic_article"=>"id_syndic_article",
			"id_syndic"=>"id_syndic");

	$tables_principales['spip_syndic'] =
		array('field' => &$spip_syndic, 'key' => &$spip_syndic_key, 'join' => &$spip_syndic_join);
	$tables_principales['spip_syndic_articles']	=
		array('field' => &$spip_syndic_articles, 'key' => &$spip_syndic_articles_key, 'join' => &$spip_syndic_articles_join);
	

	return $tables_principales;
}


/**
 * Declarer le surnom des syndic
 *
 * @param array $table
 * @return array
 */
function sites_declarer_tables_objets_surnoms($table){
	$table['syndic'] = 'syndic'; 
	$table['site'] = 'syndic';  # hum hum
	$table['syndic_article'] = 'syndic_articles';
	return $table;
}

/**
 * Declarer le surnom 'site' pour le type de spip_syndic
 * @param array $table
 * @return string
 */
function sites_declarer_type_surnoms($table){
	$table['syndic'] = 'site';
	return $table;
}

?>
